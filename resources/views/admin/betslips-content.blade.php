
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tips</h4>
                                <h6 class="card-subtitle">List of all tips on SafeBets</h6>
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
												$bsite = $bs["bsite"];
												$bookingCode = $bs["booking-code"];
												$gs = "fa fa-question-circle";
												
												if($gameStatus == "win") $gs = "text-success fa fa-check";
												else if($gameStatus == "loss") $gs = "text-primary fa fa-times";
											
												
												$badgeClass = "label-info";
												$statusClass = "badge-info";
			
												if($category == "regular") $badgeClass = "label-success";
												else if($category == "premium") $badgeClass = "label-danger";
																								
												$url = url('nimda/tip');
												$seller = $bs["seller"];
												$id = $bs["id"];
												$url .= "/".$id;
												
												$winURL = url("nimda/shez/quee")."/".$id;
												$lossURL = url("nimda/shez/abra")."/".$id;
											?>
                                            <tr>
                                                <td>{{$bs["date"]}}</td>
                                                <td>{{$product}}</td>
                                                <td><span class="badge {{$badgeClass}}">{{$category}}</span></td>
                                                <td><a href='#'>{{$odds}}</a><br></td>
                                                <td><a href='#'>{{$bsite}}: {{$bookingCode}}</a><br></td>
                                                <td><a href='#'>{{$seller}}</a><br></td>
                                                <td><i class="{{$gs}}"></i></td>
												<td>
												 <a class="btn btn-warning text-white" href="{{$url}}">View</a>
												 @if($gameStatus == "uncleared")
												 <div class="btn-group" role="group">
												    <button id="mark-btn" type="button" class="btn btn-info text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mark</button>
												 <div class="dropdown-menu" aria-labelledby="mark-btn">
												    <a class="dropdown-item" href="{{$winURL}}">Win</a>												    
												    <a class="dropdown-item" href="{{$lossURL}}">Loss</a>
												 </div>													
												 </div>
												 @endif
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