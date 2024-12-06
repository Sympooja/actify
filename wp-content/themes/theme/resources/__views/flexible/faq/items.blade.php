<?php 
$icon = $layout === '2' ? 'chevron-right-circle' : 'chevron-right';
if(!isset($items) || !$items) $items = [];
$item_classes = '';
$list_classes = 'border-t border-light-gray';
switch ($layout){
	case '1':
		$item_classes = 'md:px-[30px] py-[18px] md:py-[24px] border-b border-light-gray';
		break;
	case '2':
		$list_classes = 'space-y-2';
		$item_classes = 'px-[16px] md:px-[30px] py-[18px] md:py-[26px] shadow-accordion rounded-sm accordion-border';
		break;
	case '3':
		$item_classes = 'py-[18px] md:py-[24px] border-b border-light-gray';
		break;
}
?>
<div class="max-w-[995px] mx-auto" data-aos=appear data-aos-once=true>
	<ul class="{{ $list_classes }}" data-aos=child_appear data-aos-once=true accordion>
	@foreach ($items as $item)
		<li class="{{ $item_classes }}" accordion-item>
			<?php $answer = get_field('answer', $item); ?>
			<div class="flex hover:text-blue transition" accordion-toggle>
				<div class="flex-1 pr-4">
					@include('elements.text', ['text' => $item->post_title, 'type' => 'h3', 'size' => 22])
				</div>
				<div class="inline-block-child text-right w-[27px] relative md:top-[2px]">
					@include('icons.'.$icon)
				</div>
			</div>
			<div class="pt-2 lg:max-w-[85%]" accordion-content>
				@include('elements.text', ['text' => $answer, 'type' => 'wysiwyg', 'size' => 14])
			</div>
		</li>
	@endforeach
	</ul>
</div>