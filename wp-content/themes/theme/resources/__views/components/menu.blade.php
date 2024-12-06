<nav class="hidden md:flex space-x-[26px] ml-auto items-center" accordion>

  @foreach ($options['menu'] as $item)
    @if (!$item['submenu'])
      <a href="{{ $item['link']['url'] }}" target="{{ $item['link']['target'] }}" class="text-[13px] tracking-[-0.02em] font-normal hover:text-blue">
        {!! $item['link']['title'] !!}
      </a>
    @else
      <div class="relative text-[13px]" accordion-item>
        <button type="button" class="tracking-[-0.02em] font-normal hover:text-blue bg-white  flex items-center" aria-expanded="false" accordion-toggle>
          <span class="mr-1">{{ $item['link']['title'] }}</span>
          <svg class="alt-animation" width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 0.5L4 3.5L7 0.5" stroke="#233741"/>
          </svg>
        </button>
        <div class="hidden absolute z-[10] mt-3 px-2 w-screen max-w-[240px]" accordion-content>
          <div class="rounded-lg bg-white py-3 shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="relative">
              @foreach ($item['submenu'] as $subitem)
                @if($subitem['link'])
                <a href="{{ $subitem['link']['url'] }}" target="{{ $subitem['link']['target'] }}" class="py-1 px-6 block hover:text-blue">
                  {{ $subitem['link']['title'] }}
                </a>
                @endif
              @endforeach
              @if($item['view_parent_text'])
                <a href="{{ $item['link']['url'] }}" class="pt-3 mt-2 px-6 block hover:text-blue border-t opacity-60 hover:opacity-100">
                  {{ $item['view_parent_text'] }}
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endif
  @endforeach

  @include('elements.button', ['link' => $options['contact_button'], 'color' => 'blue', 'size' => 14])
</nav>