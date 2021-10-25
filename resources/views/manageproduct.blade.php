@extends('layouts.header')

@section('content')
@if(Session::get('deleted'))
<div class="alert alert-success" style="margin-left: 900px;text-align: center;">
    {{Session::get('deleted')}}
</div>
@endif

@if(Session::get('success'))
<div class="alert alert-success" style="margin-left: 900px;text-align: center;">
    {{Session::get('success')}}
</div>
@endif

@if(Session::get('fail'))
<div class="alert alert-danger" style="margin-left: 900px;text-align: center;">
    {{Session::get('fail')}}
</div>
@endif

<div class="table-title">
    <div class="row">
        <div class="col-sm-6">
            <h2>Manage <b>Product</b></h2>
        </div>
        <div class="col-sm-6">
            <a href="{{ url('/addproduct')}}" class="btn btn-success" data-toggle="modal"><i
                    class="material-icons"></i> <span>Add New Product</span></a>
        </div>
    </div>
</div>
<thead>

    <tr>
</thead>

<table class="table table-striped table-hover">
    <thead>
        <tr>

            <th>
                S.NO
            </th>
            <th>Name of the Product</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action

            </th>
    </thead>
    <tbody>
        @foreach($request as $key => $data)
        <tr>
            <td>
                {{$key+1}}
            </td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->price }}</td>
            <td>{{ $data->description }}</td>
            <td>
                <li class="list-inline-item">
                    <img alt="Avatar" class="table-avatar" src="{{asset('/storage/'.$data->image)}}"
                        style="width:300px; height:200px">
                </li>
            </td>
            <td>
                <a href="{{ url('/productedit/' . $data->id ) }}"
                    class="edit" data-toggle="modal"><i
                        class="material-icons" data-toggle="tooltip" title="Edit"></i></a>
                <a href="{{url('/productdelete/' . $data->id )}}"  onclick="return confirm('Are you sure want to delete ?')"class="delete" data-toggle="modal"><i
                        class="material-icons" data-toggle="tooltip" title="Delete"></i> </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection