<?php 
$two_columns = $layout === '3';
?>
<section data-type="faq" data-layout="{{ $layout }}" class="py-[30px] md:py-[60px] lg:py-[75px] relative">
	<div class="container">
		@if (!$two_columns)
			<div class="max-w-[750px] mx-auto mb-12 text-center">
				@include('flexible.faq.header')
			</div>
			@include('flexible.faq.items')
		@else
			<div class="lg:flex">
				<div class="lg:w-[40%] lg:mr-[10%] mb-8 md:mb-12">
					@include('flexible.faq.header', ['heading_size' => 32])
				</div>
				<div class="flex-1">
					@include('flexible.faq.items')
				</div>
			</div>
		@endif
	</div>
</section>