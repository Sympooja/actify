<div class="space-y-4 relative">
	@include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 48])
	@include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 16])
	@if ($buttons)
		<div class="space-y-1">
			@foreach ($buttons as $key => $button)
				@include('elements.button', ['link' => $button['link'], 'color' => $key === 0 ? 'blue' : 'outline', 'classes' => ['mr-3'], 'size' => 'large'])
			@endforeach
		</div>
	@endif
</div>