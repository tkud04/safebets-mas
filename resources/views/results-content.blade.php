  <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Results</h4>
                                <h6 class="card-subtitle">Daily Tips Results</h6><br>
								<a href="{{url('/')}}" class="btn btn-lg btn-primary">GET WINNING TIPS</a><br>
								<input type="hidden" value="{{csrf_token()}}" id="tk"/>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                       <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Category</th>
                                                <th>Odds</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
										<tbody>
										    @if(isset($betslips))
											@foreach($betslips as $bs)
										    <?php
											    $category = $bs["category"];
												$gameStatus = $bs["status"];
												$odds = $bs["odds"];
												$gs = "fa fa-question-circle";
												
												if($gameStatus == "win") $gs = "text-success fa fa-check";
												else if($gameStatus == "loss") $gs = "text-primary fa fa-times";
											
												
												$badgeClass = "badge-info";
												$statusClass = "badge-info";
			
												if($category == "free") $badgeClass = "badge-success";
												else if($category == "premium") $badgeClass = "badge-premium";
																								
											
												$id = $bs["id"];
												$url = url('view-tip')."/".$id;
											?>
                                            <tr>
                                                <td>{{$bs["date"]}}</td>
                                                <td><span class="badge {{$badgeClass}}">{{$category}}</span></td>
                                                <td><a href='#'>{{$odds}}</a><br></td>
                                                <td><i class="{{$gs}}"></i></td>
												<td>
												 <a class="btn btn-warning text-white mlm" href="{{$url}}" target="_blank">View</a>												
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