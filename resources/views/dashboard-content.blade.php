    <section id="dashboard">
	    <h2 class="section-header">Dashboard</h2>
	     <div class="container">
                <div class="row">
                    <div class="col-md-4 text-success">
                        <div class="card crd">
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
					<div class="col-md-4 text-primary">
                        <div class="card crd">
                            <div class="row">
                                <div class="col-md-4">
                                    <span><i class="db-icon fa fa-soccer-ball-o fa-2x f-s-40 color-primary mt-3"></i></span>
                                </div>
                                <div class="col-md-8">
                                    <h2>{{$totalBetSlipsSold}}</h2>
                                    <p class="m-b-0">Tips sold</p>
									<a href="{{url('my-tips')}}" class="btn btn-primary">View tips</a>
                                </div>
                            </div>
                        </div>
                    </div>	
					<div class="col-md-4 text-info">
                        <div class="card crd">
                            <div class="row">
                                <div class="col-md-4">
                                    <span><i class="db-icon fa fa-soccer-ball-o fa-2x f-s-40 color-primary mt-3"></i></span>
                                </div>
                                <div class="col-md-8">
                                    <h2>{{$totalBetSlipsPurchased}}</h2>
                                    <p class="m-b-0">Tips purchased</p>
									<a href="{{url('my-tips')}}" class="btn btn-info">View tips</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
		 </div>
    </section>