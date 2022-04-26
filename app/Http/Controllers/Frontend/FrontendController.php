<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
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

        $data = [];
        $data['details'] = Product::where('slug',$slug)->first();

//        $data['products'] = $data['details']->products()->get();

        if (!empty(Auth::guard('customer')->user()->id)){
            $data['customers'] = Customer::all();
            $dataSet = [];
            foreach($data['customers'] as $customer){
                $dataSet[$customer->id] = Rating::where('customer_id',$customer->id)->pluck('rate','product_id')->toArray();
            }
//            $dataSet = array_filter($dataSet);
            $data['recommended_products'] = $this->getRecommendations($dataSet, Auth::guard('customer')->user()->id);
            $data['ratedata'] =  Rating::where('customer_id' ,Auth::guard('customer')->user()->id)->where('product_id',$data['details']->id)->count();
            $data['ratings'] =  Rating::where('product_id',$data['details']->id)->get();
        }
//        dd($data);
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
        $request->request->add(['customer_id' => Auth::guard('customer')->user()->id]);
        Rating::create($request->all());
        $product = Product::find($request->product_id);
        return redirect()->route('frontend.product',$product->slug);

    }

    //Euclidean distance
    public function similarityDistance($preferences, $person1, $person2)
    {
        $similar = array();
        $sum = 0;


        foreach($preferences[$person1] as $key=>$value)
        {
            if(array_key_exists($key, $preferences[$person2]))
                $similar[$key] = 1;
        }

        if(count($similar) == 0)
            return 0;

        foreach($preferences[$person1] as $key=>$value)
        {
            if(array_key_exists($key, $preferences[$person2]))
                $sum = $sum + pow($value - $preferences[$person2][$key], 2);
        }

        return  1/(1 + sqrt($sum));
    }

    public function getRecommendations($preferences, $person)
    {
        $total = array();
        $simSums = array();
        $ranks = array();
        $sim = 0;
        foreach($preferences as $otherPerson=>$values)
        {

            if($otherPerson != $person)
            {
                $sim = $this->similarityDistance($preferences, $person, $otherPerson);
            }


            if($sim > 0)
            {

                foreach($preferences[$otherPerson] as $key=>$value)
                {
                    if(!array_key_exists($key, $preferences[$person]))
                    {

                        if(!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }
                        $total[$key] += $preferences[$otherPerson][$key] * $sim;

                        if(!array_key_exists($key, $simSums)) {
                            $simSums[$key] = 0;
                        }
                        $simSums[$key] += $sim;
                    }
                }

            }
        }


        foreach($total as $key=>$value)
        {
            $ranks[$key] = $value / $simSums[$key];
        }
//        array_multisort($ranks, SORT_DESC);
        return $ranks;

    }

}
