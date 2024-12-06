<div id="form3" class="container-outer bg-grey">
    <div class="container py-[45px] lg:py-[120px]" data-aos=child_appear data-aos-once=true>
        <div class="text-white mb-[25px] lg:mb-[45px] space-y-4 max-w-[750px] mx-auto text-center">
            @include('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 40])
            @include('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 16])
        </div>
        <div class="bg-lighter-grey px-[20px] py-[20px] lg:px-[80px] lg:py-[55px] max-w-[800px] mx-auto">
            <iframe src="{!! $form_embed !!}" width="100%" height="500" type="text/html" frameborder="0"
                allowTransparency="true" style="border: 0"></iframe>
        </div>
    </div>
</div>
