@include("emails.header")

  <div class="body">
      <?php echo date("jS F, Y"); ?><br><br>
	  
	   Hello admin, a user just unsubscribed from your email list.<br><br>
	   Email: <strong>{{$em}}</strong>
	  <span style="color: red"><strong>WARNING:</strong> Make sure you update your offline list accordingly!</span> 
  </div><br><br>
 @include("emails.footer")