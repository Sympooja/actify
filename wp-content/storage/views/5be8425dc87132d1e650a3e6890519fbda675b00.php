<section class="bg-white border-t border-b py-3 md:py-5">
  <div class="container md:flex items-center">
    <div class="w-full md:w-3/4 lg:w-2/3 hidden md:block">
      <menu class="ml-0 pl-0 pr-2 my-0 list-none flex justify-between md:space-x-2 lg:space-x-4 xl:space-x-8">
        <?php $__currentLoopData = $options['blog']['category_links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><a href="<?php echo e($item['link']['url']); ?>" class="text-[14px] lg:text-[16px] xl:text-[18px] hover:text-blue"><?php echo e($item['link']['title']); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </menu>
    </div>
    <?php if($dropdown): ?>
      <div class="w-full md:w-1/4 lg:w-1/3 text-right">
        <span class="relative inline-block">
          <select id="categories" name="categories" aria-placeholder="Categories" class="link-select w-[180px] appearance-none block w-full h-9 bg-none bg-white border border-gray-300 rounded-[2em] px-[8px] pt-[4px] pb-[4px] pr-[10px] pl-[26px] leading-[1.25em] text-[16px] text-grey">
            <option value="/blog">Categories</option>
            <?php $__currentLoopData = $options['blog']['category_dropdown']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e(get_term_link($item)); ?>"><?php echo e(get_term($item)->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <span class="pointer-events-none w-[13px] absolute top-[16px] right-[16px]">
            <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.19644 0.914157L4.09766 4.01294L0.998874 0.914157" stroke="#8A8A8A" stroke-width="0.720721"/>
            </svg>
          </span>
        </span>
      </div>
    <?php endif; ?>
  </div>
</section><?php /**PATH /app/wp-content/themes/theme/resources/views/components/blog-nav.blade.php ENDPATH**/ ?>