
      <div class="container-fluid">
	  <input type="hidden" id="urlx" value="{{url('nimda/a-s')}}"/>
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
											<?php $bs_id = $bs["id"]; ?>
										
											@foreach($bs['matches'] as $m)
										    <?php
											    $date = $m[0];
												$match = $m[1];
												$prediction = $m[2];
												$result = $m[3];
												$status = $m[4];
												$id = $m[5];

												$gs = "fa fa-question-circle fa-2x";
												
												if($status == "win") $gs = "text-success fa fa-check fa-2x";
												else if($status == "loss") $gs = "text-primary fa fa-times fa-2x";
											
												
												$badgeClass = "badge-info";
												$statusClass = "badge-info";
												
												$winURL = url("nimda/swqq/quee")."/".$id."/".$bs_id;
												$lossURL = url("nimda/swqq/abra")."/".$id."/".$bs_id;
											?>
											<script>
													  document.querySelector('#bs-id').textContent = "{{$id}}";
											</script>
                                            <tr>
                                                <td>{{$date}}</td>
                                                <td>{{$match}}</td>
                                                <td>{{$prediction}}</td>
                                                <td>
												@if($result == "")
												   <a href="#" class="btn btn-warning add-scoreline-btn">FT score?</a>
											       <input type="text" class="ft-s" placeholder="1 - 0"/>
											       <input type="hidden" class="dip" value="<?php echo $id; ?>"/>
											       <button class="btn btn-warning ft-s-btn">Submit</button>
											    @else
 			 				 					   {{$result}}
											    @endif
												</td>
                                                <td>{{$status}}</td>
												<td>
												 @if($status == "uncleared")
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