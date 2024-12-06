<?php 
$heading_size = 26;
$body_size = '14-tight';
$weight = 300;
$name_on_separate_line = $layout !== '1';
$restricted_width_name = in_array($layout, ['4','5','6']);
$box_classes = '';
$heading_classes = '';
switch($layout){
	case '3':
		$heading_classes = 'max-w-[760px] mx-auto';
		break;
	case '4':
		$heading_size = 18;
		$weight = 400;
		break;
	case '5':
		$box_classes = 'px-[20px] pb-[20px] lg:px-[38px] lg:pb-[40px] shadow-default';
		$heading_size = 16;
		$weight = 400;
		break;
	case '6':
		$box_classes = 'px-[20px] pb-[60px] lg:px-[38px] lg:pb-[90px] shadow-default';
		$heading_size = 18;
		$body_size = 16;
		$weight = 400;
		$heading_classes = 'max-w-[630px] mx-auto';
		break;
}
?>
<div class="<?php echo e($box_classes); ?> space-y-6">
	<?php if($layout === '2'): ?>
		<div class="inline-block-child">
			<?php echo $__env->make('icons.quote-with-circle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	<?php elseif(in_array($layout, ['3','4'])): ?>
		<div class="inline-block-child">
			<?php echo $__env->make('icons.quote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	<?php elseif(in_array($layout, ['5','6'])): ?>
		<div class="inline-block-child relative top-[-31px] mb-[-50px] md:top-[-31px] md:mb-[-31px] scale-[0.6] md:scale-[1]">
			<?php echo $__env->make('icons.quote-with-circle-alt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	<?php endif; ?>
	<div class="<?php echo e($heading_classes); ?>">
		<?php echo $__env->make('elements.text', ['text' => $quote, 'type' => 'h3', 'size' => $heading_size, 'weight' => $weight], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
	<div class="<?php echo e($restricted_width_name ? 'max-w-[250px] mx-auto' : ''); ?>">
		<?php echo $__env->make('elements.text', ['text' => "<strong class='".($name_on_separate_line ? 'block' : '')."'>".$name.($subtitle ? ", " : "")."</strong>".$subtitle, 'type' => 'wysiwyg', 'size' => $body_size, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/testimonials/item.blade.php ENDPATH**/ ?>