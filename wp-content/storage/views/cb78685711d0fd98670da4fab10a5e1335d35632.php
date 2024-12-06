<?php 
$has_heading = !in_array($layout, ['1','2']) && $heading;
$name_on_separate_line = in_array($layout, ['2']);

$fill_testimonial_data = function($testimonial){
	return [
		'name' => get_field('name', $testimonial),
		'subtitle' => get_field('subtitle', $testimonial),
		'quote' => get_field('quote', $testimonial),
	];
};

if($item) $item = $fill_testimonial_data($item);
if($items) $items = array_map($fill_testimonial_data, $items);

$has_inner_container = in_array($layout, ['1','3'])
?>
<section data-type="testimonials" data-layout="<?php echo e($layout); ?>" class="py-[30px] md:py-[60px] relative overflow-hidden">
	<?php if(!$has_inner_container): ?>
	<div class="container">
	<?php endif; ?>
		<?php if($has_heading): ?>
			<div class="<?php echo e($has_inner_container ? 'container' : ''); ?> text-center mb-4 lg:mb-16">
				<?php echo $__env->make('elements.text', ['text' => $heading, 'type' => 'h2', 'size' => 40], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		<?php endif; ?>
		<?php if($layout === '1'): ?>
			<div class="container-outer bg-dark-grey text-white py-[30px] md:py-[50px] lg:py-[80px] overflow-hidden">
				<div class="container">
					<div class="absolute top-[-40px] md:top-[40px] left-[25px]">
						<?php echo $__env->make('icons.quote-background', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
					<div class="md:flex relative" data-aos=child_appear data-aos-once=true>
						<div class="w-[120px] relative md:top-[10px] mb-6 md:mb-0">
							<?php echo $__env->make('icons.quote-alt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
						<div class="flex-1">
							<?php echo $__env->make('flexible.testimonials.item', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>
			</div>
		<?php elseif($layout === '2'): ?>
			<div class="text-center max-w-[1040px] mx-auto">
				<?php echo $__env->make('flexible.testimonials.item', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		<?php elseif(in_array($layout, ['3'])): ?>
			<div class="swiper swiper-visible-sides text-center relative"  data-aos=appear data-aos-once=true>
				<ul class="swiper-wrapper pb-[35px] md:pb-[50px]">
					<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li class="swiper-slide max-w-[900px]">
						<div class="container">
							<?php echo $__env->make('flexible.testimonials.item', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
				<div class="swiper-pagination absolute bottom-0 z-10 left-0 right-0"></div>
			</div>
		<?php elseif(in_array($layout, ['4','5'])): ?>
			<ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 text-center gap-y-12 gap-6 <?php echo e($layout === '4' ? 'lg:gap-12' : 'pt-[30px]'); ?>"  data-aos=child_appear data-aos-once=true>
				<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li>
					<?php echo $__env->make('flexible.testimonials.item', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
		<?php elseif(in_array($layout, ['6'])): ?>
			<div class="swiper swiper-standard text-center relative"  data-aos=appear data-aos-once=true>
				<ul class="swiper-wrapper pt-[35px] pb-[15px]">
					<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li class="swiper-slide">
						<div class="px-[25px] md:px-[80px] xl:px-[140px]">
							<?php echo $__env->make('flexible.testimonials.item', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
				<div class="swiper-pagination absolute bottom-[35px] lg:bottom-[50px] z-10 left-0 right-0"></div>

				<div class="swiper-button-prev scale-[0.6] md:scale-[1] cursor-pointer absolute z-10 top-[50%] mt-[-35px] left-[-10px] md:left-0">
					<?php echo $__env->make('icons.slider-arrow-left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="swiper-button-next scale-[0.6] md:scale-[1] cursor-pointer absolute z-10 top-[50%] mt-[-35px] right-[-10px] md:right-0">
					<?php echo $__env->make('icons.slider-arrow-right', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php if(!$has_inner_container): ?>
	<div class="container">
	<?php endif; ?>
</section><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/testimonials/testimonials.blade.php ENDPATH**/ ?>