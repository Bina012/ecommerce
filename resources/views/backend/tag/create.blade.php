@extends('layouts.backend')
@section('title',$panel . ' Create')
@section('main-content')
    <!-- Main content -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{route('backend.tag.index')}}" class="btn btn-info">List {{$panel}}</a>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Create {{$panel}}</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => $base_route . 'store', 'method' => 'post']) !!}
                            @include($folder . 'includes.main_form',['button' => 'Save'])

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
@endsection
