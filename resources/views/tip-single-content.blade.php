  <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
          	@if(isset($tip))
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Results</h4>
                                
                                <?php
                             
											    $category = $tip["category"];
												$gameStatus = $tip["status"];
												$odds = $tip["odds"];
												$gs = "fa fa-question-circle";
												
												if($gameStatus == "win") $gs = "text-success fa fa-check";
												else if($gameStatus == "loss") $gs = "text-primary fa fa-times";
											
												
												$badgeClass = "badge-info";
												$statusClass = "badge-info";
			
												if($category == "free") $badgeClass = "badge-success";
												else if($category == "premium") $badgeClass = "badge-premium";
																								
											
												$id = $tip["id"];
												$url = url('view-tip')."/".$id;
											?>
                                <h6 class="card-subtitle">Total odds: {{$odds}} <span class="badge {{$badgeClass}}">{{$category}}</span></h6><br>
								<a href="{{url('/')}}" class="btn btn-lg btn-primary">GET WINNING TIPS</a><br>
								
								  {!! $tip['content'] !!}
								
                            </div>
                        </div>
                     @endif
          </div>
        </div>
      </div>
    </section>