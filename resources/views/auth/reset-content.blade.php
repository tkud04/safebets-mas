    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
		   <h2 class="section-heading">Set Your New Password</h2>
            									<form action="{{url('change-password')}}" method="post">
											   {{csrf_field()}}
												<div class="form-group">
												    <label for="email"><strong>ENter your email address <span class="required">*</span></strong></label>
													<input class="form-control" type="email" id="email" name="email" placeholder="Email address" value="{{old('email')}}" />
												</div>
												<div class="form-group">					
													<button type="submit" class="btn btn-success">Submit</button> 
												</div>
											</form>
          </div>
        </div>
      </div><br><br>
    </section>