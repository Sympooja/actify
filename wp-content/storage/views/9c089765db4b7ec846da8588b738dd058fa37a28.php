<div class="space-y-4 relative">
	<?php echo $__env->make('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 48], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 16], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php if($buttons): ?>
		<div class="space-y-1">
			<?php $__currentLoopData = $buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo $__env->make('elements.button', ['link' => $button['link'], 'color' => $key === 0 ? 'blue' : 'outline', 'classes' => ['mr-3'], 'size' => 'large'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	<?php endif; ?>
</div><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/masthead/copy.blade.php ENDPATH**/ ?>