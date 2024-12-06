<div class="container-outer bg-blue text-white">
	<div class="container py-[30px] lg:py-[100px] text-[14px] md:text-[16px]">
		@include('elements.text', ['text' => $title, 'type' => 'h2', 'size' => 48])
		<ul class="font-light space-y-[3px] py-[20px]">
			@foreach ($items as $item)
			<li><strong class="font-bold">{{ $item['title'] }}:</strong> {{ $item['description'] }}</li>
			@endforeach
		</ul>
		<span class="font-light">{{ $date }}</span>
	</div>
</div>