@if(isset($ads) && count($ads) >= 3)
    <section class="p-0" id="">
      <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
		  @foreach($ads as $ad)
		  <?php $ad = asset($ad); ?>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="#">
              <img class="img-fluid" src="{{$ad}}" alt="">
            </a>
          </div>
		  @endforeach
		</div>
	  </div>
	</section>
@endif