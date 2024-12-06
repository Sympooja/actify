<div class="space-y-3 cursor-pointer">
	<?php echo $__env->make('elements.text', ['text' => $heading, 'type' => 'h3', 'size' => 22], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 14], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php if($link): ?>
		<div class="link-container pt-1">
			<?php echo $__env->make('elements.link', ['link' => $link, 'show_arrow' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	<?php endif; ?>
</div><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/how_it_works/item.blade.php ENDPATH**/ ?>