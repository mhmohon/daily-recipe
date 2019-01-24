<!-- banner -->
		<div class="banner">
<!-- Slider-starts-Here -->
				<script src="js/responsiveslides.min.js"></script>
				 <script>
				    // You can also use "$(window).load(function() {"
				    $(function () {
				      // Slideshow 4
				      $("#slider3").responsiveSlides({
				        auto: true,
				        pager: false,
				        nav: true,
				        speed: 1000,
				        namespace: "callbacks",
				        before: function () {
				          $('.events').append("<li>before event fired.</li>");
				        },
				        after: function () {
				          $('.events').append("<li>after event fired.</li>");
				        }
				      });
				
				    });
				  </script>
			<!--//End-slider-script -->
				<div  id="top" class="callbacks_container wow fadeInUp" data-wow-delay="0.5s">
					<ul class="rslides" id="slider3">
						<li>
							<div class="banner-inf">
								<h3>Welcome To MasterChef</h3>
								<p>We’re not entirely vegetarian, but most of the recipes here are. I love to try new foods and create new recipes.but I will always have a soft spot for avocado toast and kale salads</p>
								<a href="index.php">Visit</a>
							</div>
						</li>
						<li>
							<div class="banner-inf">
								<h3>Want To Know About Me!</h3>
								<p>I’ve morphed my love of making food with my former career as a Creative Director in publishing to become a photo-taking, storytelling, magazine and e-cookbook designing food blogger.</p>
								<a href="about.php">Know More</a>
							</div>
						</li>
						<li>
							<div class="banner-inf">
								<h3>Also – our book is out!</h3>
								<p>The New York Times described the book as “happiness in itself tossed in every bowl.” Bon Appétit said it was “One of the loveliest cookbooks we’ve ever seen.”</p>
								<a href="https://www.amazon.com/gp/product/1583335862/ref=as_li_qf_sp_asin_il_tl?ie=UTF8&camp=1789&creative=9325&creativeASIN=1583335862&linkCode=as2&tag=loveandlemobl-20&linkId=QFDTBMM3E753RKXY">See Link</a>
							</div>
						</li>
					</ul>
				</div>
		</div>
<!-- //banner -->