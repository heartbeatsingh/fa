@extends('layouts.admin')
@section('users','active')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User </div>
                <div class="panel-body">



                    {!! Form::model($user, [
                    'method' => 'PATCH',
                    'url' => ['/users', $user->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}

                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                        {!! Form::label('first_name', 'First Name', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                        {!! Form::label('last_name', 'Last Name', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
                        {!! Form::label('gender', 'Gender', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('gender', array('male' => 'Male','female' => 'Female'),$user->gender, ['class' => 'form-control']) !!}
                            {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('email', null, ['class' => 'form-control','readonly' => 'readonly']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('lati') ? 'has-error' : ''}}">
                        {!! Form::label('lati', 'Latitude', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('lati', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('lati', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('longi') ? 'has-error' : ''}}">
                        {!! Form::label('longi', 'Longitude', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('longi', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('longi', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('about') ? 'has-error' : ''}}">
                        {!! Form::label('about', 'About', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::textarea('about', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('about', '<p class="help-block">:message</p>') !!}
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