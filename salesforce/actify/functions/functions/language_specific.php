<?php

	// New analytics setup
	// Track traffic using the correct analytics account code
function actify_get_analytics_code() {

	if (ICL_LANGUAGE_CODE == 'de') {
		$ua_code = 'UA-3527360-3';
	}
	else if (ICL_LANGUAGE_CODE == 'en-gb') {
		$ua_code = 'UA-1656812-1';
	}
	else if (ICL_LANGUAGE_CODE == 'zh-hans') {
		$ua_code = 'UA-3527360-2';
	}
	else { // if (ICL_LANGUAGE_CODE == 'en')
		$ua_code = 'UA-3527360-4';
	}
		
	if (defined('WP_ENV') && WP_ENV == "production") {
			# code...
		$code = <<<EOD
			<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '$ua_code', 'auto');
  ga('send', 'pageview');

</script>
EOD;
	}	
	
	return $code;
}


// Set up google webmasters tools per domain
function actify_get_webmasters_code() {

	if (ICL_LANGUAGE_CODE == 'de') {
		$wm_code = '_qAB4sAuKuOn4C_QL1csR3FadmB3pu5Q_2KOf4j_lcw';
	}
	else if (ICL_LANGUAGE_CODE == 'en-gb') {
		$wm_code = 'r0RKkERJalTcKdA6_fREodDgrvkr2OXbdyQdt3R5pU8';
	}
	else if (ICL_LANGUAGE_CODE == 'zh-hans') {
		$wm_code = 'pDpRm3s8axjRxuMj0UMDq9ESKA_BM5qEoTVL59gpK3Q';
	}
	else { // if (ICL_LANGUAGE_CODE == 'en')
		$wm_code = '5oLE-RYpJhedDJf8qLYcWDscBRBDT4PSjx2cg8LbvY0';
	}
		
	if (defined('WP_ENV') && WP_ENV == "production") {
		$code = <<<EOD
	<meta name="google-site-verification" content="$wm_code" />
EOD;
	}	
	
	return $code;
}



// Get the default Partner Name for Leads
function actify_get_default_partner_name()
{
	if (ICL_LANGUAGE_CODE == 'en')
	{
		// actify.com
		return 'Actify';
	}	
	else if (ICL_LANGUAGE_CODE == 'de')
	{
		// actifyeurope.de
		return 'Actify Germany';
	}
	else if (ICL_LANGUAGE_CODE == 'en-gb')
	{
		// actify.co.uk
		return 'Actify UK';
	}
	else if (ICL_LANGUAGE_CODE == 'zh-hans')
	{
		// actify.asia
		return 'Actify China';
	}
} ?>