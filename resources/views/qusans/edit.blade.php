@extends('layouts.admin')
@section('qBar','active open')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Question </div>
                <div class="panel-body">
                    {!! Form::model($qusan, [
                    'method' => 'PATCH',
                    'url' => ['/qusans', $qusan->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}
                    <div class="form-group {{ $errors->has('question') ? 'has-error' : ''}}">
                        {!! Form::label('question', 'Question', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('question', $qusan->question, ['class' => 'form-control']) !!}
                            {!! $errors->first('question', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('order_no') ? 'has-error' : ''}}">
                        {!! Form::label('order_no', 'Order No', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::number('order_no', $qusan->order_no, ['class' => 'form-control']) !!}
                            {!! $errors->first('order_no', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                        {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-sm-6">
                            @if($qusan->status == 1)
                            {!! Form::checkbox('status', 1 ,true, ['class' => 'form-control']) !!}
                            @else
                            {!! Form::checkbox('status', 1 ,false, ['class' => 'form-control']) !!}
                            @endif

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection