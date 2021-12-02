<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PermissionRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Module;
use App\Models\permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends BackendBaseController
{
    protected $panel = 'Permission';
    protected  $folder = 'backend.permission.';
    protected  $base_route = 'backend.permission.';
    protected  $file_path = 'images' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'permission' . DIRECTORY_SEPARATOR;


    function __construct(){
        $this->model = new permission();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] = permission::orderby('created_at','desc')->get();
        return view($this->__loadDataToView($this->folder . 'index'),compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['modules'] = Module::pluck('name','id');
        return view($this->__loadDataToView($this->folder . 'create'),compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $request->request->add(['created_by' => Auth::user()->id]);
        $record = $this->model->create($request->all());
        if ($record){
            $request->session()->flash('success',$this->panel . 'Created Successfully.');
        } else {
            $request->session()->flash('error',$this->panel . 'Creation Failed!!');
        }
        return redirect()->route($this->base_route . 'index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['record'] = permission::find($id);
        return view($this->__loadDataToView($this->folder . 'show'),compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['modules'] = Module::pluck('name','id');
        $data['record'] = permission::find($id);
        if($data['record']){
            return view($this->__loadDataToView($this->folder . 'edit'),compact('data'));

        }else{
            request()->session()->flash('error','Invalid Request');
            return redirect()->route($this->base_route . 'index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $data['record'] = permission::find($id);
        $request->request->add(['updated_by'=>Auth::user()->id]);
        if ($data['record']->update($request->all())){
            $request->session()->flash('success','Permission update success');
        }else{
            $request->session()->flash('error','Permission update failed');
        }
        return redirect()->route($this->base_route . 'index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $data['record'] = permission::find($id);
//        $img = $data['record']->image;
        if ($data['record']->delete()){
//            if ($img){
//                if (file_exists(public_path().'/admin/category/'.$img)){
//                    unlink(public_path().'/admin/category/'.$img);
//                }
//            }
            $request->session()->flash('success','Permission delete success');
            return redirect()->route($this->base_route . 'index');
        }else{
            $request->session()->flash('error','Permission deletion failed');
            return redirect()->route($this->base_route . 'index');
        }

    }
}
