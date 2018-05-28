   <!-- All Jquery -->
    <script src="{{asset('admin/js/lib/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('admin/js/lib/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('admin/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('admin/js/lib/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <!--Custom JavaScript -->
	
    <!--Toastr -->
    <script src="{{asset('admin/js/lib/toastr/toastr.min.js')}}"></script>
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
			   <script>
			     var msg = "{{$msg}}";
			     
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
					});
			   </script>
			   
	<script src="{{asset('admin/js/lib/calendar-2/moment.latest.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('admin/js/lib/calendar-2/semantic.ui.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('admin/js/lib/calendar-2/prism.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('admin/js/lib/calendar-2/pignose.calendar.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('admin/js/lib/calendar-2/pignose.init.js')}}"></script>

    <script src="{{asset('admin/js/lib/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/owl-carousel/owl.carousel-init.js')}}"></script>
    <script src="{{asset('admin/js/scripts.js')}}"></script>
    <!-- scripit init-->
	
		<!-- Bootstrap Datatable -->
	<script src="{{asset('admin/js/lib/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/datatables/datatables-init.js')}}"></script>

    <script src="{{asset('admin/js/custom.min.js')}}"></script>

</body>

</html>