<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flexible.index', ['flexible_content' => $acf['flexible_content']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/wp-content/themes/theme/resources/views/pages/default.blade.php ENDPATH**/ ?>