<?php 
if(!isset($heading_size)) $heading_size = 40;
?>
<div class="space-y-4" data-aos=mixed_appear data-aos-once=true>
	@if ($subtitle)
	<div class="text-blue">
		@include('elements.text', ['text' => $subtitle, 'type' => 'h6', 'size' => 14, 'weight' => 500])
	</div>
	@endif
	@include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => $heading_size])
	@include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 16])
</div>