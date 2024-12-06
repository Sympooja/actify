<?php 
$has_header = in_array($layout, ['2','3','5','6','7','8','9']);
$centered_header = in_array($layout, ['2','5','8','9']);

$has_image = in_array($layout, ['8','9']);

$item_cols = '';
if(in_array($layout, ['1','2','3'])) $item_cols = 'gap-6 gap-y-12 grid-cols-1 md:grid-cols-2 lg:grid-cols-3';
if(in_array($layout, ['4','5','6'])) $item_cols = 'gap-6 gap-y-12 grid-cols-1 md:grid-cols-2 xl:grid-cols-4';
if(in_array($layout, ['7','8'])) $item_cols = 'gap-12 gap-y-6 md:gap-y-10 grid-cols-1 md:grid-cols-2';
if(in_array($layout, ['9'])) $item_cols = 'gap-6 gap-y-6 md:gap-y-10 grid-cols-1 md:grid-cols-2 lg:grid-cols-1';

$item_options = [
	'has_image' => $layout !== '7',
	'image_on_left' => $layout === '9',
	'item_cols' => $item_cols,
	'centered' => in_array($layout, ['1','2','4','5']),
	'has_border' => $layout === '7',
	'items' => $items
];
?>
<section data-type="benefits" data-layout="<?php echo e($layout); ?>" class="py-[30px] md:py-[60px] relative">
	<div class="container">

		<?php if($has_header && $layout !== '7'): ?>
			<div class="max-w-[750px] mb-12 <?php echo e($centered_header ? "mx-auto text-center" : ""); ?>">
				<?php echo $__env->make('flexible.benefits.header', $header, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		<?php endif; ?>

		<?php if($has_image): ?>

			<div class="lg:flex items-center lg:pt-6 <?php echo e($flip_columns ? 'flex-row-reverse' : ''); ?>">
				<div class="md:mx-auto pb-6 lg:pb-0 md:w-[80%] lg:w-[49.5%]" data-aos=appear data-aos-once=true>

					<?php if($video['video_looping']): ?>
							<video width="100%" height="auto" autoplay loop muted>
								<source src="<?php echo e($video['video_looping']['url']); ?>" type="video/mp4" />
							</video>
					<?php elseif($image): ?>
						<div class="image">
							<?php if($video['video_embed']): ?>
								<a href="<?php echo e($video['video_embed']); ?>" class="glightbox relative block hover:video-button">
										<?php echo wp_get_attachment_image($image['ID'],'large', "full", false, "role"); ?>
									<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
										<?php echo $__env->make('icons.play-button-small', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									</div>
								</a>
							<?php else: ?>
									<?php echo wp_get_attachment_image($image['ID'],'large', "full", false, "role"); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>

				</div>
				<div class="flex-1 md:pt-5 md:pb-5 <?php echo e($flip_columns ? 'lg:pr-20' : 'lg:pl-[100px]'); ?>">
					<?php echo $__env->make('flexible.benefits.items',$item_options, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>

		<?php elseif($layout === '7'): ?>

			<div class="lg:flex space-y-12 lg:space-y-0">
				<div class="lg:w-[35%] lg:pr-[60px]">
					<?php echo $__env->make('flexible.benefits.header', $header, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="flex-1">
					<?php echo $__env->make('flexible.benefits.items',$item_options, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>

		<?php else: ?>
			<?php echo $__env->make('flexible.benefits.items',$item_options, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

	</div>
</section><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/benefits/benefits.blade.php ENDPATH**/ ?>