@include("emails.header")

  <div class="body">
      <?php echo date("jS F, Y"); ?><br><br>
      {!!$msg!!}
	  <br><br>
	   Get full access to winning tips DAILY for FREE by subscribing to the VIP list NOW: <a href="{{url('free-tips')}}">SUBSCRIBE TO VIP LIST</a><br><br> 
	   Happy betting!<br><br>
	  <span style="color: red"><strong>WARNING:</strong> Bet responsibly, stake what you can afford to lose</span> 
  </div><br><br>
 @include("emails.footer")