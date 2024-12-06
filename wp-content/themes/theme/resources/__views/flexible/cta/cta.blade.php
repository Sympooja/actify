<?php 
$two_columns = $layout !== '1';
$right_align_buttons = in_array($layout, ['2','6']);
$flip_columns = $layout === '3';
$background = $layout === '2' ? 'bg-darkest-blue' : 'bg-blue';
$button_separation_class = 'space-y-5';
$has_image = in_array($layout, ['3','4']);
?>

@if ($layout === "5")
  <section data-type="cta" data-layout="{{ $layout }}" class="container text-center md:text-left lg:flex items-center">
    <div class="flex-1 mb-6 lg:mb-0">
      @include('elements.text', [
        'text' => $content['heading'], 
        'size' => 36, 
        'type' => 'h3'
      ])
    </div>
    <div class="lg:w-[40%] lg:text-right">
      <div class="space-y-2 md:space-x-4">
        @foreach ($content['buttons'] as $button)
          @include('elements.button', [
            'link' => $button['link'], 
            'color' => 'blue',
            'size' => 14
          ])
        @endforeach
      </div>
    </div>
  </section>
@else 
	<section data-type="cta" data-layout="{{ $layout }}" class="py-[60px] md:py-[105px] overflow-hidden relative {{ $background }} text-white container-outer" data-aos="mixed_appear" data-aos-once="true">

		@if ($has_image && $media['image'])
			<div class="absolute image-background w-[50%] top-0 bottom-0 cover-image-child {{ $flip_columns ? 'left-0 img-gradient-left' : 'right-0 img-gradient-right' }}">
				@img($media['image']['ID'], 'large')
			</div>
		@endif

		<div class="container relative">

			@if ($two_columns)

				@if($layout === "6")
					<div class="absolute top-[50%] left-[15%]" style="transform: translate(-50%, -50%)">
						@include('flexible.cta.background')
					</div>
				@endif
				<div class="grid lg:grid-cols-2 md:gap-2 items-center">
					<div class="{{ $button_separation_class }} {{ $flip_columns ? 'lg:pl-[80px] xl:pl-[145px]' : '' }}">
						<div class="max-w-[450px] {{ $button_separation_class }}">
							@include('flexible.cta.copy', $content)
							@if (!$right_align_buttons)
								@include('flexible.cta.buttons', ['buttons' => $content['buttons']])
							@endif
						</div>
					</div>
					<div class="{{ $flip_columns ? 'row-start-1' : '' }} lg:text-right mt-5 md:mt-0">
						@if ($right_align_buttons)
							@include('flexible.cta.buttons', ['buttons' => $content['buttons']])
						@endif
					</div>
				</div>

			@else

				<div class="absolute top-[50%] left-[50%]" style="transform: translate(-50%, -50%)">
					@include('flexible.cta.background')
				</div>
				<div class="relative text-center max-w-[520px] lg:py-4 mx-auto {{ $button_separation_class }}">
					@include('flexible.cta.copy', $content)
					@include('flexible.cta.buttons', ['buttons' => $content['buttons']])
				</div>

			@endif

		</div>
	</section>
@endif