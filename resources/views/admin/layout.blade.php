@include('admin.head')
@include('admin.header')
@include('admin.sidebar')
@include('admin.breadcrumb')

    <div class="container-fluid">
         <div class="row">
		     <div class="col-md-12">
			     @include("input-errors")
			 </div>
			<div class="col-md-12">
				<?php
				     $msg = "";
			       if(Session::has("mark-game-status") && Session::get("mark-game-status") == "success") $msg = "Game result successfully updated";
			       else if(Session::has("mark-bet-slip-status") && Session::get("mark-bet-slip-status") == "success") $msg = "Bet slip result successfully updated";
				   else if(Session::has("op"))
				   {
					   $op = Session::get("op");
					   if($op == "add-country") $msg = "Country ";
					   else if($op == "add-competition") $msg = "Competition ";
					   else if($op == "add-team") $msg = "Team ";
					   
					   $status = Session::get("status");
					   if($status == "success") $msg .= "added!";
				   }
				?>
				<!--
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
               </div>-->
			   <input type="hidden" id="msg" value="{{$msg}}"/>
			   <script>
			     var msg = $('#msg').val();
			     $('#toastr-success-top-right').on("click", function() {
					toastr.success(msg,'Top Right',{
					timeOut: 5000,
					"closeButton": true,
					"debug": false,
					"newestOnTop": true,
					"progressBar": true,
					"positionClass": "toast-top-right",
					"preventDuplicates": true,
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut",
					"tapToDismiss": false
					})
				});
			   </script>
            </div>
		 </div>
    </div>

@yield('content')

@include('admin.footer')
@include('admin.foot')
