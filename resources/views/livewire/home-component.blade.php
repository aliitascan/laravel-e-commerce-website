<main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					@foreach ($slides as $slide)
						<div class="item-slide">
							<img src="{{ asset('assets/images/slides/' . $slide->image) }}" alt="{{ $slide->title }}" class="img-slide" height="100%">
							<div class="slide-info slide-1">
								<h2 class="f-title">{{ $slide->title }}</h2>
								<span class="subtitle">{{ $slide->subtitle }}</span>
								<p class="sale-info">Only price: <span class="price">${{ $slide->price }}</span></p>
								<a href="{{ $slide->link }}" class="btn-link">Shop Now</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('assets/images/home-1-banner-1.jpg') }}" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('assets/images/home-1-banner-2.jpg') }}" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
			@if ($products->count() > 0)
				<div class="wrap-show-advance-info-box style-1 has-countdown">
					<h3 class="title-box">On Sale</h3>
					<div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
					<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
						@foreach ($products as $product)
							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="{{ route('product.details', $product->slug) }}" title="{{ $product->name }}">
										<figure><img src="{{ asset('assets/images/products/' . $product->image) }}" width="800" height="800" alt="{{ $product->name }}"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label">sale</span>
									</div>
								</div>
								<div class="product-info">
									<a href="{{ route('product.details', $product->slug) }}" class="product-name"><span>{{ $product->name }}</span></a>
									<div class="wrap-price">
										<ins><p class="product-price">${{ $product->salePrice }}</p></ins>
										<del><p class="product-price">${{ $product->regularPrice }}</p></del>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			@endif

			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{ asset('assets/images/digital-electronic-banner.jpg') }}" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">						
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
									@foreach ($latestProducts as $product)
										<div class="product product-style-2 equal-elem ">
											<div class="product-thumnail">
												<a href="{{ route('product.details', $product->slug) }}" title="{{ $product->name }}">
													<figure><img src="{{ asset('assets/images/products/' . $product->image) }}" width="800" height="800" alt="{{ $product->name }}"></figure>
												</a>
											</div>
											<div class="product-info">
												<a href="{{ route('product.details', $product->slug) }}" class="product-name"><span>{{ $product->name }}</span></a>
												<div class="wrap-price"><span class="product-price">${{ $product->regularPrice }}</span></div>
											</div>
										</div>
									@endforeach
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>

			<!--Product Categories-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Product Categories</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{ asset('assets/images/fashion-accesories-banner.jpg') }}" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-control">
							@foreach ($categories as $key => $category)
								<a href="#tab{{ $category->id }}" class="tab-control-item {{ $key == 0 ? 'active' : '' }}">{{ $category->name }}</a>
							@endforeach
						</div>
						<div class="tab-contents">
							@foreach ($categories as $key => $category)
								<div class="tab-content-item {{ $key == 0 ? 'active' : '' }}" id="tab{{ $category->id }}">
									<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
										@foreach ($category->products as $product)
											<div class="product product-style-2 equal-elem ">
												<div class="product-thumnail">
													<a href="{{ route('product.details', $product->slug) }}" title="{{ $product->name }}">
														<figure><img src="{{ asset('assets/images/products/' . $product->image) }}" width="800" height="800" alt="{{ $product->name }}"></figure>
													</a>
												</div>
												<div class="product-info">
													<a href="{{ route('product.details', $product->slug) }}" class="product-name"><span>{{ $product->name }}</span></a>
													<div class="wrap-price"><span class="product-price">${{ $product->regularPrice }}</span></div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>			

		</div>

	</main>