@extends('layouts.app')

@section('content')
    <div class="jumbotron">
    <h1>Reviews</h1></br>
    @if(count($reviews) > 0)
        @foreach($reviews as $review)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a href="/reviews/{{$review->id}}"><img style="width:100%" src="/storage/cover_images/{{$review->cover_image}}"></a>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/reviews/{{$review->id}}">{{$review->title}}</a></h3>
                        <small>{{$review->artist}}</small>
                        <p>{!!$review->summary!!}</p>
                        <small>Written on {{ date('F d, Y', strtotime($review->created_at)) }} by {{$review->user->name}}</small><br>
                        
                    </div>
                </div>
            </div>
        @endforeach
        {{$reviews->links()}}
    @else
        <p>No reviews found</p>
    @endif
    </div>
@endsection