<!DOCTYPE html>
<html lang="en">

<head>
	<title>Nana Print | @yield('page-title')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="OneTech shop project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/bootstrap4/bootstrap.min.css') }}">
	<link href="{{ asset('assets/customer/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet"
			type="text/css">
	<link rel="stylesheet" type="text/css"
			href="{{ asset('assets/customer/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
	<link rel="stylesheet" type="text/css"
			href="{{ asset('assets/customer/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/plugins/OwlCarousel2-2.2.1/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/plugins/slick-1.8.0/slick.css') }}">

	@yield('css-tambahan')

	@stack('css')
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/product_styles.css') }}"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/product_responsive.css') }}">
	--}}
</head>

<body>

	<div class="super_container">

	<!-- Header -->

	<header class="header">

			<!-- Top Bar -->

			<div class="top_bar">
				<div class="container">
					<div class="row">
							<div class="col d-flex flex-row">
								<div class="top_bar_contact_item">
									<div class="top_bar_icon"><img src="{{ asset('assets/customer/images/phone.png') }}"
										alt=""></div>086137732366
								</div>
								<div class="top_bar_contact_item">
									<div class="top_bar_icon"><img src="{{ asset('assets/customer/images/mail.png') }}"
												alt=""></div><a href="mailto:fastsales@gmail.com">nanaprint@gmail.com</a>
								</div>
								<div class="top_bar_content ml-auto">
									<div class="top_bar_user">
											<div class="user_icon"><img src="{{ asset('assets/customer/images/user.svg') }}"
														alt=""></div>
											@if (Route::has('login'))
												@auth
													<div><a href="#">Logout</a></div>
												@else
													<div><a href="{{ route('registration') }}">Registrasi</a></div>
													<div><a href="{{ route('login') }}">Masuk</a></div>
												@endauth
											@endif
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>

			<!-- Header Main -->

			<div class="header_main">
				<div class="container">
					<div class="row">

							<!-- Logo -->
							<div class="col-lg-2 col-sm-3 col-3 order-1">
								<div class="logo_container">
									<div class="logo"><a href="{{ route('customer.dashboard') }}" style="font-size: 30px">Nana Print</a></div>
								</div>
							</div>
							<?php $category = \App\Category::all(); ?>
							
							<!-- Search -->
							<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
								<div class="header_search">
									<div class="header_search_content">
											<div class="header_search_form_container">
												<form action="#" class="header_search_form clearfix">
													<input type="search" required="required" class="header_search_input"
																placeholder="Search for products...">
													<div class="custom_dropdown">
															<div class="custom_dropdown_list">
																<span class="custom_dropdown_placeholder clc">All Categories</span>
																<i class="fas fa-chevron-down"></i>
																<ul class="custom_list clc">
																	<li><a class="clc" href="#">All Categories</a></li>
																	@foreach ($category as $item)
																		<li><a class="clc" href="#">{{ $item->name }}</a></li>
																	@endforeach
																</ul>
															</div>
													</div>
													<button type="submit" class="header_search_button trans_300"
														value="Submit">
													<img src="{{ asset('assets/customer/images/search.png') }}" alt=""></button>
												</form>
											</div>
									</div>
								</div>
							</div>

							@if (!Route::has('login'))
								<!-- Wishlist -->
								<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
									<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
										<!-- Cart -->
										<div class="cart">
												<div class="cart_container d-flex flex-row align-items-center justify-content-end">
													<div class="cart_icon">
														<img src="{{ asset('assets/customer/images/cart.png') }}" alt="">
														<div class="cart_count"><span>10</span></div>
													</div>
													<div class="cart_content">
														<div class="cart_text"><a href="#">Keranjang</a></div>
														<div class="cart_price">Rp. 4000</div>
													</div>
												</div>
										</div>
									</div>
								</div>
							@endif
					</div>
				</div>
			</div>

			<!-- Main Navigation -->

			<nav class="main_nav">
				<div class="container">
					<div class="row">
							<div class="col">

								<div class="main_nav_content d-flex flex-row">

									<!-- Categories Menu -->

									<div class="cat_menu_container">
											<div
												class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
												<div class="cat_burger"><span></span><span></span><span></span></div>
												<div class="cat_menu_text">Kategori ATK</div>
											</div>

											<ul class="cat_menu">
												@foreach ($category as $item)
													<li><a href="#">{{ $item->name }} <i class="fas fa-chevron-right ml-auto"></i></a></li>
												@endforeach												
										</ul>
									</div>

									<!-- Main Nav Menu -->

									<div class="main_nav_menu" >
											<ul class="standard_dropdown main_nav_dropdown">
												<li><a href="{{ route('customer.dashboard') }}" class="margin_a_nav_menu"
													style="margin-left : 25px; margin-right: 25px">Beranda<i class="fas fa-chevron-down"></i></a></li>
												<li><a href="{{ route('customer.product') }}" class="margin_a_nav_menu"
													style="margin-left : 25px; margin-right: 25px">Produk ATK<i class="fas fa-chevron-down"></i></a></li>
												<li class="hassubs">
													<a href="#" class="margin_a_nav_menu"
														style="margin-left : 25px; margin-right: 25px">Print Online<i class="fas fa-chevron-down"></i></a>
													<ul>
															<li><a href="{{ route('customer.order-print') }}">Print Data <i class="fas fa-chevron-down"></i></a></li>
															<li><a href="{{ route('customer.order-photo') }}">Print Foto<i class="fas fa-chevron-down"></i></a></li>
													</ul>
												</li>
												<li><a href="{{ route('contact-us') }}" class="margin_a_nav_menu"
													style="margin-left : 25px; margin-right: 25px">Kontak Pemilik<i class="fas fa-chevron-down"></i></a></li>
											</ul>
									</div>

									<!-- Menu Trigger -->

									<div class="menu_trigger_container ml-auto">
											<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
												<div class="menu_burger">
													<div class="menu_trigger_text">menu</div>
													<div class="cat_burger menu_burger_inner">
															<span></span><span></span><span></span></div>
												</div>
											</div>
									</div>

								</div>
							</div>
					</div>
				</div>
			</nav>

			<!-- Menu -->

			<div class="page_menu">
					<div class="container">
						<div class="row">
							<div class="col">

									<div class="page_menu_content">

										<div class="page_menu_search">
											<form action="#">
													<input type="search" required="required" class="page_menu_search_input"
															placeholder="Search for products...">
											</form>
										</div>
										<ul class="page_menu_nav">
											<li class="page_menu_item has-children">
													<a href="#">Akun<i class="fa fa-angle-down"></i></a>
													<ul class="page_menu_selection">
														<li><a href="#">Login<i class="fa fa-angle-down"></i></a></li>
														<li><a href="#">Registrasi<i class="fa fa-angle-down"></i></a></li>
													</ul>
											</li>
											<li class="page_menu_item">
													<a href="#">Beranda<i class="fa fa-angle-down"></i></a>
											</li>
											<li class="page_menu_item">
													<a href="#">Produk ATK<i class="fa fa-angle-down"></i></a>
											</li>
											<li class="page_menu_item has-children">
													<a href="#">Print Online<i class="fa fa-angle-down"></i></a>
													<ul class="page_menu_selection">
														<li><a href="#">Print Data<i class="fa fa-angle-down"></i></a></li>
														<li><a href="#">Print Foto<i class="fa fa-angle-down"></i></a></li>
													</ul>
											</li>
											<li class="page_menu_item"><a href="contact.html">Kontak Pemilik<i
												class="fa fa-angle-down"></i></a></li>
										</ul>

										<div class="menu_contact">
											<div class="menu_contact_item">
													<div class="menu_contact_icon"><img
																src="{{ asset('assets/customer/images/phone_white.png') }}" alt="">
													</div>08577162133
											</div>
											<div class="menu_contact_item" style="float:right">
													<div class="menu_contact_icon"><img
																src="{{ asset('assets/customer/images/mail_white.png') }}" alt="">
													</div><a href="mailto:fastsales@gmail.com">nanaprint@gmail.com</a>
											</div>

										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
		</header>

		<!-- Hot New Arrivals -->

		@yield('content')

	
	@include('customer.layouts.footer')
	
	@yield('js-tambahan')

	@stack('js')
</body>

</html>
