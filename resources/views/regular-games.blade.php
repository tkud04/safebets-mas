    <section id="premium-games">
	  <center><h2 class="section-heading">Top Regular Games</h2></center>
	  <hr>
      <div class="container">
        <div class="row">
		  @if(isset($regularGames) && count($regularGames) > 0)
		  @foreach($regularGames as $r)
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
                            <div class="card-header"><span class="badge {{$badgeClass}}">{{$r["category"]}}</span></div>
                            <div class="card-body">
                                <h4 class="card-title">{{$r["desc"]}}</h4>
								<hr class="hr-success">
                                <h6 class="card-subtitle">{{$r["type"]}}</h6>
								<p>{{$r["league"]}}</p>
								<hr class="hr-success">
								<a href="#" class="btn btn-success">{{$cta}}</a>
                            </div>
							<div class="card-footer text-muted">{{$r["date"]}}</div>
                        </div>
          </div>
		  @endforeach
		   @endif
        </div> 	         
		
		<br><br>
		<div class="row">
		     <div class="col-md-12">
			     <center><a href="{{url('games')}}" class="btn btn-primary btn-lg">View more games</a></center>
			 </div>
		</div>
      </div>
    </section>