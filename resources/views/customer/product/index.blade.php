@extends('customer.layouts.app')

@section('page-title', 'Produk ATK')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/shop_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/shop_responsive.css') }}">
@endsection

@push('css')
	<style>
		.product_a {
			text-decoration: none;
			color: black;
		}
		.product_a:hover {
			color: black;
		}

		.product_if_hover {
			background: white;
		}

		.product_if_hover:hover {
			background: #f4f2f2;
			color: black;
		}
	
	</style>
@endpush

@section('content')
	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Categories</div>
							<ul class="sidebar_categories">
								<li><a href="{{ route('product') }}">All Categories</a></li>
								@foreach ($categories as $category)
									<li><a href="{{ route('product', ['category' => $category->name]) }}">{{ $category->name }} ({{ $category->items->count() }})</a></li>
								@endforeach
							</ul>
						</div>
					</div>

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><a href="{{ route('product') }}"><span>{{ $itemsCount }}</span></a> products found</div>
							<div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>

						<div class="product_grid">
							
							@foreach ($items as $key => $item)
							<div class="product_grid_border"></div>
								<!-- Product Item -->
								<div class="product_item product_if_hover">
									<div class="product_border"></div>
										<a href="{{ route('show-product', $item->id) }}" tabindex="{{ $key }}" class="product_a">
										<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('storage/' . $item->cover) }}" width="120px" alt=""></div>
										<div class="product_content">
											<div class="product_price">{{ toRupiah($item->price) }}</div>
											<div class="product_name"><div>{{ $item->name }}</div></div>
										</div>
									</a>
								</div>
							@endforeach
							@empty($item)
								<div class="mt-4">Barang yang anda cari tidak tersedia</div>
							@endempty
                     
						</div>

						<!-- Shop Page Navigation/Pagination -->

						<div class="shop_page_nav d-flex flex-row justify-content-center">							
							<ul class="page_nav d-flex flex-row"> 
									{{ $items->appends(Request::all())->links() }}
							</ul>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
@endsection

@section('js-tambahan')
   <script src="{{ asset('assets/customer/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
   <script src="{{ asset('assets/customer/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
   <script src="{{ asset('assets/customer/js/shop_custom.js') }}"></script> 
@endsection