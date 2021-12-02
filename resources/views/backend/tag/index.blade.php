@extends('layouts.backend')
@section('title',$panel . ' List')
@section('main-content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{route('backend.tag.create')}}" class="btn btn-info">Create {{$panel}}</a>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">List {{$panel}}</h5>
                            @include('backend.common.flash_message')
                            <table class="table-bordered table" id="ecommerce1">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                @foreach($data['records'] as $record)
                                    <tbody>
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$record->name}}</td>
                                        <td>{{$record->slug}}</td>
                                        <td>
                                            @if($record->status==1)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('backend.tag.show',$record->id)}}" class="btn btn-info">View Details</a>
                                            <a href="{{route('backend.tag.edit',$record->id)}}"class="btn btn-warning">Edit</a>
                                            <form action="{{route('backend.tag.destroy',$record->id)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
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
