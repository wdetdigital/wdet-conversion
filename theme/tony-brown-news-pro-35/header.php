<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package news-box-pro
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    googletag.defineSlot('/127394106/WDET_middle_970x250', [[970, 250], [728, 90]], 'div-gpt-ad-1632775015332-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
	
	<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    googletag.defineSlot('/127394106/wdet_leaderboard_top', [[970, 250], [728, 90]], 'div-gpt-ad-1632775225693-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
	
	</head>

<body <?php body_class(); ?>>
	<?php
	 $news_box_preloader = get_theme_mod( 'news_box_show_preloader', 1 ); 
	 if($news_box_preloader == 1):
	 ?>
		<!--preloader -->
	<div id="preloader" class="news-box-preloader">
<?php get_template_part('template-parts/header/preloader-template'); ?>
	</div>
	<?php endif; ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'news-box-pro' ); ?></a>

	
			  
	<header class="site-header2">
		<div class="container site-header-container">

						<div class="top-header">

        				<a href="/" class="logo">
				            <div class="logo site-header2-logo">
	<div class="png">
		<img src="https://layout.wdet.org/wp-content/uploads/2021/09/logo-shape-inverted.png" alt="wdet"/>
	</div>
	<div class="svg">
		

<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	viewBox="0 0 120 162" style="enable-background:new 0 0 120 162;" xml:space="preserve">
	<path class="logo-outline" d="M82,58.8c3.2,0,5.1,2.5,5.4,5.6H76.4C76.9,61.1,79,58.8,82,58.8 M75.5,86.7c-1.4,0-2.1,0.8-2.1,1.9v0
		c0,1.1,0.8,1.9,2.2,1.9c1.4,0,2.1-0.8,2.1-1.9v0C77.7,87.5,76.9,86.7,75.5,86.7 M50.6,86.8c-1.6,0-2.7,1.7-2.7,3.9v0
		c0,2.3,1.1,4,2.7,4c1.7,0,2.7-1.7,2.7-3.9v0C53.3,88.5,52.2,86.8,50.6,86.8 M56.7,72.8c3.3,0,6.2-2.7,6.2-6.8v-0.1
		c0-4.1-2.9-6.8-6.2-6.8c-3.4,0-6.1,2.6-6.1,6.8v0.1C50.5,70.1,53.4,72.8,56.7,72.8 M107.3,55.2h-5.7v-5.9h-4.9v5.9H94v4.2h2.7v11.2
		c0,4.7,2.5,6.3,6.1,6.3c1.8,0,3.2-0.4,4.4-1.1v-4c-1,0.5-1.9,0.7-3,0.7c-1.7,0-2.6-0.8-2.6-2.7V59.4h5.7V55.2z M107.3,90.8
		c0-2.3-1.2-3.5-3.2-3.5c-1.3,0-2.3,0.5-3.1,1.5c-0.5-1-1.4-1.5-2.7-1.5c-1.4,0-2.2,0.7-2.8,1.5v-1.4h-2.7V97h2.7v-5.3
		c0-1.3,0.6-1.9,1.6-1.9c1,0,1.6,0.7,1.6,1.9V97h2.7v-5.3c0-1.3,0.6-1.9,1.6-1.9c1,0,1.6,0.7,1.6,1.9V97h2.7V90.8z M92.1,67.6
		c0-0.5,0.1-0.9,0.1-1.4c0-6.1-3.4-11.5-10.2-11.5c-6.1,0-10.4,5-10.4,11.1V66c0,6.6,4.8,11.1,10.9,11.1c3.9,0,6.7-1.6,8.7-4
		l-2.9-2.5C86.7,72.1,85,73,82.6,73c-3.1,0-5.6-1.9-6.1-5.4H92.1 M90.9,84.1c-0.5-0.2-1.1-0.3-1.9-0.3c-1,0-1.7,0.2-2.2,0.7
		c-0.5,0.5-0.8,1.3-0.8,2.3v0.6h-1.1v2.2H86V97h2.7v-7.2h2.2v-2.2h-2.2v-0.4c0-0.7,0.4-1,1-1c0.5,0,0.8,0.1,1.2,0.2V84.1z M80.5,90.4
		c0-2.5-0.6-3.8-1.5-4.7c-0.9-0.9-1.9-1.4-3.6-1.4c-2.8,0-4.8,1.9-4.8,4.4v0c0,2.5,1.7,4,4.5,4c1.1,0,1.9-0.3,2.5-0.9
		c-0.2,1.7-1,2.8-2.5,2.8c-1.1,0-1.8-0.3-2.7-1.1l-1.4,2.1c1.1,0.9,2.3,1.5,4.1,1.5C78.6,97.2,80.5,94.5,80.5,90.4L80.5,90.4z
		M68.5,94.2h-2.9V97h2.9V94.2z M62.9,84.4H61l-3.6,1.1l0.6,2.2l2.2-0.5V97h2.7V84.4z M56.1,90.7c0-3.6-2.2-6.4-5.5-6.4
		c-3.3,0-5.6,2.8-5.6,6.5v0c0,3.6,2.2,6.4,5.5,6.4C53.9,97.2,56.1,94.4,56.1,90.7L56.1,90.7z M45.6,65.9c0,7.1,4.9,11.1,9.9,11.1
		c3.5,0,5.7-1.8,7.3-4v3.6h4.9V47.1h-4.9v11.5c-1.5-2-3.8-3.8-7.3-3.8C50.4,54.8,45.6,58.8,45.6,65.9L45.6,65.9z M44.3,55.2h-4.9
		l-4.4,14.6l-4.8-14.7h-4.2l-4.7,14.7l-4.3-14.6h-5l6.9,21.5h4.4l4.8-14.6L33,76.7h4.4L44.3,55.2z M42.4,84.4h-1.9L37,85.5l0.6,2.2
		l2.2-0.5V97h2.7V84.4z M105.2,0c8.3,0,14.8,6.4,14.8,14.7v87.5c0,4.4-2,8.3-5,11.1v0l0.2,0.1c0,0,0.1,0,0.1,0.1l-53.4,44.9
		c-2.2,2-6.4,3.7-9.4,3.7H22.7c-3,0-4-2-2.2-4.5c0,0,25.7-36.6,27.6-39.2c2.4-3.3,1.1-5.3-3.1-5.3H15.5C7.2,113,0,106.3,0,97.9V14.7
		C0,6.4,7.2,0,15.5,0H105"/>
</svg>	</div>
</div>					<span class="h1 sr-only">WDET</span>
        </a>

			         

			          <div class="hidden-xs">
          <div class="top-header-desktop">
    				<div class="now-playing-wrapper">
              <span class="now-playing"><iframe src="https://composer.nprstations.org/widgets/iframe/now.html?v=5.11.0&station=5182d007e1c809685c190ee6" seamless></iframe></span>
             <a class="sgplayer-link" target="_blank" width="500" height="250"
href="https://player.streamguys.com/wdet/sgplayer3/player.php?l=layout-small+single-stream-metadata">
    					  <span class="fa fa-volume-up" aria-hidden></span>
    					  <strong style="word-break: normal">Listen</strong>
              </a>
    				</div>
    				<a href="/give/" class="header-donate">
    					<span class="fa fa-heart" aria-hidden></span>
    					<strong><p style="color:red;margin-bottom:1px;">Donate</p></strong>
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
	  
	

<?php
// current page 
$newsbox_current_page = max(1,get_query_var('paged'));
$news_box_top_bar = get_theme_mod( 'news_box_top_bar', 1 );
if($news_box_top_bar){
 get_template_part( 'template-parts/header/top-bar' );
}else{
	//need fix for vticekr.js error
	echo '<div class="date-time d-none"></div>';
}

// header style from customizer
$news_box_header_style = get_theme_mod( 'news_box_header_style', 'one' );
if( $news_box_header_style === 'one' ){
	get_template_part('template-parts/header/classic-header');
}else{
	get_template_part('template-parts/header/standard-header');
}

	get_template_part('template-parts/header/news-ticker');


//Home slider and grid section 
	if( $newsbox_current_page == 1 && (is_home() || is_front_page()) ){
		get_template_part('template-parts/home-page/home-feature-slider');
	}
	
	if( $newsbox_current_page == 1 && (is_home() || is_front_page()) ){
		get_template_part('template-parts/home-page/home-top-video');
	}

 ?>
