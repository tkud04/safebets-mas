@include('admin.head')
@include('admin.header')
@include('admin.sidebar')
@include('admin.breadcrumb')

    <div class="container-fluid">
         <div class="row">
		     <div class="col-md-12">
			     @include("input-errors")
			 </div>
		 </div>
    </div>

@yield('content')

@include('admin.footer')
@include('admin.foot')
