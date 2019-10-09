<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>
            @if(isset($title))
                {{$title}} -
            @endif
            Vocabulary Remider
        </title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/vendors/linericon/style.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="/vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="/vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="/vendors/animate-css/animate.css">
        <link rel="stylesheet" href="/vendors/popup/magnific-popup.css">
        <!-- main css -->
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/responsive.css">
        <link rel="stylesheet" type="text/css" href="/DataTables/css/dataTables.bootstrap4.min.css"/>
        <link rel="stylesheet" type="text/css" href="/css/toastr.min.css">
    </head>
    <body>

        <!--================Header Menu Area =================-->
        <header class="header_area">
           	<div class="top_menu row m0">
           		<div class="container">
					<div class="float-left">
						<ul class="list header_social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-behance"></i></a></li>
						</ul>
					</div>
					<div class="float-right">
						@if (Auth::check())
							<a class="dn_btn" href="{{route('user_profile')}}">{{Auth::user()->fullname}}</a>
							<a class="dn_btn" href="{{route('user_profile')}}">{{Auth::user()->email}}</a>
						@else
							<a class="dn_btn" href="{{route('login')}}">Đăng nhập</a>
							<a class="dn_btn" href="{{route('signup')}}">Đăng ký</a>
						@endif
					</div>
           		</div>
           	</div>
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="/"><img src="img/logo.png" alt=""></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item active"><a class="nav-link" href="/">Trang chủ</a></li> 
								<li class="nav-item"><a class="nav-link" href="{{route('vocabularies')}}">Từ vựng</a></li> 
								@if (Auth::check())
									<li class="nav-item"><a class="nav-link" href="/remind">Nhắc nhở</a></li> 
									<li class="nav-item"><a class="nav-link" href="{{route('vocabulary-manager')}}">Quản lý từ vựng</a></li> 
									<li class="nav-item submenu dropdown">
										<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tài khoản</a>
										<ul class="dropdown-menu" style="left: -70px;">
											<li class="nav-item"><a class="nav-link" href="{{route('user_profile')}}">Thông tin tài khoản</a>
											<li class="nav-item"><a class="nav-link" href="{{route('logout')}}">Đăng xuất</a></li>
										</ul>
									</li>
								@endif
							</ul>
						</div>
					</div>
            	</nav>
            </div>
        </header>
		<!--================Header Menu Area =================-->

		<div class="content-section" style="min-height: calc(100vh - 212px)">
			@yield('content')
		</div>

        <!--================ start footer Area  =================-->
		<footer class="footer-area">
				<div class="container">
					<div class="row footer-bottom d-flex justify-content-between align-items-center">
						<p class="col-lg-8 col-md-8 footer-text m-0">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Bài tập lớn môn phát triển phần mềm hướng dịch vụ. Được phát triển bởi <a href="#">Nhóm 5</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
						<div class="col-lg-4 col-md-4 footer-social">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</footer>
		<!--================ End footer Area  =================-->






        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="/js/jquery-3.3.1.min.js"></script>
        <script src="/js/toastr.min.js"></script>
        <script src="/js/popper.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/stellar.js"></script>
        <script src="/vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="/vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="/vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="/vendors/isotope/isotope.pkgd.min.js"></script>
        <script src="/vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="/vendors/popup/jquery.magnific-popup.min.js"></script>
        <script src="/js/jquery.ajaxchimp.min.js"></script>
        <script src="/vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="/vendors/counter-up/jquery.counterup.js"></script>
        <script src="/js/mail-script.js"></script>
        <script src="/js/theme.js"></script>
        <script type="text/javascript" src="/DataTables/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="/DataTables/js/dataTables.bootstrap4.min.js"></script>
        @yield('script')
    </body>
</html>
