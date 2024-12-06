<section data-type="masthead" data-layout="<?php echo e($layout); ?>" data-aos=mixed_appear data-aos-once=true>
	<?php if(in_array($layout, ['1','2'])): ?>
		<div class="container-outer relative">
			<div class="container <?php echo e($layout === '1' ? 'py-8 md:py-32' : 'py-8 md:py-12'); ?>">
				<div class="md:flex items-center md:flex-row-reverse">
					<div class="md:w-[40%] pb-10 md:pb-0">
						<?php if($layout === '1'): ?>
							<div class="absolute top-0 bottom-0 left-0 right-0 cover-image-child img-gradient-light-left">
								<?php echo wp_get_attachment_image($image['ID'], "full", false, "role"); ?>
							</div>
							<a href="<?php echo e($video_modal); ?>" class="glightbox relative block hover:video-button min-h-[200px]">
								<div class="absolute absolute top-[50%] left-[50%] ml-[-75px] mt-[-75px]">
									<?php echo $__env->make('icons.play-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								</div>
							</a>
						<?php else: ?>
							<a href="<?php echo e($video_modal); ?>" class="image glightbox relative block hover:video-button">
								<?php echo wp_get_attachment_image($image['ID'], 'large', "full", false, "role"); ?>
								<div class="absolute absolute top-[50%] left-[50%] ml-[-75px] mt-[-75px]">
									<?php echo $__env->make('icons.play-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								</div>
							</a>
						<?php endif; ?>
					</div>
					<div class="flex-1 pb-10 md:pb-0 md:pr-10 lg:pr-24">
						<?php echo $__env->make('flexible.masthead.copy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php elseif(in_array($layout, ['3','5','6'])): ?>
		<div class="container-outer <?php echo e($layout !== '6' ? 'bg-grey text-white' : ''); ?> <?php echo e($layout === '5' ? 'md:mb-[40px] lg:mb-[90px] xl:mb-[105px]' : ''); ?>">
			<div class="container py-8 md:py-12">
				<div class="md:flex <?php echo e($form_embed ? '' : 'items-center'); ?>">
					<div class="flex-1 pb-10 md:pb-0 md:pr-10 lg:pr-24 <?php echo e($form_embed ? 'lg:pt-12' : ''); ?>">
						<?php echo $__env->make('flexible.masthead.copy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
					<div class="flex-1">
						<?php if($layout === '3'): ?>
							<div class="p-6 bg-white text-grey shadow-default">
								<iframe src="<?php echo $form_embed; ?>" width="100%" height="500" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
							</div>
						<?php else: ?>
							<?php if($layout === '5'): ?>
								<div class="image relative md:mb-[-40px] lg:mb-[-90px]">
									<div class="image bg-blue absolute w-[100%] h-[100%] top-[25px] left-[25px] hidden md:block"></div>
									<div class="relative">
										<?php echo wp_get_attachment_image($image['ID'], "full", false, "role"); ?>
									</div>
								</div>
							<?php else: ?>
								<div class="image">
									<?php echo wp_get_attachment_image($image['ID'], "full", false, "role"); ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php elseif(in_array($layout, ['4'])): ?>
		<div class="container-outer relative bg-grey">
			<span class="bg-masthead-4 absolute inset-0"></span>
			<?php if($add_looping_video && $video_looping): ?>
			<span class="bg-grey absolute inset-0 z-4 opacity-40"></span>
			<span class="absolute inset-0">
					<video class="absolute inset-0 object-cover h-full" width="100%" height="100%" autoplay loop muted>
						<source src="<?php echo e($video_looping['url']); ?>" type="video/mp4" />
					</video>
			</span>
			<?php else: ?>
			<span class="bg-grey absolute inset-0 z-4 opacity-70"></span>
				<span class="absolute inset-0"><?php echo wp_get_attachment_image($image['ID'], 'w-full h-full object-cover', "full", false, "role"); ?></span>
			<?php endif; ?>
			<div class="container relative <?php echo e(($add_looping_video && $video_looping) ? 'py-24 md:py-48' : 'py-16 md:py-36'); ?> z-20">
				<div class="md:flex items-center md:flex-row-reverse">
					<div class="flex-1 max-w-3xl mx-auto xl:px-4 text-center text-white">
						<?php echo $__env->make('flexible.masthead.copy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php elseif(in_array($layout, ['7','8'])): ?>
		<div class="container py-8 md:py-12">
			<div class="pb-8 md:pb-16 max-w-[750px] <?php echo e($layout === '7' ? 'text-center mx-auto' : ''); ?>">
				<?php echo $__env->make('flexible.masthead.copy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<div class="image">
				<?php echo wp_get_attachment_image($image['ID'], "full", false, "role"); ?>
			</div>
		</div>
	<?php endif; ?>
</section><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/masthead/masthead.blade.php ENDPATH**/ ?>