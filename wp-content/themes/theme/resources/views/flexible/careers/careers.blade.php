{{-- Job listings --}}

<section class="bg-lighter-grey pt-14 pb-16 md:pt-20 md:pb-24 lg:pt-24 lg:pb-32 my-8 md:my-12">
  <div class="container">
    <div class="text-center">
      <span class="mb-2 md:mb-4 block">
        @include('elements.text', ['text' => $positions['subtitle'], 'type' => 'h5', 'size' => 14, 'color' => 'blue'])
      </span>
      @include('elements.text', ['text' => $positions['title'], 'type' => 'h2', 'size' => 40])
    </div>
    <div class="space-y-4 w-full md:w-5/6 mx-auto my-10 md:my-14">
      @foreach($positions['listings'] as $listing)
        @include('components.job-listing', $listing)
      @endforeach
    </div>
    <div class="text-center">
      @include('elements.text', ['text' => $positions['question_title'], 'type' => 'h3', 'size' => 22])
      @include('elements.button', [
        'link' => $positions['question_link'], 
        'color' => 'blue',
        'classes' => ['h-14 w-36 max-w-[140px] min-w-[120px] flex mx-auto items-center justify-center text-[16px] my-4 md:my-6'],
        'size' => 14
      ])
    </div>
  </div>
</section>

{{-- Mission --}}

<section class="py-[30px] md:py-[60px]">
  <div class="container grid grid-cols-12 gap-4 md:gap-8">
    <div class="col-span-12 sm:col-span-10 md:col-span-6 lg:pr-14">
      <div class="space-y-6 mb-8 md:mb-12 lg:mb-16 xl:mb-24">
        @include('elements.text', ['text' => $mission['subtitle'], 'type' => 'h5', 'size' => 14, 'color' => 'blue'])
        <span class="block max-w-md">
          @include('elements.text', ['text' => $mission['title'], 'type' => 'h2', 'size' =>
          40])
        </span>
        <div>
          @include('elements.text', ['text' => $mission['content'], 'type' => 'wsywig', 'size' => 18, 'weight' => 300])
        </div>
      </div>
      @img($mission['image_2']['ID'], 'large')
    </div>
    <div class="col-span-12 flex md:block md:col-span-6 space-y-2 md:space-y-8 lg:space-y-12">
      <div class="w-3/5 md:w-full">@img($mission['image_1']['ID'], 'large')</div>
      <div class="w-2/5 md:w-2/3 pl-4 md:pl-8">@img($mission['image_3']['ID'], 'large')</div>
    </div>
  </div>
</section>
