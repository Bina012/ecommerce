<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends BackendBaseController
{
    protected $panel = 'Category ';
    protected  $folder = 'backend.category.';
    protected  $base_route = 'backend.category.';
    protected  $file_path = 'images' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR;


    function __construct(){
        $this->model = new Category();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] = Category::orderby('created_at','desc')->get();
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
    public function store(CategoryRequest $request)
    {
        $request->request->add(['created_by' => Auth::user()->id]);

        if ($request->hasFile('image_file')){
            $file = $request->file('image_file');
            $file_name = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . DIRECTORY_SEPARATOR . $this->file_path , $file_name);
            $request->request->add(['image' => $file_name]);
        }

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
        $data['record'] = Category::find($id);
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
        $data['record'] = Category::find($id);
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
    public function update(CategoryRequest $request, $id)
    {
        $data['record'] = Category::find($id);
        $request->request->add(['updated_by'=>Auth::user()->id]);
        if ($request->hasFile('image_file')){
            $file = $request->file('image_file');
            $file_name = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . DIRECTORY_SEPARATOR . $this->file_path , $file_name);
            $request->request->add(['image' => $file_name]);
            unlink(public_path() . DIRECTORY_SEPARATOR . $this->file_path .$data['record']->image);
        }
        if ($data['record']->update($request->all())){
            $request->session()->flash('success','Category update success');
        }else{
            $request->session()->flash('error','Category update failed');
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
        $data['record'] = Category::find($id);
//        $img = $data['record']->image;
        if ($data['record']->delete()){
//            if ($img){
//                if (file_exists(public_path().'/admin/category/'.$img)){
//                    unlink(public_path().'/admin/category/'.$img);
//                }
//            }
            $request->session()->flash('success','Category delete success');
            return redirect()->route($this->base_route . 'index');
        }else{
            $request->session()->flash('error','Category deletion failed');
            return redirect()->route($this->base_route . 'index');
        }

    }

    function getSubcategory(Request  $request){
        $subcategoryList = Subcategory::where('category_id',$request->id)->get();
        $option = "<option value=''>Select Subcategory</option>";
        foreach ($subcategoryList as $sub){
            $option .= "<option value='$sub->id'>$sub->name</option>";
        }
        return $option;
    }
}
