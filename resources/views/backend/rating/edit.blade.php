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
                            {!! Form::model($data['record'], ['route' => [$base_route . 'update', $data['record']->id],'method' => 'put','files' => true]) !!}
                            {!! Form::open(['route' => $base_route . 'store', 'method' => 'post','files' => true]) !!}
                            <div class="form-group">
                                {!! Form::label('product_id', 'Product'); !!}
                                {!! Form::select('product_id',$data['products'], null,['class' => 'form-control','placeholder' => 'Select']); !!}
                                @include('backend.common.validation_field',['field' => 'product_id'])
                            </div>
                            <div class="form-group">
                                {!! Form::label('name', 'Name'); !!}
                                {!! Form::text('name', null,['class' => 'form-control']); !!}
                                @include('backend.common.validation_field',['field' => 'name'])
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email'); !!}
                                {!! Form::text('email', null,['class' => 'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('phone', 'Phone'); !!}
                                {!! Form::number('date_from', null,['class' => 'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('review', 'Review'); !!}
                                {!! Form::number('review', null,['class' => 'form-control']); !!}
                            </div>
                            <div>
                                {!! Form::label('rate','Rate'); !!}
                                {!! Form::number('rate',null,['class'=>'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Update ' . $panel, ['class' => 'btn btn-info']); !!}
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
