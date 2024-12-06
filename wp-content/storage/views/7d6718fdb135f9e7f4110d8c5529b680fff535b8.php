<?php 
$page = intval(get_query_var('paged'));
if($page === 0) $page = 1;

$query = new WP_Query([
  'paged' => $page,
  'post_type' => 'post'
]);
$articles = apply_filters('posts_to_array', $query->posts);
$num_pages = $query->max_num_pages;


$blog_options = get_field('blog', 'options');
$featured_articles = apply_filters('posts_to_array', $blog_options['featured_articles']);
$first_article = $featured_articles[0];
?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.blog-nav', [
  'dropdown' => true,
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if($page === 1){ ?>
<section class="pt-16 md:pt-20 pb-8 md:pb-12 bg-lighter-grey">
  <div class="container md:flex md:items-end justify-between mb-6 md:mb-12">
    <div class="w-full md:w-3/4 lg:w-2/3">
      <?php echo $__env->make('elements.text', ['text' => 'Featured', 'type' => 'h1', 'size' => 48, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="w-full md:w-1/4 lg:w-1/3 md:pl-8 lg:pl-12">
      <form action="/">
        <input name="s" type="text" class="search-form w-full" placeholder="Search">
      </form>
    </div>
  </div>
  <div class="container md:flex space-y-6 md:space-y-0 md:space-x-6">
    <a href="<?php echo e($first_article['url']); ?>" class="block lg:min-h-[450px] w-full md:w-1/2 lg:w-7/12 relative text-white px-10 py-12">
      <div class="relative z-10 w-3/4 md:w-full lg:w-3/4 space-y-4 md:space-y-6">
        <span class="bg-blue text-white uppercase px-2 py-0.5 text-[14px]">
          <?php echo e($first_article['category']); ?>

        </span>
        <?php echo $__env->make('elements.text', ['text' => $first_article['title'], 'type' => 'h1', 'size' => 32], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <ul class="sm:flex md:block lg:flex sm:space-x-1 md:space-x-0 lg:space-x-3">
          <?php echo $__env->make('elements.text', ['text' => $first_article['date'], 'type' => 'li', 'size' => 16, 'weight' => 500], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <li class="hidden sm:block md:hidden lg:block text-blue">•</li>
          <?php echo $__env->make('elements.text', ['text' => $first_article['author_name'], 'type' => 'li', 'size' => 16, 'weight' => 500], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </ul>
      </div>
      <?php echo wp_get_attachment_image($first_article['featured_image_id'], 'large w-full h-full absolute top-0 right-0 bottom-0 object-cover', "full", false, "role"); ?>
      <span class="absolute inset-0 blog-overlay"></span>
    </a>
    <div class="w-full md:w-1/2 lg:w-7/12 grid grid-cols-12 gap-4 md:gap-6">
      <?php $__currentLoopData = array_slice($featured_articles, 1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	      <?php echo $__env->make('components.blog-preview-masthead', [
		      'article' => $article
	      ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php } ?>

<section class="pb-16 pt-6 md:pb-20 md:pt-8 bg-lighter-grey">
  <div class="container mb-6 md:mb-10">
      <?php echo $__env->make('elements.text', ['text' => 'Latest', 'type' => 'h2', 'size' => 40, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <div class="container grid md:flex space-y-10 md:space-y-0 md:space-x-10 lg:space-x-12">
    <div class="gap-4 w-full md:w-2/3 grid grid-cols-12 mb-auto">
      <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('components.blog-preview', [
          'article' => $article,
          'layout' => '1',
          'cols' => 'sm:col-span-6',
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

<?php 
$prev_link = get_previous_posts_page_link();
$next_link = get_next_posts_page_link();
?>

<section class="pagination bg-lighter-grey py-16">
  <div class="container flex flex-wrap order-1">
    <div class="w-1/2 md:w-1/3 text-left">
    <?php if($page != 1){ ?>
      <a href="<?php echo e($prev_link); ?>" class="hover:text-blue flex items-center">
        <span class="mr-2">
        <svg width="61" height="15" viewBox="0 0 61 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M60.4102 8.25H0.410156V6.75H60.4102V8.25ZM0.940487 6.96967L7.44049 13.4697L6.37983 14.5303L-0.120174 8.03033L0.940487 6.96967ZM-0.120174 6.96967L6.37983 0.46967L7.44049 1.53033L0.940487 8.03033L-0.120174 6.96967Z" fill="#186FE0"/>
          </svg>
        </span>
        Previous
        </a>
    <?php } ?>
    </div>
    <div class="w-full md:w-1/3 text-center order-3 md:order-2 mt-4 md:mt-0">
      <ul class="flex justify-evenly space-x-2">
        <?php $__currentLoopData = range(1,$num_pages); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><a href="/blog/page/<?php echo e($index); ?>" class="w-8 py-1 block <?php if($index == $page): ?>bg-blue text-white <?php else: ?> hover:bg-blue hover:text-white <?php endif; ?>"><?php echo $index ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <div class="o-layout u-margin-bottom-large">
        <div class="c-pagination u-margin-top-large u-margin-bottom-small">
          <?php echo paginate_links([
            'prev_text' => '<span>Previous</span>',
            'next_text' => '<span>Next</span>'
          ]); ?>

        </div>
      </div>
    </div>
    <div class="w-1/2 md:w-1/3 text-right flex justify-end order-2 md:order-3">
    <?php if($page != $num_pages){ ?>
      <a href="<?php echo e($next_link); ?>" class="hover:text-blue flex items-center">Next 
        <span class="ml-2">
        <svg width="61" height="15" viewBox="0 0 61 15" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 8.25H60V6.75H0V8.25ZM59.4697 6.96967L52.9697 13.4697L54.0303 14.5303L60.5303 8.03033L59.4697 6.96967ZM60.5303 6.96967L54.0303 0.46967L52.9697 1.53033L59.4697 8.03033L60.5303 6.96967Z" fill="#186FE0"/>
        </svg>
        </span>
      </a>
    <?php } ?>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/wp-content/themes/theme/resources/views/pages/blog.blade.php ENDPATH**/ ?>