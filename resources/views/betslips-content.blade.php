  <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Transactions</h4>
                                <h6 class="card-subtitle">List of your transactions on SafeBets</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Transaction</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
										<tbody>
										    @if(isset($totalBetSlipsPurchased))
											@foreach($totalBetSlipsPurchased as $bs)
										    <?php
											    $category = $bs["category"];
												$product = $bs["product"];
												$status = $bs['status'];
												$gs = "";
												
												$gameStatus = $bs['game-status'];
												if($gameStatus == "win") $gs = "text-success fa fa-check";
												else $gs = "text-primary fa fa-times";
											
												
												$badgeClass = "badge-info";
												$statusClass = "badge-info";
			
												if($category == "regular") $badgeClass = "badge-success";
												else if($category == "premium") $badgeClass = "badge-premium";
												
												if($status == "sold") $statusClass = "badge-success";
												else if($status == "refunded") $statusClass = "badge-danger";
												
												$url = url('view-bs');
												$exchangeUser = $bs["user-2"];
												$id = $bs["bs-id"];
											?>
                                            <tr>
                                                <td>{{$bs["date"]}}</td>
                                                <td>{{$product}}</td>
                                                <td><span class="badge {{$badgeClass}}">{{$category}}</span></td>
                                                <td><a href='#'>{{$exchangeUser}}</a><br><span class='badge {{$statusClass}}'>{{$status}}</span></td>
                                                <td><i class="{{$gs}}"></i></td>
                                                <td><a class="btn btn-warning text-white" href="#" onclick="viewBS({{$id}},'{{$url}}')">View</a></td>
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