
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-title">
                                <h4>Bet Slip #<span id="bs-id"></span> </h4>
								<div id="bs-error"></div>
								<div id="bs-working"></div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Match</th>
                                                <th>Prediction</th>
                                                <th>Result</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </tr>
                                        </thead>                                        
										<tbody>
										    @if(isset($bs))
											@foreach($bs['matches'] as $m)
										    <?php
											    $date = $m[0];
												$match = $m[1];
												$prediction = $m[2];
												$result = $m[3];
												$status = $m[4];
												$id = $bs["id"];

												$gs = "fa fa-question-circle";
												
												if($status == "win") $gs = "text-success fa fa-check";
												else if($status == "loss") $gs = "text-primary fa fa-times";
											
												
												$badgeClass = "badge-info";
												$statusClass = "badge-info";
												
												$winURL = url("nimda/swqq/quee")."/".$id;
												$lossURL = url("nimda/swqq/abra")."/".$id;
											?>
											<script>
													  document.querySelector('#bs-id').value = "{{$id}}";
											</script>
                                            <tr>
                                                <td>{{$date}}</td>
                                                <td>{{$match}}</td>
                                                <td>{{$prediction}}</td>
                                                <td>{{$result}}</td>
                                                <td>{{$status}}</td>
												<td>
												 @if($status == "uncleared")
												 <div class="btn-group" role="group">
												    <button id="mark-btn" type="button" class="btn btn-info text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mark</button>
												 <div class="dropdown-menu" aria-labelledby="mark-btn">
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