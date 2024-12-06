<div class="col-span-12 md:col-span-6 lg:col-span-4 flex flex-col items-center px-5 text-center">
  <div class="w-32 h-32 rounded-full relative overflow-hidden mb-4 md:mb-6">
    @img($picture['ID'], 'large absolute w-full h-full top-0 left-0 object-cover')
  </div>
  <div class="space-y-2 md:space-3">
    @include('elements.text', ['text' => $name, 'type' => 'wysiwyg', 'size' => 22])
    @include('elements.text', ['text' => $job_title, 'type' => 'wysiwyg', 'size' => 16, 'weight' => 500])
    @include('elements.text', ['text' => $description, 'type' => 'wysiwyg', 'size' => 16])
  </div>
</div>