    <section class="bg-dark text-white">
      <div class="container text-center">
        <h2 class="mb-4">Win big by buying winning predictions or get a refund</h2>
       <?php #<a class="btn btn-light btn-xl sr-button" href="http://startbootstrap.com/template-overviews/creative/">Download Now!</a> 
	   ?>
      </div>
    </section>

    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Contact Us!</h2>
            <hr class="my-4">
            <p class="mb-5">Call, text or email us anytime, we would love to hear from you.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fa fa-phone fa-3x mb-3 sr-contact"></i>
            <p>0705-429-1601</p>
          </div>
          <div class="col-lg-4 mr-auto text-center">
            <i class="fa fa-envelope-o fa-3x mb-3 sr-contact"></i>
            <p>
              <a href="mailto:safeBets.disenado@gmail.com">safebets.disenado@gmail.com</a>
            </p>
          </div>
        </div>
      </div><br><br>
      <div class="container text-center">
        <h2 class="mb-4">Powered by <img src="{{asset('img/logo.png')}}" class="img img-responsive" width="150"></h2>
       <?php #<a class="btn btn-light btn-xl sr-button" href="http://startbootstrap.com/template-overviews/creative/">Download Now!</a> 
	   ?>
      </div>
    </section>


			<!-- Login Modal -->
			<div id="loginModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<button type="button" class="close btn btn-warning" data-dismiss="modal">&times; close</button>
						<div class="modal-body">
											<p class="coupon-text">Returning customer? Sign in here.</p>
											<form action="{{url('login')}}" id="login-form" method="post">
											   {{csrf_field()}}
												<div class="form-group">
												    <label for="email"><strong>Username or email <span class="required">*</span></strong></label>
													<input class="form-control" type="text" id="email" name="email" placeholder="Username or Email address" value="{{old('email')}}" />
												</div>
												<div class="form-group">
													<label for="pass"><strong>Password <span class="required">*</span></strong></label>
													<input class="form-control" type="password" id="password" name="password" />
												</div>
												<div class="form-group">					
													<button type="submit" class="btn btn-success">Submit</button> 
													<label>
														<input type="checkbox" name="remember_me" />
														 Remember me 
													</label>
												</div>
												<p class="lost-password">
													<a href="{{url('lost-password')}}">Forgot password?</a>
												</p>
											</form>

						</div>
					</div>
				</div>
			</div>
			
			<!-- Register Modal -->
			<div id="registerModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<button type="button" class="close btn btn-warning" data-dismiss="modal">&times; close</button>
						<div class="modal-body">

											<p class="coupon-text">New customer? Sign up here!</p>
											<form action="{{url('register')}}" method="post">
											   {{csrf_field()}}
											   <div class="row">
													 <div class="col-sm-12 col-md-6">
														 <div class="form-group">
															 <label for="fname"><strong>First name  <span class="required">*</span></strong></label>
															 <input class="form-control" type="text" id="fname" name="fname" placeholder="First name" value="{{old('fname')}}" />
														 </div>
													 </div>													 
													 <div class="col-sm-12 col-md-6">
														 <div class="form-group">
															 <label for="lname"><strong>Last name  <span class="required">*</span></strong></label>
															 <input class="form-control" type="text" id="lname" name="lname" placeholder="Last name" value="{{old('lname')}}" />
														 </div>
													 </div>
											   </div>	
											    <div class="row">
													 <div class="col-sm-12">
														 <div class="form-group">
															 <label for="username"><strong>Username  <span class="required">*</span></strong></label>
															 <input class="form-control" type="text" name="username" placeholder="Your username" value="{{old('username')}}" />
														 </div>
													 </div>													 
											   </div>	
											   <div class="row">
													 <div class="col-sm-12">
														 <div class="form-group">
															 <label for="email"><strong>Email address  <span class="required">*</span></strong></label>
															 <input class="form-control" type="email" name="email" placeholder="Email address" value="{{old('email')}}" />
														 </div>
													 </div>													 
											   </div>											   
											   <div class="row">
													 <div class="col-sm-12">
														 <div class="form-group">
															 <label for="email"><strong>Phone number  <span class="required">*</span></strong></label>
															 <input class="form-control" type="text" name="phone" placeholder="Phone number" value="{{old('phone')}}" />
														 </div>
													 </div>													 
											   </div>											   
											   <div class="row">												 
													 <div class="col-sm-12 col-md-6">
														 <div class="form-group">
															 <label for="r-pass"><strong>Password  <span class="required">*</span></strong></label>
															 <input class="form-control" type="password" id="r-pass" name="pass" placeholder="Password" />
														 </div>
													 </div>													 
													 <div class="col-sm-12 col-md-6">
														 <div class="form-group">
															 <label for="r-pass2"><strong>Confirm password  <span class="required">*</span></strong></label>
															 <input class="form-control" type="password" id="r-pass2" name="pass_confirmation" placeholder="Confirm password" />
														 </div>
													 </div>
											   </div>											   
											   <div class="row">												 												 
													 <div class="col-md-12">
														 <div class="form-group">
															 <label>
														     By clicking Submit below you agree to the <a href="#" id="login-btn">Terms and Conditions</a>
													         </label>
														 </div>
													 </div>
											   </div>
												<div class="form-group">					
													<button type="submit" class="btn btn-success btn-lg">Submit</button> <br>
													<label>
														Existing user? <a href="#" id="login-btn">Sign in</a>
													</label>
												</div>											   
											</form>
						</div>
					</div>
				</div>
			</div>
			

			<!-- View Betslip Modal -->
			<div id="viewBetSlipModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<button type="button" class="close btn btn-warning" data-dismiss="modal">&times; close</button>
						<div class="modal-body">
						
                        <div class="card">
                            <div class="card-title">
                                <h4>Bet Slip #<span id="bs-id"></span> </h4>
								<div id="bs-error"></div>
								<div id="bs-working"></div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="bs-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Match</th>
                                                <th>Prediction</th>
                                                <th>Result</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						</div>
					</div>
				</div>
			</div>
			
		
		
			<!-- View Game Modal -->
			<div id="viewGameModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<button type="button" class="close btn btn-warning" data-dismiss="modal">&times; close</button>
						<div class="modal-body">

                        <div class="card">
                            <div class="card-title">
                                <h4>Bet Slip #<span id="vg-id"></span> </h4>
								<div id="vg-error"></div>
								<div id="vg-working"></div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="vg-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Match</th>
                                                <th>Prediction</th>
                                                <th>Result</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						</div>
					</div>
				</div>
			</div>
			
			
			<!-- Insufficient funds modal -->
			<div id="insufficientFundsModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<button type="button" class="close btn btn-warning" data-dismiss="modal">&times; close</button>
						<div class="modal-body">

                        <div class="card">
                            <div class="card-title">
                                <h4>Not enough tokens? </h4>
                            </div>
                            <div class="card-body">
        <div class="row">
         <div class="well text-center">Buy a token pack now!</div>		
		  <div class="col-lg-6 col-md-12 ml-auto text-center">
                        <div class="card mt-5">
                            <div class="card-body">
							    <span class="badge badge-info">STARTER PACK</span><br><br>
                                <h4 class="card-title">8 Tokens</h4>
								<hr class="hr-info"><br>
                                <h5 class="card-subtitle">&#8358;1,000</h5><br>
								<hr class="hr-info">
								<a href="#" class="btn btn-info">Buy now</a>
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
								<a href="#" class="btn btn-success">Buy now</a>
                            </div>
                        </div>
          </div>		  

        </div><br><br>
                            </div>
                        </div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Save Bet Slip Modal -->
			<div id="saveBetSlipModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<button type="button" class="close btn btn-warning" data-dismiss="modal">&times; close</button>
						<div class="modal-body">
											<p class="coupon-text">Enter the total odds and booking code.</p>
											<form>
												<div class="form-group">
												    <label for="booking_code"><strong>Booking code <span class="required">*</span></strong></label>
													<input class="form-control" type="text" id="booking_code" placeholder="Booking code.."/>
												</div>
												<div class="form-group">
													<label for="total_odds"><strong>Total odds <span class="required">*</span></strong></label>
													<input class="form-control" type="text" id="total_odds" placeholder="Total odds.."/>
												</div>
												<div class="form-group">					
													<a id="sbs-btn" class="btn btn-success" href="#">Submit</a> 
												</div>
											</form>

						</div>
					</div>
				</div>
			</div>