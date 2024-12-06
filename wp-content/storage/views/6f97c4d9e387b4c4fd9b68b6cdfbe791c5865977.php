<nav class="hidden md:flex space-x-[26px] ml-auto items-center" accordion>

  <?php $__currentLoopData = $options['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!$item['submenu']): ?>
      <a href="<?php echo e($item['link']['url']); ?>" target="<?php echo e($item['link']['target']); ?>" class="text-[13px] tracking-[-0.02em] font-normal hover:text-blue">
        <?php echo $item['link']['title']; ?>

      </a>
    <?php else: ?>
      <div class="relative text-[13px]" accordion-item>
        <button type="button" class="tracking-[-0.02em] font-normal hover:text-blue bg-white  flex items-center" aria-expanded="false" accordion-toggle>
          <span class="mr-1"><?php echo e($item['link']['title']); ?></span>
          <svg class="alt-animation" width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 0.5L4 3.5L7 0.5" stroke="#233741"/>
          </svg>
        </button>
        <div class="hidden absolute z-[10] mt-3 px-2 w-screen max-w-[240px]" accordion-content>
          <div class="rounded-lg bg-white py-3 shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="relative">
              <?php $__currentLoopData = $item['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($subitem['link']): ?>
                <a href="<?php echo e($subitem['link']['url']); ?>" target="<?php echo e($subitem['link']['target']); ?>" class="py-1 px-6 block hover:text-blue">
                  <?php echo e($subitem['link']['title']); ?>

                </a>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php if($item['view_parent_text']): ?>
                <a href="<?php echo e($item['link']['url']); ?>" class="pt-3 mt-2 px-6 block hover:text-blue border-t opacity-60 hover:opacity-100">
                  <?php echo e($item['view_parent_text']); ?>

                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <?php echo $__env->make('elements.button', ['link' => $options['contact_button'], 'color' => 'blue', 'size' => 14], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</nav><?php /**PATH /app/wp-content/themes/theme/resources/views/components/menu.blade.php ENDPATH**/ ?>