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
                                    <th>Title</th>
                                    <td>{{$data['record']->title}}</td>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <td>{{$data['record']->code}}</td>
                                </tr>
                                <tr>
                                    <th>Discount Percentage</th>
                                    <td>{{$data['record']->discount_percentage}}</td>
                                </tr>
                                <tr>
                                    <th>Date From</th>
                                    <td>{{$data['record']->date_from}}</td>
                                </tr>
                                <tr>
                                    <th>Date To</th>
                                    <td>{{$data['record']->date_to}}</td>
                                </tr>
                                <th>Status</th>
                                    <td>
                                        @if($data['record']->status==1)
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">Deactive</span>
                                        @endif
                                    </td>
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
                                    <th>Deleted at</th>
                                    <td>{{$data['record']->deleted_at}}</td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

