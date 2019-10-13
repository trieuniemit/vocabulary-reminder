@extends('layouts.site_layout')

@section('content')
	<!--================Home Banner Area =================-->
	<section class="home_banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
			<div class="container">
				<div class="banner_content text-center">
					<h3>TƯƠNG LAI PHỤ THUỘC VÀO HÀNH ĐỘNG HÔM NAY</h3>
					<p>Chúng tôi mang đến một giải pháp học tiếng anh hiệu quả cho người Việt</p>
					<a class="main_btn" href="#">Bắt đầu học ngay</a>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->
	
	<!--================Finance Area =================-->
	<section class="finance_area">
		<div class="container">
			<div class="finance_inner row">
				<div class="col-lg-3 col-sm-6">
					<div class="finance_item">
						<div class="media">
							<div class="d-flex">
								<i class="lnr lnr-rocket"></i>
							</div>
							<div class="media-body">
								<h5>TĂNG TỐC</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="finance_item">
						<div class="media">
							<div class="d-flex">
								<i class="lnr lnr-earth"></i>
							</div>
							<div class="media-body">
								<h5>GẮN KẾT</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="finance_item">
						<div class="media">
							<div class="d-flex">
								<i class="lnr lnr-smile"></i>
							</div>
							<div class="media-body">
								<h5>NIỀM VUI</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="finance_item">
						<div class="media">
							<div class="d-flex">
								<i class="lnr lnr-tag"></i>
							</div>
							<div class="media-body">
								<h5>HIỆU QUẢ</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Finance Area =================-->
	<div class="container">
		<div class="content">
			<h3 class="update_title">TỪ MỚI CẬP NHẬT</h3>
			<div class="row">
				<div class="col-md-12" >
					<form action="" id="quick_search" style="justify-content: center;" autocomplete="off">
						<div class="form-group" style="margin: 0 5px;">
							<input type="text" name="q" id="search" class="form-control" placeholder="Nhập từ cần tra..." autocomplete="off">
						</div>
						<button type="button" class="btn btn-success"><i class="fa fa-search"></i></button>
					</form>
					<div class="quick_search_result">
						<ul></ul>
					</div>
				</div>
			</div>
			<div class="card-body" style="padding: 1.25rem 0;">
				<div class="row" id="x">
					<!-- item -->
					@foreach ($vocas as $index => $voca)
						<div class="col-md-2">
							<div class="word_elm" style="{{ $index <= 42 ? 'border-bottom: 1px solid #ececec;':''}}">
								<div class="card-desc">
									<h3 style="text-transform: capitalize;"><a href="{{route('home_vocabulary_detail', ['word' => $voca->word])}}" style="color: #000;">{{$voca->word}}</a></h3>
									<h6>/{{$voca->spelling}}/</h6>
									<p><i style="color: blue;">[{{$voca->means[0]->type}}]</i></p>
									<p>{{$voca->means[0]->mean}}</p>
								</div>
							</div>
						</div>
					@endforeach
					<!-- end item -->
				</div>
			</div>
		</div>
	</div>
	
	<!--================Impress Area =================-->
	<section class="impress_area p_120">
		<div class="container">
			<div class="impress_inner text-center">
				<h2>Become an instructor</h2>
				<p>There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station whether that is on the deck</p>
			</div>
		</div>
	</section>
	<!--================End Impress Area =================-->

@endsection