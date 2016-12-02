@extends('layouts.admin')
@section('pages','active')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Page</div>
                <div class="panel-body">



                    {!! Form::model($page, [
                    'method' => 'PATCH',
                    'url' => ['/pages', $page->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                        {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
                        {!! Form::label('slug', 'Slug', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('slug', null, ['class' => 'form-control','readonly' => 'readonly']) !!}
                            {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
                        {!! Form::label('content', 'Content', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                        {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-sm-6">
                            @if($page->status == 1)
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