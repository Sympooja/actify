<?php 
global $posts;
$articles = apply_filters('posts_to_array', $posts);
$query = get_search_query();
?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.blog-nav', [
  'dropdown' => false,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div>
  <section data-type="masthead" data-layout="<?php echo e($layout); ?>" class="py-[60px] pb-0 bg-lighter-grey">
    <div class="container">
      <div class="pb-[30px] lg:pb-[50px]">
        <?php echo $__env->make('elements.text', ['text' => single_cat_title('', false), 'type' => 'h1', 'size' => 48], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <div class="swiper blog-masthead-swiper">
      <div class="swiper-wrapper">
        <?php $__currentLoopData = array_slice($articles, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="swiper-slide grid grid-cols-12 ">
          <div class="col-span-12 md:col-span-6 h-full">
            <?php echo wp_get_attachment_image($article['featured_image_id'], 'large w-full h-full object-cover', "full", false, "role"); ?>
          </div>
          <a href="<?php echo e($article['url']); ?>"
            class="block space-y-4 px-6 sm:px-12 md:pl-16 lg:pl-20 xl:pl-28 md:pr-10 lg:pr-20 py-8 sm:py-12 md:py-16 lg:py-20 col-span-12 md:col-span-6 bg-white relative">
            <span class="bg-blue text-white px-2 py-0.5 text-[14px]">
             Featured
            </span>
            <?php echo $__env->make('elements.text', ['text' => $article['title'], 'type' => 'h2', 'size' => 32], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('elements.text', ['text' => $article['excerpt'], 'type' => 'wysiwyg', 'size' => 16], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <ul class="sm:flex md:block lg:flex sm:space-x-1 md:space-x-0 lg:space-x-3">
              <?php echo $__env->make('elements.text', ['text' => single_cat_title('', false), 'type' => 'li', 'size' => 16, 'weight' => 500], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <li class="hidden sm:block md:hidden lg:block text-blue">•</li>
              <?php echo $__env->make('elements.text', ['text' => $article['date'], 'type' => 'li', 'size' => 16, 'weight' => 500], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </ul>
          </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="absolute right-0 bottom-0 flex z-10">
        <span class="swiper-button-prev bg-blue bg-opacity-40 w-12 h-12 flex justify-center items-center">
          <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.9844 18.9688L2 9.98438L10.9844 1" stroke="white" stroke-width="2"/>
          </svg>
        </span>
        <span class="swiper-button-next bg-blue w-12 h-12 flex justify-center items-center">
          <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.984375 1L9.96875 9.98437L0.984375 18.9687" stroke="white" stroke-width="2"/>
            </svg>            
        </span>
      </div>
      </div>
    </div>
  </section>
</div>

<section class="py-16 md:py-20 mb-16 md:mb-20 bg-lighter-grey">
  <div class="container mb-6 md:mb-10">
      <?php echo $__env->make('elements.text', ['text' => 'Latest', 'type' => 'h2', 'size' => 40, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <div class="container grid md:flex space-y-10 md:space-y-0 md:space-x-10 lg:space-x-12">
    <div class="gap-4 w-full md:w-2/3 grid grid-cols-12 mb-auto">
      <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('components.blog-preview', [
          'layout' => '1',
          'cols' => 'sm:col-span-6',
          'article' => $article
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="w-full md:w-1/3 md:col-start-9">
      <aside class="sticky top-6 space-y-3 md:space-y-5">
        <?php echo $__env->make('components.blog-cta', [
          'layout' => '2',
          'heading_size' => '26',
          'content_size' => '16',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('components.other-articles', [
          'background' => 'bg-white'
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </aside>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/wp-content/themes/theme/resources/views/pages/category.blade.php ENDPATH**/ ?>