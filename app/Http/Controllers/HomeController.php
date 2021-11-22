<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Http\Request;

class HomeController extends BackendBaseController
{
    protected $panel = 'Dashboard ';
    protected  $folder = 'backend.dashboard';
    protected  $base_route = 'home';
    protected  $file_path = 'images' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view($this->__loadDataToView('dashboard'));

    }
}
