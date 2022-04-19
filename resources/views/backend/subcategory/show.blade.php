@extends('layouts.backend')
@section('title',$panel . 'Details')
@section('main-content')
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
                                    <th>Status</th>
                                    <td>{{$data['record']->status}}</td>
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
                                    <td>{{$data['record']->image_file}}</td>
                                </tr>
                                <tr>
                                    <th>Meta Keyword</th>
                                    <td>{{$data['record']->meta_keyword}}</td>
                                </tr>
                                <tr>
                                    <th>Meta Description</th>
                                    <td>{{$data['record']->meta_description}}</td>
                                </tr>
                                <tr>
                                    <th>Meta Title</th>
                                    <td>{{$data['record']->meta_title}}</td>
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
                                <tr>
                                    <th>Created by</th>
                                    <td>{{$data['record']->created_by}}</td>
                                </tr>
                                <tr>
                                    <th>Updated by</th>
                                    <td>{{$data['record']->updated_by}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
