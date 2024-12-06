<?php

/* Emma API Keys */
require 'api/e2ma-keys.php';
?>


<!doctype html>
<html lang="en-US" prefix="og: http://ogp.me/ns#" class="no-js">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Actify | The Product Data Intelligence Company</title>

<!-- This site is optimized with the Yoast SEO plugin v5.5 - https://yoast.com/wordpress/plugins/seo/ -->
<meta name="description" content="Make smarter, faster decisions that directly impact the bottom line"/>
<link rel="canonical" href="https://www.actify.com/" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Actify | The Product Data Intelligence Company" />
<meta property="og:description" content="Make smarter, faster decisions that directly impact the bottom line" />
<meta property="og:url" content="https://www.actify.com/" />
<meta property="og:site_name" content="Actify" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="Make smarter, faster decisions that directly impact the bottom line" />
<meta name="twitter:title" content="Actify | The Product Data Intelligence Company" />


<link rel="stylesheet" href="https://www.actify.com/wp-content/themes/actify/dist/styles/main.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="css/e2ma.css" media="all" rel="stylesheet" type="text/css">
  </head>
  <body class="body">
    <?php require 'blocks/header.php'; ?>
    <div class="ui stackable grid" id="content">
      <?php require 'blocks/signup.php'; ?>
      <?php require 'blocks/manage.php'; ?>
      <?php require 'blocks/form.php'; ?>
    </div>
    <!-- end #content -->

    <?php require 'blocks/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js">
    </script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.js">
    </script> 
    <script src="js/e2ma.js">
    </script>

  </body>
</html>