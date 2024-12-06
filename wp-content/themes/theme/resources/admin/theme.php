<?php
use Illuminate\Support\Str;


add_action('admin_init', function() {
  global $menu;

  foreach($menu as &$item) {
    if($item[0] === 'Header') {
      $item[2] = 'admin.php?page=header&lang='.ICL_LANGUAGE_CODE;
    }
    if($item[0] === 'Footer') {
      $item[2] = 'admin.php?page=footer&lang='.ICL_LANGUAGE_CODE;
    }
    if($item[0] === 'Blog') {
      $item[2] = 'admin.php?page=blog&lang='.ICL_LANGUAGE_CODE;
    }
  }
});

function getLocale() {
  $locale = explode('_', get_locale())[0];
  return $locale === 'en' ? '': $locale;
}

function translateLink($url = '') {
  return apply_filters( 'wpml_permalink', $url, ICL_LANGUAGE_CODE, true );
}

\Blade::directive('translateLink', function ($text='') {
  return "<?=translateLink($text)?>";
});


if (!function_exists('set_magic_quotes_runtime')) {
  function set_magic_quotes_runtime($new_setting) {
    return true;
  }
}


/*--------------------------------------------------------------------------------------
  Get static map
--------------------------------------------------------------------------------------*/
function getStaticMap($lat, $lng, $zoom = 11) {
  return "https://maps.googleapis.com/maps/api/staticmap?center={$lat}%2C{$lng}&zoom={$zoom}&size=265x275&key=AIzaSyCTlsb0iDLx-YD9C-3peOjD4ODPHZozWsU";
}


/*--------------------------------------------------------------------------------------
  Create multidimensional array of nav items
--------------------------------------------------------------------------------------*/
function nestedNav($location) {
  $menu_locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object($menu_locations[$location]);
  $menu_items = wp_get_nav_menu_items($menu->term_id);
  $new_menu_array = [];

  foreach ((array) $menu_items as $key => $menu_item) {
    $new_menu_array[$menu_item->menu_item_parent][] = $menu_item;
  }

  $new_menu_array1 = [];
  foreach ((array) $menu_items as $key => $menu_item) {
    $assocPost = get_post($menu_item->object_id);
    $pageName = isset($assocPost) && isset($assocPost->post_name) ? 'nav--'.$assocPost->post_name : '';
    $postType = isset($assocPost) && $assocPost->post_type ? 'post-type--'.$assocPost->post_type : '';
    if (is_object($menu_item)) {
      $menu_item->name = $assocPost->post_name ?? '';
      $menu_item->fields = get_fields($menu_item->db_id);
      $menu_item->css_classes = $pageName.' '.$postType.' '.implode(' ', $menu_item->classes);

      if (isset($new_menu_array[$menu_item->ID])) {
        $menu_item->sub = $new_menu_array[$menu_item->ID];
        if($menu_item->menu_item_parent == 0) {
          $new_menu_array1[] = $menu_item;
        }
      }
    }
  }

  if(isset($new_menu_array[0])) {
    $menu_tree = array_splice($new_menu_array[0], 0, 15, $new_menu_array1);
    return $menu_tree;
  } else {
    return [];
  }
}

function themosis_placeholder() {
  return themosis_theme_assets().'/images/placeholder';
}

function addColourSpan($text='', $colour='') {
  // Replace the | char
  return preg_replace("~\|(.+)\|~U", "<span>$1</span>", $text);
}

function slugify($str = '') {
  return Str::slug($str, '-');
}

function removeShortcodes($str='') {
  return preg_replace('#\[[^\]]+\]#', '', $str);
}

function excerpt($str='', $length=40, $end='...') {
  return Str::limit(removeShortcodes(strip_tags($str)), $length, $end);
}

function removeHTMLAttrs($str='') {
  return preg_replace('/(<[^>]+) (style|class)=".*?"/i', '$1', $str);
}

function isSVG($url) {
  return strpos($url,'.svg') !== false;
}

function getCurrentURL() {
  return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
}

function getPostCat($postID) {
  $cats = wp_get_post_categories($postID);
  if (!empty($cats)) {
    return get_category($cats[0]);
  } else {
    return false;
  }
}

\Blade::directive('colourHeading', function ($text='', $colour='') {
  return "<?=addColourSpan($text, '$colour')?>";
});

\Blade::directive('img', function ($id, $size = 'full') {
  $stuff = '"role"';
  return '<?php echo wp_get_attachment_image('.$id.', "'.$size.'", false, '.$stuff.'); ?>';
});

\Blade::directive('translate', function ($text) {
  return "<?php echo $text ?>";
});
