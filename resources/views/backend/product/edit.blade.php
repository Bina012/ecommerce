@extends('layouts.backend')
@section('title',$panel . ' Create')
@section('main-content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit {{$panel}}</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::model($data['record'], ['route' => [$base_route . 'update', $data['record']->id],'method' => 'put']) !!}
                            <div class="form-group">
                                {!! Form::label('category_id', 'Category'); !!}
                                {!! Form::select('category_id',$data['categories'], null,['class' => 'form-control','placeholder' => 'Select category']); !!}
                                @include('backend.common.validation_field',['field' => 'name'])
                            </div>
                            <div class="form-group">
                                {!! Form::label('subcategory_id', 'Subcategory'); !!}
                                {!! Form::select('subcategory_id',$data['subcategories'], null,['class' => 'form-control','placeholder' => 'Select subcategory']); !!}
                                @include('backend.common.validation_field',['field' => 'name'])
                            </div>
                            <div class="form-group">
                                {!! Form::label('title', 'Title'); !!}
                                {!! Form::text('title', null,['class' => 'form-control']); !!}
                                @include('backend.common.validation_field',['field' => 'title'])
                            </div>
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug'); !!}
                                {!! Form::text('slug', null,['class' => 'form-control']); !!}
                                @include('backend.common.validation_field',['field' => 'slug'])
                            </div>
                            <div class="form-group">
                                {!! Form::label('price', 'Price'); !!}
                                {!! Form::number('price', null,['class' => 'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('discount', 'Discount'); !!}
                                {!! Form::textarea('discount', null,['class' => 'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('quantity', 'Quantity'); !!}
                                {!! Form::textarea('quantity', null,['class' => 'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('unit_id', 'Unit'); !!}
                                {!! Form::select('unit_id',$data['units'], null,['class' => 'form-control','placeholder' => 'Select unit']); !!}
                                @include('backend.common.validation_field',['field' => 'name'])
                            </div>
                            <div class="form-group">
                                {!! Form::label('feature_product', 'Feature Product'); !!}<br>
                                {!!Form::radio('feature_product', 1, true); !!}YES
                                {!!Form::radio('feature_product', 0, false);!!}NO
                            </div>
                            <div class="form-group">
                                {!! Form::label('flash_product', 'Flash Product'); !!}<br>
                                {!!Form::radio('flash_product',1, true); !!}YES
                                {!!Form::radio('flash_product', 0, false);!!}NO
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status'); !!}
                                {!! Form::radio('status', 1); !!} Active
                                {!! Form::radio('status', 0,true); !!} Deactive
                            </div>
                            <div class="form-group">
                                {!! Form::label('short_description', 'Short Description'); !!}
                                {!! Form::textarea('short_description', null,['class' => 'form-control','rows' => 2]); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description'); !!}
                                {!! Form::textarea('description', null,['class' => 'form-control','rows' => 2]); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('specification', 'Specification'); !!}
                                {!! Form::textarea('specification', null,['class' => 'form-control','rows' => 2]); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('meta_title', 'Meta Title'); !!}
                                {!! Form::textarea('meta_tile', null,['class' => 'form-control','rows' => 2]); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('meta_description', 'Meta Description'); !!}
                                {!! Form::textarea('meta_description', null,['class' => 'form-control','rows' => 2]); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('meta_keyword', 'Meta Keyword'); !!}
                                {!! Form::textarea('meta_keyword', null,['class' => 'form-control','rows' => 2]); !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('image_file', 'Image'); !!}
                                {!! Form::file('image_file',['class' => 'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Save ' . $panel, ['class' => 'btn btn-info']); !!}
                                {!! Form::reset('Clear', ['class' => 'btn btn-danger']); !!}
                            </div>


                            {!! Form::close() !!}

                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
