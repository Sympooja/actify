<?php if($flexible_content): ?>
	<?php $__currentLoopData = $flexible_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo $__env->make('flexible.'.$layout['acf_fc_layout'].'.'.$layout['acf_fc_layout'],$layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/index.blade.php ENDPATH**/ ?>