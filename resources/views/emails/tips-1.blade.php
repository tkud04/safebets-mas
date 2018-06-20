@include("emails.header")

  <div class="body">
      <?php echo date("jS F, Y"); ?><br><br>
	  <strong>Hi there! Here are some SURE tips for you to stake on today as promised:</strong><br><br>
      {!!$msg!!}
	  <br><br>
	   These tips have been thoroughly researched and are vetted by top betting experts in the game. Don't let them go to waste!<br><br>
	   Also don't forget to share your success stories with us :) kindly send your testimonials to <strong>safebets.disenado@gmail.com</strong>, we'd appreciate. Happy betting!<br><br>
	  <span style="color: red"><strong>WARNING:</strong> Bet responsibly, stake what you can afford to lose</span> 
  </div><br><br>
 @include("emails.footer")