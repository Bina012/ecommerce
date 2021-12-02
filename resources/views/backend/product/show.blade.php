@extends('layouts.backend')
@section('title',$panel . ' List')
@section('main-content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            @include('backend.common.flash_message')
                            <table class="table-bordered table">
                                <tr>
                                    <th>Category</th>
                                    <td>{{$data['record']->category->name}}</td>
                                </tr>
                                <tr>
                                    <th>SubCategory</th>
                                    <td>{{$data['record']->subcategory->name}}</td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td>{{$data['record']->title}}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{$data['record']->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{$data['record']->price}}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>{{$data['record']->discount}}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{$data['record']->quantity}}</td>
                                </tr>
                                <tr>
                                    <th>Feature Product</th>
                                    <td>
                                        @if($data['record']->feature_product == 1)
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">Deactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Flash Product</th>
                                    <td>
                                        @if($data['record']->flash_product == 1)
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">Deactive</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Short Description</th>
                                    <td>{{$data['record']->short_description}}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{$data['record']->description}}</td>
                                </tr>
                                <tr>
                                    <th>Specification</th>
                                    <td>{{$data['record']->specification}}</td>
                                </tr>

                                <tr>
                                    <th>Created at</th>
                                    <td>{{$data['record']->created_at}}</td>
                                </tr>
                                <tr>
                                    <th>Updated at</th>
                                    <td>{{$data['record']->updated_at}}</td>
                                </tr>
                                <tr>
                                    <th>Created by</th>
                                    <td>{{\App\Models\User::find($data['record']->created_by)->name}}</td>
                                </tr>
                                <tr>
                                    <th>Updated by</th>
                                    <td>
                                        @if($data['record']->updated_by)
                                            {{\App\Models\User::find($data['record']->updated_by)->name}}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <h4>Meta Information</h4>
                            <table class="table table-bordered ">
                                <tr>
                                    <th>Meta Title</th>
                                    <td>{{$data['record']->meta_title}}</td>
                                </tr>
                                <tr>
                                    <th>Meta Description</th>
                                    <td>{{$data['record']->meta_description}}</td>
                                </tr>
                                <tr>
                                    <th>Meta Keyword</th>
                                    <td>{{$data['record']->meta_keyword}}</td>
                                </tr>
                            </table>

                            <h4>Tag</h4>
                            <table class="table table-bordered ">
                                <tr>
                                    <th>Tags</th>
                                    <td>
                                        <ul>
                                        @foreach($data['record']->tags as $tag)
                                            <li>{{$tag->name}}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                            <h4>Attributes</h4>
                            <table class="table table-bordered ">
                                <tr>
                                    <td>Attribute Name</td>
                                    <td>Attribute Value</td>
                                </tr>
                                @foreach($data['record']->productAttributes as $attribute)
                                <tr>
                                    <th>{{\App\Models\Attribute::find($attribute->attribute_id)->name}}</th>
                                    <td>
                                       {{$attribute->attribute_value}}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>

        </div>
        <table>
            <tr>
                <th>Image</th>

            </tr>
        </table>

    </div>
    <!-- /.content -->
@endsection

