    <section id="dashboard">
	     <div class="container">
                <div class="row">
				    <div class="col-md-2"></div>
                    <div class="col-md-4 text-success">
                        <div class="card crd p-30">
                            <div class="row">
                                <div class="col-md-4">
                                    <span><i class="db-icon fa fa-cubes fa-2x f-s-40 color-primary mt-3"></i></span>
                                </div>
                                <div class="col-md-8">
                                    <h2>{{$tokenBalance}}</h2>
                                    <p class="m-b-0">Tokens</p>
									<a href="{{url('pricing')}}" class="btn btn-success">Get more tokens</a>
                                </div>
                            </div>
                        </div>
                    </div>                    
					<div class="col-md-4 text-info">
                        <div class="card crd p-30">
                            <div class="row">
                                <div class="col-md-4">
                                    <span><i class="db-icon fa fa-soccer-ball-o fa-2x f-s-40 color-primary mt-3"></i></span>
                                </div>
                                <div class="col-md-8">
                                    <h2>{{$totalBetSlipsPurchased}}</h2>
                                    <p class="m-b-0">Bet slips purchased</p>
									<a href="{{url('betslips')}}" class="btn btn-info">View bet slips</a>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-md-2"></div>
                </div>
                </div>
		 </div>
    </section>