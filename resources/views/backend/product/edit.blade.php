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
