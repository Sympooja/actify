<?php 
$articles = [];
if($selection === 'latest'){
	$articles = get_posts(['posts_per_page' => 4]);
} else if($selection === 'category'){
	$articles = get_posts(['posts_per_page' => 4, 'cat' => $category]);
} else if($selection === 'hand-picked'){
	$articles = $posts;
}
$articles = apply_filters('posts_to_array', $articles);
?>
<?php if($articles): ?>
<section data-type="archive" class="py-[30px] md:py-[60px] relative">
	<?php if($heading): ?>
		<div class="container md:flex md:items-end justify-between items-center mb-6 md:mb-12">
			<div class="w-full md:w-3/4 lg:w-2/3">
				<?php echo $__env->make('elements.text', ['text' => $heading, 'type' => 'h1', 'size' => 40, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<?php if($link): ?>
			<div class="w-full md:w-1/4 lg:w-1/3 md:pl-8 lg:pl-12 md:text-right pt-2 md:pt-0">
				<?php echo $__env->make('elements.link', ['link' => $link, 'show_arrow' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="container">
	    <div class="gap-4 grid grid-cols-12" data-aos=child_appear data-aos-once=true>
	      	<?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        <?php echo $__env->make('components.blog-preview', [
		          'layout' => '1',
		          'cols' => 'sm:col-span-6 lg:col-span-3',
		          'article' => $article
		        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	    </div>
	</div>
</section>
<?php endif; ?><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/archive/archive.blade.php ENDPATH**/ ?>