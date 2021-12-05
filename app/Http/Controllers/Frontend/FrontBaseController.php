<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontBaseController extends Controller
{
    protected function __loadDataToView($viewPath){
    view()->composer($viewPath,function($view){
        $category = Category::where('status',1)->get();
        $view->with('category',$category);

    });
    return $viewPath;
}
}
