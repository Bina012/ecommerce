<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendBaseController extends Controller
{
    //function to load data to view file
    protected function __loadDataToView($viewPath){
        view()->composer($viewPath,function($view){
            $view->with('panel',$this->panel);
            $view->with('folder',$this->folder);
            $view->with('base_route',$this->base_route);
            if (isset($this->file_path)){
                $view->with('file_path',$this->file_path);
            }
        });
        return $viewPath;
    }

}
