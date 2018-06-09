  <section id="my-tips">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">My Tips</h4>
                                <h6 class="card-subtitle">List of your tips on SafeBets</h6><br>
								<a href="{{url('add-tip')}}" class="btn btn-lg btn-primary">Add tip</a><br>
								<input type="hidden" value="{{csrf_token()}}" id="tk"/>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                       <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Odds</th>
                                                <th>Booking code</th>
                                                <th>Seller</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
										<tbody>
										    @if(isset($betslips))
											@foreach($betslips as $bs)
										    <?php
											    $category = $bs["category"];
												$product = $bs["product"];
												$gameStatus = $bs["status"];
												$odds = $bs["odds"];
												$bookingCode = $bs["booking-code"];
												$bsite = $bs["bsite"];
												$gs = "fa fa-question-circle";
												
												if($gameStatus == "win") $gs = "text-success fa fa-check";
												else if($gameStatus == "loss") $gs = "text-primary fa fa-times";
											
												
												$badgeClass = "badge-info";
												$statusClass = "badge-info";
			
												if($category == "regular") $badgeClass = "badge-success";
												else if($category == "premium") $badgeClass = "badge-premium";
																								
												$url = url('view-bs');
												$seller = $bs["seller"];
												$id = $bs["id"];
											?>
                                            <tr>
                                                <td>{{$bs["date"]}}</td>
                                                <td>{{$product}}</td>
                                                <td><span class="badge {{$badgeClass}}">{{$category}}</span></td>
                                                <td><a href='#'>{{$odds}}</a><br></td>
                                                <td><a href='#'><strong>{{$bsite}}</strong>: {{$bookingCode}}</a><br></td>
                                                <td><a href='#'>{{$seller}}</a><br></td>
                                                <td><i class="{{$gs}}"></i></td>
												<td>
												 <a class="btn btn-warning text-white" href="#" onclick="viewBS({{$id}},'<?php echo $url; ?>')">View</a>
												</td>
                                            </tr>  
											@endforeach
											@endif
                                        </tbody>
										
                                    </table>
                                </div>
                            </div>
                        </div>
          </div>
        </div>
      </div>
    </section>