<div class="space-y-3 cursor-pointer">
	@include('elements.text', ['text' => $heading, 'type' => 'h3', 'size' => 22])
	@include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 14])
	@if ($link)
		<div class="link-container pt-1">
			@include('elements.link', ['link' => $link, 'show_arrow' => true])
		</div>
	@endif
</div>