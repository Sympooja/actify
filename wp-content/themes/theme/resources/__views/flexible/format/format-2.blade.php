<div class="container-outer bg-lighter-grey overflow-hidden">
	<div class="container py-[40px] py-[100px]">
		@if( $table_heading)
			<div class="mb-6 md:mb-8">
				@include('elements.text', ['text' => $table_heading , 'type' => 'h2', 'size' => 22, 'weight' => 400])
			</div>
		@endif
		<div swipe-helper-area class="overflow-auto mr-[-35px] relative">
			<table class="format-table w-[1200px]">
				<thead>
					<tr>
						<th class="text-left" rowspan="2">{{ _e('Name') }}</th>
						<th class="text-left" rowspan="2">{{ _e('Versions') }}</th>
						<th class="text-left" rowspan="2">{{ _e('File Types') }}</th>
						<th colspan="3">{{ _e('Format Attributes') }}</th>
						<th rowspan="2">{{ _e('Basic') }}</th>
						<th rowspan="2">{{ _e('Classic') }}</th>
						<th rowspan="2">{{ _e('Premium') }}</th>
					</tr>
					<tr>
						<th>{{ _e('Tessellation') }}</th>
						<th>{{ _e('B-Rep') }}</th>
						<th>{{ _e('PMI') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($table as $row)
					<tr>
						<td>{{ $row['name'] }}</td>
						<td>{{ $row['versions'] }}</td>
						<td>{{ $row['file_types'] }}</td>
						<td class="text-center"><span class="bool val-{{ $row['tessellation'] }}"></span></td>
						<td class="text-center"><span class="bool val-{{ $row['b-rep'] }}"></span></td>
						<td class="text-center"><span class="bool val-{{ $row['pmi'] }}"></span></td>
						<td class="text-center"><span class="bool val-{{ $row['basic'] }}"></span></td>
						<td class="text-center"><span class="bool val-{{ $row['classic'] }}"></span></td>
						<td class="text-center"><span class="bool val-{{ $row['premium'] }}"></span></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div swipe-helper class="absolute top-0 left-0 right-0 bottom-0 xl:hidden" style="background: rgba(255,255,255,0.75)">
				<div class="absolute top-[50%] left-[50%] mt-[-50px] ml-[-100px]">
					@include('icons.swiper-hand')
				</div>
			</div>
		</div>
	</div>
</div>