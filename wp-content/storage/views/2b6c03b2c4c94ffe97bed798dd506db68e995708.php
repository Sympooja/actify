<section data-type="how_it_works" data-layout="<?php echo e($layout); ?>" class="py-[60px] md:py-[105px]">
	<div class="container">
		<div class="space-y-4 mb-[25px] lg:mb-[60px] max-w-[750px] mx-auto text-center" data-aos=child_appear data-aos-once=true>
			<?php echo $__env->make('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 40], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php echo $__env->make('elements.text', ['text' => $text, 'type' => 'wysiwyg', 'size' => 16], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		<div class="tabbed-swiper">
			<?php if($layout === '1'): ?>
				<div class="swiper tabbed-swiper-wrapper swiper-layout-<?php echo e($layout); ?> relative" data-aos=appear data-aos-once=true>
					<div class="hidden md:flex md:px-[80px] xl:px-[150px] pb-12"  data-aos=child_appear data-aos-once=true>
						<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="slidenav flex-1 pb-4 text-[14px] opacity-50 text-center tabbed-swiper-navigation-item cursor-pointer" data-name="	<?php echo e($item['tab_title']); ?>">
							<?php echo e($item['tab_title']); ?>

						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<ul class="swiper-wrapper" >
						<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="swiper-slide" data-hash="slide<?php echo e($key+1); ?>">
							<div class="px-[45px] md:px-[80px] xl:px-[150px]">
								<div class="md:flex items-center md:flex-row-reverse">
									<div class="md:w-[45%] lg:w-[55%] mb-6 md:mb-0">
										<?php if($item['video_embed']): ?>
											<a href="<?php echo e($item['video_embed']); ?>" class="glightbox h-full relative block hover:video-button">
										<?php endif; ?>
												<?php echo wp_get_attachment_image($item['image']['ID'], 'large w-full h-full object-cover', "full", false, "role"); ?>
										<?php if($item['video_embed']): ?>
												<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
													<?php echo $__env->make('icons.play-button-white', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
												</div>
											</a>
										<?php endif; ?>
									</div>
									<div class="flex-1 pl-2 md:pl-0 md:pr-6 lg:pr-28">
										<?php echo $__env->make('flexible.how_it_works.item', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									</div>
								</div>
							</div>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
					<div class="swiper-button-prev scale-[0.6] md:scale-[1] cursor-pointer absolute z-10 top-[50%] mt-[-35px] left-[-10px] md:left-0">
						<?php echo $__env->make('icons.slider-arrow-left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
					<div class="swiper-button-next scale-[0.6] md:scale-[1] cursor-pointer absolute z-10 top-[50%] mt-[-35px] right-[-10px] md:right-0">
						<?php echo $__env->make('icons.slider-arrow-right', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				</div>
			<?php elseif($layout === '4'): ?>
				<div class="relative">
					<div class="md:flex items-center <?php echo e($flip_columns ? '' : 'flex-row-reverse'); ?>">
						<div class="md:w-[57%] hidden md:block">
							<div class="swiper tabbed-swiper-wrapper">
								<ul class="swiper-wrapper">
									<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li class="swiper-slide">
										<?php if($item['video_embed']): ?>
											<a href="<?php echo e($item['video_embed']); ?>" class="glightbox h-full relative block hover:video-button">
										<?php endif; ?>
												<?php echo wp_get_attachment_image($item['image']['ID'], 'large w-full h-full object-cover', "full", false, "role"); ?>
										<?php if($item['video_embed']): ?>
												<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
													<?php echo $__env->make('icons.play-button-white', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
												</div>
											</a>
										<?php endif; ?>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>
						</div>
						<div class="swiper-layout-<?php echo e($layout); ?> flex-1 space-y-6 pt-6 md:pt-0 <?php echo e($flip_columns ? 'md:pl-8 lg:pl-24' : 'md:pr-8 lg:pr-24'); ?>" data-aos=child_appear data-aos-once=true>
							<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="tabbed-swiper-navigation-item md:pl-6 lg:pl-10 lg:py-2">
								<div class="md:hidden pb-6">
									<?php if($item['video_embed']): ?>
											<a href="<?php echo e($item['video_embed']); ?>" class="glightbox h-full relative block hover:video-button">
										<?php endif; ?>
												<?php echo wp_get_attachment_image($item['image']['ID'], 'large w-full h-full object-cover', "full", false, "role"); ?>
										<?php if($item['video_embed']): ?>
												<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
													<?php echo $__env->make('icons.play-button-white', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
												</div>
											</a>
										<?php endif; ?>
								</div>
								<?php echo $__env->make('flexible.how_it_works.item', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			<?php elseif($layout === '5'): ?>
				<div class="swiper tabbed-swiper-wrapper swiper-layout-<?php echo e($layout); ?> relative">
					<ul class="swiper-wrapper">
						<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="swiper-slide hidden md:block">
							<?php if($item['video_embed']): ?>
								<a href="<?php echo e($item['video_embed']); ?>" class="glightbox h-full relative block hover:video-button">
							<?php endif; ?>
									<?php echo wp_get_attachment_image($item['image']['ID'], 'large w-full h-full object-cover', "full", false, "role"); ?>
							<?php if($item['video_embed']): ?>
									<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
										<?php echo $__env->make('icons.play-button-white', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									</div>
								</a>
							<?php endif; ?>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
					<div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 lg:gap-x-20" data-aos=child_appear data-aos-once=true>
						<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="tabbed-swiper-navigation-item md:pt-10 mt-8 lg:pr-8">
							<div class="md:hidden pb-6">
								<?php if($item['video_embed']): ?>
									<a href="<?php echo e($item['video_embed']); ?>" class="glightbox h-full relative block hover:video-button">
								<?php endif; ?>
										<?php echo wp_get_attachment_image($item['image']['ID'], 'large w-full h-full object-cover', "full", false, "role"); ?>
								<?php if($item['video_embed']): ?>
										<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
											<?php echo $__env->make('icons.play-button-white', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
										</div>
									</a>
								<?php endif; ?>
							</div>
							<?php echo $__env->make('flexible.how_it_works.item', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/how_it_works/how_it_works.blade.php ENDPATH**/ ?>