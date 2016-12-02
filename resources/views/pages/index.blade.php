@extends('layouts.admin')
@section('pages','active')
@section('content')
<div class="content">

    <div class="row">
        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <!-- PAGE HEADER -->
                <i class="fa fa-book"></i> 
                Pages 
            </h1>
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Pages</div>
                <div class="panel-body">


                    <div class="table-responsive">
                        <table id="dt_basic"  class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th><th> Title </th><th> Slug </th><th> Status </th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td><td>{{ $item->slug }}</td>
                                    <td><span class="label bg-color-{{ $item->status == 1 ? 'green' : 'red' }}">{{ $item->status == 1 ? 'Activated' : 'Deactivated' }}</span></td>
                                    <td>

                                        <a href="{{ url('/pages/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/pages', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Page" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Page',
                                        'onclick'=>'return confirm("Are you sure you want delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $pages->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection