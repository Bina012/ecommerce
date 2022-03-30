<?php

namespace App\Http\Controllers\Customer;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Only Authenticated users for "admin" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        if (!Auth::user()){
            return view('customer.login');
        }
        $this->middleware('auth:customer');
    }

    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $category =  Category::where('status',1)->get();

        return view('customer.home',compact('category'));
    }
}
