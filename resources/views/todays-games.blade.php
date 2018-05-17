    <section id="todays-games">
	  <center><h2 class="section-heading">Top Games Today</h2></center>
	  <hr>
      <div class="container">
	    @if(isset($todayGames) && count($todayGames) > 0)
		@foreach($todayGames as $tg)
        <div class="row">
		  @foreach($tg as $t)
		  <?php 
		    $category = $t["category"];
		    $type = $t["type"];
			$badgeClass = "badge-info";
			
			if($category == "regular") $badgeClass = "badge-success";
			else if($category == "premium") $badgeClass = "badge-premium";
			
			if($type == "single")
			{
				if($category == "beginner") $cta = "View this game";
				else $cta = "Get this game";
			}			
			
			else if($type == "multi")
			{
				if($category == "beginner") $cta = "View games";
				else $cta = "Get this game";
			}
		  ?>
          <div class="col-lg-3col-md-12 ml-auto text-center">
                        <div class="card mt-5">
                            <div class="card-header"><span class="badge {{$badgeClass}}">{{$t["category"]}}</span></div>
                            <div class="card-body">
                                <h4 class="card-title">{{$t["desc"]}}</h4>
								<hr class="hr-success">
                                <h6 class="card-subtitle">{{$t["type"]}}</h6>
								<p>{{$t["league"]}}</p>
								<hr class="hr-success">
								<a href="#" class="btn btn-success">{{$cta}}</a>
                            </div>
							<div class="card-footer text-muted">{{$t["date"]}}</div>
                        </div>
          </div>
		  @endforeach
        </div> 
        @endforeach	
        @endif		
		
		<br><br>
		<div class="row">
		     <div class="col-md-12">
			     <center><a href="{{url('games')}}" class="btn btn-primary btn-lg">View more games</a></center>
			 </div>
		</div>
      </div>
    </section>