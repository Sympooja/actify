<div class="space-y-4" data-aos=mixed_appear data-aos-once=true>
	<?php if($icon): ?>
		<div data-aos=appear data-aos-once=true>
			<?php echo wp_get_attachment_image($icon['ID'], "full", false, "role"); ?>
		</div>
	<?php endif; ?>
	<?php echo $__env->make('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 40], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 16], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/benefits/header.blade.php ENDPATH**/ ?>