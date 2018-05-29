 var userPredictions = [];
   $('#predictions').hide();
   $('#for-mt').hide();
   
(function($) {
  "use strict"; // Start of use strict

  $('#league').change(function(e){
	  var l = $(this).val();
	  var u = $(this).attr('data-lef');

	  if(l == "none") alert("Please select a league to continue");
	  else if(l == "other") showOtherLeagues();
	  else getLeague(u,l);
  });  
  
  $('#other-country').change(function(e){
	  var oc = $(this).val();
	  var ocu = $(this).attr('data-lef');

	  if(l == "none") alert("Please select a country to continue");
	  else getOtherLeagues(ocu,oc);
  });  
  
  $('#other-competition').change(function(e){
	  var occ = $(this).val();
	  var occu = $(this).attr('data-lef');

	  if(l == "none") alert("Please select a competition to continue");
	  else getOtherTeams(occu,occ);
  });
  
  	$("a#regbtnn").click(function(e){
		console.log("abt reg btn");
		e.preventDefault();
		$('#loginModal').modal("hide");
		$('#registerModal').modal("show");
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
  
    $('#r-loading').hide();
    $('#l-loading').hide();
	
    $("a#reg-btn").click(function(e){
		e.preventDefault();
		$('#loginModal').modal("hide");
		$('#registerModal').modal("show");
	});    

    $('a#login-btn').click(function(e){
		e.preventDefault();
		$('#loginModal').modal("show");
		$('#registerModal').modal("hide");
	});    
	
	$('a#save-btn').click(function(e){
		e.preventDefault();
		$("#ssp").val(JSON.stringify(userPredictions));
		
		$("#save-form").submit();
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
			 $('#for-mt').hide();
			 $('#for-fxt').fadeIn();
			 
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

function getOtherLeagues(url,country){
	$.ajax({   
   type : 'GET',
   url  : url,
   data: {'xid':country},
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
			 $('#for-fxt').hide();
			 $('#for-mt').fadeIn();
			 
		     $('#other-competition').html("<option value='none'>Select competition</option>");
		     rr = JSON.parse(response);
		     $.each(rr,function(i,v){
			    obj = v;
			    $('#other-competition').append("<option value='" + obj['id'] + "'>" + obj['name'] + "</option>");
		     });			 
	   }   
     
     }
   });
}

function getOtherTeams(url,league){
	$.ajax({   
   type : 'GET',
   url  : url,
   data: {'xid':league},
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
			 $('#for-fxt').hide();
			 $('#for-mt').fadeIn();
			 
		     $('#other-home').html("<option value='none'>Select home team</option>");
		     $('#other-away').html("<option value='none'>Select away team</option>");
			 
		     rr = JSON.parse(response);
		     $.each(rr,function(i,v){
			    obj = v;
			    $('#other-home').append("<option value='" + obj['uid'] + "'>" + obj['name'] + "</option>");
			    $('#other-away').append("<option value='" + obj['uid'] + "'>" + obj['name'] + "</option>");
		     });			 
	   }   
     
     }
   });
}

function showOtherLeagues()
{
	$("#for-fxt").hide();
	$("#for-mt").fadeIn();
	$('#other-competition').html("<option value='none'>Select competition</option>");
	$('#other-home').html("<option value='none'>Home team</option>");
	$('#other-away').html("<option value='none'>Away team</option>");
	//$("#predictions").fadeIn();
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
		td.append("<a href='#' class='btn btn-danger' onclick='sssh(" + i + ");return false;'>Remove</a>");
		tr.append(td);
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

function sssh(gb){
    removePrediction(gb);
    window.setTimeout(refreshPredictions,1500);	
}

function viewBS(id,url){
	$.ajax({   
   type : 'POST',
   url  : url,
   data : {'id':id},
   beforeSend: function()
   { 
    $("#bs-error").fadeOut();
    $("#bs-table").fadeOut();
    $("#bs-table > tbody").html("");
    $("#bs-working").html('<br><br><div class="alert alert-info" role="alert" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  <i class = "fa fa-spinner fa-2x slow-spin"></i>  Processing.. </strong></div>');
	$('#bs-working').fadeIn();
	$('#viewBetSlipModal').modal("show");
   },
   success :  function(response)
      {         
       $('#bs-working').html("");	   
       $('#bs-working').fadeOut();	   
       //$('#result').html(response);	
	   if(response.length < 3){}
	   else{
		   //$('#fixtures').html("<option value='none'>Select fixture</option>");
		   var ret = JSON.parse(response);
		   console.log(ret);
		   $("#bs-id").html(ret['id']);
		   var gs = ret['matches'];
		   console.log(gs);
		   
		   fillTable("bs",gs);  
	   }   
       setTimeout(function(){$('#bs-table').fadeIn();},800);    
     
     }
   });
   
	return false;
}

function fillTable(table,data){
	$.each(data,function(i,v){
			 obj = v;
			 var tr = $("<tr></tr>");
			 var status = "<i class='text-success fa fa-question-circle'></i>";
			 
			 var tbody = "";
			 if(table == "vg") tbody = '#vg-table > tbody';
			 else if(table == "bs") tbody = '#bs-table > tbody';
			 
			 if(obj[4] == "win") status = "<i class='text-success fa fa-check'></i>";
			 else if(obj[4] == "fail") status = "<i class='text-primary fa fa-times'></i>";
			 tr.append("<td>" + obj[0] + "</td><td>" + obj[1] + "</td><td><strong>" + obj[2] + "</strong></td>" + "</td><td>" + obj[3] + "</td>" + "</td><td>" + status + "</td>");
			 $(tbody).append(tr);
		 });
}