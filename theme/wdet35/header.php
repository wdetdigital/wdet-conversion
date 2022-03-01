<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CoverNews
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	
<meta name="description" content="WDET is Detroit's Public Radio Station. For over 60 years, WDET has provided an independent voice for Detroit through a mix of news, music and cultural programming that's unique as the city and region we serve.">
  <meta name="keywords" content="NPR Detroit, public radio, radio news, detroit news, detroit music, detroit podcast, breaking news detriot, new in detroit, live news, 101.9fm, wdet,">
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-60587032-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-60587032-1');
</script>

	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    googletag.defineSlot('/127394106/wdet_side_bottom', [300, 250], 'div-gpt-ad-1641665776976-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    googletag.defineSlot('/127394106/wdet_side_1', [[300, 250], [300, 600]], 'div-gpt-ad-1641666371508-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
	<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    googletag.defineSlot('/127394106/wdet_leaderboard_top', [[728, 90], [970, 250]], 'div-gpt-ad-1641667171256-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    googletag.defineSlot('/127394106/WDET_middle_970x250', [[970, 250], [728, 90]], 'div-gpt-ad-1641683631381-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>	
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
} ?>

	<div class="example"> 
	<header class="site-header2">
		<div class="container site-header-container">

						<div class="top-header">

        				<a href="/" class="logo">
				            <div class="logo site-header2-logo">
	<div class="png">
		<img src="/wp-content/uploads/2022/01/22logo-shape-inverted.png" alt="wdet"/>
	</div>
	
</div>					<span class="h1 sr-only">WDET</span>
        </a>

			         

			          <div class="hidden-xs">
          <div class="top-header-desktop">
    				<div class="now-playing-wrapper">
              <span class="now-playing"><iframe src="https://composer.nprstations.org/widgets/iframe/now.html?v=5.11.0&station=5182d007e1c809685c190ee6" seamless></iframe></span>
             <a class="sgplayer-link" target="_blank" width="500" height="600"
href="https://player.streamguys.com/wdet/sgplayer3/player.php?l=layout-small+single-stream-metadata">
    					  <span class="fa fa-volume-up" aria-hidden></span>
    					  <strong style="word-break: normal">Listen</strong>
              </a>
    				</div>
    			
			  
			  
			  <a href="https://wdet.secureallegiance.com/wdet/WebModule/Donate.aspx?P=WEBGIFTS&PAGETYPE=PLG&CHECK=h8P6BDqH37CDky%2bMCTICJW3L5BYddGq6PVAl6UEf65g%3d" class="header-donate"> 
    					<span class="fa fa-heart red-color" aria-hidden></span>
    					<strong><p style="color:red;">Donate</p></strong>
    				</a>
    			
			  
	
    			
    				<div class="social">
            	<a href="https://www.facebook.com/WDETFM" aria-label="Visit us on Facebook." class="a-no-decorate" target="_blank">
            	  <span class="fa fa-fw fa-facebook" aria-hidden></span>
            	</a>
            	<a href="https://twitter.com/wdet" aria-label="Visit us on Twitter." class="a-no-decorate" target="_blank">
          			<span class="fa fa-fw fa-twitter" aria-hidden></span>
            	</a>
            	<a href="http://instagram.com/wdetdetroit" aria-label="Visit us on Instagram." class="a-no-decorate" target="_blank">
          			<span class="fa fa-fw fa-instagram" aria-hidden></span>
            	</a>
            	<a href="https://www.linkedin.com/company/wdet-101.9-fm-detroit-public-radio/" aria-label="Visit us on Linkedin." class="a-no-decorate" target="_blank">
          			<span class="fa fa-fw fa-linkedin" aria-hidden></span>
            	</a>
            </div>
    				<div class="tagline">
              Detroit's NPR Station
            </div>
          </div>
        </div>
			</div>
	  </div>
		
		

</header>
	</div>
	<!-- /127394106/wdet_leaderboard_top -->
<div class="example">
<center>

<div id="div-gpt-ad-1641667171256-0" style="min-width: 728px; min-height: 90px;"><script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1641667171256-0'); });
  </script></div>
	
	</center>
</div>
	<br/>
<?php
$enable_preloader = covernews_get_option('enable_site_preloader');
if ( 1 == $enable_preloader ):
    ?>
    <div id="af-preloader">
        <div id="loader-wrapper">
            <div id="loader"></div>
        </div>
    </div>
<?php endif; ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'covernews'); ?></a>

<?php
$header_layout = covernews_get_option('header_layout');
if($header_layout == 'header-layout-3'){
    covernews_get_block('header-layout-3');
} elseif($header_layout == 'header-layout-2'){
    covernews_get_block('header-layout-2');
} else {
    covernews_get_block('header-layout-1');

}

?>
    <div id="content" class="container">
<?php
    do_action('covernews_action_get_breadcrumb');