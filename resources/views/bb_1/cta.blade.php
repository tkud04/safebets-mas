 <!-- Call to action Section -->
        <section id="cta-1" class="section event">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="wow animated slideInRight" data-wow-delay=".4s"><a rel="nofollow" href="#">Drop Your Email Below to Subscribe to VIP Mailing List:</a></h2>
						<form action ="{{url('subscribe')}}" method="post">
							<input type="hidden" id="hh" name="_token" value="{{csrf_token()}}"/>
							<input type="hidden" id="hoh" value="{{url('subscribe')}}"/>
						 <div class="form-group">
						    <div class="row">
			    				<div class="com-md-12">
				    		      <input type="text" class="form-control" name="em" placeholder="Your email address.."/>
					    	    </div>
							</div>
						 </div>
						 <button type="submit" class="wow animated fadeInUp btn btn-common btn-lg mt-50" data-wow-delay=".6s"><i class="fa fa-check-square"></i> <strong>YES! SUBSCRIBE ME NOW!</strong><div class="ripple-container"></div></button>
						 </form>
						 <div id="working"></div>                   
                    </div>
                </div>
            </div>
        </section>
        <!-- Call to action Section End -->    </div>
