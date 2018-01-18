@extends('layouts.app')

@section('content')

    <div class="jumbotron text-center">
    
        <img style="width:100%" src="/storage/site_images/header.jpg">
            
                <h1>Welcome To Bluesandmoreagain</h1>
                </br>
                <p>It’s summer. Long hours of daylight and the occasional ray of sunshine, and the enemy of music reviewers keen on enjoying a bit of it away from the CD mountain and the laptop.
        Somehow, the site turnstile has clicked nearly 20000 times, despite pressures from elsewhere preventing much updating. Thanks for visiting. I must get an interactive comments box installed.
        It’s not always possible to review everything that comes my way, but I do put a fair bit of effort into appraising those that look most interesting, and apportioning my efforts as equally as possible to ensure that all the hard-working PRs who have me on their mailing lists get their piece of the action.
        The live scene in NE Scotland has been very busy with an impressive number of high quality gigs drawing in the punters, and many more arranged to take place during the rest of 2017.
        As ever, Almost Blue Promotions, Blues Rock, Aberdeen and Glenbuchat Hall – and an increasing number of altruists holding house concerts - deserve credit for their dedication and efforts to provide us with the best.
        Thanks for staying with Bluesandmoreagain.</p>
                
            
        
    </div>
    <br>
	
    <div class="jumbotron">
        <h2>Latest Updates</h2>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach( $reviews as $review )
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach( $reviews as $review )
                        <div class="item {{ $loop->first ? ' active' : '' }}" >
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <a href="/reviews/{{$review->id}}"><img style="width:100%" src="/storage/cover_images/{{$review->cover_image}}"></a>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h3><a href="/reviews/{{$review->id}}">{{$review->title}}</a></h3>
                                        <small>{{$review->artist}}</small>
                                        <p>{!!$review->summary!!}</p>
                                        <small>Written on {{ date('F d, Y', strtotime($review->created_at)) }} by {{$review->user->name}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
        </div>
    </div>



@endsection