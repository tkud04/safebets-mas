           <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>&#8358;{{$totalRevenue}}</h2>
                                    <p class="m-b-0">Total revenue</p>
									<a class="btn btn-primary" href="{{url('nimda/transactions')}}">View details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-shopping-cart f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>{{$tokenSold}}</h2>
                                    <p class="m-b-0">Tokens sold</p>
									<a class="btn btn-primary" href="{{url('nimda/transactions')}}">View details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-archive f-s-40 color-warning"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>{{$totalBetSlips}}</h2>
                                    <p class="m-b-0">Tips</p>
									<a class="btn btn-primary" href="{{url('nimda/tips')}}">View tips</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-user f-s-40 color-danger"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>{{$totalPunters}}</h2>
                                    <p class="m-b-0">Punters</p>
									<a class="btn btn-primary" href="{{url('nimda/transactions')}}">View details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
					<div class="col-lg-3">
                        <div class="card bg-dark">
                            <div class="testimonial-widget-one p-17">
                                <div class="testimonial-widget-one owl-carousel owl-theme">
                                    <div class="item">
                                        <div class="testimonial-content">
                                            <img class="testimonial-author-img" src="{{asset('admin/images/avatar/2.jpg')}}" alt="" />
                                            <div class="testimonial-author">John</div>
                                            <div class="testimonial-author-position">Founder-Ceo. Dell Corp</div>

                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left"></i>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .
                                                <i class="fa fa-quote-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="testimonial-content">
                                            <img class="testimonial-author-img" src="{{asset('admin/images/avatar/3.jpg')}}" alt="" />
                                            <div class="testimonial-author">Richard Branson</div>
                                            <div class="testimonial-author-position">Founder-Coo. Dell Corp</div>

                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left"></i> My biggest motivation? Just to keep challenging myself. I see life almost like one long university education that I never had - everyday I'm learning something new. 
                                                <i class="fa fa-quote-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="testimonial-content">
                                            <img class="testimonial-author-img" src="{{asset('admin/images/avatar/1.jpg')}}" alt="" />
                                            <div class="testimonial-author">Thomas Edison</div>
                                            <div class="testimonial-author-position">Founder-Cfo. Dell Corp</div>

                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left"></i>  Genius is 1% inspiration and 88% perspiration.
                                                <i class="fa fa-quote-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="testimonial-content">
                                            <img class="testimonial-author-img" src="{{asset('admin/images/avatar/4.jpg')}}" alt="" />
                                            <div class="testimonial-author">Oprah Winfrey</div>
                                            <div class="testimonial-author-position">Founder-Ceo. Dell Corp</div>

                                           <div class="testimonial-text">
                                                <i class="fa fa-quote-left"></i>  Every time you state what you want or believe, you're the first to hear it. It's a message to both you and others about what you think is possible. Don't put a ceiling on yourself.
                                                <i class="fa fa-quote-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="testimonial-content">
                                            <img class="testimonial-author-img" src="{{asset('admin/images/avatar/5.jpg')}}" alt="" />
                                            <div class="testimonial-author">Ralph Waldo Emerson</div>
                                            <div class="testimonial-author-position">Founder-Ceo. Dell Corp</div>

                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left"></i>  Without ambition one starts nothing. Without work one finishes nothing. The prize will not be sent to you. You have to win it.
                                                <i class="fa fa-quote-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-title">
                                <h4>Recent Orders </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Username</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentOrders as $order)
											<?php
											  $username = $order['username'];
											  $product = $order['product'];
											  $quantity = $order['qty'];
											  $status = $order['status'];
											  
											  $statusClass = "badge-success";
											  
											  if($status == "refunded") $statusClass = "badge-danger";
											  $status = strtoupper($status);
											?>
                                            <tr>
                                                <td>
                                                    <div class="round-img">
                                                        <a href="#"><i class="fa fa-user"></i></a>
                                                    </div>
                                                </td>
                                                <td>{{$username}}</td>
                                                <td><span>{{$product}}</span></td>
                                                <td><span>{{$quantity}} pcs</span></td>
                                                <td><span class="badge {{$statusClass}}">{{$status}}</span></td>
                                            </tr>
											@endforeach            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


						<div class="row">
						<div class="col-lg-6">
							<div class="card">
								<div class="card-title">
									<h4>Messages</h4>
								</div>
								<div class="recent-comment">
								    @if(isset($messages))
								    @foreach($messages as $msg)
									<?php
									   $sender = $msg['sender'];
									   $m = $msg['msg'];
									   $date = $msg['date'];
									   
									   $mediaClass = "media";
									   if($counter == count($messages)) $mediaClass = "media no-border";
									   
									?>
									<div class="{{$mediaClass}}">
										<div class="media-left">
											<a href="#"><img alt="..." src="images/avatar/1.jpg" class="media-object"></a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">{{$sender}}</h4>
											<p>{{$m}}</p>
											<p class="comment-date">{{$date}}</p>
										</div>
									</div>
									@endforeach
									@endif
								</div>
							</div>
							<!-- /# card -->
						</div>
						<!-- /# column -->
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<div class="year-calendar"></div>
								</div>
							</div>
						</div>


						</div>

                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->