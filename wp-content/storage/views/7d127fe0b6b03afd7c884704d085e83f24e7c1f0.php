<?php 
$max_width = '';
$padding = '';
$heading_size = 32;
$body_size = 14;
switch($layout){
	case '1':
		$heading_size = 40;
		$body_size = 16;
		break;
	case '2':
		$max_width = 'max-w-[840px]';
		$padding = 'md:py-[35px] md:px-[45px]';
		break;
	case '3':
		$heading_size = 22;
		$padding = 'md:py-[15px] md:pl-[30px]';
		break;
	case '4':
		$max_width = 'max-w-[465px]';
		$padding = 'md:py-[60px] md:px-[35px]';
		break;
	case '5':
		$heading_size = 22;
		break;
	case '6':
		$max_width = 'max-w-[390px]';
		$padding = 'py-[40px] md:py-[140px] lg:py-[225px]';
		break;
}
$element_spacing = $layout === '5' ? 'space-y-2' : 'space-y-4';
?>
<div class="<?php echo e($padding); ?> <?php echo e($element_spacing); ?> <?php echo e($max_width); ?>">
	<?php if($subtitle): ?>
		<div class="mb-[-6px] text-blue">
			<?php echo $__env->make('elements.text', ['text' => $subtitle, 'type' => 'h6', 'size' => 14, 'weight' => 500], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	<?php endif; ?>
	<?php echo $__env->make('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => $heading_size], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => $body_size], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php if($link): ?>
		<div class="link-container pt-1">
			<?php echo $__env->make('elements.link', ['link' => $link, 'show_arrow' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	<?php endif; ?>
</div><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/content/copy.blade.php ENDPATH**/ ?>