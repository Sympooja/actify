<div class="text-right bg-light-grey text-[10px]">
  <div class="container flex">
    <div class="ml-auto flex items-center space-x-2 py-[8px]">
      <span><?php echo e($options['select_language_text']); ?></span>
      <span class="relative inline-block">
        <select onchange="location = this.value;" id="language" name="language" class="w-[90px] appearance-none block w-full bg-none bg-white border border-gray-300 rounded-[2em] px-[8px] pt-[4px] pb-[4px] pr-[10px] pl-[14px] leading-[1.25em] text-[10px]">
          <?php $__currentLoopData = $options['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php if(getLocale() === $language['locale_code']): ?> selected <?php endif; ?> value="/<?php echo e($language['locale_code']); ?>"><?php echo e($language['name']); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <span class="pointer-events-none w-[13px] absolute top-[8px] right-[4px]">
          <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.19644 0.914157L4.09766 4.01294L0.998874 0.914157" stroke="#8A8A8A" stroke-width="0.720721"/>
          </svg>
        </span>
      </span>
    </div>
  </div>
</div><?php /**PATH /app/wp-content/themes/theme/resources/views/components/top-bar.blade.php ENDPATH**/ ?>