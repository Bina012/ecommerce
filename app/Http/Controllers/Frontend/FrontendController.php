<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends FrontBaseController
{
    public  function  index(){
        $data['latest_products'] = Product::where('status',1)->orderby('created_at','desc')->limit(8)->get();
        return view($this->__loadDataToView('frontend.index'),compact('data'));
    }

    public  function  category($slug){
        $data['details'] = Category::where('slug',$slug)->first();
        $data['products'] = $data['details']->products()->orderBy('price')->get();
        $data['deals_of_the_weeks'] = Product::where('feature_product',1)->get();
        return view($this->__loadDataToView('frontend.category'),compact('data'));
    }

    public  function  product($slug){

        $data['details'] = Product::where('slug',$slug)->first();
        $data['ratedata'] =  Rating::where('customer_id' ,Auth::guard('customer')->user()->id)->where('product_id',$data['details']->id)->count();
        $data['ratings'] =  Rating::where('product_id',$data['details']->id)->get();

        return view($this->__loadDataToView('frontend.product'),compact('data'));
    }

    public function  subcategory($slug){
        $data['details'] = Subcategory::where('slug',$slug)->first();
        $data['products'] = $data['details']->products()->get();
        return view($this->__loadDataToView('frontend.subcategory'),compact('data'));
    }
    public function  filterProduct(Request $request){

      $products = Product::where('category_id',$request->catid)
                              ->where(function($q) use ($request){
                                  $q->where('price','>=', $request->lower_price)
                                      ->where('price','<=', $request->upper_price);
                              })->orderby('price',$request->order)
                        ->get();
      $html = "";
      foreach ($products as $product){
          $image = $product->productImage()->first();
          $html .= "<div class='col-lg-4 col-md-6'>
							<div class='single-product'>
								<img class='img-fluid' src='" .asset('images/backend/product/255_271_' . $image->image_name) . "' alt=''>
								<div class='product-details'>
									<h6>$product->title</h6>
									<div class='price'>
										<h6>$product->price</h6>
										<h6 class='l-through'>$product->price</h6>
									</div>
									<div class='prd-bottom'>

										<a href='' class='social-info'>
											<span class='ti-bag'></span>
											<p class='hover-text'>add to bag</p>
										</a>
										<a href='' class='social-info'>
											<span class='lnr lnr-heart'></span>
											<p class='hover-text'>Wishlist</p>
										</a>
										<a href='' class='social-info'>
											<span class='lnr lnr-sync'></span>
											<p class='hover-text'>compare</p>
										</a>
										<a href='" . route('frontend.product',$product->slug)  ."' class='social-info'>
											<span class='lnr lnr-move'></span>
											<p class='hover-text'>view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>";

      }
        return $html;
    }

    function rating(Request  $request){
        $request->request->add(['customer_id' => 1]);
        Rating::create($request->all());
        $product = Product::find($request->product_id);
        return redirect()->route('frontend.product',$product->slug);

    }

}
