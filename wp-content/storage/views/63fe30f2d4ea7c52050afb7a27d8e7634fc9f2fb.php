
<ul class="grid <?php echo e($item_cols); ?> <?php echo e($centered ? 'text-center justify-items-center' : ''); ?>" data-aos=child_appear data-aos-once=true>
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li class="<?php echo e(!$image_on_left ? 'space-y-2' : ''); ?> <?php echo e($has_border ? 'pb-6 md:pb-10 border-b border-light' : ''); ?>">
		<?php if($image_on_left): ?>
		<div class="flex">
			<div class="w-[60px] lg:w-[80px]">
		<?php endif; ?>

			<?php if($has_image and $item['icon']): ?>
				<div class="inline-block h-[40px] height-fix-image mb-6">
					<?php echo wp_get_attachment_image($item['icon']['ID'], "full", false, "role"); ?>
				</div>
			<?php endif; ?>

			<?php if($image_on_left): ?>
			</div>
			<div class="flex-1 space-y-2">
			<?php endif; ?>

			<?php echo $__env->make('elements.text', ['text' => $item['heading'], 'type' => 'h3', 'size' => 22], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php echo $__env->make('elements.text', ['text' => $item['text'], 'type' => 'wysiwyg', 'size' => 14], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<?php if($image_on_left): ?>
		</div>
		<?php endif; ?>
	</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/benefits/items.blade.php ENDPATH**/ ?>