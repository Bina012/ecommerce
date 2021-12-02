@extends('layouts.backend')
@section('title','Assign permission')
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
                            {!! Form::open(['route' => 'backend.role.assign_permission','method' => 'post']) !!}
                            {!! Form::hidden('role_id',$data['record']->id) !!}
                            <table class="table-bordered table">
                                <tr>
                                    <th>Name</th>
                                    <td>{{$data['record']->name}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Permission List</td>
                                </tr>
                                @foreach($data['modules'] as $module)
                                    <tr>
                                        <td>{{$module->name}}</td>
                                        <td>
                                            <ul type="none">
                                            @foreach($module->permissions as $permission)
                                                @if(in_array($permission->id,$data['assigned_permission']))
                                                    <li>{!! Form::checkbox('permission_id[]',$permission->id,true)  !!} {{$permission->name}}</li>
                                                    @else
                                                        <li>{!! Form::checkbox('permission_id[]',$permission->id)  !!} {{$permission->name}}</li>
                                                        @endif
                                            @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {!! Form::submit('Assign') !!}
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

