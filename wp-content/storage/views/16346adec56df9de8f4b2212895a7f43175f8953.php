<?php
  $cacheStr = '1.0.0';
?>

<!DOCTYPE html>
<html lang="<?php echo e(get_locale()); ?>">
<!--
Made Together
[https://together.agency]
-->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(themosis_theme_assets()); ?>/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(themosis_theme_assets()); ?>/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(themosis_theme_assets()); ?>/images/favicon-16x16.png">
  <link rel="manifest" href="<?php echo e(themosis_theme_assets()); ?>/images/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  
  <style>
    /* hide all img elements until the svg is injected to prevent "unstyled image flash" */
    img.injectable {
      visibility: hidden;
    }
  </style>

  
  <link rel="stylesheet" href="<?php echo e(themosis_theme_assets()); ?>/webpack/styles.css?v=<?php echo $cacheStr; ?>">

  
  <?php echo e(wp_head()); ?>


  <script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=i5xbypjcezno8a4j9zjvlg" async="true"></script>

  <!-- Google Tag Manager -->
  
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-3527360-4"></script>
  <script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","UA-3527360-4")</script>
</head>

<body class="text-grey <?php echo e('page--'.(isset($pageName) ? $pageName : '')); ?> <?php echo e(implode(get_body_class(), ' ')); ?> <?php echo e('title--'.slugify($page->post_title)); ?>  <?php echo e($customBodyClass ?? ''); ?> <?php if($isDev): ?> is-dev <?php endif; ?>">


  <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <main class="content">
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="/wp-content/themes/theme/dist/webpack/main.js?v=<?php echo $cacheStr; ?>"></script>

  <?php echo e(wp_footer()); ?>


</body>
</html>
<?php /**PATH /app/wp-content/themes/theme/resources/views/layouts/default.blade.php ENDPATH**/ ?>