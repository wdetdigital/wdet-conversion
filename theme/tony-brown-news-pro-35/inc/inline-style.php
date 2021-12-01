<?php
/**
 * Add inline css 
 *
 * 
 */
if ( ! function_exists( 'news_box_inline_css' ) ) :
function news_box_inline_css() {

  $style = ''; 
  // Logo height and width
  $news_box_logo_width_auto = get_theme_mod( 'news_box_logo_width_auto',1 );
  $news_box_logo_width = get_theme_mod( 'news_box_logo_width');
  $news_box_logo_height_auto = get_theme_mod( 'news_box_logo_height_auto',1);
  $news_box_logo_height = get_theme_mod( 'news_box_logo_height');

if($news_box_logo_width_auto != 1 && $news_box_logo_width){
    $style .='.site-logo img{width:'.$news_box_logo_width.'px !important}';
}
if($news_box_logo_height_auto != 1 && $news_box_logo_height){
    $style .='.site-logo img{height:'.$news_box_logo_height.'px !important}';
}


// font settings
  $news_box_font = get_theme_mod( 'news_box_font', 'Open Sans' );
  $news_box_head_font = get_theme_mod( 'news_box_head_font', 'Roboto Slab' );
  $news_box_font_size = get_theme_mod( 'news_box_font_size', '14' );
  $news_box_header_font_transform = get_theme_mod( 'news_box_header_font_transform', 'none' );
  $news_box_widget_head_fsize = get_theme_mod( 'news_box_widget_head_fsize', '16' );
  if( $news_box_font != 'Open Sans' ){
    $style .='html,body,p{font-family:\''.$news_box_font.'\'}';
  }
  if( $news_box_head_font != 'Roboto Slab' ){
    $style .='h1,h2,h3,h4,h5,h6{font-family:\''.$news_box_head_font.'\'}';
  }
  if( $news_box_font_size != '14' ){
    $style .='body,p{font-size:'.$news_box_font_size.'px}';
  }
  if( $news_box_header_font_transform != 'none' ){
    $style .='h1,h2,h3,h4,h5,h6{text-transform:'.$news_box_header_font_transform.'}';
  }
  if( $news_box_widget_head_fsize != '16' ){
    $style .='.widget.wstyle2 h4.widget-title{font-size:'.$news_box_widget_head_fsize.'px}';
  }
  $background_color = get_theme_mod( 'background_color','ffffff');
  if( $background_color != 'ffffff' ){
    $style .='.post-meta.grid-meta .slider-meta, .widget.wstyle2 span.title-mid{background-color:#'.$background_color.'}';
    $style .='.card-content { padding: 10px; }';
  }
  



    $newsbox_header_textcolor = get_theme_mod('header_textcolor', '000' );
     $style .= '.site-title a, .site-description{color:#'.$newsbox_header_textcolor.'}';

  $news_box_logo_section_padding = get_theme_mod( 'news_box_logo_section_padding', 0 );
  $style .= '.site-branding.logo-padding{padding:'.$news_box_logo_section_padding.'px}';

 // Page header style from customize
  $newsbox_page_heading = get_theme_mod('newsbox_page_heading', 'standard' );
  $news_box_page_head_padding = get_theme_mod('news_box_page_head_padding', 50 );
  $news_box_page_overlay_color = get_theme_mod('news_box_page_overlay_color', '#000' );
  $news_box_page_overlay_opacity = get_theme_mod('news_box_page_overlay_opacity', '7' );
  $news_box_page_header_color = get_theme_mod('news_box_page_header_color', '#fff' );
    //page Style
    $style .= 'header.page-header.single-page-head{padding:'.$news_box_page_head_padding.'px}';
  if( $newsbox_page_heading == 'standard-img' || $newsbox_page_heading == 'standard-bg' ): 
    $style .= 'header.page-header.single-page-head h1{color:'.$news_box_page_header_color.'}';
    $style .= 'header.page-header.single-page-head.overlay-balck:before{background-color:'.$news_box_page_overlay_color.'; opacity:0.'.$news_box_page_overlay_opacity.'}';
  endif;



 // Single header settings
  $news_bonews_box_heading = get_theme_mod( 'news_bonews_box_heading', 'standard' );

  $news_bonews_box_head_padding = get_theme_mod('news_bonews_box_head_padding', 50 );
   $news_bonews_box_overlay_color = get_theme_mod('news_bonews_box_overlay_color', '#000' );
   $news_bonews_box_overlay_opacity = get_theme_mod('news_bonews_box_overlay_opacity', '7' );
  $news_bonews_box_header_color = get_theme_mod('news_bonews_box_header_color', '#000' );
  // Single blog header style 
    $style .= 'header.page-header.single-header{padding:'.$news_bonews_box_head_padding.'px}';

     $style .= 'header.page-header.single-header.overlay-balck:before{background-color:'.$news_bonews_box_overlay_color.'; opacity:0.'.$news_bonews_box_overlay_opacity.'}';

    $style .= 'header.page-header.single-header.overlay-balck p, header.page-header.single-header.overlay-balck h2, header.page-header.single-header.overlay-balck h1, header.page-header.single-header .x-overlay h2, header.page-header.single-header.overlay-balck i, header.page-header.single-header.overlay-balck .xbreadcrumb span, header.page-header.single-header.overlay-balck .xbreadcrumb span a{color:'.$news_bonews_box_header_color.' !important}';



   // archive page settings 
 $news_box_archive_heading = get_theme_mod('news_box_archive_heading', 'standard' );
 $news_box_archive_head_padding = get_theme_mod('news_box_archive_head_padding', 70 );
 $news_box_archive_overlay_color = get_theme_mod('news_box_archive_overlay_color', '#000' );
 $news_box_archive_overlay_opacity = get_theme_mod('news_box_archive_overlay_opacity', '7' );
 $news_box_archive_header_color = get_theme_mod('news_box_archive_header_color', '#000' );
 $news_box_author_desc_color = get_theme_mod('news_box_author_desc_color', '#fff' );


      // archive header style 
        $style .= 'header.archive-header{padding:'.$news_box_archive_head_padding.'px}';
if( $news_box_archive_heading == 'standard-img' || $news_box_archive_heading == 'standard-bg' ): 
    $style .= 'header.page-header.archive-header.overlay-balck:before{background-color:'.$news_box_archive_overlay_color.'; opacity:0.'.$news_box_archive_overlay_opacity.'}';
       
        if ($news_box_archive_header_color != '#fff' ){
                $style .= '.archive-header.overlay-balck p, .archive-header.overlay-balck h3, .archive-header.overlay-balck .x-overlay h2, .archive-header.overlay-balck h1, .archive-header.overlay-balck .xbreadcrumb span, .archive-header.overlay-balck .xbreadcrumb, .archive-header.overlay-balck i, header.author-header h3.author-name{color:'.$news_box_archive_header_color.' !important}';
         }
  $style .= 'header.archive-header .archive-desc p,header.archive-header .archive-desc a, header.author-header .x-overlay h2,
            header.archive-header .archive-desc i{color:'.$news_box_author_desc_color.' !important}';
endif;
    


  //theme color
$news_box_theme_color = get_theme_mod( 'news_box_theme_color', 'default');
$news_box_primary_color = get_theme_mod( 'news_box_primary_color', '#fff');
$news_box_secondary_color = get_theme_mod( 'news_box_secondary_color', '#000');

if( $news_box_theme_color === 'custom' && ($news_box_primary_color != '#fff' || $news_box_secondary_color != '#000') ){

    /* primary color */
 $style .='
div#mainNav, a.fcat-btn,.news-box-social-widget li a:hover,
.news-box-slider-widget button.owl-dot.active,
.owl-carousel button.owl-dot.active,ul.advance-meta li p:hover,
.footer-social:before,.site-info,#scrollUp,.footer-widget:before,
.x-overlay:before,.search-header input.search-submit,
.widget input.search-submit:hover,input[type="submit"]:hover, 
#comments input[type="submit"]:hover, .pagination .nav-links a, .pagination .nav-links span,a.readmore:before,
input.wpcf7-form-control.wpcf7-submit:hover,.insta-follow a,.main-navigation ul li li > a:hover,.footer-widget input[type="submit"]:hover,.widget input.search-submit{
    background-color: '.$news_box_primary_color.' !important;
}
.about-img-cap, .social-icon a, ul.advance-meta li p i,a,a:hover,a:focus,a:visited,.adshow i,.slider-meta span a,.slider-meta span{
    color: '.$news_box_primary_color.' !important;
}
div#mainNav,.site-info,.footer-widget input[type="submit"],ul.advance-meta li p, .home-slider-text a.more-link {
    border-color:'.$news_box_primary_color.' !important;
}';
/* Secondary color */
$style .='.pagination_next:before,
.pagination_prev:before,.standard-social a,
.bg-white .main-navigation ul li a,.fcat-link a,
a.fcat-btn:hover,#scrollUp i,.news-box-social-widget li a:hover,
.pagination_num,.default-footer p.copyright,
ul.advance-meta li p:hover i,.home-slider-text .slider-meta a:before,
.grid-content .slider-meta a:before,.search-header input.search-submit,.search-header input.search-submit:hover,.footer-widget input[type="submit"]:hover,.x-overlay a, .footer-social a, .site-info a, .site-info p, .insta-follow a,.nav-links a:hover,.widget input.search-submit{
    color:'.$news_box_secondary_color.' !important;
}
h5.widget-title:after,h5.widget-title:before,.home-slider-text .slider-meta a:before, .grid-content .slider-meta a:before, .slider-text-three .slider-meta a:before{
    background-color:'.$news_box_secondary_color.' !important;
}
ul.advance-meta li p:hover i,.main-navigation ul li li > a:hover,.search-header input.search-submit:hover{
    opacity: 0.7;
}';




   }



        wp_add_inline_style( 'news-box-pro-style', $style );
}
add_action( 'wp_enqueue_scripts', 'news_box_inline_css' );
endif;
