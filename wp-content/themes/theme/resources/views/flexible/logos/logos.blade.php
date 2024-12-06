<div class="container">
	<section data-type="logos" class="py-[12px] md:py-[30px] relative border-b border-light-gray overflow-hidden">
		<div class="swiper swiper-logos">
			<div class="swiper-wrapper">
				@foreach ($items as $key => $item)
					<?php 
					if($item['link']){
						$tag = 'a';
						$url = $item['link']['url'];
					} else {
						$tag = 'span';
						$url = '#';
					}
					?>
					<{{ $tag }} href="{{ $url }}" class="js-swiper-logos block swiper-slide text-center" data-hash="logo{{$key+1}}">
						<span class="inline-block max-w-[200px] h-[60px] flex">
							@img($item['logo']['ID'], 'large max-w-[100%] max-h-[100%] mx-auto my-auto object-contain')
						</span>
					</{{ $tag }}>
				@endforeach
			</div>
		</div>
	</section>
</div>