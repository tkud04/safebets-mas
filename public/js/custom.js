(function($) {
  "use strict"; // Start of use strict

  $('#league').change(function(e){
	  var l = $(this).val();
	  var u = $(this).attr('data-lef');
	  if(l == "none") alert("Please select a league to continue");
	  else getLeague(u,l);
  });

})(jQuery); // End of use strict

function getLeague(url,id){
	$.ajax({   
   type : 'GET',
   url  : url,
   data : {'id':id},
   beforeSend: function()
   { 
    $("#error").fadeOut();
    $("#result").fadeOut();
    $("#working").html('<br><br><div class="alert alert-info" role="alert" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  <i class = "fa fa-spinner fa-2x slow-spin"></i>  Connecting.... </strong></div>');
	$('#working').fadeOut();
   },
   success :  function(response)
      {         
       $('#working').fadeOut();	   
       //$('#result').html(response);	
	   if(response == "404"){}
	   else{
		   rr = JSON.parse(response);
		 $.each(rr,function(i,v){
			 obj = v;
			 $('#fixtures').append("<option value='" + obj['href'] + "'>" + obj['d'] + " - " + obj['vs'] + "</option>");
		 });	  
	   }   
       setTimeout(function(){$('#result').fadeIn();},1500);    
     
     }
   });
}