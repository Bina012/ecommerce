<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\Facades\Image;

class ProductController extends BackendBaseController
{
    protected $panel = 'Product ';
    protected  $folder = 'backend.product.';
    protected  $base_route = 'backend.product.';
    protected  $file_path = 'images' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR;


    function __construct(){
        $this->model = new Product();
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
        $data['categories'] = Category::pluck('name','id');
        $data['subcategories'] = Subcategory::pluck('name','id');
        $data['tags'] = Tag::pluck('name','id');
        $data['attributes'] = Attribute::pluck('name','id');
        $data['units'] = Unit::pluck('name','id');
        return view($this->__loadDataToView($this->folder . 'create'),compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
//        dd($request->all());
        $request->request->add(['created_by' => Auth::user()->id]);
        $request->request->add(['stock' => $request->quantity]);

        $record = $this->model->create($request->all());
        if ($record){
            if (count($request->tag_id) > 0){
                //add data into product tags
                $record->tags()->attach($request->tag_id);
            }

            //attribute

            $attribute_id = $request->attribute_id;
            $attributes = $request->attribute_value;

            for ($i=0;$i < count($attribute_id);$i++){
                if (!empty($attribute_id[$i]) && !empty($attributes[$i])){
                    //process to save data
                    ProductAttribute::create([
                        'product_id' => $record->id,
                        'attribute_id' => $attribute_id[$i],
                        'attribute_value' => $attributes[$i],
                        'status' => 1,
                    ]);
                }
            }
            //process to store image
            $titles = $request->input('image_title');

            $images = $request->file('image_file');
           for ($i = 0;$i < count($titles);$i++)
           {
               if (!empty($titles[$i]) && !empty($images[$i])){
                   $iname = uniqid() . '_'  .$images[$i]->getClientOriginalName();
                   $images[$i]->move('images/backend/product/',$iname);
                    $image_dimesions = [
                        [
                            'width' => 255,
                            'height' => 271
                        ],
                        [
                            'width' => 500,
                            'height' => 500
                        ],
                        [
                            'width' => 1000,
                            'height' => 1000
                        ]
                    ];
                    foreach ($image_dimesions as $dimesion){
                        $img =  Image::make('images/backend/product/'.$iname)->resize($dimesion['width'], $dimesion['height']);
                        $img->save('images/backend/product/'.$dimesion['width'] . '_' . $dimesion['height'] . '_'. $iname);
                    }

                   ProductImage::create([
                       'product_id' => $record->id,
                       'image_name' => $iname,
                       'image_title' => $titles[$i],
                       'status' => 1,
                   ]);
               }
           }
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
        $data['record'] = Product::find($id);
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
        $data['categories'] = Category::pluck('name','id');
        $data['subcategories'] = Subcategory::pluck('name','id');
        $data['tags'] = Tag::pluck('name','id');
        $data['attributes'] = Attribute::pluck('name','id');
        $data['units'] = Unit::pluck('name','id');
        $data['record'] = Product::find($id);
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
    public function update(ProductRequest $request, $id)
    {
        $data['record'] = Product::find($id);
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
        Schema::disableForeignKeyConstraints();
        $data['record'] = Product::find($id);
        $data['record']->tags()->detach();
        $data['record']->productAttributes()->delete();
        $data['record']->productImage()->delete();
        Schema::enableForeignKeyConstraints();
        if ($data['record']->delete()){
            $request->session()->flash('success','Product delete success');
            return redirect()->route($this->base_route . 'index');
        }else{
            $request->session()->flash('error','Product deletion failed');
            return redirect()->route($this->base_route . 'index');
        }

    }
}
