<footer class="container pb-20">
  
  <div class="xl:flex pt-10 pb-10 md: pt-20 md:pb-20 border-t border-light-gray">
    <div class="lg:flex-1 xl:pt-[33px] grid grid-cols-2 md:grid-cols-4 gap-2 gap-y-6 md:gap-6">
      <?php $__currentLoopData = $options['menus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
          <h3 class="text-[16px] font-medium">
            <?php echo e($menu['heading']); ?>

          </h3>
          <ul role="list" class="text-[14px] mt-3 space-y-3">
            <?php $__currentLoopData = $menu['links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($item['link']): ?>
              <li>
                <a class="opacity-70 hover:text-blue hover:opacity-100" href="<?php echo e($item['link']['url']); ?>" target="<?php echo e($item['link']['target']); ?>">
                  <?php echo $item['link']['title']; ?>

                </a>
              </li>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    <div class="mt-12 xl:mt-0 max-w-[450px] xl:w-[35%]">
      <div class="bg-light-grey py-[20px] px-[30px] md:py-[33px] md:px-[45px]">
          <h3 class="text-[16px] font-medium">
            <?php echo e($options['contact_title']); ?>

          </h3>
          <ul role="list" class="mt-4 space-y-1">
            <?php $__currentLoopData = $options['contact_links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($item['link']): ?>
              <li>
                <a href="<?php echo e($item['link']['url']); ?>" target="<?php echo e($item['link']['target']); ?>" class="text-[14px] sm:flex items-center">
                  <?php if($item['icon']): ?>
                    <span class="hidden sm:block w-[25px] inline-block">
                      <?php echo wp_get_attachment_image($item['icon']['ID'], "full", false, "role"); ?>
                    </span>
                  <?php endif; ?>
                  <span class="flex-1"><?php echo $item['title']; ?></span>
                  <span class="block ml-auto text-blue font-medium hover:text-black"><?php echo $item['link']['title']; ?></span>
                </a>
              </li>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
      </div>
    </div>
  </div>
  
  <div class="border-t border-light-gray pt-6 md:flex md:items-center md:justify-between">
    <div>
      <ul class="flex space-x-4">
        <?php $__currentLoopData = $options['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <a class="flex items-center space-x-2 rounded-[2em] px-5 py-[10px] text-[12px] border <?php if(getLocale() === $item['locale_code']): ?> border-gray-400 <?php else: ?> border-light-gray <?php endif; ?> hover:border-gray-400 transition" href="/<?php echo e($item['locale_code']); ?>">
              
              
              <span>
                <?php echo e($item['name']); ?>

              </span>
            </a>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
    
    <div class="mt-6 md:mt-0 flex text-[14px]">
      <span class="hidden md:block"><?php echo e($options['connect_title']); ?></span>
      <ul class="flex items-center space-x-[25px] md:ml-6">
        <?php $__currentLoopData = $options['connect_links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <a class="inline-block hover:opacity-[0.5]" href="<?php echo e($item['link']['url']); ?>" title="<?php echo e($item['link']['title']); ?>" target="<?php echo e($item['link']['target']); ?>">
              <?php if($item['icon']): ?>
                <?php echo wp_get_attachment_image($item['icon']['ID'], "full", false, "role"); ?>
              <?php endif; ?>
            </a>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  </div>
  
  <div class="mt-6 border-t border-light-gray pt-8 md:flex md:items-center md:justify-between text-[14px]">
    <div class="sm:flex sm:space-x-6 lg:space-x-14 md:order-2">
      <?php $__currentLoopData = $options['legal_menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a class="block underline text-blue hover:text-black" href="<?php echo e($item['link']['url']); ?>" target="<?php echo e($item['link']['target']); ?>"><?php echo $item['link']['title']; ?></a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    <p class="mt-8 md:mt-0 md:order-1">
      <?php echo $options['copyright']; ?>

    </p>
  </div>
</footer><?php /**PATH /app/wp-content/themes/theme/resources/views/components/footer.blade.php ENDPATH**/ ?>