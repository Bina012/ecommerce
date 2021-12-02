@extends('layouts.backend')
@section('title',$panel . ' Create')
@section('main-content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{route('backend.attribute.index')}}" class="btn btn-info">List {{$panel}}</a>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Create {{$panel}}</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => $base_route . 'store', 'method' => 'post']) !!}
                                <div class="form-group">
                                   {!! Form::label('name', 'Name'); !!}
                                   {!! Form::text('name', null,['class' => 'form-control']); !!}
                                    @include('backend.common.validation_field',['field' => 'name'])
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
@section('js')
    <script>
        $("#name").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#slug").val(Text);
        });
    </script>
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
