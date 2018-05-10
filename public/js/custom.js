 var userPredictions = [];
   $('#predictions').hide();
   
(function($) {
  "use strict"; // Start of use strict
  
  $('.osh').click(function(e){
	  e.preventDefault();
	  var gbene = $(this).attr('data-gbene');
	  removePrediction(gbene);
	  window.setTimeout(refreshPredictions,1500);
  });

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
	  var lg = $('#league').val(); var lgh = $('#league > option:selected').html();
	  var fx = $('#fixtures').val(); var fxh = $('#fixtures > option:selected').html();
	  var pd = $('#prediction').val(); var pdh = $('#prediction > option:selected').html();
	  
	  if(lg == "none" || fx == "none" || pd == "")
	  {
		  if(lg == "none") alert("Select a competition to continue.");
		  if(fx == "none") alert("Select a fixture to continue.");
		  if(pd == "none") alert("Select a prediction to continue.");
	  }
	  
	  else
	  {
		  var dt = {"lg":lg,"lgh":lgh,"pd":pd,"pdh":pdh,"fx":fx,"fxh":fxh};
		  console.log(dt);
		  userPredictions.push(dt);
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
	$("#predictions").hide("");
	$("#predictions-tbody").html("");
	console.log(userPredictions);
	for(var i = 0; i < userPredictions.length; i++){
		var item = userPredictions[i];
		var tr = $("<tr></tr>");
		var td = $("<td></td>");
		tr.append("<td>" + item.lgh + "</td>");
		tr.append("<td>" + item.fxh + "</td>");
		tr.append("<td>" + item.pdh + "</td>");
		td.append("<a href='#' data-gbene='" + url + "' class='osh btn btn-danger'>Remove</a>");
		$("#predictions-tbody").append(tr);
	}
	$("#predictions").fadeIn();
}

function removePrediction(gb)
{
	for(var i = 0; i < userPredictions.length; i++){
		if(gb == i){
			userPredictions.splice(i,1);
			break;
		}
	}
}