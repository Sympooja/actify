<section data-type="wysiwyg_with_form" class="py-[30px] md:py-[60px] relative">

  <div class="container grid grid-cols-12">
    <article class="content space-y-3 md:space-y-8 col-span-12 md:col-span-7">
      @include('elements.text', ['text' => $content, 'type' => 'wysiwyg', 'size' => 18])
      @if( $form_embed )
        <iframe class="block md:hidden" src="{{ $form_embed  }}" width="100%" height="800" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
      @endif
    </article>
    <div class="col-span-12 md:col-span-4 md:col-start-9">
      <aside class="sticky top-6 space-y-3 md:space-y-5">
        @if( $form_embed )
          <iframe class="hidden md:block" src="{{ $form_embed  }}" width="100%" height="1100" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
        @else
          @include('components.blog-cta', [
            'layout' => '2',
            'heading_size' => '26',
            'content_size' => '16',
          ])

          @include('components.other-articles', [
            'background' => 'bg-lighter-grey'
          ])
        @endif
      </aside>
    </div>
    
  </div>
</section>