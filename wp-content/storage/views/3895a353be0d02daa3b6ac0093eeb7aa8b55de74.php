<a href="<?php echo e($article['url']); ?>" class="flex items-center border-t md:space-x-4 py-4 md:py-6">
  <div class="md:w-1/3 pr-4 md:pr-0">
    <?php if($article['featured_image_id']): ?>
      <?php echo wp_get_attachment_image($article['featured_image_id'], 'small', "full", false, "role"); ?>
    <?php endif; ?>
  </div>
  <div class="md:w-2/3 line-clamp-2">
    <?php echo $__env->make('elements.text', ['text' => $article['title'], 'type' => 'h5', 'size' => 16, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
</a><?php /**PATH /app/wp-content/themes/theme/resources/views/components/blog-preview-small.blade.php ENDPATH**/ ?>