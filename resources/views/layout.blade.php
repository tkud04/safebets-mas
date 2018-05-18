@include('head')
@include('header')

@yield('banner')
<section id="">
    <div class="container">
         <div class="row">
		     <div class="col-md-12">
			     @include("input-errors")
			 </div>
			<div class="col-md-12">
				<?php
				     $msg = "";
			       if(Session::has("reset-status") && Session::get("reset-status") == "success") $msg = "Your password change was successful";
				?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
               </div>
            </div>
		 </div>
    </div>
</section>
@yield('content')

@include('footer')
@include('foot')
