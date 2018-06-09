var urlxx = $('#urlxx').val();
var urlxx = $('#urlxx').val();
var notif = $('#urlnn').val();
var cqd = 0;
$('#py-mthds').hide();

$(document).ready(function(){
    $('a#bvyq').click(function(e){
         var prt = $(this).parent(".well");
         //alert(prt.html());
         var ret = new Object();
          ret.name = "Starter token pack";
          ret.description = "8 SafeBets tokens";
          ret.price = "1000";
          pay(ret);
    });
	$('a#fgds').click(function(e){
         var prt = $(this).parent(".well");
         //alert(prt.html());
         var ret = new Object();
          ret.name = "Jumbo token pack";
          ret.description = "40 SafeBets tokens";
          ret.price = "5000";
          pay(ret);
    });
  $('a.tk').click(function(e){
	  e.preventDefault();
	  cqd = $(this).attr("data-cqd");
	  console.log("cdq = " + cqd);
	  showPMthds();
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
        alert('Transaction was successful, Ref: '+transaction_id);
        sendNotification(transaction_id);		
    }

     failedFunction=function(transaction_id) {
         alert('Transaction was not successful, Ref: '+transaction_id);
		 sendNotification(transaction_id);
    }

function pay(ret){
       //Initiate voguepay inline payment
        Voguepay.init({
            v_merchant_id: 'demo',
            total: ret.price,
            notify_url:urlxx,
            cur: 'NGN',
            merchant_ref: 'ref123',
            memo:'Buy tokens from SafeBets',
            recurrent: false,
            developer_code: '5a61be72ab323',
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
   data: {'transaction_id':tid},
   beforeSend: function()
   { 
    $("#error").fadeOut();
   },
   success :  function(response)
      {         
	   if(response.status == "error"){}
	   else{
			 console.log("Notification sent.");			 
	   }   
     
     }
   });
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