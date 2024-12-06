<section data-type="how_it_works" data-layout="{{ $layout }}" class="py-[60px] md:py-[105px]">
	<div class="container">
		<div class="space-y-4 mb-[25px] lg:mb-[60px] max-w-[750px] mx-auto text-center" data-aos=child_appear data-aos-once=true>
			@include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 40])
			@include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 16])
		</div>
		<div class="tabbed-swiper">
			@if ($layout === '1')
				<div class="swiper tabbed-swiper-wrapper swiper-layout-{{ $layout }} relative" data-aos=appear data-aos-once=true>
					<div class="hidden md:flex md:px-[80px] xl:px-[150px] pb-12"  data-aos=child_appear data-aos-once=true>
						@foreach ($items as $item)
						<div class="slidenav flex-1 pb-4 text-[14px] opacity-50 text-center tabbed-swiper-navigation-item cursor-pointer" data-name="	{{ $item['tab_title'] }}">
							{{ $item['tab_title'] }}
						</div>
						@endforeach
					</div>
					<ul class="swiper-wrapper" >
						@foreach ($items as $key => $item)
						<li class="swiper-slide" data-hash="slide{{$key+1}}">
							<div class="px-[45px] md:px-[80px] xl:px-[150px]">
								<div class="md:flex items-center md:flex-row-reverse">
									<div class="md:w-[45%] lg:w-[55%] mb-6 md:mb-0">
										@if ($item['video_embed'])
											<a href="{{ $item['video_embed'] }}" class="glightbox h-full relative block hover:video-button">
										@endif
												@img($item['image']['ID'], 'large w-full h-full object-cover')
										@if ($item['video_embed'])
												<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
													@include('icons.play-button-white')
												</div>
											</a>
										@endif
									</div>
									<div class="flex-1 pl-2 md:pl-0 md:pr-6 lg:pr-28">
										@include('flexible.how_it_works.item', $item)
									</div>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
					<div class="swiper-button-prev scale-[0.6] md:scale-[1] cursor-pointer absolute z-10 top-[50%] mt-[-35px] left-[-10px] md:left-0">
						@include('icons.slider-arrow-left')
					</div>
					<div class="swiper-button-next scale-[0.6] md:scale-[1] cursor-pointer absolute z-10 top-[50%] mt-[-35px] right-[-10px] md:right-0">
						@include('icons.slider-arrow-right')
					</div>
				</div>
			@elseif($layout === '4')
				<div class="relative">
					<div class="md:flex items-center {{ $flip_columns ? '' : 'flex-row-reverse'}}">
						<div class="md:w-[57%] hidden md:block">
							<div class="swiper tabbed-swiper-wrapper">
								<ul class="swiper-wrapper">
									@foreach ($items as $item)
									<li class="swiper-slide">
										@if ($item['video_embed'])
											<a href="{{ $item['video_embed'] }}" class="glightbox h-full relative block hover:video-button">
										@endif
												@img($item['image']['ID'], 'large w-full h-full object-cover')
										@if ($item['video_embed'])
												<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
													@include('icons.play-button-white')
												</div>
											</a>
										@endif
									</li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="swiper-layout-{{ $layout }} flex-1 space-y-6 pt-6 md:pt-0 {{ $flip_columns ? 'md:pl-8 lg:pl-24' : 'md:pr-8 lg:pr-24' }}" data-aos=child_appear data-aos-once=true>
							@foreach ($items as $item)
							<div class="tabbed-swiper-navigation-item md:pl-6 lg:pl-10 lg:py-2">
								<div class="md:hidden pb-6">
									@if ($item['video_embed'])
											<a href="{{ $item['video_embed'] }}" class="glightbox h-full relative block hover:video-button">
										@endif
												@img($item['image']['ID'], 'large w-full h-full object-cover')
										@if ($item['video_embed'])
												<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
													@include('icons.play-button-white')
												</div>
											</a>
										@endif
								</div>
								@include('flexible.how_it_works.item', $item)
							</div>
							@endforeach
						</div>
					</div>
				</div>
			@elseif($layout === '5')
				<div class="swiper tabbed-swiper-wrapper swiper-layout-{{ $layout }} relative">
					<ul class="swiper-wrapper">
						@foreach ($items as $item)
						<li class="swiper-slide hidden md:block">
							@if ($item['video_embed'])
								<a href="{{ $item['video_embed'] }}" class="glightbox h-full relative block hover:video-button">
							@endif
									@img($item['image']['ID'], 'large w-full h-full object-cover')
							@if ($item['video_embed'])
									<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
										@include('icons.play-button-white')
									</div>
								</a>
							@endif
						</li>
						@endforeach
					</ul>
					<div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 lg:gap-x-20" data-aos=child_appear data-aos-once=true>
						@foreach ($items as $item)
						<div class="tabbed-swiper-navigation-item md:pt-10 mt-8 lg:pr-8">
							<div class="md:hidden pb-6">
								@if ($item['video_embed'])
									<a href="{{ $item['video_embed'] }}" class="glightbox h-full relative block hover:video-button">
								@endif
										@img($item['image']['ID'], 'large w-full h-full object-cover')
								@if ($item['video_embed'])
										<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
											@include('icons.play-button-white')
										</div>
									</a>
								@endif
							</div>
							@include('flexible.how_it_works.item', $item)
						</div>
						@endforeach
					</div>
				</div>
			@endif
		</div>
	</div>
</section>