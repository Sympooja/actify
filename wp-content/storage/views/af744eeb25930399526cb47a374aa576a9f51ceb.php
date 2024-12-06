<!--
  Mobile menu, show/hide based on mobile menu state.

  Entering: "duration-200 ease-out"
    From: "opacity-0 scale-95"
    To: "opacity-100 scale-100"
  Leaving: "duration-100 ease-in"
    From: "opacity-100 scale-100"
    To: "opacity-0 scale-95"
-->
<div id="mobile-menu" class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
  <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
    <div class="pt-5 pb-6 px-5">
      <div class="flex items-center justify-between">
        
        <div>
          <?php echo wp_get_attachment_image($options['logo']['ID'], "full", false, "role"); ?>
        </div>
        
        <div class="-mr-2">
          <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center" toggle="#mobile-menu">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>
    <div class="py-3 px-5 grid grid-cols-1" accordion>
      <?php $__currentLoopData = $options['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$item['submenu']): ?>
          <a href="<?php echo e($item['link']['url']); ?>" target="<?php echo e($item['link']['target']); ?>" class="block py-3 text-[15px] tracking-[-0.02em] font-normal hover:text-blue">
            <?php echo $item['link']['title']; ?>

          </a>
        <?php else: ?>
          <div class="relative text-[15px]" accordion-item>
            <button type="button" class="block py-3 w-[100%] tracking-[-0.02em] font-normal hover:text-blue bg-white  flex items-center" aria-expanded="false" accordion-toggle>
              <span class="mr-1"><?php echo e($item['link']['title']); ?></span>
              <svg class="ml-auto alt-animation" width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 0.5L4 3.5L7 0.5" stroke="#233741"/>
              </svg>
            </button>
            <div class="hidden border pt-3 pb-4" accordion-content>
              <?php $__currentLoopData = $item['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($subitem['link']['url']); ?>" target="<?php echo e($subitem['link']['target']); ?>" class="py-2 px-4 block hover:text-blue">
                  <?php echo e($subitem['link']['title']); ?>

                </a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e($item['link']['url']); ?>" class="pt-4 mt-3 px-4 block hover:text-blue border-t opacity-60">
                <?php echo e($item['view_parent_text']); ?>

              </a>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <div class="mt-3 pb-2">
         <?php echo $__env->make('elements.button', ['link' => $options['contact_button'], 'color' => 'blue', 'size' => 14], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </div>
</div><?php /**PATH /app/wp-content/themes/theme/resources/views/components/mobile-menu.blade.php ENDPATH**/ ?>