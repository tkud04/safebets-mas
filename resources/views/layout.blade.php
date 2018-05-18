@include('head')
@include('header')

@yield('banner')
<section id="">
    <div class="container">
         <div class="row">
		     <div class="col-md-12">
			     @include("input-errors")
			 </div>
		 </div>
    </div>
</section>
@yield('content')

@include('footer')
@include('foot')
