 <hr>
  <div class="footer">
     This email was sent to <strong>{{$em}}</strong> by <strong>safebets@disenado.com.ng</strong><br>
	 Lagos, Nigeria<br>
	 <a href="{{url('/')}}" target="_blank">http://safebets.disenado.com.ng</a><br><br>
	 
	 <div>
	   <?php $url = url('unsubscribe')."/".$em; ?>
	   <a href="{{$url}}">Unsubscribe</a> | <a href="{{$url}}">Manage subscriptions</a> | <a href="#">Report spam</a> 
	 </div>
  </div>
</body>
</html>