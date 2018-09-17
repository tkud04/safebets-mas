<html>
<head>
<style type="text/css">
.header{
   margin-bottom: 3px;
   font-size: 9px;
}

.gdpr{
  margin-bottom: 16px;
}

.body{
  font-size: 1.2em; 
}

.premium{
   margin-bottom: 3px;
   font-style: oblique;
}

.footer{
   font-size: 9px;
   background: rgba(0,0,0,0.1);
   text-align: center;
}
</style>
</head>
<body>
  <div class="header">
    <div class="gdpr">
     <?php
         $unsub = url('unsubscribe')."/".$em;
      ?>
      Hi! Please add <strong>safebets@disenado.com.ng</strong> to your address book and mark as NOT SPAM so you don't miss all the valuable tips and predictions we are sending you daily to your inbox. <a href="{{$unsub}}">If you do not want to receive these emails, you may unsubscribe here.</a>
	</div>
	<center><img src="{{asset('img/logo.JPG')}}" height="150" alt="Bet with sense. Choose SafeBets!"/></center><br><br>
  </div>