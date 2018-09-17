@include("emails.header")

  <div class="body">
      <?php echo date("jS F, Y"); ?><br><br>
      Hello punters, <br>
	  {!!$msg!!}
	  <br><br>
	   <span style="color:red; font-weight: bold;">DISCLAIMER: As much as we'd like to, we cannot assure you that you will win all the time (we don't do fixed matches), but we can GUARANTEE you will record more wins than losses with our tips.</span> <br><br>
	   Also don't forget to share your success stories with us :) kindly send your testimonials to <strong>safebets.disenado@gmail.com</strong>, we'd appreciate. Happy betting!<br><br>
	  <span style="color: red">Only stake what you can afford to lose, we will NOT be held responsible for any irrecoverable loss on your end</span> 
  </div><br><br>
 @include("emails.footer")