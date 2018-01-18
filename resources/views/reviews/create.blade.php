@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1>Create Review</h1>
    {!! Form::open(['action' => 'ReviewsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('category', 'Category')}}
            {{Form::text('category', '', ['class' => 'form-control', 'placeholder' => 'Category'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('artist', 'Artist')}}
            {{Form::text('artist', '', ['class' => 'form-control', 'placeholder' => 'Artist'])}}
        </div>
        <div class="form-group">
            {{Form::label('label', 'Label')}}
            {{Form::text('label', '', ['class' => 'form-control', 'placeholder' => 'Label'])}}
        </div>
        <div class="form-group">
            {{Form::label('summary', 'Summary')}}
            {{Form::textarea('summary', '', ['class' => 'form-control', 'placeholder' => 'Summary'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('web1', 'Website Link 1')}}
            {{Form::text('web1', '', ['class' => 'form-control', 'placeholder' => 'Website Link 1'])}}
        </div>
        <div class="form-group">
            {{Form::label('web2', 'Website Link 2')}}
            {{Form::text('web2', '', ['class' => 'form-control', 'placeholder' => 'Website Link 2'])}}
        </div>
        <div class="form-group">
            {{Form::label('web3', 'Website Link 3')}}
            {{Form::text('web3', '', ['class' => 'form-control', 'placeholder' => 'Website Link 3'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    </div>
@endsection