<?php
if(!isset($link) || !$link) return;
if(!$link['url']) return;
if(!$link['target']) $link['target'] = "";
if(!$link['title']) $link['title'] = $link['url'];


if(!isset($color)) $color = 'white';
if(!isset($size)) $size = 16;
if(!isset($classes)) $classes = [];
$classes[] = 'button inline-block rounded-[2em] min-w-[60%] text-center md:min-w-0';
$circle_bg = 'bg-darkest-blue';
switch($color){
	case 'white':
		$circle_bg = 'bg-faded-blue';
		$classes[] = 'bg-white text-blue';
		break;
	case 'blue':
		$classes[] = 'bg-blue text-white';
		break;
	case 'outline':
		$circle_bg = 'bg-contextual';
		$classes[] = 'border-contextual';
		break;
}
switch($size){
	case 'large':
		$classes[] = 'text-[14px] md:text-[16px] px-[20px] md:px-[35px] py-[10px] md:py-[18px]';
		break;
	case 16:
		$classes[] = 'text-[14px] md:text-[16px] px-[20px] md:px-[30px] py-[10px] md:py-[13px]';
		break;
	case 14:
		$classes[] = 'text-[13px] md:text-[14px] px-[22px] py-[10px]';
		break;
}

$is_video = is_string($link['url']) && str_contains($link['url'], 'youtube');

if($is_video) $classes[] = 'glightbox';
?>
<a class="<?php echo e(implode(' ', $classes)); ?>" href="<?php echo e($link['url']); ?>">
	<span style="opacity: 0;" class="button-circle <?php echo e($circle_bg); ?>"></span>
	<span class="relative">
		<?php if($is_video): ?>
			<span class="inline-block mr-2 mb-[-1px] relative top-[2px]"><?php echo $__env->make('icons.play-simple', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></span>
		<?php endif; ?>
		<?php echo e($link['title']); ?>

	</span>
</a><?php /**PATH /app/wp-content/themes/theme/resources/views/elements/button.blade.php ENDPATH**/ ?>