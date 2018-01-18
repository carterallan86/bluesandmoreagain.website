@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        
        <div class="row">
                    <div class="col-md-5 col-sm-5">
                        <a href="/reviews/{{$review->id}}"><img style="width:100%" src="/storage/cover_images/{{$review->cover_image}}"></a>
                    </div>
                    <div class="col-md-5 col-sm-5">
                    
                        <h2>{{$review->title}}</h2>
                        <h3>{{$review->artist}}</h3>
                        @if (!empty($review->label)) 
                            <p>{{$review->label}}</p>
                        
                        @else {}
                        @endif
                        @if (!empty($review->web1)) 
                            <a href="{{$review->web1}}">{{$review->web1}}</a></br>
                        
                        @else {}
                        @endif
                        @if (!empty($review->web1)) 
                            <a href="{{$review->web2}}">{{$review->web2}}</a></br>
                        
                        @else {}
                        @endif
                        @if (!empty($review->web1)) 
                            <a href="{{$review->web3}}">{{$review->web3}}</a></br>
                        
                        @else {}
                        @endif
                        <small>Written on {{ date('F d, Y', strtotime($review->created_at)) }} by {{$review->user->name}}</small>
                    </div>
                    <div class="col-md-2 col-sm-2">
                    <a href="/reviews" class="btn btn-default pull-right">Back to Reviews</a>
                    @if(!Auth::guest())
                        @if(Auth::user()->id == $review->user_id)
                            <a href="/reviews/{{$review->id}}/edit" class="btn btn-default">Edit</a>

                            {!!Form::open(['action' => ['ReviewsController@destroy', $review->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                        @endif
                    @endif
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <p>{!!$review->body!!}</p>
                    </div>
                    
                </div>
                </div>
                
        
  
        </div>
            
 
        
        <hr>
        @if(!Auth::guest())
            @if(Auth::user()->id == $review->user_id)
                <a href="/reviews/{{$review->id}}/edit" class="btn btn-default">Edit</a>

                {!!Form::open(['action' => ['ReviewsController@destroy', $review->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            @endif
        @endif
    </div>
@endsection