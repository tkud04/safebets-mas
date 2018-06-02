@if(Session::has("notif") && Session::get("notif") == "yes")
<section id="">
    <div class="container">
         <div class="row">
		     <div class="col-md-12">
			     @include("input-errors")
			 </div>
			 
			 <?php
				     $msg = "";
			       if(Session::has("reset-status") && Session::get("reset-status") == "success") $msg = "Your password change was successful";
			       if(Session::has("signup-status") && Session::get("signup-status") == "success") $msg = "Signup successful! You can now login";
				   
				   if(Session::has("op")){
				      $op = Session::get("op"); $status = Session::get("status");
				      if($op == "add-betslip"){
						 if($status == "success") $msg = "Bet slip added!";
				         else if($status == "error") $msg = Session::get("msg"); 
					  }				      
					  elseif($op == "settings"){
						 if($status == "success") $msg = "Info updated!";
				         else if($status == "error") $msg = Session::get("msg"); 
					  }
				      
				   }
				?>
			 
			 @if($msg != "")			
			
			<div class="col-md-12">
				
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      {{$msg}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
               </div>
            </div>
	    @endif
		 </div>
    </div>
</section>
@endif