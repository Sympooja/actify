<?php 
if(!isset($link) || !$link) return;
if(!$link['url']) return;
if(!$link['target']) $link['target'] = "";
if(!$link['title']) $link['title'] = $link['url'];

if(!isset($show_arrow)) $show_arrow = false;
?>
<a class="link hover:icon-shift-right text-[13px] md:text-[14px] tracking-[-0.0135em] font-medium inline-block text-blue hover:text-darkest-blue" href="<?php echo e($link['url']); ?>" target="<?php echo e($link['target']); ?>">
	<?php echo e($link['title']); ?>

	<?php if($show_arrow): ?>
		<span class="animated-icon inline-block ml-2 relative top-[1px]">
			<?php echo $__env->make('icons.arrow-right', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</span>
	<?php endif; ?>
</a><?php /**PATH /app/wp-content/themes/theme/resources/views/elements/link.blade.php ENDPATH**/ ?>