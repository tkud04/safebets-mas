    <section id="todays-tips">
	  <center><h2 class="section-heading">Top Tips Today</h2></center>
	  <hr>
      <div class="container">
	    @if(isset($todayGames) && count($todayGames) > 0)
		<?php $itemCount = 0; ?>
	    <input type="hidden" value="{{url('v-g')}}" id="urlx"/>
	    <input type="hidden" value="{{csrf_token()}}" id="tk"/>
	
		@foreach($todayGames as $t)
		<?php ++$itemCount; ?>
		@if($itemCount == 1 || $itemCount % 5 == 0)
        <div class="row">
	    @endif
		  <?php 
		    $category = $t["category"];
		    $type = $t["type"];
			
			$al = $t["al"];
			$ct = $t["ct"];
			$xe = $t["id"];
			
			$badgeClass = "badge-info";
			$hrClass = "hr-info";
			$btnClass = "btn-info";
			
			if($category == "regular"){
				$badgeClass = "badge-success";
				$hrClass = "hr-success";
				$btnClass = "btn-success";
			} 
			else if($category == "premium"){
				$badgeClass = "badge-premium";
				$hrClass = "hr";
				$btnClass = "btn-primary";				
			}
			
			$typeText = "";
			
			if($type == "single")
			{
				$typeText = "Single game";
				if($category == "unverified") $cta = "View tip";
				else $cta = "View tip";
			}			
			
			else if($type == "multi")
			{
				$typeText = "Bet slip";
				if($category == "unverified") $cta = "View tip";
				else $cta = "View tip";
			}
		
		  ?>
          <div class="col-lg-3 col-md-12 ml-auto text-center">
                        <div class="card mt-5">
                            <div class="card-header"><span class="badge {{$badgeClass}}">{{$t["category"]}}</span></div>
                            <div class="card-body">
                                <h4 class="card-title">{{$t["seller"]}}</h4>
								<hr class="{{$hrClass}}">
                                <h6 class="card-subtitle">{{$typeText}}</h6>
								<p>Odds: <strong>{{$t["odds"]}}</strong></p>
								<hr class="{{$hrClass}}">
								<a href="#" class="btn {{$btnClass}} buy-game" data-al="{{$al}}" data-ct="{{$ct}}" data-xe="{{$xe}}">{{$cta}}</a>
                            </div>
							<div class="card-footer text-muted">{{$t["date"]}}</div>
                        </div>
          </div>
		@if($itemCount % 5 == 0)
        </div> 
	    @endif
        @endforeach	
        @endif		
		
		<br><br>
		<div class="row">
		     <div class="col-md-12">
			     <center><a href="{{url('tips')}}" class="btn btn-primary btn-lg">View more tips</a></center>
			 </div>
		</div>
      </div>
    </section>