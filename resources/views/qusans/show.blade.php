@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Qusan {{ $qusan->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('qusans/' . $qusan->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Qusan"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['qusans', $qusan->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Qusan',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $qusan->id }}</td>
                                    </tr>
                                    <tr><th> Question </th><td> {{ $qusan->question }} </td></tr><tr><th> Order No </th><td> {{ $qusan->order_no }} </td></tr><tr><th> Status </th><td> {{ $qusan->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection