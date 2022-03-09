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
                            <div class="form-group">
                                {!! Form::label('title', 'Title'); !!}
                                {!! Form::text('title', null,['class' => 'form-control']); !!}
                                @include('backend.common.validation_field',['field' => 'title'])
                            </div>
                            <div class="form-group">
                                {!! Form::label('code', 'Code'); !!}
                                {!! Form::number('code', null,['class' => 'form-control']); !!}
                                @include('backend.common.validation_field',['field' => 'code'])
                            </div>
                            <div class="form-group">
                                {!! Form::label('discount_percentage', 'Discount Percentage'); !!}
                                {!! Form::number('discount_percentage', null,['class' => 'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('date_from', 'Date From'); !!}
                                {!! Form::number('date_from', null,['class' => 'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('date_to', 'Date To'); !!}
                                {!! Form::number('date_to', null,['class' => 'form-control']); !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status'); !!}
                                {!! Form::radio('status', 1); !!} Active
                                {!! Form::radio('status', 0,true); !!} Deactive
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
