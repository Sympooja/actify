<?php
$text_alignment = $text_alignment ?: 'center';
$two_column_items = $layout !== '1';
$image_on_top = in_array($layout, ['5']);
if(!isset($flip_columns)) $flip_columns = false;
$flip_columns = in_array($layout, ['6','3']) ? !$flip_columns : $flip_columns;
$items_in_cols = in_array($layout, ['3', '5']);
$has_section_heading = $layout === '5';
$items_have_containers = $layout === '6';
$item_animation_properties = $items_in_cols ? "" : "data-aos=mixed_appear data-aos-once=true";
$image_size_classes = '';
switch($layout){
	case "2":
		$image_size_classes = 'md:w-[40%] lg:w-[26.5%]';
		break;
	case "4":
		$image_size_classes = 'md:w-[40%] lg:w-[58%]';
		break;
}
$has_space_between_items = in_array($layout, ['1','2','4']);

?>

<section data-type="content" data-layout="<?php echo e($layout); ?>" class="py-[30px] md:py-[60px] relative">

	<?php if(!$items_have_containers): ?>
		<div class="container relative <?php echo e($has_space_between_items ? 'space-y-[40px] lg:space-y-[85px]' : ''); ?>">
	<?php endif; ?>

		<?php if($section_heading && $has_section_heading): ?>
			<div class="text-center mb-12" data-aos=appear data-aos-once=true>
				<?php echo $__env->make('elements.text', ['text' => $section_heading, 'type' => 'h2', 'size' => 40], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		<?php endif; ?>

		<?php if($items_in_cols): ?>
			<div class="grid gap-6 gap-y-12 <?php echo e($layout === '3' ? 'lg:grid-cols-2' : 'md:grid-cols-2 lg:grid-cols-3'); ?>" data-aos=child_appear data-aos-once=true>
		<?php endif; ?>

		<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php

			// Pass layout name to content
			$item['content']['layout'] = $layout;

			// Alternate columns if not layout 3
			$flip_columns = $layout === '3' ? $flip_columns : !$flip_columns;
			?>

			<?php if($items_have_containers): ?>
				<div class="container-outer bg-grey overflow-hidden text-white relative" <?php echo e($item_animation_properties); ?>>
					<?php if($item['media']['image']): ?>
						<div class="absolute image-background top-0 bottom-0 left-0 right-0 cover-image-child <?php echo e($flip_columns ? 'img-gradient-grey-left' : 'img-gradient-grey-right'); ?>">
							<?php echo wp_get_attachment_image($item['media']['image']['ID'], 'large', "full", false, "role"); ?>
						</div>
					<?php endif; ?>
					<div class="container relative">

			<?php endif; ?>

			<?php if($two_column_items): ?>

				<div class="space-y-6 <?php echo e(!$image_on_top ? 'md:space-y-0 md:flex items-center' : 'md:space-y-10'); ?> <?php echo e($flip_columns ? '' : 'flex-row-reverse'); ?>" <?php echo e(!$items_have_containers ? $item_animation_properties : ''); ?>>
					<div class="<?php echo e($image_size_classes ? $image_size_classes : 'flex-1'); ?>">
						<?php if(!$items_have_containers && $item['media']['video_looping']): ?>
							<video width="100%" height="auto" autoplay loop muted>
								<source src="<?php echo e($item['media']['video_looping']['url']); ?>" type="video/mp4" />
							</video>
						<?php elseif(!$items_have_containers && $item['media']['image']): ?>
							<div class="image">
								<?php if($item['media']['video_embed']): ?>
									<a href="<?php echo e($item['media']['video_embed']); ?>" class="glightbox relative block hover:video-button">
										<?php echo wp_get_attachment_image($item['media']['image']['ID'], 'large', "full", false, "role"); ?>
										<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
											<?php echo $__env->make('icons.play-button-small', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
										</div>
									</a>
								<?php else: ?>
									<?php echo wp_get_attachment_image($item['media']['image']['ID'], 'large', "full", false, "role"); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="flex-1 flex">
						<div class="<?php echo e($flip_columns && $layout === '6' ? 'ml-auto' : ''); ?> <?php echo e($flip_columns && $layout !== '6' ? 'lg:ml-auto' : ''); ?>">
							<?php echo $__env->make('flexible.content.copy', $item['content'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>

			<?php else: ?>
			<div>
				<?php if( $item['media']['type'] === 'nomedia' ): ?>
				
				<?php else: ?>
				<div class="mb-8 md:mb-12">
					<?php if($item['media']['video_looping']): ?>
							<video width="100%" height="auto" autoplay loop muted>
								<source src="<?php echo e($item['media']['video_looping']['url']); ?>" type="video/mp4" />
							</video>
					<?php elseif($item['media']['image']): ?>
						<div class="w-full aspect-16-6 relative">
							<?php if($item['media']['video_embed']): ?>
								<a href="<?php echo e($item['media']['video_embed']); ?>" class="glightbox relative block hover:video-button w-full h-full object-cover">
									<?php echo wp_get_attachment_image($item['media']['image']['ID'], 'large w-full h-full object-cover', "full", false, "role"); ?>
									<div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
										<?php echo $__env->make('icons.play-button-small', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									</div>
								</a>
							<?php else: ?>
								<?php echo wp_get_attachment_image($item['media']['image']['ID'], 'large w-full h-full object-cover', "full", false, "role"); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<div class="relative lg:py-4 <?php if($item['no_max_width']): ?>  <?php else: ?> max-w-[750px] <?php endif; ?> <?php if($text_alignment === 'left'): ?> text-left <?php else: ?> text-center mx-auto <?php endif; ?> <?php if($item['item_position'] === 'center'): ?> mx-auto <?php else: ?> ml-0 <?php endif; ?>" <?php echo e($item_animation_properties); ?>>
					<?php echo $__env->make('flexible.content.copy', $item['content'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if($items_have_containers): ?>
					</div>
				</div>
			<?php endif; ?>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php if($items_in_cols): ?>
			</div>
		<?php endif; ?>

	<?php if(!$items_have_containers): ?>
		</div>
	<?php endif; ?>

</section><?php /**PATH /app/wp-content/themes/theme/resources/views/flexible/content/content.blade.php ENDPATH**/ ?>