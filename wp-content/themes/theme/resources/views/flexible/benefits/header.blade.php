<div class="space-y-4" data-aos=mixed_appear data-aos-once=true>
	@if ($icon)
		<div data-aos=appear data-aos-once=true>
			@img($icon['ID'])
		</div>
	@endif
	@include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 40])
	@include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 16])
</div>