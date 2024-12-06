<a href="{{ $url }}" class="flex p-6 px-4 md:px-8 rounded-md justify-between items-center hover:text-blue bg-white shadow-lg">
  @include('elements.text', ['text' => $title, 'type' => 'span', 'size' => 22])
  <div class="transform rotate-90 ml-2"> 
  @include('icons.chevron-right-circle', [])
  </div>
</a>