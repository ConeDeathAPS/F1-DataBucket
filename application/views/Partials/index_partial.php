<script type="text/javascript">
	$(document).ready(function() {
		var sources = ["imgs/Force_India_gravel.jpg", "imgs/F1_pitstop.jpg", "imgs/Williams_close.jpg", "imgs/Corner_1.jpg", "imgs/Merc_close.jpg"];
		var image = $("img");
		var i = 1;
		setInterval(function() {
			image.fadeOut('slow', function() {
				image.attr("src", sources[i%5]);					
			});
			image.fadeIn('slow');			
			i++;
		}, 4000);
	})
</script>
<div id="slideshow">
<!-- 	<div class="progress" hidden>
      <div class="indeterminate"></div>
    </div> -->
	<img src="imgs/Force_India_gravel.jpg" alt="Slideshow">

</div>