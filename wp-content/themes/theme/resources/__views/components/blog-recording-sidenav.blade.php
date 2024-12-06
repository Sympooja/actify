<a href="#day-{{ $anchor }}" class="event-side-nav-item flex justify-between items-center px-4 py-3 bg-white">
  <div>
    @include('elements.text', ['text' => $day , 'type' => 'wysiwyg', 'size' => 14])
    @include('elements.text', ['text' => $date, 'type' => 'wysiwyg', 'size' => 18])
  </div>
  <div class="circle w-10 h-10 rounded-full bg-lighter-grey flex justify-center items-center drop-shadow-xl text-black">
    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 7H12" stroke="currentColor" stroke-width="1.5"></path> 
      <path d="M6 1L12 7L6 13" stroke="currentColor" stroke-width="1.5"></path>
    </svg>
  </div>
</a>