{{--  Blog Article --}}

@if($layout === '1')
<section data-type="masthead" data-layout="{{ $layout }}" class="py-[60px] bg-lighter-grey">
  <div class="container md:flex items-center">
    <div class="space-y-4 md:space-y-6 md:pr-16 lg:pr-20 xl:pr-28 w-full @if($no_image) md:w-3/4 @else md:w-1/2 mb-[20px] lg:mb-[60px] @endif">
      @include('elements.text', ['text' => $heading, 'type' => 'h1', 'size' => 40])
      @include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 18])
      @if ($buttons)
      <div class="space-y-4 md:space-x-4">
        @foreach ($buttons as $button)
        @include('elements.button', ['link' => $button['link']])
        @endforeach
      </div>
      @endif
      <ul class="sm:flex lg:flex sm:space-x-1 lg:space-x-3 @if($no_image) md:space-x-3 @else md:block md:space-x-0 @endif">
        @include('elements.text', ['text' => $cat, 'type' => 'li', 'size' => 16, 'weight' => 500])
        <li class="hidden sm:block lg:block text-blue @if($no_image) @else md:hidden @endif">•</li>
        @include('elements.text', ['text' => $date, 'type' => 'li', 'size' => 16, 'weight' => 500])
        {{-- <li class="hidden sm:block lg:block text-blue @if($no_image) @else md:hidden @endif">•</li>
        @include('elements.text', ['text' => $author, 'type' => 'li', 'size' => 16, 'weight' => 500])
      </ul> --}}
    </div>
    @if($no_image)
    @else
      <div class=" w-full md:w-1/2">
        @if ($image)   
           @if($reduce_image_size)
            @img($image['id'],' w-3/4 sm:w-1/2 mx-auto h-auto')
          @else
            @img($image['id'],' w-full h-auto')
          @endif 
        @endif
      </div>
    @endif
  </div>
</section>
@endif

{{--  Blog Event --}}

@if($layout === '2')
<section data-type="masthead" data-layout="{{ $layout }}" class="bg-blue text-white relative">
  <div class="container md:flex items-center">
    <div
      class="space-y-4 mb-[20px] @if ($buttons) @else lg:mb-[60px] @endif md:pr-16 lg:pr-20 xl:pr-28 pt-16 pb-0 md:py-20 lg:py-28 w-full md:w-1/2">
      <ul class="sm:flex md:block lg:flex space-y-2 sm:space-y-0 sm:space-x-1 md:space-x-0 lg:space-x-3">
        @if($event_date)
        <span class="flex items-center mr-4 lg:mr-8">
          <svg class="mr-2" width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.5 1V4.5" stroke="white" stroke-width="1.51372" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16.75 1V4.5" stroke="white" stroke-width="1.51372" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1 9.75H20.25" stroke="white" stroke-width="1.51372" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.5 4.5H2.75C1.7835 4.5 1 5.2835 1 6.25V18.5C1 19.4665 1.7835 20.25 2.75 20.25H18.5C19.4665 20.25 20.25 19.4665 20.25 18.5V6.25C20.25 5.2835 19.4665 4.5 18.5 4.5Z" stroke="white" stroke-width="1.51372" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          @include('elements.text', ['text' => $event_date, 'type' => 'li', 'size' => 16, 'weight' => 500])
        </span>
        @endif
        @if($time)
        <span class="flex items-center">
          <svg class="mr-2" width="20" height="19" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.625 4.33325V10.1666H16.75" stroke="white" stroke-width="1.51372" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10.625 19.3333C15.9407 19.3333 20.25 15.2293 20.25 10.1667C20.25 5.10406 15.9407 1 10.625 1C5.30926 1 1 5.10406 1 10.1667C1 15.2293 5.30926 19.3333 10.625 19.3333Z" stroke="white" stroke-width="1.51372" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>            
          @include('elements.text', ['text' => $time, 'type' => 'li', 'size' => 16, 'weight' => 500])
        </span>
        @endif
      </ul>
      @include('elements.text', ['text' => $heading, 'type' => 'h1', 'size' => 40])
      @include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 18])
      @if ($buttons)
      <div class="space-y-4 md:space-x-4 pt-2 md:pt-4">
        @foreach ($buttons as $button)
        @include('elements.button', ['link' => $button['link']])
        @endforeach
      </div>
      @endif
    </div>
    @if ($image)   
      <div class="w-full md:w-1/2 md:h-full pb-12 pt-4 md:pt-0 md:pb-0 md:absolute top-0 right-0 bottom-0">
        @img($image['id'], 'large w-full h-auto md:h-full md:object-cover')
      </div> 
    @endif
  </div>
</section>
@if ($logo_strip)   
  <section data-type="masthead-logo-strip">
      <div class="container flex flex-wrap items-center justify-between my-8 mt-16 gap-y-4 lg:gap-y-0">
        @foreach ($logo_strip as $logos)
          <div class="flex items-center justify-center relative w-1/2 sm:w-1/4 lg:w-auto">
            @img($logos['logo']['id'], ' relative flex justify-center items-center p-2 w-1/2 lg:w-auto h-auto')
          </div>
        @endforeach
      </div>
  </section>
@endif
@endif

{{--  Blog Video --}}

@if($layout === '3')
<section data-type="masthead" data-layout="{{ $layout }}" class="py-[60px]"
  style="background: linear-gradient(0deg, rgba(255,255,255,1) 35%, rgba(247,248,251,1) 35%);">
  <div class="container items-center">
    <div class="space-y-4 mb-[20px] lg:mb-[60px] md:pr-16 lg:pr-20 xl:pr-28 w-full md:w-3/4 lg:w-2/3">
      @include('elements.text', ['text' => $heading, 'type' => 'h1', 'size' => 40])
      @if ($buttons)
      <div class="space-y-4 md:space-x-4">
        @foreach ($buttons as $button)
        @include('elements.button', ['link' => $button['link']])
        @endforeach
      </div>
      @endif
      <ul class="sm:flex sm:space-x-1 lg:space-x-3">
        @include('elements.text', ['text' => $cat, 'type' => 'li', 'size' => 16, 'weight' => 500])
        <li class="hidden sm:block text-blue">•</li>
        @include('elements.text', ['text' => $date, 'type' => 'li', 'size' => 16, 'weight' => 500])
        {{-- <li class="hidden sm:block text-blue">•</li>
        @include('elements.text', ['text' => $author, 'type' => 'li', 'size' => 16, 'weight' => 500]) --}}
      </ul>
    </div>
    <div class="w-full blog-video-container relative">
      @if ($image)
        <a href="{{ $video_embed }}" class="glightbox h-full relative block hover:video-button">
          @img($image['id'], 'large w-full h-full object-cover')
          <div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
            @include('icons.play-button-white')
          </div>
        </a>
      @endif
    </div>
  </div>
</section>
@endif

{{--  Blog Press Release --}}

@if($layout === '4')
<section data-type="masthead" data-layout="{{ $layout }}" class="py-[60px] bg-lighter-grey relative">
  <div class="container md:flex items-center">
    <div
      class="space-y-4 mb-[20px] lg:mb-[60px] md:pr-16 xl:pr-28 md:py-16 w-full md:w-1/2 bg-lighter-grey relative z-10">
      @include('elements.text', ['text' => $heading, 'type' => 'h1', 'size' => 40])
      @include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 18])
      @if ($buttons)
      <div class="space-y-4 md:space-x-4">
        @foreach ($buttons as $button)
        @include('elements.button', ['link' => $button['link']])
        @endforeach
      </div>
      @endif
      <ul class="sm:flex sm:space-x-1 lg:space-x-3">
        @include('elements.text', ['text' => $cat, 'type' => 'li', 'size' => 16, 'weight' => 500])
        <li class="hidden sm:block text-blue">•</li>
        @include('elements.text', ['text' => $date, 'type' => 'li', 'size' => 16, 'weight' => 500])
      </ul>
    </div>
    @if ($image)   
      <div class=" w-full md:w-2/3 md:h-full pt-4 md:pt-0 md:absolute top-0 right-0 bottom-0">
        @img($image['id'], 'large w-full h-auto md:h-full md:object-cover')
      </div>
    @endif
  </div>
</section>
@endif

{{--  Blog With form --}}

@if($layout === '5')
<section data-type="masthead" data-layout="{{ $layout }}" class="py-[60px] bg-darker-blue text-white">
  <div class="container md:flex items-center justify-between">
    <div class="space-y-4 mb-[20px] lg:mb-[60px] md:pr-16 lg:pr-20 xl:pr-28 w-full md:w-1/2">
      @include('elements.text', ['text' => $heading, 'type' => 'h1', 'size' => 40])
      @include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 18])
      @if ($buttons)
      <div class="space-y-4 md:space-x-4">
        @foreach ($buttons as $button)
        @include('elements.button', ['link' => $button['link']])
        @endforeach
      </div>
      @endif
      <ul class="sm:flex sm:space-x-1 lg:space-x-3">
        @include('elements.text', ['text' => $cat, 'type' => 'li', 'size' => 16, 'weight' => 500])
        <li class="hidden sm:block text-blue">•</li>
        @include('elements.text', ['text' => $date, 'type' => 'li', 'size' => 16, 'weight' => 500])
        {{-- <li class="hidden sm:block text-blue">•</li>
        @include('elements.text', ['text' => $author, 'type' => 'li', 'size' => 16, 'weight' => 500]) --}}
      </ul>
    </div>
    <div class="w-full md:w-1/2 max-w-lg mx-auto md:mr-0 text-black bg-white px-10 py-8 lg:px-14 lg:py-12 mt-8 md:mt-0">
      @include('elements.text', ['text' => $form_heading, 'type' => 'h2', 'size' => 32])
      @if ($form_embed)
      <iframe src="{{ $form_embed }}" width="100%" height="500" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
      @endif
    </div>
  </div>
</section>
@endif

{{--  Blog Video --}}

@if($layout === '6')
<section data-type="masthead" data-layout="{{ $layout }}" class="py-[60px] bg-lighter-grey">
  <div class="container md:flex items-center">
    <div class="space-y-4 mb-[20px] lg:mb-[60px] md:pr-16 lg:pr-20 xl:pr-28 w-full md:w-1/2">
      @include('elements.text', ['text' => $heading, 'type' => 'h1', 'size' => 40])
      @include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 18])
      @if ($buttons)
      <div class="space-y-4 md:space-x-4">
        @foreach ($buttons as $button)
        @include('elements.button', ['link' => $button['link']])
        @endforeach
      </div>
      @endif
      <ul class="sm:flex md:block lg:flex sm:space-x-1 md:space-x-0 lg:space-x-3">
        @include('elements.text', ['text' => $cat, 'type' => 'li', 'size' => 16, 'weight' => 500])
        <li class="hidden sm:block md:hidden lg:block text-blue">•</li>
        @include('elements.text', ['text' => $date, 'type' => 'li', 'size' => 16, 'weight' => 500])
        {{-- <li class="hidden sm:block md:hidden lg:block text-blue">•</li>
        @include('elements.text', ['text' => $author, 'type' => 'li', 'size' => 16, 'weight' => 500]) --}}
      </ul>
    </div>
    <div class=" w-full md:w-1/2 relative">
      @if ($image)
        <a href="{{ $video_embed }}" class="glightbox h-full relative block hover:video-button">
          @img($image['id'], 'large w-full h-full object-cover')
          <div class="absolute z-10 absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
            @include('icons.play-button-white')
          </div>
        </a>
      @endif
      <span class="absolute inset-0 w-full h-full bg-blue bg-opacity-50"></span>
    </div>
  </div>
</section>
@endif
