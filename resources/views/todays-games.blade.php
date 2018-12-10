    <section id="todays-tips">
	  <center><h2 class="section-heading">WINNING Tips for <?= date("jS F, Y"); ?></h2></center>
	  <hr>
      <div class="container">
	    @if(isset($todayGames) && count($todayGames) > 0)
	     <?php $g = $todayGames[0];?>
        <div class="row">
          <div class="col-md-12">
          	<span class="label label-info">{{ $g['confidence'] }}</span>
                {!! $g['content'] !!}
          </div>
        </div> 
        @else
         <div class="row">
	       <div class="col-md-12">
		     <p>The predictions are coming in. Check back later? :)</p>
		   </div>
		 </div>			
        @endif		
		
		<br><br>
		<div class="row">
		     <div class="col-md-12">
			     <center><a href="{{url('results')}}" class="btn btn-primary btn-lg">View past results</a></center>
			 </div>
		</div>
      </div>
    </section>