  <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">My Bet Slips</h4>
                                <h6 class="card-subtitle">List of all bet slips that you've purchased from SafeBets</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Category</th>
                                                <th>Sold by</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
										<tbody>
										    @if(isset($totalBetSlipsPurchased))
											@foreach($totalBetSlipsPurchased as $bs)
										    <?php
											    $category = $bs["category"];
												$type = $bs["type"];
												$status = $bs['status'];
												$gs = "";
												
												$gameStatus = $bs['game-status'];
												if($gameStatus == "win") $gs = "<i class='text-success fa fa-check'></i>";
												else $gs = "<i class='text-primary fa fa-times'></i>";
												
												$badgeClass = "badge-info";
												$statusClass = "badge-info";
			
												if($category == "regular") $badgeClass = "badge-success";
												else if($category == "premium") $badgeClass = "badge-premium";
												
												if($status == "sold") $statusClass = "badge-success";
												
												$url = url('view-bs');
												$exchangeUser = $bs["user-2"];
												$id = $bs["id"];
											?>
                                            <tr>
                                                <td>{{$bs["date"]}}</td>
                                                <td>Single-game bet slip</td>
                                                <td><span class="badge {{$badgeClass}}">{{$category}}</span></td>
                                                <td><a href='#'>{{$exchangeUser}}</a><br><span class='badge {{$statusClass}}'>{{$status}}</span></td>
                                                <td>{{$gs}}</td>
                                                <td><a class="btn btn-warning text-white" href="#" onclick="viewBS({{$id}},'{{$url}}')">View</a></td>
                                            </tr>  
											@endforeach
                                        </tbody>
										
                                    </table>
                                </div>
                            </div>
                        </div>
          </div>
        </div>
      </div>
    </section>