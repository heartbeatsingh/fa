@extends('layouts.admin')
@section('qList','active')
@section('content')
<div class="content">
    <div class="row">
        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <!-- PAGE HEADER -->
                <i class="fa fa-question"></i> 
                Questions <a href="{{ url('/qusans/create') }}" class="btn btn-primary bg-color-green" title="Add New Question"><span class="glyphicon glyphicon-plus txt-color-white" aria-hidden="true"/></a>
            </h1>
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Questions</div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dt_basic"  class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th><th> Question </th><th> Order No </th><th> Status </th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($qusans !== '')
                                @foreach($qusans as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->question }}</td><td>{{ $item->order_no }}</td><td><span class="label bg-color-{{ $item->status == 1 ? 'green' : 'red' }}">{{ $item->status == 1 ? 'Activated' : 'Deactivated' }}</span></td>
                                    <td>
                                        
                                        <a href="{{ url('/qusans/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Qusan"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/qusans', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Question" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Qusan',
                                        'onclick'=>'return confirm("Are you sure to want delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $qusans->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection