    <section id="pricing">
	  <center><h2 class="section-heading">Buy token packs to get more winning tips!</h2></center>
	  <hr class="hr-success">
	  <input type="hidden" id="urlxx" value="{{url('notiff')}}"/>
	  <input type="hidden" id="ttt" value="{{csrf_token()}}"/>
	  <input type="hidden" id="urlnn" value="{{url('notiff')}}"/>
      <div class="container">
        <div class="row" id="tk-paks">
        <?php
		 $a = "no";
         if(isset($user) && $user != null) $a = "tk";
        ?>		
		  <div class="col-lg-6 col-md-12 ml-auto text-center">
                        <div class="card mt-5">
                            <div class="card-body">
							    <span class="badge badge-info">STARTER PACK</span><br><br>
                                <h4 class="card-title">8 Tokens</h4>
								<hr class="hr-info"><br>
                                <h5 class="card-subtitle">&#8358;1,000</h5><br>
								<hr class="hr-info">
								<a href="#" class="btn btn-info {{$a}}" data-cqd="bvyq">Buy now</a>
                            </div>
                        </div>
          </div>		  
		  <div class="col-lg-6 col-md-12 ml-auto text-center">
                        <div class="card mt-5">
                            <div class="card-body">
							    <span class="badge badge-success">JUMBO PACK</span><br><br>
                                <h4 class="card-title">40 Tokens</h4>
								<hr class="hr-success"><br>
                                <h5 class="card-subtitle">&#8358;5,000</h5><br>
								<hr class="hr-success">
								<a href="#" class="btn btn-success {{$a}}" data-cqd="fdgs">Buy now</a>
                            </div>
                        </div>
          </div>		  
          <div class="col-md-12 mt-5"><center><a href="{{url('tips')}}" class="btn btn-primary btn-lg">View more tips</a></center></div>
        </div><br><br>	
		<div class="row" id="py-mthds">
		   <div class="col-md-12">
            <p>Choose your preferred method of payment:</p>
            <div id="accordion">
				 <div class="card">
					 <div class="card-header" id="heading-1">
					     <h5 class="mb-0">
						     <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">Instant Deposit</button>
                         </h5>
					 </div>

					 <div id="collapse-1" class="collapse" aria-labelledby="heading-1" data-parent="#accordion">
					     <div class="card-body">
						   <div id="bkf">
                             Make a deposit or transfer using any of the payment methods listed. If your transaction is authorized, your account will be credited immediately.<br>              
							 <center><a href="#" class="btn btn-primary btn-lg mt-5" id="pybt">Proceed</a></center>
						   </div>
						   <div id="bks">
						     <h4 style="text-success">Amount: &#8358;</strong><span class="cdqq"></span></strong></h4>
                             Payment methods available:
							 <center>
							   <h5 class="text-success"><i class="fa fa-check-o fa-2x"></i> Bank transfer</h5>
							   <h5 class="text-success"><i class="fa fa-check-o fa-2x"></i> Western Union/MoneyGram</h5>
							   <h5 class="text-success"><i class="fa fa-check-o fa-2x"></i>Bitcoin</h5>
							 </center><br>
							 Contact customer support to make payment:<br>
							 Email: <span class="text-success">safebets.disenado@gmail.com</span><br>
							 Phone: <span class="text-success">(234)705 429 1601</span><br><br>
							 After payment you are required to send:<br>
							 <ul>
							   <li>Proof of payment (<strong>teller number,reference number,control number </strong> OR <strong>screenshot</strong>)</li>
							   <li>Your username</li>
							 </ul><br>
							 As soon as the transaction is approved you will be credited instantly.<br><br>
							 
							 <center><a href="#" class="btn btn-primary btn-lg mt-5" id="bks-btn">Back</a></center>
						   </div>
						 </div>
					 </div>
				 </div>
                 <div class="card">
					 <div class="card-header" id="heading-2">
					     <h5 class="mb-0">
						     <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-2" aria-expanded="true" aria-controls="collapse-2">Pay online with debit card</button>
                         </h5>
					 </div>

					 <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion">
					     <div class="card-body">
                            There is no fee for deposits with this payment method. If your transaction is authorized, your account will be credited immediately.<br><br>
							<span style="color: red"><strong>NOTE:</strong> Method is currently unavailable. Please try another payment method.</span>
							<center><span id="pyop-loading"></span><a href="#" class="btn btn-primary btn-lg mt-5" id="pyopp">Proceed</a></center>
						 </div>
					 </div>
				 </div>                                  
			</div><br>
			<center><a href="#" id="rambo" class="btn btn-primary btn-lg">Back</a></center>
		  </div>
		</div>		
      </div>
    </section>