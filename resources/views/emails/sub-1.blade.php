<html>
<head>
<style type="text/css">
.header{
   margin-bottom: 3px;
   font-size: 14px;
}

.gdpr{
  margin-bottom: 16px;
}

.body{
  font-size: 1.2em; 
}

.footer{
   font-size: 14px;
   background: rgba(0,0,0,0.1);
   text-align: center;
}
</style>
</head>
<body>
  <div class="header">
    <div class="gdpr">
      Hi! Please add <strong>safebets.disenado@gmail.com</strong> to your address book so you don't miss all the valuable tips and predictions we are sending you daily to your inbox. <a href="#">If you do not want to receive these emails, you may unsubscribe here.</a>
	</div>
	<img src="{{asset('img/logo.JPG')}}" height="150" alt="Bet with sense. Choose SafeBets!"/><br><br>
  </div>
  <div class="body">
    <strong>Subscribe to our VIP list by clicking the link below and get sure 3+ odds in your inbox DAILY for FREE:</strong><br><br>
	<a href="{{url('free-tips')}}">Click Here to Subscribe to Our VIP List NOW</a><br><br>
	Have you been losing on bets? Been scammed by so-called 'fixed matches'? <br><br>
    Don't you just hate it when a single game casts your ticket? If you're looking for a better place to invest and get SURE WINNING TIPS...<br><br>
HERE IS THE BEST PLACE FOR YOU: <a href="{{url('free-tips')}}">Click Here to Subscribe to Our VIP List NOW</a><br><br>
  </div><br><br>
  <hr>
  <div class="footer">
     This email was sent to <strong>{{$em}}</strong> by <strong>safebets.disenado@gmail.com</strong><br>
	 Lagos, Nigeria<br>
	 <a href="http://safebets.disenado.com.ng" target="_blank">http://safebets.disenado.com.ng</a><br><br>
	 
	 <div>
	   <?php $url = url('unsubscribe')."/".$em; ?>
	   <a href="{{$url}}">Unsubscribe</a> | <a href="{{$url}}">Manage subscriptions</a> | <a href="#">Report spam</a> 
	 </div>
  </div>
</body>
</html>