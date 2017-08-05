<div id="slider" class="flexslider main-slider" style="overflow: hidden;">
  <ul class="slides" style="transition-duration: 0.6s; width: 1000%; transform: translate3d(-2698px, 0px, 0px);">
      @foreach($slide as $slide)
      <li class="slide" style="width: 1349px; float: left; display: block;">
        <a href="#">
          <img src="storage/app/upload/slide/{{$slide->hinh}}" alt="">
        </a>
      </li>
      @endforeach
<ul class="flex-direction-nav"><li><a class="prev" href="#">Previous</a></li><li><a class="next" href="#">Next</a></li></ul></div>