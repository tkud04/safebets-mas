    <section id="todays-games">
	  <center><h2 class="section-heading">Top Games Today</h2></center>
	  <hr>
      <div class="container">
	    @if(isset($todayGames) && count($todayGames) > 0)
		<?php $itemCount = 0; ?>
	
		@foreach($todayGames as $t)
	    <input type="hidden" value="{{url('v-g')}}" id="urlx"/>
		<?php ++$itemCount; ?>
		@if($itemCount == 1 || $itemCount % 4 == 0)
        <div class="row">
	    @endif
		  <?php 
		    $category = $t["category"];
		    $type = $t["type"];
			
			$al = $t["al"];
			$ct = $t["ct"];
			$xe = $t["id"];
			
			$badgeClass = "badge-info";
			
			if($category == "regular") $badgeClass = "badge-success";
			else if($category == "premium") $badgeClass = "badge-premium";
			
			$typeText = "";
			
			if($type == "single")
			{
				$typeText = "single game";
				if($category == "beginner") $cta = "View this game";
				else $cta = "Get this game";
			}			
			
			else if($type == "multi")
			{
				$typeText = "bet slip";
				if($category == "beginner") $cta = "View games";
				else $cta = "Get this game";
			}
		
		  ?>
          <div class="col-lg-3 col-md-12 ml-auto text-center">
                        <div class="card mt-5">
                            <div class="card-header"><span class="badge {{$badgeClass}}">{{$t["category"]}}</span></div>
                            <div class="card-body">
                                <h4 class="card-title">{{$t["seller"]}}</h4>
								<hr class="hr-success">
                                <h6 class="card-subtitle">{{$typeText}}</h6>
								<p>Odds: <strong>{{$t["odds"]}}</strong></p>
								<hr class="hr-success">
								<a href="#" class="btn btn-success buy-game" data-al="{{$al}}" data-ct="{{$ct}}" data-xe="{{$xe}}">{{$cta}}</a>
                            </div>
							<div class="card-footer text-muted">{{$t["date"]}}</div>
                        </div>
          </div>
		@if($itemCount % 4 == 0)
        </div> 
	    @endif
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