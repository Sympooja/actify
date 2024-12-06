<a href="<?php echo e($article['url']); ?>" class="col-span-12 flex-auto flex items-center shadow-lg flex-row max-h-48">
  <div class="w-2/5 h-full">
    <?php if($article['featured_image_id']): ?>
      <?php echo wp_get_attachment_image($article['featured_image_id'], 'small w-full h-full object-cover', "full", false, "role"); ?>
    <?php endif; ?>
  </div>
  <div class="w-3/5 px-6 py-7 space-y-4 bg-white h-full">
    <span class="bg-blue text-white uppercase px-2 py-0.5 text-[14px]">
      <?php echo e($article['category']); ?>

    </span>
    <div class="line-clamp-2">
    <?php echo $__env->make('elements.text', ['text' => $article['title'], 'type' => 'h5', 'size'
    => 18, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</a><?php /**PATH /app/wp-content/themes/theme/resources/views/components/blog-preview-masthead.blade.php ENDPATH**/ ?>