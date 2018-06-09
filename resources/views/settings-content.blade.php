  <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Profile</h4>
                                <h6 class="card-subtitle">Preview or update your account information</h6>
							    <form id="fixture-form" action="{{url('profile')}}" method="post">
								@if(isset($ret) && count($ret) > 0)
									{{csrf_field()}}
								             <?php
											    $category = $ret['category'];
											    $status = $ret['status'];
											    $fname = $ret['fname'];
											    $lname = $ret['lname'];
											    $phone = $ret['phone'];
											    $balance = $ret['balance'];
												
											   $categoryClass = "info";
											   
											   if($category == "regular") $categoryClass = "success";
											   elseif($category == "premium") $categoryClass = "primary";
											   $cac = "badge badge-".$categoryClass;											   
											   
											   $statusClass = "info";
											   
											   if($status == "active") $statusClass = "success";
											   elseif($status == "disabled") $statusClass = "primary";
											   $sc = "badge badge-".$statusClass;
											 ?>
									<div class="row">
									   <div class="col-lg-4 col-md-12">
							              <div class="form-group">
								             <label for="fname">First name</label>
								             <input class="form-control" type="text" placeholder="First name" id="fname" value="{{old('fname')}}"/>
							              </div>							     
							           </div>									   
									   <div class="col-lg-4 col-md-12">
							              <div class="form-group">
								             <label for="lname">Last name</label>
								             <input class="form-control" type="text" placeholder="Last name" id="lname" value="{{old('lname')}}"/>
							              </div>							     
							           </div>									   
									   <div class="col-lg-4 col-md-12">
							              <div class="form-group">
								             <label for="phone">Phone number</label>
								             <input class="form-control" type="text" placeholder="Last name" id="phone" value="{{old('phone')}}" disabled />
							              </div>							     
							           </div>							     
						            </div><br>						
                                   
                                    <script>
									  document.querySelector('#fname').value = "{{$fname}}";
									  document.querySelector('#lname').value = "{{$lname}}";
									  document.querySelector('#phone').value = "{{$phone}}";
									</script>								   
									
									<div class="row">
									   <div class="col-lg-4 col-md-12">
							              <div class="form-group">
								             <label for="balance">Current balance (tokens)</label>
								             <input class="form-control" type="text" placeholder="Current balance" id="balance" value="{{$balance}}" disabled />
							              </div>							     
							           </div>									   
									   <div class="col-lg-4 col-md-12">
							              <div class="form-group">
								             <label for="category">Category</label>
											 <span id="category" class="{{$cac}} form-control">{{$category}}</span>
							              </div>							     
							           </div>									   
									   <div class="col-lg-4 col-md-12">
							              <div class="form-group">
								             <label for="status">Account status</label>
								             <span id="status" class="{{$sc}} form-control">{{$status}}</span>
							              </div>							     
							           </div>							     
						            </div><br>	
									@endif
			                    </form>
                            </div>
                        </div>
          </div>
        </div>
      </div>
    </section>