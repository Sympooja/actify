
<ul class="grid {{ $item_cols }} {{ $centered ? 'text-center justify-items-center' : '' }}" data-aos=child_appear data-aos-once=true>
@foreach ($items as $item)
	<li class="{{ !$image_on_left ? 'space-y-2' : '' }} {{ $has_border ? 'pb-6 md:pb-10 border-b border-light' : '' }}">
		@if ($image_on_left)
		<div class="flex">
			<div class="w-[60px] lg:w-[80px]">
		@endif

			@if ($has_image and $item['icon'])
				<div class="inline-block h-[40px] height-fix-image mb-6">
					@img($item['icon']['ID'])
				</div>
			@endif

			@if ($image_on_left)
			</div>
			<div class="flex-1 space-y-2">
			@endif

			@include('elements.text', ['text' => $item['heading'], 'type' => 'h3', 'size' => 22])
			@include('elements.text', ['text' => $item['text'], 'type' => 'wysiwyg', 'size' => 14])

		@if ($image_on_left)
		</div>
		@endif
	</li>
@endforeach
</ul>