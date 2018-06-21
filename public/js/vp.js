var urlxx = $('#urlxx').val();
var ttt = $('#ttt').val();
var notif = $('#urlnn').val();
var cqd = "";
var nm = 0; var nnp = "";

$('#py-mthds').hide();
$('#bks').hide();

$(document).ready(function(){
    $('a#pyop').click(function(e){
         //alert(prt.html());
		 $('#pyop-loading').html("Please wait..");
		 if(cqd == "bvyq"){
			 nm = "8"; nnp = "1000";
		 }
		 else if(cqd == "fdgs"){
			 nm = "40"; nnp = "5000";
		 }
		 
         var ret = new Object();
          ret.name = "Starter token pack";
          ret.description = nm + " units of tokens from safebets.disenado.com.ng";
          ret.price = nnp;
          pay(ret);
    });
	$('a#pybt').click(function(e){
         showBnk();
    });
	$('a#bks-btn').click(function(e){
         hideBnk();
    });
  $('a.tk').click(function(e){
	  e.preventDefault();
	  cqd = $(this).attr("data-cqd");
	  console.log("cqd = " + cqd);
	  showPMthds();
  });
  
  $('a.no').click(function(e){
	  e.preventDefault();
	  $('#loginModal').modal("show");
  });
  
  $('a#rambo').click(function(e){
	  e.preventDefault();
	  hidePMthds();
  });
});


closedFunction=function() {
        //alert('window closed');
    }

     successFunction=function(transaction_id) {
		 $('#pyop-loading').html("");
		 hidePMthds();
        //alert('Transaction was successful, Ref: '+transaction_id);
        sendNotification(transaction_id);		
    }

     failedFunction=function(transaction_id) {
		 $('#pyop-loading').html("");
		 hidePMthds();
         //alert('Transaction was not successful, Ref: '+transaction_id);
		 sendNotification(transaction_id);
    }

function pay(ret){
       //Initiate voguepay inline payment
        Voguepay.init({
            v_merchant_id: '3778-0037623',
            total: ret.price,
            notify_url:urlxx,
            cur: 'NGN',
            merchant_ref: 'ref123',
            memo:'Buy token pack from SafeBets',
            recurrent: false,
            developer_code: '5b2238c5423a9',
            store_id:1,
            items: [
                {
                    name: ret.name,
                    description: ret.description,
                    price: ret.price
                },             
            ],
           closed:closedFunction,
           success:successFunction,
           failed:failedFunction
       });
    }

function sendNotification(tid){
	$.ajax({   
   type : 'POST',
   url  : notif,
   data: {'_token':ttt,'transaction_id':tid},
   beforeSend: function()
   { 
    $("#error").fadeOut();
   },
   success :  function(response)
      {    
       alert(response);	  
	   console.log(response);
     
     }
   });
}

function showBnk(){
	//cqd: bvyq - starter, fgds - jumbo
	$('#bkf').hide();
	$('#bks').fadeIn();
	var vvv = 0; 
	if(cqd == "bvyq") vvv = "1000";
	else if(cqd == "fgds") vvv = "5000";
	$('.cdqq').html(vvv);
}

function hideBnk(){
	//cqd: bvyq - starter, fgds - jumbo
	$('#bks').hide();
	$('#bkf').fadeIn();
}

function showPMthds(){
	//cqd: bvyq - starter, fgds - jumbo
	$('#tk-paks').hide();
	$('#py-mthds').fadeIn();
	window.location.href = "#py-mthds";
}

function hidePMthds(){
	$('#py-mthds').hide();
	$('#tk-paks').fadeIn();
}