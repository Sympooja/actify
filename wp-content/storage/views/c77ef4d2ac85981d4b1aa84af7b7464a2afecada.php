<?php 

$article = apply_filters('posts_to_array', [get_post()])[0];

$header = $acf['header'];
$sidebar_form = $acf['sidebar_form'];
$flexible_content = $acf['flexible_content'];
$additional_content = $acf['additional_content'];
$event_content = $acf['event_content'];
$recordings = $acf['recordings'];
$speakers = $acf['speakers'];

// Clean this up
$cat = $article['category'];
$date = $article['date'];
$author = $article['author_name'];
$time = $article['time'];
$role = $article['author_title'];
$author_image = $article['author_title'];
?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.blog-masthead', [
  'layout' =>  $header['layout'],
  'heading' => $article['title'],
  'text' => $header['summary'],
  'buttons' => $header['buttons'],
  'cat' => $cat,
  'date' => $date,
  'event_date' => $header['date'],
  'author' => $author,
  'time' => $header['time'],
  'image' => $header['image'],
  'video_embed' => $header['video_embed'],
  'form_heading' => $header['form_heading'],
  'form_embed' => $header['form_embed'],
  'logo_strip' => $header['logo_strip'],
  'no_image' => $header['no_image'],
  'reduce_image_size' => $header['reduce_image_size']
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if($additional_content): ?>
  <?php $__currentLoopData = $additional_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($add_content['acf_fc_layout'] === 'content'): ?>
      <?php echo $__env->make('flexible.index', ['flexible_content' => $additional_content], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if($event_content): ?>
  <?php $__currentLoopData = $event_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($event['acf_fc_layout'] === 'recordings' ): ?>
      <section class="my-16 md:my-20 py-12 md:py-16 bg-lighter-grey">
        <div class="container grid grid-cols-12">
          <div class="col-span-12 md:col-span-8 md:col-start-3 lg:col-span-6 lg:col-start-4 text-center mb-12 md:mb-16">
            <?php echo $__env->make('elements.text', ['text' => $event['recordings']['heading'], 'type' => 'h2', 'size' => 40, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
        <div class="container grid grid-cols-12 gap-6 md:gap-10 lg:gap-12">
          <div class="hidden lg:block cols-span-12 md:col-span-4">
            <div class="sticky top-6 space-y-4">
              <?php $__currentLoopData = $event['recordings']['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('components.blog-recording-sidenav', [
                  'day' =>  $day['day'],
                  'date' => $day['date'],
                  'anchor' => $loop->index
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
          <div class="col-span-12 lg:col-span-8">
            <?php $__currentLoopData = $event['recordings']['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div id="day-<?php echo e($loop->index); ?>" class="sidebar-item flex justify-between items-center px-4 md:px-6 py-3 md:py-4 bg-blue text-white">
                <div class="flex items-center justify-between w-full">
                  <?php echo $__env->make('elements.text', ['text' => $day['day'], 'type' => 'wysiwyg', 'size' => 22,'weight' => 500], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php echo $__env->make('elements.text', ['text' => $day['date'], 'type' => 'wysiwyg', 'size' => 16], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
              <div class="mt-3 mb-6">
                <?php if( $day['list'] ): ?>
                <?php $__currentLoopData = $day['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="my-2 md:my-4">
                    <div class="bg-white p-6 md:p-8 lg:p-10 flex flex-col-reverse lg:flex-row justify-between">
                      <div class="lg:w-4/12 h-64 relative overflow-hidden">
                        <div class="recording-video w-full h-full">
                          <div class="my-0 h-full">
                            <div class="h-full cursor-pointer">
                              <div class="image h-full">
                                <?php if($listitem['is_video']): ?>
                                  <a href="<?php echo e($listitem['video_embed']); ?>" class="glightbox h-full relative block hover:video-button">
                                    <?php echo wp_get_attachment_image($listitem['image']['ID'], 'large w-full h-full object-cover', "full", false, "role"); ?>
                                    <div class="absolute absolute top-[50%] left-[50%] ml-[-36px] mt-[-36px]">
                                      <?php echo $__env->make('icons.play-button-small', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                  </a>
                                <?php else: ?>
                                  <?php echo wp_get_attachment_image($listitem['image']['ID'], 'large w-full h-full object-cover', "full", false, "role"); ?>
                                <?php endif; ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="lg:w-7/12 relative flex flex-col justify-between items-start">
                        <?php echo $__env->make('elements.text', ['text' => $listitem['heading'], 'type' => 'wysiwyg', 'size' => 22,'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="w-full mb-4 lg:mb-0">
                          <?php $__currentLoopData = $listitem['speakers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="mb-4 lg:mb-2 mt-6 lg:mt-0 flex flex-wrap -ml-2 ">
                            <div class="flex items-center pl-2 mt-2 md:mt-0">
                              <div class="relative w-10 h-10 md:w-12 md:h-12 rounded-full overflow-hidden mr-2">
                                <?php echo wp_get_attachment_image($speaker['profile_picture']['id'], ' absolute top-0 left-0 w-full h-full object-cover', "full", false, "role"); ?>
                              </div> 
                              <div class="flex-auto pl-2 md:pr-6">
                                <?php echo $__env->make('elements.text', ['text' => $speaker['name'], 'type' => 'wysiwyg', 'size' => 16, 'weight' => 500], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('elements.text', ['text' => $speaker['job_title'], 'type' => 'wysiwyg', 'size' => 14], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                              </div>
                            </div>
                          </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                <?php endif; ?>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="sidebar-item flex justify-center items-center px-4 md:px-6 py-3 md:py-4 bg-grey text-white text-center">
              <div class="flex items-center justify-center w-full">
                <?php echo $__env->make('elements.text', ['text' => 'CLOSING', 'type' => 'wysiwyg', 'size' => 18,'weight' => 600], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php elseif( $event['acf_fc_layout'] === 'speakers' ): ?>
        <section class="my-16 md:my-20 bg-white">
          <div class="container grid grid-cols-12">
            <div class="col-span-12 md:col-span-8 md:col-start-3 lg:col-span-6 lg:col-start-4 text-center mb-12 md:mb-16">
              <?php echo $__env->make('elements.text', ['text' => $event['speakers']['heading'], 'type' => 'h2', 'size' => 40, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
          </div>
          <div class="container grid grid-cols-12 gap-6 md:gap-10 lg:gap-12">
                <?php $__currentLoopData = $event['speaker']['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php echo $__env->make('components.blog-speaker', [
                    'name' =>  $speaker['name'],
                    'job_title' => $speaker['job_title'],
                    'description' => $speaker['description'],
                    'picture' => $speaker['profile_picture'],
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </section>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<section class="my-16 md:my-20">
  <div class="container grid grid-cols-12">
    <article class="content space-y-3 md:space-y-8 col-span-12 md:col-span-7">
      <?php $__currentLoopData = $flexible_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($item['acf_fc_layout'] === 'wysiwyg'): ?>
          <?php echo $__env->make('elements.text', ['text' => $item['content'], 'type' => 'wysiwyg', 'size' => 18], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif($item['acf_fc_layout'] === 'image'): ?>
          <div class="w-full py-2 md:py-6">
            <?php echo wp_get_attachment_image($item['image']['ID'], 'large w-full h-auto', "full", false, "role"); ?>
          </div>
        <?php elseif($item['acf_fc_layout'] === 'list'): ?>
          <ol class="space-y-3 md:space-y-4">
            <?php $__currentLoopData = $item['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php echo $__env->make('elements.text', ['text' => $item['text'], 'type' => 'li', 'size' => 18, 'weight' => 400], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ol>
        <?php elseif($item['acf_fc_layout'] === 'quote'): ?>
          <?php echo $__env->make('components.pull-quote', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif($item['acf_fc_layout'] === 'form_embed'): ?>
          <iframe src="<?php echo e($item['form_embed']); ?>" width="100%" height="800" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if( $sidebar_form['form_embed']): ?>
        <iframe class="block md:hidden" src="<?php echo e($sidebar_form['form_embed']); ?>" width="100%" height="800" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
      <?php endif; ?>
      
    </article>
    <div class="col-span-12 md:col-span-4 md:col-start-9">
      <aside class="sticky top-6 space-y-3 md:space-y-5">
        <?php if( $sidebar_form['form_embed']): ?>
          <iframe class="hidden md:block" src="<?php echo e($sidebar_form['form_embed']); ?>" width="100%" height="1100" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>
        <?php else: ?>
          <?php echo $__env->make('components.blog-cta', [
            'layout' => '2',
            'heading_size' => '26',
            'content_size' => '16',
          ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <?php echo $__env->make('components.other-articles', [
            'background' => 'bg-lighter-grey'
          ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
      </aside>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <?php echo $__env->make('components.blog-cta', [
      'layout' => '1',
      'heading_size' => '36',
      'content_size' => '18',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/wp-content/themes/theme/resources/views/pages/post.blade.php ENDPATH**/ ?>