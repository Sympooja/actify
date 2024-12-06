<section data-type="format" data-layout="{{ $layout }}" class="py-[30px] md:py-[60px] relative">
	@if($layout === '1')
		@include('flexible.format.format-1', $format_1)
	@elseif($layout === '2')
		@include('flexible.format.format-2', $format_2)
	@endif
</section>