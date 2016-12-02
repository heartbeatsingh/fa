@extends('layouts.admin')
@section('users','active')
@section('content')
<div class="content">
    <div class="row">
        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <!-- PAGE HEADER -->
                <i class="fa fa-users"></i> 
                Users 
            </h1>
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">


                    <div class="table-responsive">
                        <table id="dt_basic"  class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th><th> First Name </th><th> Last Name </th><th> Email </th><th> Gender </th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->first_name }}</td><td>{{ $item->last_name }}</td><td>{{ $item->email }}</td>
                                    <td>@if($item->gender == 'male') <i class="fa fa-male fa-lg" style="color:green"></i> Male @else <i class="fa fa-female fa-lg" style="color:red"></i> Female @endif</td>
                                    <td>

                                        <a href="{{ url('/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/users', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete User" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete User',
                                        'onclick'=>'return confirm("Are you sure you want to delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $users->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection