<?php
require_once( __DIR__ . '/functions/functions.php' );
$reflFunc = new ReflectionFunction('actify_remove_wp_magic_quotes');
print $reflFunc->getFileName() . ':' . $reflFunc->getStartLine();
?>