<style>
  [data-type=faq]{
    background: #F7F8FB;
  }
  @media only screen and (min-width: 1024px) {
    [data-type=faq]{
      padding-bottom: 90px;
      margin-bottom: 30px;
    }
  }
</style>
<section>
  <div class="container text-center mt-16 mb-12 md:mt-20 md:mb-16 lg:mt-28 lg:mb-24">
    <div class="max-w-2xl mx-auto">
      @include('elements.text', ['text' => $header['heading'],
      'type' => 'h1', 'size' =>
      48])
    </div>
    <menu class="pl-0 my-6 list-none flex md:w-3/4 lg:w-1/2 xl:w-1/3 justify-between mx-auto">
      @foreach ($header['links'] as $item)
      <li><a href="{{ $item['link']['url'] }}" class="text-[14px] md:text-[18px] hover:text-blue">{{ $item['link']['title'] }}</a></li>
      @endforeach
    </menu>
  </div>
  <div class="apect-16-7">
    @img($header['image']['ID'], 'large w-full h-full object-cover')
  </div>
</section>

{{-- Who we are --}}

<section id="who_we_are" class="mt-16 mb-20 md:mt-20 md:mb-28">
  <div class="container grid grid-cols-12 md:gap-6">
    <div class="col-span-12 md:col-span-8 lg:col-span-7 space-y-4 mb-2 md:mb-4">
      @include('elements.text', ['text' => $who_we_are['subtitle'], 'type' => 'h5', 'size' => 14, 'color' => 'blue', ])
      @include('elements.text', ['text' => $who_we_are['title'], 'type' => 'h2', 'size' =>
      32])
    </div>
    <div class="col-span-12 md:col-span-8 lg:col-span-7">
      @include('elements.text', ['text' => $who_we_are['content'],'type' => 'wysiwyg', 'size' => 14, 'weight' => 300])
    </div>
    <div class="col-span-12 md:col-span-4 lg:col-span-4 lg:col-start-9 space-y-6 sm:space-y-0 md:space-y-10 mt-10 md:mt-0 sm:flex md:block">
      
      @foreach ($who_we_are['stats'] as $item)
        <div class="flex sm:flex-col sm:items-center sm:text-center space-x-4 sm:space-x-0 sm:w-1/3 md:w-full md:text-left md:flex-row md:space-x-4 border-b pb-6 md:pb-10">
          @img($item['icon']['ID'], 'small w-14 h-14')
          <div class="sm:mt-2 md:mt-0">
            @include('elements.text', ['text' => $item['title'], 'type' => 'h2', 'size' =>
            32])
            @include('elements.text', ['text' => $item['subtitle'], 'type' => 'h5', 'size' => 14, 'color' => 'blue', ])
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="pb-6 md:pb-12 lg:pb-19" style="background: linear-gradient(180deg, rgba(255,255,255,1) 45%, rgba(247,248,251,1) 45%);">
  <div class="container apect-16-7">
    @img($who_we_are['image']['ID'], 'large w-full h-full object-cover')
  </div>
</section>