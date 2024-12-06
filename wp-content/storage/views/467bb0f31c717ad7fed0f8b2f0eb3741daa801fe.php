<div class="<?php echo e($background); ?> py-9 px-7">
  <?php echo $__env->make('elements.text', ['text' => $options['blog']['other_articles_title'], 'type' => 'h4', 'size' => 22, 'weight' => 500 ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="mt-4">
    <?php $__currentLoopData = apply_filters('posts_to_array', $options['blog']['other_articles']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php echo $__env->make('components.blog-preview-small', ['article' => $article], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div><?php /**PATH /app/wp-content/themes/theme/resources/views/components/other-articles.blade.php ENDPATH**/ ?>