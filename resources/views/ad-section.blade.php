@if(isset($ads) && count($ads) >= 3)
    <section class="p-0" id="">
      <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
		  @foreach($ads as $ad)
		  <?php $img = $ad['img']; $img = asset($img); $href = $ad['href']; ?>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="{{$href}}" target="_blank">
              <img class="img-fluid" src="{{$img}}" alt="" width="650" height="350">
            </a>
          </div>
		  @endforeach
		</div>
	  </div>
	</section>
@endif