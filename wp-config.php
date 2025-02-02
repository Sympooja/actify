<?php

require_once (__DIR__.'/vendor/autoload.php');

define( 'WP_MEMORY_LIMIT', '256M' );

if (!file_exists('/tmp/storage/views')) {
  mkdir('/tmp/storage/views', 0777, true);
}

define('THEMOSIS_STORAGE', '/tmp/storage');
define('WP_DEBUG', false);


# Database Configuration
define( 'DB_NAME', 'wp_actify' );
define( 'DB_USER', 'actify' );
define( 'DB_PASSWORD', 'ktBVKxhEc3Zpc9UOL8j5' );
define( 'DB_HOST', '127.0.0.1:3306' );
define( 'DB_HOST_SLAVE', '127.0.0.1:3306' );
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '^WTYr|+OC8&Hl)`a)(]sC,8at~ESGl,T |DSc!*^{G_A)(QV8k+rmYr5Q|>`!}6=');
define('SECURE_AUTH_KEY',  '~I7IL[;zfXO&g|5Nn$GLyX7TMwBrk^DqJyC7zyN^0^h`WP{XsIWv`*F:e%~S4=m2');
define('LOGGED_IN_KEY',    'y&~LVLd?=ma%M1!X|Et|Ll)0E3Aiz~giY_ACB_Ng5+|?`CD(}P0!LXO2-W-36HsJ');
define('NONCE_KEY',        'H/`86hB 4`zxN{?-cUK,/&m{+603ile<#HgsLUv(sm:.43+OA%!,7p%Fl[+9I4Q*');
define('AUTH_SALT',        '[G(y%JaB~24de&dK&*8lp+|!>L-Wi9/.iiB72XFlI89i:MVtI=tYr-0-=(+x4Px`');
define('SECURE_AUTH_SALT', 'X}7,$# -IFu^Z.4J<Zs<:-CwOu RH&oG0ntGCZ*KZrkJXJ]bA`r{[,n#so?J]2UT');
define('LOGGED_IN_SALT',   'n|,rj-,KeDa)--mW=ads_IY-0$sf>sT.#V#zU=w@Am6:DBfNe*YttP5%Z8y,!p+o');
define('NONCE_SALT',       '$:zoenz+7o!@G_8hg]_-cP;MB+w!@K$lg>A,f`Tu(w!6G-4kV%IH1+pa4z]=1qQP');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'actify' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

umask(0002);

define( 'WPE_APIKEY', '9c7f7d427dd6fd4819624f7550143369293faf7e' );

define( 'WPE_CLUSTER_ID', '100142' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_SFTP_ENDPOINT', '' );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', 5 );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'actify.wpengine.com', 1 => 'actify.wpenginepowered.com', 2 => 'archive.actify.com', 3 => 'spinfire.com', 4 => 'www.spinfire.com', );

$wpe_varnish_servers=array ( 0 => 'pod-100142', );

$wpe_special_ips=array ( 0 => '104.196.1.148', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );


# WP Engine ID


# WP Engine Settings




# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');
/*MEMCACHED_ENV_START*/ if (isset($_ENV['WPE_CACHE_HOST'])) $memcached_servers=array ( 'default' =>  array ( 0 => $_ENV['WPE_CACHE_HOST'], ), ); /*MEMCACHED_ENV_END*/
