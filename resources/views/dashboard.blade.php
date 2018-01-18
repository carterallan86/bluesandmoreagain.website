@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="row">
        
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/reviews/create" class="btn btn-primary">Create Review</a>
                    <h3>Your Reviews</h3>
                    @if(count($reviews) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Artist</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{$review->title}}</td>
                                    <td>{{$review->artist}}</td>
                                    <td><a href="/reviews/{{$review->id}}/edit" class="btn btn-default">Edit</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['ReviewsController@destroy', $review->id], 'method' => 'Review', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                            
                        </table>
                    @else
                        <p>You have no reviews</p>
                    @endif
                </div>
            
        </div>
    </div>
</div>
@endsection
