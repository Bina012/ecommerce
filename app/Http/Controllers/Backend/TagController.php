<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends BackendBaseController
{
    protected $panel = 'Tag';
    protected  $folder = 'backend.tag.';
    protected  $base_route = 'backend.tag.';
//    protected  $file_path = 'images' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'tag' . DIRECTORY_SEPARATOR;

    function __construct(){
        $this->model = new Tag();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['records'] = $this->model->orderby('created_at','desc')->get();
        return view($this->__loadDataToView($this->folder . 'index'),compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['tags'] = Tag::pluck('name','id');
        return view($this->__loadDataToView($this->folder . 'create'),compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['record'] = $this->model->find($id);
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
        $data['tags'] = Tag::pluck('name','id');
        $data['record'] = $this->model->find($id);
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
    public function update(Request $request, $id)
    {
        $data['record'] = Tag::find($id);
        $request->validate([
            'name'=>'required',
            'slug'=>'required',
            'status'=>'required',
        ]);
        $request->request->add(['updated_by'=>Auth::user()->id]);

        if ($data['record']->update($request->all())){
            $request->session()->flash('success','Tag update success');
        }else{
            $request->session()->flash('error','Tag update failed');
        }
        return redirect()->route($this->base_route . 'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request,$id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record']->delete()){
            $request->session()->flash('success','Tag delete success');
            return redirect()->route($this->base_route . 'index');
        }else{
            $request->session()->flash('error','Tag deletion failed');
            return redirect()->route($this->base_route . 'index');
        }

    }

}
