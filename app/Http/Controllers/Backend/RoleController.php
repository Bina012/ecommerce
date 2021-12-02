<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ModuleRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Module;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends BackendBaseController
{
    protected $panel = 'Role';
    protected  $folder = 'backend.role.';
    protected  $base_route = 'backend.role.';
    protected  $file_path = 'images' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'role' . DIRECTORY_SEPARATOR;


    function __construct(){
        $this->model = new role();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] = role::orderby('created_at','desc')->get();
        return view($this->__loadDataToView($this->folder . 'index'),compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->__loadDataToView($this->folder . 'create'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $request->request->add(['created_by' => Auth::user()->id]);
        $record = $this->model->create($request->all());
        if ($record){
            $request->session()->flash('success',$this->panel . ' Created Successfully.');
        } else {
            $request->session()->flash('error',$this->panel . ' Creation Failed!!');
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
        $data['record'] = role::find($id);
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
        $data['record'] = role::find($id);
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
    public function update(RoleRequest $request, $id)
    {
        $data['record'] = role::find($id);
        $request->request->add(['updated_by'=>Auth::user()->id]);
        if ($data['record']->update($request->all())){
            $request->session()->flash('success',$this->panel . ' Created Successfully.');
        }else{
            $request->session()->flash('error',$this->panel . ' Created Successfully.');
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
        $data['record'] = role::find($id);
//        $img = $data['record']->image;
        if ($data['record']->delete()){
//            if ($img){
//                if (file_exists(public_path().'/admin/category/'.$img)){
//                    unlink(public_path().'/admin/category/'.$img);
//                }
//            }
            $request->session()->flash('success',$this->panel . ' Created Successfully.');
            return redirect()->route($this->base_route . 'index');
        }else{
            $request->session()->flash('error',$this->panel . ' Created Successfully.');
            return redirect()->route($this->base_route . 'index');
        }

    }


    public function assignForm ($id)
    {

        $data['record'] = role::find($id);
        $data['modules'] = Module::all();
        $role_permissions = $data['record']->permissions()->get();
        $assigned_permission = [];
        foreach ($role_permissions as $rp){
            array_push($assigned_permission,$rp->id);
        }
        $data['assigned_permission'] = $assigned_permission;
        return view($this->__loadDataToView($this->folder . 'assign_form'),compact('data'));

    }

    public function assignPermission (Request  $request)
    {
        $data['record'] = role::find($request->role_id);
        $data['record'] ->permissions()->sync($request->permission_id);
        $request->session()->flash('success',$this->panel . ' Assigned Successfully.');
        return redirect()->route($this->base_route . 'index');
    }
}
