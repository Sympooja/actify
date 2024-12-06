@if ($buttons)
	<div class="space-y-4 md:space-x-4">
		@foreach ($buttons as $button)
			@include('elements.button', ['link' => $button['link']])
		@endforeach
	</div>
@endif