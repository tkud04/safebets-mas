document.querySelectorAll('.buy-game').onclick = function(){
	var ct = $(this).attr("data-ct");
	var xe = $(this).attr("data-xe");
	var al = $(this).attr("data-al");
	var urlx = $("#urlx").val();
	var fee = 0;
	
	if(ct == "pm") fee = 8;
	else if(ct == "ps") fee = 4;
	else if(ct == "rm") fee = 2;
	else if(ct == "rs") fee = 1;
	else if(ct == "uv") fee = 0;
	
	var tt = " token";
	if(fee == 0 || fee > 1) tt = " tokens";
	
	var swalConfig = {};
	
	if(al == "lg"){
		$("#loginModal").modal("show");
	}
	
  else{
	if(al == "py"){
		swalConfig = {
            title: "Confirm Action",
            text: "Click OK to continue ",
            type: "info",
        }
	}
	
	else if(al == "np"){
		swalConfig = {
            title: "Confirm Purchase",
            text: "Fee: " + fee + tt,
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }
	}
	
	var tk = $('#tk').val();
	
    swal(swalConfig,
        function(){
            setTimeout(function(){
				gg(al,xe,tk,urlx);
            }, 2000);
        });
  }
};

function gg(al,id,tk,url){
	$.ajax({   
   type : 'POST',
   url  : url,
   data : {'_token':tk,'id':id},
   beforeSend: function()
   { 
    $("#vg-error").fadeOut();
    $("#vg-table").fadeOut();
    $("#vg-table > tbody").html("");
    $("#vg-working").html('<br><br><div class="alert alert-info" role="alert" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  <i class = "fa fa-spinner fa-2x slow-spin"></i>  Processing.. </strong></div>');
	$('#vg-working').fadeIn();
   },
   success :  function(response)
      {         
       $('#vg-working').html("");	   
       $('#vg-working').fadeOut();	   
       //$('#result').html(response);
	   var ret = JSON.parse(response);	   
	   if(ret['error'] == "insufficient-funds"){
		   sweetAlert("Oops...", "You don't have enough tokens to buy this game.", "error");
		   $('#insufficientFundsModal').modal("show");
	   }
	   else{
		   //$('#fixtures').html("<option value='none'>Select fixture</option>");
		   $("#vg-id").html(ret['id']);
		   var vg = ret['matches'];
		   console.log(vg);
		   
		   fillTable("vg",vg);  
		   
	     if(al == "np"){
		   swal("Payment successful!! Click View to continue");
	       $('#viewGameModal').modal("show");
           $('#vg-table').fadeIn(); 
	     }
	   }	   
     
     }
   });
   
	return false;
}
