@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1>Edit Review</h1>
    {!! Form::open(['action' => ['ReviewsController@update', $review->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('category', 'Category')}}
            {{Form::text('category', $review->category, ['class' => 'form-control', 'placeholder' => 'Category'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $review->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('artist', 'Artist')}}
            {{Form::text('artist', $review->artist, ['class' => 'form-control', 'placeholder' => 'Artist'])}}
        </div>
        <div class="form-group">
            {{Form::label('label', 'Label')}}
            {{Form::text('label', $review->label, ['class' => 'form-control', 'placeholder' => 'Label'])}}
        </div>
        <div class="form-group">
            {{Form::label('summary', 'Summary')}}
            {{Form::textarea('summary', $review->summary, ['class' => 'form-control', 'placeholder' => 'Summary'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $review->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('web1', 'Website Link 1')}}
            {{Form::text('web1', $review->web1, ['class' => 'form-control', 'placeholder' => 'Website Link 1'])}}
        </div>
        <div class="form-group">
            {{Form::label('web2', 'Website Link 2')}}
            {{Form::text('web2', $review->web2, ['class' => 'form-control', 'placeholder' => 'Website Link 2'])}}
        </div>
        <div class="form-group">
            {{Form::label('web3', 'Website Link 3')}}
            {{Form::text('web3', $review->web3, ['class' => 'form-control', 'placeholder' => 'Website Link 3'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

    <div id="backend-comments" style="margin-top: 50px;">
				<h3>Comments <small>{{ $review->comments()->count() }} total</small></h3>

				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Comment</th>
							<th width="70px"></th>
						</tr>
					</thead>

					<tbody>
						@foreach ($review->comments as $comment)
						<tr>
							<td>{{ $comment->name }}</td>
							<td>{{ $comment->email }}</td>
							<td>{{ $comment->comment }}</td>
							<td>
								<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
</div>
@endsection
