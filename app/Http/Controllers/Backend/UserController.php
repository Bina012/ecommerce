<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ModuleRequest;
use App\Http\Requests\UserRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Module;
use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BackendBaseController
{
    protected $panel = 'User';
    protected  $folder = 'backend.user.';
    protected  $base_route = 'backend.user.';
    protected  $file_path = 'images' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR;


    function __construct(){
        $this->model = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] = User::orderby('created_at','desc')->get();
        return view($this->__loadDataToView($this->folder . 'index'),compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = role::pluck('name','id');
        return view($this->__loadDataToView($this->folder . 'create'),compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->request->add(['password' =>  Hash::make($request->password)]);
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
        $data['record'] = User::find($id);
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
        $data['roles'] = role::pluck('name','id');
        $data['record'] = User::find($id);
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
    public function update(UserRequest $request, $id)
    {
        $data['record'] = User::find($id);

        if (!empty($request->password)){
            $request->request->add(['password' =>  Hash::make($request->password)]);
        } else{
            $request->request->add(['password' =>  $data['record']->password]);
        }
        $request->request->add(['updated_by'=>Auth::user()->id]);
        if ($data['record']->update($request->all())){
            $request->session()->flash('success','User update success');
        }else{
            $request->session()->flash('error','User update failed');
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
        $data['record'] = User::find($id);
//        $img = $data['record']->image;
        if ($data['record']->delete()){
//            if ($img){
//                if (file_exists(public_path().'/admin/category/'.$img)){
//                    unlink(public_path().'/admin/category/'.$img);
//                }
//            }
            $request->session()->flash('success','User delete success');
            return redirect()->route($this->base_route . 'index');
        }else{
            $request->session()->flash('error','User deletion failed');
            return redirect()->route($this->base_route . 'index');
        }

    }
}
