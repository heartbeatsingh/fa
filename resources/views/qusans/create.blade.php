@extends('layouts.admin')
@section('qCreate','active')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Question</div>
                    <div class="panel-body">

                       

                        {!! Form::open(['url' => '/qusans', 'class' => 'form-horizontal', 'files' => true]) !!}

                                    <div class="form-group {{ $errors->has('question') ? 'has-error' : ''}}">
                {!! Form::label('question', 'Question', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('question', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('question', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('order_no') ? 'has-error' : ''}}">
                {!! Form::label('order_no', 'Order No', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('order_no', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('order_no', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                     {!! Form::checkbox('status', 1, true, ['class' => 'form-control']) !!}
                    
                </div>
            </div>


                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection