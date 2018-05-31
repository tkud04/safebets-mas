 var userPredictions = [];
   $('#predictions').hide();
   $('#for-mt').hide();
   var currentP = "fxt";
   
(function($) {
  "use strict"; // Start of use strict

  $('#league').change(function(e){
	  var l = $(this).val();
	  var u = $(this).attr('data-lef');

	  if(l == "none") alert("Please select a league to continue");
	  else if(l == "other"){
		  currentP = "mt";
		  showOtherLeagues();
	  } 
	  else{
		  currentP = "fxt";
		  getLeague(u,l);
	  }
  });  
  
  $('#other-country').change(function(e){
	  var oc = $(this).val();
	  var ocu = $(this).attr('data-lef');

	  if(oc == "none") alert("Please select a country to continue");
	  else getOtherLeagues(ocu,oc);
  });  
  
  $('#other-competition').change(function(e){
	  var occ = $(this).val();
	  var occu = $(this).attr('data-lef');

	  if(occ == "none") alert("Please select a competition to continue");
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
	  var lg = "",lgh="",fx="",fxh="",pd="",pdh="";
	  var ct = "",cth="",cc="",cch="",ho="",hoh="",aw="",awh="",dy="";
	  var status = "",errMsgs = [], dt = {};
	  
	  if(currentP == "fxt"){
		  lg = $('#league').val(); lgh = $('#league > option:selected').html();
		  fx = $('#fixtures').val(); fxh = $('#fixtures > option:selected').html();
		  
		  if(lg == "none" || fx == "none")
	      {
   		     status = "err"; errMsgs = [];
		     if(lg == "none") errMsgs.push("Select a competition to continue.");
		     if(fx == "none") errMsgs.push("Select a fixture to continue.");
	      }
		  
		  else
	      {
		      dt = {"md":"fxt","lg":lg,"lgh":lgh,"pd":pd,"pdh":pdh,"fx":fx,"fxh":fxh};
	      }
	  }
	  
	  else if(currentP == "mt"){
		  ct = $('#other-country').val(); cth = $('#other-country > option:selected').html();
		  cc = $('#other-competition').val(); cch = $('#other-competition > option:selected').html();
		  ho = $('#other-home').val(); hoh = $('#other-home > option:selected').html();
		  aw = $('#other-away').val(); awh = $('#other-away > option:selected').html();
		  dy = $('#other-date').val(); var cnow = new Date(); var validDt = false;
		  
		  if(dy != ""){
			  var ddy = new Date(dy); validDt = cnow < ddy;
			  console.log("validDt: " + validDt);
		  }
		  
		  if(ct == "none" || cc == "none" || ho == "none" || aw == "none" || dy == "" || validDt == false)
	      {
   		     status = "err"; errMsgs = [];
		     if(ct == "none") errMsgs.push("Select a country to continue.");
		     if(cc == "none") errMsgs.push("Select a competition to continue.");
		     if(ho == "none") errMsgs.push("Select the home team to continue.");
		     if(aw == "none") errMsgs.push("Select the away team to continue.");
		     if(dy == "") errMsgs.push("Input the fixture date to continue.");
		     if(validDt == false) errMsgs.push("Invalid date, please try again.");
	      }
		  
		  else
	      {
		      dt = {"md":"mt","pd":pd,"pdh":pdh,"ct":ct,"cth":cth,"cc":cc,"cch":cch,"ho":ho,"hoh":hoh,"aw":aw,"awh":awh,"dy":dy};
	      }
	  }
	  
	  var pd = $('#prediction').val(); var pdh = $('#prediction > option:selected').html();
	  if(pd == "none"){
		  status = "err";
		  errMsgs.push("Select a prediction to continue.");

	  }
	  else{
		  dt.pd = pd; dt.pdh = pdh;
	  }
	  
      if(status == "err"){
		  for(var i = 0; i < errMsgs.length; i++) alert(errMsgs[i]);
	  }
	  
	  else{
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
	   if(response.status == "error"){}
	   else{
			 $('#for-fxt').hide();
			 $('#for-mt').fadeIn();
			 
		     clearMT();
			 console.log(response);
		     rr = JSON.parse(response);
			 var comps = rr['competitions'];
		     $.each(comps,function(i,v){
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
	   if(response.status == "error"){}
	   else{
			 $('#for-fxt').hide();
			 $('#for-mt').fadeIn();
			 
		     
			 clearMT();
			 console.log(response);
			 
		     rr = JSON.parse(response);
			 var ms = rr['teams'];
		     $.each(ms,function(i,v){
			    obj = v;
			    $('#other-home').append("<option value='" + obj['uid'] + "'>" + obj['name'] + "</option>");
			    $('#other-away').append("<option value='" + obj['uid'] + "'>" + obj['name'] + "</option>");
		     });			 
	   }   
     
     }
   });
}

function clearMT(){
	$('#other-competition').html("<option value='none'>Select competition</option>");
	$('#other-home').html("<option value='none'>Select home team</option>");
    $('#other-away').html("<option value='none'>Select away team</option>");
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
		
		if(item.md == "fxt"){
		 tr.append("<td>" + item.lgh + "</td>");
		 tr.append("<td>" + item.fxh + "</td>");
		 tr.append("<td>" + item.pdh + "</td>");
		}
		
		else if(item.md == "mt"){
		//{"md":"mt","pd":pd,"pdh":pdh,"ct":ct,"cth":cth,"cc":cc,"cch":cch,"ho":ho,"hoh":hoh,"aw":aw,"awh":awh,"dy":dy};
		 tr.append("<td>(" + item.cth + ") " + item.cch + "</td>");
		 tr.append("<td>" + item.dy + " - " + item.hoh + " vs " + item.awh + "</td>");
		 tr.append("<td>" + item.pdh + "</td>");
		}
		
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