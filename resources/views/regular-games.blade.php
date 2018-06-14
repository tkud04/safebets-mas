    <section id="todays-tips">
	  <center><h2 class="section-heading">Regular Tips</h2></center>
	  <hr>
      <div class="container">
	    @if(isset($regularGames) && count($regularGames) > 0)
		<?php $itemCount = 0; $counter = 0; $total = count($regularGames); ?>

	    <input type="hidden" value="{{url('v-g')}}" id="urlx"/>
	    <input type="hidden" value="{{csrf_token()}}" id="tk"/>

	
		@foreach($regularGames as $t)
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
								<hr class="hr-success">
                                <h6 class="card-subtitle">{{$typeText}}</h6>
								<p>Odds: <strong>{{$t["odds"]}}</strong></p>
								<hr class="hr-success">
								<a href="#" class="btn btn-success buy-game" data-al="{{$al}}" data-ct="{{$ct}}" data-xe="{{$xe}}">{{$cta}}</a>
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
			     <center><a href="{{url('tips')}}" class="btn btn-primary btn-lg">View more tips</a></center>
			 </div>
		</div>
      </div>
    </section>