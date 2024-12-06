<?php 
$has_header = in_array($layout, ['2','3','5','6','7','8','9']);
$centered_header = in_array($layout, ['2','5','8','9']);

$has_image = in_array($layout, ['8','9']);

$item_cols = '';
if(in_array($layout, ['1','2','3'])) $item_cols = 'gap-6 gap-y-12 grid-cols-1 md:grid-cols-2 lg:grid-cols-3';
if(in_array($layout, ['4','5','6'])) $item_cols = 'gap-6 gap-y-12 grid-cols-1 md:grid-cols-2 xl:grid-cols-4';
if(in_array($layout, ['7','8'])) $item_cols = 'gap-12 gap-y-6 md:gap-y-10 grid-cols-1 md:grid-cols-2';
if(in_array($layout, ['9'])) $item_cols = 'gap-6 gap-y-6 md:gap-y-10 grid-cols-1 md:grid-cols-2 lg:grid-cols-1';

$item_options = [
	'has_image' => $layout !== '7',
	'image_on_left' => $layout === '9',
	'item_cols' => $item_cols,
	'centered' => in_array($layout, ['1','2','4','5']),
	'has_border' => $layout === '7',
	'items' => $items
];
?>
<section data-type="benefits" data-layout="{{ $layout }}" class="py-[30px] md:py-[60px] relative">
	<div class="container">

		@if($has_header && $layout !== '7')
			<div class="max-w-[750px] mb-12 {{ $centered_header ? "mx-auto text-center" : ""}}">
				@include('flexible.benefits.header', $header)
			</div>
		@endif

		@if($has_image)

			<div class="lg:flex items-center lg:pt-6 {{ $flip_columns ? 'flex-row-reverse' : '' }}">
				<div class="md:mx-auto pb-6 lg:pb-0 md:w-[80%] lg:w-[49.5%]" data-aos=appear data-aos-once=true>

					@if ($video['video_looping'])
							<video width="100%" height="auto" autoplay loop muted>
								<source src="{{ $video['video_looping']['url'] }}" type="video/mp4" />
							</video>
					@elseif ($image)
						<div class="image">
							@if ($video['video_embed'])
								<a href="{{ $video['video_embed'] }}" class="glightbox relative block hover:video-button">
										@img($image['ID'],'large')
									<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
										@include('icons.play-button-small')
									</div>
								</a>
							@else
									@img($image['ID'],'large')
							@endif
						</div>
					@endif

				</div>
				<div class="flex-1 md:pt-5 md:pb-5 {{ $flip_columns ? 'lg:pr-20' : 'lg:pl-[100px]' }}">
					@include('flexible.benefits.items',$item_options)
				</div>
			</div>

		@elseif($layout === '7')

			<div class="lg:flex space-y-12 lg:space-y-0">
				<div class="lg:w-[35%] lg:pr-[60px]">
					@include('flexible.benefits.header', $header)
				</div>
				<div class="flex-1">
					@include('flexible.benefits.items',$item_options)
				</div>
			</div>

		@else
			@include('flexible.benefits.items',$item_options)
		@endif

	</div>
</section>