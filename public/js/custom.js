(function($) {
  "use strict"; // Start of use strict

  $('#predictions').hide();
  var predictions = [];
  
  $('#league').change(function(e){
	  var l = $(this).val();
	  var u = $(this).attr('data-lef');
	  if(l == "none") alert("Please select a league to continue");
	  else getLeague(u,l);
  });

  $('#fixtures').change(function(e){
  });
  
  $('#fixture-form').submit(function(e){
	  e.preventDefault();
	  lg = $('#league').val();
	  fx = $('#fixtures').val();
	  pd = $('#prediction').val();
	  
	  if(lg == "none" || fx == "none" || pd == "")
	  {
		  if(lg == "none") alert("Select a competition to continue.");
		  if(fx == "none") alert("Select a fixture to continue.");
		  if(pd == "none") alert("Select a prediction to continue.");
	  }
	  
	  else
	  {
		  dt = {"lg":lg,"fx":fx,"pd":pd};
		  predictions.push(dt);
		  //add notification here
		  window.setTimeout(refreshPredictions,1500);
		  $('#league').val("none");
	      $('#fixtures').val("none");
	      $('#prediction').val("none");
	  }
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
	$('#working').fadeIn();
   },
   success :  function(response)
      {         
       $('#working').html("");	   
       $('#working').fadeOut();	   
       //$('#result').html(response);	
	   if(response == "404"){}
	   else{
		   $('#fixtures').html("<option value='none'>Select fixture</option>");
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

function refreshPredictions()
{
	$("#predictions > table > tbody").hide("");
	$("#predictions > table > tbody").html("");
	predictions.forEach(function(item){
		$("#predictions > table > tbody").append("<tr><td>" + item.lg + "</td><td>" + item.fx + "</td><td>" + item.pd + "</td></tr>");
	});
	$("#predictions > table > tbody").fadeIn();
}