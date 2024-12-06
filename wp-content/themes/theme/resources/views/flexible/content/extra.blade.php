<?php
$heading_size = 22;
$body_size = 14;
?>
<div>
    @include('elements.text', ['text' => $subheading, 'type' => 'h2', 'size' => $heading_size])
    <div class="flex mt-6">
        <div>
            @include('icons.how-actify-helps')
        </div>
        <div class="flex-1 ml-6">
            @include('elements.text', [
                'text' => $subtext,
                'type' => 'wysiwyg',
                'size' => $body_size,
                'weight' => '500',
            ])
        </div>
    </div>
</div>
