<section data-type="forms" data-layout="{{ $layout }}" class="py-[30px] md:py-[60px] relative">
    @if ($layout === '1')
        @include('flexible.forms.forms-1', $form_1)
    @elseif($layout === '2')
        @include('flexible.forms.forms-2', $form_2)
    @elseif($layout === '3')
        @include('flexible.forms.forms-3', $form_3)
    @elseif($layout === '4')
        @include('flexible.forms.forms-4', $form_4)
    @elseif($layout === '5')
        @include('flexible.forms.forms-5', $form_5)
    @endif
</section>
