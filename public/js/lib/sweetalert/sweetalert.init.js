document.querySelector('.buy-game').onclick = function(){
	var ct = $(this).attr("data-ct");
	var xe = $(this).attr("data-xe");
	var al = $(this).attr("data-al");
	var urlx = $("#urlx").val();
	var fee = 0;
	
	if(ct == "pm") fee = 8;
	if(ct == "ps") fee = 4;
	else if(ct == "rm") fee = 2;
	else if(ct == "rs") fee = 1;
	
	var tt = " token";
	if(fee == 0 || fee > 1) tt = " tokens";
	
	var swalConfig = {};
	
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
	
    swal(swalConfig,
        function(){
            setTimeout(function(){
				gg(al,xe,urlx);
            }, 2000);
        });
};

function gg(al,id,url){
	$.ajax({   
   type : 'POST',
   url  : url,
   data : {'id':id},
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
	   if(response.length < 3){}
	   else{
		   //$('#fixtures').html("<option value='none'>Select fixture</option>");
		   var ret = JSON.parse(response);
		   console.log(ret);
		   $("#vg-id").html(ret['id']);
		   var vg = ret['matches'];
		   console.log(vg);
		   
		   fillTable("vg",vg);  
	   }   
	   if(al == "np") swal("Payment successful!! Click View to continue");
	   $('#viewGameModal').modal("show");
       $('#vg-table').fadeIn();    
     
     }
   });
   
	return false;
}
