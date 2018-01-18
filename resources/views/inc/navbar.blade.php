<nav class="navbar navbar-inverse">
<div class="container">
    <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
            &nbsp;
        </ul>

        <ul class="nav navbar-nav">
          <li><a href="/reviews">Reviews</a></li>
          <li><a href="/contact">Contact</a></li>
          @if(!Auth::guest())
            <li><a href="/dashboard">Dashboard</a></li>
          @endif
        </ul>


        
    </div>
</div>
</nav>