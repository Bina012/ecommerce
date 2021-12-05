<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends FrontBaseController
{
    public  function  index(){
        $data['latest_products'] = Product::where('status',1)->orderby('created_at','desc')->limit(8)->get();
        return view($this->__loadDataToView('frontend.index'),compact('data'));
    }

    public  function  category(){
        return view('frontend.category');
    }
}
