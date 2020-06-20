<?php 
	include 'inc/functions.php'; 
	include 'inc/config.php';
?>
<!DOCTYPE html>
<head>
	<title>Gallery</title>
	<!-- custom-theme -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Megapixel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //custom-theme -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" property="" />
	<link href="css/style7.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Owl-carousel-CSS -->
	<link href="css/owl.carousel.css" rel="stylesheet">

	<link rel="stylesheet" href="css/team.css" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- font-awesome-icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome-icons -->
	<link href="//fonts.googleapis.com/css?family=Montserrat:100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800"
	    rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
</head>

<body>
	<!-- banner -->
	<div class="banner_top" id="home">
		<div class="wrapper">
			<?php 
				$isdata=false;
				if(isset($_GET['id']) && !empty($_GET)){
					$gallery_id = $_GET['id'];
					$gallery_infos = getgallerybyForeignKey('image',$gallery_id);
					// debugger($gallery_info,true);
					if ($gallery_infos) {
						$isdata = true;
					}
				}
			?>
			<div class="gallery">
				<?php 
					if ($isdata) {
						foreach ($gallery_infos as $key => $gallery_info) {
				?>
				<div class="gallery__img-block  ">
					<img src="<?php echo UPLOAD_URL."gallery/Croped".$gallery_info['image_title'] ?>" thumb-url="<?php echo UPLOAD_URL."gallery/Thumb_".$gallery_info['image_title'] ?>" alt="" />
				</div>
				
				<?php
						}	
					}
				?>
				
				
				<div class="gallery__controls">

				</div>
			</div>
		</div>
	</div>
	<div class="w3l_footer">
		<div class="container">
			<div class="col-md-4">
				<h2><a href="index.html"><i class="fa fa-camera-retro" aria-hidden="true"></i> Gallery</a></h2>
			</div>
			<?php 
				$all_gallery=getAllRowsofgallery('gallery',$gallery_id);
				// debugger($all_gallery,true);

			?>
			<div class="row" style="clear: both;">
				<?php
					foreach ($all_gallery as $key => $gallery_info_one) {
				?>
						<div class="col-md-4">
							<a href="gallery?id=<?php echo $gallery_info_one['id'] ?>">
								<img src="<?php echo UPLOAD_URL.'gallery/'.$gallery_info_one['featured_image'] ?>" alt="" width ="100%">
								<h4 style="color: #fff; margin: 5px 0px 10px 0px;"><?php echo $gallery_info_one['image_description']; ?></h4>		
							</a>	
						</div>
				<?php		
					}
				?>
			</div>
			<div class="clearfix"> </div>
			<div class="row"></div>
			<p class="agileits_w3ls_copyright">© 2018 TECH NEWS. All rights reserved | Design and Developeed by <a href="https://www.facebook.com/Niranjan2054">Niranjan Bekoju.</a></p>
			<div class="arrow-container animated fadeInDown">
				<a href="#home" class="arrow-2 scroll">
					<i class="fa fa-angle-up"></i>
				</a>
				<div class="arrow-1 animated hinge infinite zoomIn"></div>
			</div>
		</div>
	</div>
	<!--//footer -->



	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<!-- //js -->
	<!-- Slider script -->
	<script src="js/slider.js"></script>

	<!-- Kickoff the slider -->
	<script>
		$(document).ready(function () {
			var $gallery = $('.gallery');

			$gallery.vitGallery({
				autoplay: true
			})
		})
	</script>
	<!-- /nav -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/demo1.js"></script>
	<!-- //nav -->
	<!-- js for portfolio lightbox -->
	<script src="js/jquery.chocolat.js "></script>
	<link rel="stylesheet " href="css/chocolat.css " type="text/css" media="all" />
	<!--light-box-files -->
	<!-- /js for portfolio lightbox -->
	<!-- stats -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.countup.js"></script>
	<script>
		$('.counter').countUp();
	</script>
	<!-- //stats -->
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
	<!-- requried-jsfiles-for owl -->
	<script src="js/owl.carousel.js"></script>
	<script>
		$(document).ready(function () {
			$("#owl-demo2").owlCarousel({
				items: 1,
				lazyLoad: false,
				autoPlay: true,
				navigation: false,
				navigationText: false,
				pagination: true,
			});
		});
	</script>
	<!-- //requried-jsfiles-for owl -->

	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>


</body>

</html>