    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{url('/')}}"><img class="img img-responsive" src="{{asset('landings/bb-1/assets/img/safebets-logo.png')}}" alt="Disenado" width="69"> SafeBets</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#page-top">Home</a>
            </li>
		   @if($user == null)
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#todays-tips">Top Tips Today</a>
            </li>			
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#premium-tips">Premium Tips</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" id="login-btn" href="#">Sign in</a>
            </li>            
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" id="reg-btn" href="#">Sign up</a>
            </li>
		   @elseif($user->role == "punter" || $user->role == "admin")
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('tips')}}">Tips</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('my-tips')}}">My Tips</a>
            </li>
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('transactions')}}">Transactions</a>
            </li>
			@if($user->role == "admin")
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('nimda')}}">SOS</a>
            </li>
            @endif
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('profile')}}">Profile</a>
            </li>
		   <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('logout')}}">Sign out</a>
            </li>
		   @endif
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('results')}}">Results</a>
            </li>
           @if($user == null)			
		   <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('pricing')}}">Pricing</a>
            </li>			
		   @endif
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{url('support')}}">Help</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>