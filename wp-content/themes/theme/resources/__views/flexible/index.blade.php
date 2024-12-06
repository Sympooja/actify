@if ($flexible_content)
	@foreach ($flexible_content as $layout)
		@include('flexible.'.$layout['acf_fc_layout'].'.'.$layout['acf_fc_layout'],$layout)
	@endforeach
@endif