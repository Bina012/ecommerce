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
                                    <th>Name</th>
                                    <td>{{$data['record']->name}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{$data['record']->address}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$data['record']->email}}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{$data['record']->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Pan no.</th>
                                    <td>{{$data['record']->pan_no}}</td>
                                </tr>
                                <tr>
                                    <th>Logo</th>
                                    <td><img src="{{asset($file_path . $data['record']->logo)}}" alt="" width="100"></td>
                                </tr>
                                <tr>
                                    <th>Fav icon</th>
                                    <td><img src="{{asset($file_path . $data['record']->fav_icon)}}" alt="" width="100"></td>
                                </tr>
                                <tr>
                                    <th>Facebook</th>
                                    <td>{{$data['record']->facebook}}</td>
                                </tr>
                                <tr>
                                    <th>Twitter</th>
                                    <td>{{$data['record']->twitter}}</td>
                                </tr>
                                <tr>
                                    <th>Youtube</th>
                                    <td>{{$data['record']->youtube}}</td>
                                </tr>
                                <tr>
                                    <th>Instagram</th>
                                    <td>{{$data['record']->instagram}}</td>
                                </tr>
                                <tr>
                                    <th>Google Map</th>
                                    <td>{{$data['record']->google_map}}</td>
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

