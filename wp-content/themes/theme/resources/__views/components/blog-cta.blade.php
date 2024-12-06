<div
  class="bg-lighter-grey 
  @if($layout === '1') text-center md:text-left md:flex justify-between px-6 md:px-12 py-12 md:py-16 lg:py-20 lg:px-16 
  @elseif($layout === '2') text-center px-8 py-8 md:px-4 md:py-6 lg:px-8 xl:px-12 lg:py-8 @endif">
  <div>
    @include('elements.text', ['text' => $options['blog']['community_title'], 'type' => 'h4', 'size' => $heading_size, 'weight' => 400])
    @include('elements.text', ['text' => $options['blog']['community_description'], 'type' => 'p', 'size' => $content_size, 'weight' => 400])
  </div>
  <div class="mt-2 @if($layout === '1') md:w-1/2 lg:w-2/5 @endif">
    <form
      class="@if($layout === '1') text-center md:text-left md:flex space-y-4 md:space-y-0 @elseif($layout === '2') text-center space-y-4 md:space-y-3  @endif">
      <iframe src="{{ $options['blog']['newsletter_form'] }}" width="100%" height="160" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
    </form>
  </div>
</div>