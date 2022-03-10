<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\CheckoutDetails;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Subcategory;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends FrontBaseController
{
    function add(Request  $request){
       $product = Product::find($request->product_id);
        Cart::add(['id' =>$request->product_id , 'name' => $product->title, 'qty' => $request->qty, 'price' => $product->price-$product->discount, 'weight' =>1 , 'options' => $request->attribute]);
        $request->session()->flash('success','Item added into cart successfully');
        return redirect()->route('frontend.product',$product->slug);
    }

    function  index(){
        $data['carts'] = Cart::content();
        return view($this->__loadDataToView('frontend.cart.index'),compact('data'));
    }

    function  update(Request  $request){
        Cart::update($request->rowId, $request->qty);
        $request->session()->flash('success','Cart updated successfully');
        return redirect()->route('cart.index');
    }


    function  applyCoupon(Request  $request){
        $date = date('Y-m-d');
        $coupon = Coupon::where('status',1)->where('code',$request->code)->where('date_from', '<=' ,$date  )->where('date_to', '>=' ,$date  )->first();
        $discount = 0;
        $items = Cart::content();
        $subtotal = 0;
        foreach ($items as $item)
        {
            $subtotal += $item->qty  * $item->price;
        }
        if ($coupon){
            $request->session()->put('coupon_code' , $coupon->code );
            $request->session()->put('discount_percentage' , $coupon->discount_percentage );
            $discount = ($subtotal * $coupon->discount_percentage)/100;
            $final = $subtotal - $discount;
        } else {
            $final= $subtotal;
        }
        return ['final' => $final,'discount' => $discount,'subtotal' => $subtotal];
    }

    function  checkout(){
        $data['carts'] = Cart::content();
        return view($this->__loadDataToView('frontend.cart.checkout'),compact('data'));
    }

    function  makeOrder(Request  $request){
        $request->request->add(['checkout_code' => uniqid()]);
        $data = Checkout::create($request->all());
        if ($data){
            $details['checkout_id'] = $data->id;
            foreach (Cart::content() as $rowId => $item){
                $details['product_id'] = $item->id;
                $details['price'] = $item->price;
                $details['quantity'] = $item->qty;
                CheckoutDetails::create($details);
                Cart::remove($rowId);
            }
            $request->session()->flash('success','Checkout successfully: Your checkout code is : ' . $data->checkout_code);
        } else {
            $request->session()->flash('error' , 'Checkout Failed');
        }
        return redirect()->route('cart.index');
    }
}
