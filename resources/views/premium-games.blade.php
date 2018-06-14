    <section id="premium-tips">
	  <center><h2 class="section-heading">Premium Tips</h2></center>
	  <hr>
      <div class="container">
	    @if(isset($premiumGames) && count($premiumGames) > 0)
		<?php $itemCount = 0; $total = count($premiumGames); $counter = 0;?>

	    <input type="hidden" value="{{url('v-g')}}" id="urlx"/>
	    <input type="hidden" value="{{csrf_token()}}" id="tk"/>

	
		@foreach($premiumGames as $t)
		<?php ++$itemCount; ++$counter; if($itemCount >= 5) $itemCount = 1;?>
		@if($itemCount == 1)
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
				if($category == "unverified") $cta = "View tip";
				else $cta = "Get this tip";
			}			
			
			else if($type == "multi")
			{
				$typeText = "bet slip";
				if($category == "unverified") $cta = "View tip";
				else $cta = "Get this tip";
			}
		
		  ?>
          <div class="col-lg-3 col-md-12 ml-auto text-center">
                        <div class="card mt-5">
                            <div class="card-header"><span class="badge {{$badgeClass}}">{{$t["category"]}}</span></div>
                            <div class="card-body">
                                <h4 class="card-title">{{$t["seller"]}}</h4>
								<hr class="hr">
                                <h6 class="card-subtitle">{{$typeText}}</h6>
								<p>Odds: <strong>{{$t["odds"]}}</strong></p>
								<hr class="hr">
								<a href="#" class="btn btn-primary buy-game" data-al="{{$al}}" data-ct="{{$ct}}" data-xe="{{$xe}}">{{$cta}}</a>
                            </div>
							<div class="card-footer text-muted">{{$t["date"]}}</div>
                        </div>
          </div>
		@if($itemCount == 4 || $counter == $total)
        </div> 
	    @endif
        @endforeach	
        @endif		
		
		<br><br>
		<div class="row">
		     <div class="col-md-12">
			     <center><a href="{{url('tips')}}" class="btn btn-primary btn-lg">View winning tips</a></center>
			 </div>
		</div>
      </div>
    </section>