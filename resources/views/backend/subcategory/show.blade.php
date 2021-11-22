@extends('layouts.backend')
@section('title',$panel . ' Details')
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
                                    <th>Name</th>
                                    <td>{{$data['record']->name}}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{$data['record']->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Rank</th>
                                    <td>{{$data['record']->rank}}</td>
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
                                    <th>Image</th>
                                    <td><img src="{{asset('admin/category/'. $data['record']->image)}}" alt=""></td>
                                </tr>
                                <tr>
                                    <th>Meta Description</th>
                                    <td>{{$data['record']->meta_description}}</td>
                                </tr>
                                <tr>
                                    <th>Meta title</th>
                                    <td>{{$data['record']->meta_title}}</td>
                                </tr>
                                <tr>
                                    <th>Meta keyword</th>
                                    <td>{{$data['record']->meta_Keyword}}</td>
                                </tr>
                                <tr>
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
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

