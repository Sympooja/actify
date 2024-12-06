<?php 
if(!$article) return;
if(!isset($cols)) $cols = 'sm:col-span-6';
?>
<a href="<?php echo e($article['url']); ?>"
  class="col-span-12 flex items-center shadow-lg <?php if($layout === '1'): ?> flex-col <?php echo e($cols); ?> <?php elseif($layout === '2'): ?> flex-row <?php endif; ?>">
  <div class="w-full <?php if($layout === '1'): ?> thumbnail-container <?php elseif($layout === '2'): ?> h-full <?php endif; ?>">
    <?php if($article['featured_image_id']): ?>
    <?php echo wp_get_attachment_image($article['featured_image_id'], 'small w-full h-full object-cover', "full", false, "role"); ?>
    <?php endif; ?>
  </div>
  <div class="flex-auto flex flex-col w-full px-6 py-7 bg-white">
    <?php if($article['category']): ?>
    <div class="mb-4">
      <span class="bg-blue text-white uppercase px-2 py-0.5 text-[14px]">
        <?php echo e($article['category']); ?>

      </span>
    </div>
    <?php endif; ?>
    <div>
      <?php echo $__env->make('elements.text', ['text' => $article['title'], 'type' => 'h5', 'size' => 22, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</a><?php /**PATH /app/wp-content/themes/theme/resources/views/components/blog-preview.blade.php ENDPATH**/ ?>