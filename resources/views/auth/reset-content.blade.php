    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
		   <h2 class="section-heading">Set Your New Password</h2>
            									<form action="{{url('change-password')}}" method="post">
											   {{csrf_field()}}
											<input type="hidden" name="rxf"/>
												<div class="form-group">
												    <label><strong>Enter your new password<span class="required">*</span></strong></label>
													<input class="form-control" type="password" name="password" placeholder="Your new password"/>
												</div>
												<div class="form-group">
												    <label><strong>Confirm your new password<span class="required">*</span></strong></label>
													<input class="form-control" type="password" name="password_confirmation" placeholder="Confirm password"/>
												</div>
												<div class="form-group">					
													<button type="submit" class="btn btn-success">Submit</button> 
												</div>
											</form>
          </div>
        </div>
      </div><br><br>
    </section>