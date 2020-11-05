<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Everest Rhino Travel</title>

	<!-- Styles -->
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/animate.css') }}" rel="stylesheet">

	<!-- flex slider css -->
	<link href="{{ asset('css/flex-slider/flexslider.css') }}" rel="stylesheet">
	<!-- end of flex slider css -->

	<!-- owlcarousel -->
	<link href="{{ asset('css/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">

	<!-- font awesome -->
	<link href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/plugins/toastr/build/toastr.min.css') }}" rel="stylesheet" type="text/css" />

	<!-- end of font awesome -->

	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	-->
	<!-- end of owl carousel -->
</head>
<body>
	<div class="topbar">
		<div class="wrapper">
			<div class="col-md-6"> <i class="fa fa-clock-o"></i>
				Sun to Fri 8:30 - 12:00 & 15:00 - 17:00
			</div>
			<div class="col-md-6 text-right">
				<ul class="topbar_ul">
					<li> <i class="fa fa-phone"></i>
						9851220141, 9841219873
					</li>
					<li>
						<i class="fa fa-map-marker"></i>
						Lagankhel, Lalitpur, Nepal
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div id="header-container" class="container-fluid @yield('header-container-class')">
		<header class="wrapper">
			<div class="logo col-md-5">
				<a href="{{ route('home') }}">
					<img src="{{ asset('img') }}/logo.png" alt=""></a>
			</div>
			<ul class="navbar">
				<li>
					<a class="<?php echo ((Request::routeIs('home'))? 'active': '') ?>" href="{{ route('home') }}">Home</a>
				</li>
				<li>
					<a href="javascript:;" class="{{ ((Request::is('trekkings') || Request::is('bestTour') || Request::is('gapyears'))?'active': '') }}">
						Our Program
						<i class="fa fa-sort-down"></i>
					</a>
					<ul>
						<li>
							<a href="{{ route('trekkingOffer.index') }}">Trekking</a>
						</li>
						<li>
							<a href="{{ route('bestTour.index') }}">Nepal best tours</a>
						</li>
						<li>
							<a href="{{ route('gapyearTravel.index') }}">Gap year / Volunteering programs</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="">
						Day Tour
						<i class="fa fa-sort-down"></i>
					</a>
					<ul>
						<li>
							<a href="">Joy of rafting</a>
						</li>
						<li>
							<a href="">Rock climbing</a>
						</li>
						<li>
							<a href="">Kathmandu world heritage</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="<?php echo ((Request::routeIs('pagecontent_front.show', []))? 'active': '') ?>
						">About Us
						<i class="fa fa-sort-down"></i>
					</a>
					<ul>
						<li>
							<a href="{{ route('pagecontent_front.show', [1]) }}">Our company</a>
						</li>
						<li>
							<a href="{{ route('pagecontent_front.show', [2]) }}">Our mission</a>
						</li>
						<li>
							<a href="{{ route('pagecontent_front.show', [3]) }}">Why ER travel</a>
						</li>
						<li>
							<a href="{{ route('ourTeam.index') }}">Our team</a>
						</li>
						<li>
							<a href="{{ route('pagecontent_front.show', [4]) }}">Terms of Use</a>
						</li>  
					</ul>
				</li>
			</ul>
		</header>
	</div>
	@yield ('content')
	<!-- Start of footer -->
	<footer class="container-fluid footer-container">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h3>Menu</h3>
					<ul class="footerMenu">
						<li>
							<a href="{{ route('home') }}">
								<i class="fa fa-link"></i>
								Home
							</a>
						</li>
						<li>
							<a href="{{ route('bestTour.index') }}">
								<i class="fa fa-link"></i>
								Best Tours
							</a>
						</li>
						<li>
							<a href="{{ route('trekkingOffer.index') }}">
								<i class="fa fa-link"></i>
								Trekkings
							</a>
						</li>
						<li>
							<a href="{{ route('gapyearTravel.index') }}">
								<i class="fa fa-link"></i>
								Gap Year Travels
							</a>
						</li>
					</ul>
				</div>

				<div class="col-md-4 footerContact">
					<h3>Contact</h3>
					<!-- <p>
						Lorem ipsum dolor sit amet, cons ectetueradipiscing elit, sed diam nonu my nibh euis motincidunt ut laoreetd
					</p>
					-->
					<ul class="footerContactUl animated transparentDiv">
						<li>
							<i class="fa fa-map-marker fa-fw"></i>
							Lagankhel, Lalitpur, Nepal
						</li>
						<li>
							<i class="fa fa-phone-square fa-fw"></i>
							9851220141, 9841219873
						</li>
						<li style="text-transform: lowercase;">
							<i class="fa fa-envelope fa-fw"></i>
							everestrhinotravel@gmail.com
						</li>
					</ul>

					<ul class="copyrightFooterUl footerSocialUl pull-left">
						<li class="animated animateDelay-5ms transparentDiv">
							<a href="">
								<i class="fa fa-facebook-square"></i>
							</a>
						</li>
						<li class="animated animateDelay-5ms transparentDiv">
							<a href="">
								<i class="fa fa-instagram"></i>
							</a>
						</li>
						<li class="animated animateDelay-5ms transparentDiv">
							<a href="">
								<i class="fa fa-youtube-play"></i>
							</a>
						</li>
					</ul>
				</div>

				<div class="col-md-4">
					<h3>Client Review</h3>
					<div class="owl-carousel owl-theme review-carousel">
					    <div class="item">
					    	<h4>It was way better than I expect</h4>
					    	<p title="My stay at Nepal, however short, was a memorable experience, and Everest Rhino Travel was a major part of why my experience there was so great.It was the first time I had visited Nepal, and I had heard all about  culture,  jungle safaris and other trekking, tours and Gap year activities. Nepal   attracts thousands of tourists yearly- and so I was made to expect that the hospitality there would be just as good.By travelling  through Everest Rhino Travel, I Got to experience Nepal differently. There were no complications, no worries of safety and security, and tours went smoothly without any hindrances.The tour package was best, All of the tours-whether it was the canoe ride, elephant ride, or the jeep safari-were fun and very informative. I got to learn so much since I have an interest in wildlife, and seeing so many animals, birds, reptiles and the jungle itself satisfied my interests. I never thought I’d get to experience the jungle and so many animals in a matter of days.Overall, I had a great experience in Nepal. If I ever return to Nepal for holiday or for any other purpose on that matter, I know I would always opt to Travel with Everest Rhino Travel.">
					    		My stay at Nepal, however short, was a memorable experience, and Everest Rhino Travel was a major part of why my experience there was so great.
					    		It was the first time I had visited Nepal, and I had heard all about  culture,  jungle safaris and other trekking, tours and Gap year activities. Nepal   attracts thousands...
					    	</p>
					    	<h5>- pallavi  Thapa (student)</h5>
					    </div>

					    <div class="item">
					    	<h4>It was a great experience, My tour was fun as well as informative</h4>
					    	<p title="It was the first time I had visited Nepal, and I fell like I travelled to different world. I spent two weeks in Nepal,the tour was good, I chose to stay in a hut ,whose walls housed an eye catching picture of wild animals of chitwan. Having a luxurious, fully facilated hotel room  with a pretty garden .As I consider myself to be an adventurous, nature loving person, I could not miss the opportunity to go on the jungle safari programs. The elephant back safari was a unique experience which is only performed in Nepal. The jeep safari seems more thrilling to me as I could see more of the various flora and funna including the royal Bengal Tiger and the one horned rhino. Overall, it was an unforgettable experience for me and to be immersed with the Culture and Environment. I recommend all nature lover to pay a visit and you surely would not regret it.">
					    		It was the first time I had visited Nepal, and I fell like I travelled to different world. I spent two weeks in Nepal,the tour was good, I chose to stay in a hut ,whose walls housed an eye catching picture of wild animals of chitwan. Having a luxurious, fully facilated hotel room  with a pretty garden ....
					    	</p>
					    	<h5>- Lidia  Moran (student)</h5>
					    </div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyrightFooter">
			<div class="container">
				<div class="row">
					<div class="col-md-6">Copyright © 2017 Everest Rhino Travel. All Rights Reserved.</div>
					<div class="col-md-6">
						<ul class="copyrightFooterUl">
							<li>
								<a href="{{ route('pagecontent_front.show', [4]) }}">Terms of Use</a>
							</li>
							<li>|</li>
							<li>
								<a href="{{ route('pagecontent_front.show', [4]) }}">Privacy Policy</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
<!-- End of footer -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
-->
<!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- Scripts -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/sticky-header/jquery.sticky.js') }}"></script>
<script src="{{ asset('assets/global/plugins/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
        
<!-- scroll animation -->
<script src="{{ asset('js/scrollAnim.js') }}"></script>
<!-- end of scroll animation -->

<script src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
@yield ('pageScripts')
<script type="text/javascript">
	$(function () {

		$('.affiliated-carousel').owlCarousel({
		    loop:true,
		    margin:10,
		    nav:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:5
		        }
		    }
		});

		$('.review-carousel').owlCarousel({
			loop:true,
			items: 1,
			margin:10,
			autoplay: true,
			// responsive:{
			// 	0:{
			// 		items:1
			// 	},
			// 	600:{
			// 		items:3
			// 	},
			// 	1000:{
			// 		items:6
			// 	}
			// },
		});

		$('.flexslider').flexslider({
			animation: "slide",
			pauseOnAction: false,
			start: function (slider) {
				var curSlide = slider.find(".flex-active-slide");
				var currentP = $(curSlide).find('p');
				currentP.removeClass('transparentDiv').addClass('fadeIn');
			},
			before: function (slider) {
				var curSlide = slider.find(".flex-active-slide");
				var currentP = $(curSlide).find('p');

				if (!currentP.hasClass('transparentDiv')) {
					currentP.addClass('transparentDiv').removeClass('fadeIn');
				}
			},
			after: function(slider){
				var curSlide = slider.find(".flex-active-slide");
				var currentP = $(curSlide).find('p');
				currentP.removeClass('transparentDiv').addClass('fadeIn');
			},
			});

		$('.home-pictures-carousel').owlCarousel({
			loop:true,
			items: 1,
			margin:10,
			nav: true,
			autoplay: true,
			// responsive:{
			// 	0:{
			// 		items:1
			// 	},
			// 	600:{
			// 		items:3
			// 	},
			// 	1000:{
			// 		items:6
			// 	}
			// },
		});
	});
</script>
<script type="text/javascript">
	$(function () {
		$("#header-container").sticky({ 
			topSpacing: 0,
			className: "animateStickyHeader"
		});

		$(".introBlock p").animateDivOnScroll({effect: "fadeInUp", scrollVal: 600});
		$(".bestTourBlock").find('.row').animateDivOnScroll({effect: "fadeIn", scrollVal: 650});
		$(".gapYearBlock > h1").animateDivOnScroll({effect: "bounceIn"});
		$(".gapYearDivText").animateDivOnScroll({effect: "fadeIn"});

		$(".gapYearBlock .gapYear-pic-block").each(function (index) {

			if (index < 2) {

				$(this).animateDivOnScroll({effect: "fadeInLeft", scrollVal: 650});
			} else {
				$(this).animateDivOnScroll({effect: "fadeInRight", scrollVal: 650});
			}
		});

		$(".footerContactUl").animateDivOnScroll({effect: "fadeIn", scrollVal: 600});

		$(".footerSocialUl li").each(function() {
			
			$(this).animateDivOnScroll({effect: "rubberBand", scrollVal: 700});
		});

	})
</script>
</body>
</html>