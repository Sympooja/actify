<div class="space-y-2">
	@include('elements.text', [
		'text' => $subheading, 
		'size' => 16, 
		'weight' => 300, 
		'type' => 'h6',
		'color' => 'faded-blue'
	])
	@include('elements.text', [
		'text' => $heading, 
		'size' => 40, 
		'type' => 'h3'
	])
</div>