
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Transactions</h4>
                                <h6 class="card-subtitle">List of all purchases on SafeBets</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Category</th>
                                                <th>Buyer</th>
                                                <th>Seller</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
										<tbody>
										    @if(isset($purchases))
											@foreach($purchases as $p)
										    <?php
											    $category = $p["category"];
												$qty = $p["qty"];
												$product = $p["product"];
												$buyer = $p['buyer'];
												$seller = $p['seller'];
												$status = $p['status'];
											     $url = "#";	
												if($category != "Tokens"){
												   $bs_id = $p['bs-id'];
                                                   $url = url('nimda/tip');
                                                   $url .= "/".$bs_id;												   
												}
											
												
												$badgeClass = "badge-info";
												$statusClass = "badge-info";
			
												if($category == "regular") $badgeClass = "badge-success";
												else if($category == "premium") $badgeClass = "badge-danger";
																								
												$id = $p["id"];
											?>
                                            <tr>
                                                <td>{{$p["date"]}}</td>
                                                <td>{{$product}}</td>
                                                <td>{{$qty}} pcs.</td>
                                                <td><span class="badge {{$badgeClass}}">{{$category}}</span></td>
                                                <td><a href='#'>{{$buyer}}</a><br></td>
                                                <td><a href='#'>{{$seller}}</a><br></td>
                                                <td>{{$status}}</td>
												<td>
												 @if($category != "Tokens")<a class="btn btn-warning text-white" href="{{$url}}">View</a>@endif
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