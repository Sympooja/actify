<?php $__env->startSection('content'); ?>

<section class="four-oh-four my-10 md:my-20">
	<div class="container">

		<div class="md:flex justify-between items-center">
			<article class="text-center md:text-left">
				<h6 class="c--accent text-[30px] lg:text-[60px] font-bold">404</h6>
				<h1 class="mb-16 text-[16px] lg:text-[32px]">Uh oh, we can't find that page</h1>
				<p class="mb-2 mt-0 fs--20">Let's get you back somewhere safe</p>
				<?php echo $__env->make('elements.link', ['link' => ['title' => 'Back home', 'url' => '/'], 'show_arrow' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</article>
			<div class="u-6/12@tablet">
				
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/wp-content/themes/theme/resources/views/pages/404.blade.php ENDPATH**/ ?>