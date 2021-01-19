
    <div id="wrapper">
      <div class="slider-wrapper theme-default">
  <div id="slider" class="nivoSlider">
        <img src="../images/slides/slide1.jpg" alt="" data-transition="boxRandom"/>
        <img src="../images/slides/slide2.jpg" alt="" data-transition="boxRandom"/>
        <img src="../images/slides/slide3.jpg" alt="" data-transition="boxRandom"/>
        <img src="../images/slides/slide4.jpg" alt="" data-transition="boxRandom"/>
        <img src="../images/slides/slide5.jpg" alt="" data-transition="boxRandom"/></div>

      </div>

    </div>

        <script type="text/javascript" src="../scripts/nivo-slider/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        //$('#slider').nivoSlider();  // Defualt Behaviour
		
		
		    $('#slider').nivoSlider({
				effect: 'fade',
				controlNav: false
             });
    });
    </script>