<?php
/*
*
* All customizer helper function here.
*
*/


//Sanitize theme style
if( ! function_exists( 'news_box_cat_select_sanitize' ) ) :
function news_box_cat_select_sanitize($value){ 
	$args=array(
		'orderby'    => 'count',
		'hide_empty' => 0,
		); 
	 $terms = get_terms( 'category',$args ); 
		
	$cat= array();
	$cat[]= 'all';
	if( ! empty( $terms ) && ! is_wp_error( $terms ) ):
        foreach ($terms as $term) :
			$cat[] = $term->slug;
        endforeach;
	endif;
    if(!in_array($value, $cat)){
        $value = 'all';
    }
    return $value;
}
endif;
//Sanitize theme style
if( ! function_exists( 'news_box_empty_cat_sanitize' ) ) :
function news_box_empty_cat_sanitize($value){ 
    $args=array(
        'orderby'    => 'count',
        'hide_empty' => 0,
        ); 
     $terms = get_terms( 'category',$args ); 
        
    $cat= array();
    $cat[]= 'all';
    if( ! empty( $terms ) && ! is_wp_error( $terms ) ):
        foreach ($terms as $term) :
            $cat[] = $term->slug;
        endforeach;
    endif;
    if(!in_array($value, $cat)){
        $value = '';
    }
    return $value;
}
endif;
//Sanitize video type
if( ! function_exists( 'newsbox_sanitize_topvideo_type' ) ) :
function newsbox_sanitize_topvideo_type($value){ 
    if(!in_array($value, array('latest','popular'))){
        $value = 'popular';
    }
    return $value;
}
endif;
// video style sanitize
if( ! function_exists( 'newsbox_video_style_select' ) ) :
function newsbox_video_style_select($value){ 
    if(!in_array($value, array('one','two','three','four'))){
        $value = 'two';
    }
    return $value;
}
endif;


//Sanitize type options
if( ! function_exists( 'news_box_sanitize_font' ) ) :
function news_box_sanitize_font($value){ 
    if(!in_array($value, array('Poppins','Roboto','Roboto Slab','Open Sans','Lato','Montserrat','Roboto Condensed','Source Sans Pro'))){
        $value = 'Open Sans';
    }
    return $value;
}
endif;
//Sanitize type options
if( ! function_exists( 'news_box_sanitize_head_font' ) ) :
function news_box_sanitize_head_font($value){ 
    if(!in_array($value, array('Poppins','Roboto','Roboto Slab','Open Sans','Lato','Montserrat','Roboto Condensed','Source Sans Pro'))){
        $value = 'Roboto Slab';
    }
    return $value;
}
endif;

//Sanitize type options
if( ! function_exists( 'sanitize_header_transform' ) ) :
function sanitize_header_transform($value){ 
    if(!in_array($value, array('none','uppercase','capitalize'))){
        $value = 'none';
    }
    return $value;
}
endif;

//Sanitize sns position
if( ! function_exists( 'news_box_slider_grid_number_sanitize' ) ) :
function news_box_slider_grid_number_sanitize($value){ 
    if(!in_array($value, array('1','4'))){
        $value = '4';
    }
    return $value;
}
endif;
//tab style sanitize
if( ! function_exists( 'news_box_ads_type_sanitize' ) ) :
function news_box_ads_type_sanitize($value){ 
    if(!in_array($value, array('custom','code'))){
        $value = 'custom';
    }
    return $value;
}
endif;

// Ads type sanitize
if( ! function_exists( 'news_box_tab_style_sanitize' ) ) :
function news_box_tab_style_sanitize($value){ 
    if(!in_array($value, array('one','two','three'))){
        $value = 'one';
    }
    return $value;
}
endif;

if( ! function_exists( 'news_box_sanitize_image' ) ) :
function news_box_sanitize_image( $input ){
    /* default output */
    $output = '';
    /* check file type */
    $filetype = wp_check_filetype( $input );
    $mime_type = $filetype['type'];
    /* only mime type "image" allowed */
    if( strpos( $mime_type, 'image' ) !== false ){
        $output = $input;
    }
    return $output;
}
endif;


//All sanitize function

//Sanitize sns position
if( ! function_exists( 'news_box_sanitize_logo_position' ) ) :
function news_box_sanitize_logo_position($value){ 
    if(!in_array($value, array('left','right','center'))){
        $value = 'left';
    }
    return $value;
}
endif;
//Sanitize sns position
if( ! function_exists( 'news_box_sanitize_ticker' ) ) :
function news_box_sanitize_ticker($value){ 
    if(!in_array($value, array('show-home','show','hide'))){
        $value = 'show-home';
    }
    return $value;
}
endif;

//Sanitize sns position
if( ! function_exists( 'news_box_sanitize_menu_position' ) ) :
function news_box_sanitize_menu_position($value){ 
    if(!in_array($value, array('left','center'))){
        $value = 'left';
    }
    return $value;
}
endif;

//Sanitize sns position
if( ! function_exists( 'news_box_sanitize_bottom_spost' ) ) :
function news_box_sanitize_bottom_spost($value){ 
    if(!in_array($value, array('latest','popular','cat'))){
        $value = 'popular';
    }
    return $value;
}
endif;
//Sanitize sns position
if( ! function_exists( 'news_box_sanitize_site_header' ) ) :
function news_box_sanitize_site_header($value){ 
    if(!in_array($value, array('one','two'))){
        $value = 'one';
    }
    return $value;
}
endif;
//Sanitize sns position
if( ! function_exists( 'news_box_sanitize_themecolor' ) ) :
function news_box_sanitize_themecolor($value){ 
    if(!in_array($value, array('default','custom'))){
        $value = 'default';
    }
    return $value;
}
endif;

//Sanitize footer style
if( ! function_exists( 'news_box_fourzerofour_type' ) ) :
function news_box_fourzerofour_type($value){ 
    if(!in_array($value, array('text','image'))){
        $value = 'text';
    }
    return $value;
}
endif;
//Sanitize footer style
if( ! function_exists( 'news_box_sanitize_theme_footer_style' ) ) :
function news_box_sanitize_theme_footer_style($value){ 
    if(!in_array($value, array('default','center'))){
        $value = 'default';
    }
    return $value;
}
endif;
//Sanitize footer style
if( ! function_exists( 'news_box_sanitize_footer_widget_column' ) ) :
function news_box_sanitize_footer_widget_column($value){ 
    if(!in_array($value, array('two','three','four'))){
        $value = 'three';
    }
    return $value;
}
endif;

// blog style sanitize
if( ! function_exists( 'newsbox_bottom_column_sanitize' ) ) :
function newsbox_bottom_column_sanitize($value){ 
    if(!in_array($value, array('6','4','3'))){
        $value = '3';
    }
    return $value;
}
endif;
// blog style sanitize
if( ! function_exists( 'newsbox_preloader_style_select' ) ) :
function newsbox_preloader_style_select($value){ 
    if(!in_array($value, array('one','two','three','four'))){
        $value = 'two';
    }
    return $value;
}
endif;

// blog layout sanitize
if( ! function_exists( 'newsbonews_box_layout_select' ) ) :
function newsbonews_box_layout_select($value){ 
    if(!in_array($value, array('right-sidebar','left-sidebar','full-width','full-center'))){
        $value = 'right-sidebar';
    }
    return $value;
}
endif;
// page layout sanitize
if( ! function_exists( 'newsbox_page_layout_select' ) ) :
function newsbox_page_layout_select($value){ 
    if(!in_array($value, array('right-sidebar','left-sidebar','full-width','full-center'))){
        $value = 'right-sidebar';
    }
    return $value;
}
endif;
// single blog layout sanitize
if( ! function_exists( 'newsbox_sblog_layout_select' ) ) :
function newsbox_sblog_layout_select($value){ 
    if(!in_array($value, array('right-sidebar','left-sidebar','full-width','full-center'))){
        $value = 'right-sidebar';
    }
    return $value;
}
endif;

// blog style sanitize
if( ! function_exists( 'newsbonews_box_style_select' ) ) :
function newsbonews_box_style_select($value){ 
    if(!in_array($value, array('simple-full','simple','list','grid','grid-masonry'))){
        $value = 'simple';
    }
    return $value;
}
endif;

// container set sanitize
if( ! function_exists( 'news_box_headcontainer_sanitize' ) ) :
function news_box_headcontainer_sanitize($value){ 
    if(!in_array($value, array('container-fluid','container'))){
        $value = 'container-fluid';
    }
    return $value;
}
endif;
// container set sanitize
if( ! function_exists( 'newsbonews_box_container_sanitize' ) ) :
function newsbonews_box_container_sanitize($value){ 
    if(!in_array($value, array('container-fluid','container'))){
        $value = 'container';
    }
    return $value;
}
endif;
// container set sanitize
if( ! function_exists( 'newsbox_sblog_container_sanitize' ) ) :
function newsbox_sblog_container_sanitize($value){ 
    if(!in_array($value, array('container-fluid','container'))){
        $value = 'container';
    }
    return $value;
}
endif;
// container set sanitize
if( ! function_exists( 'newsbox_page_container_sanitize' ) ) :
function newsbox_page_container_sanitize($value){ 
    if(!in_array($value, array('container-fluid','container'))){
        $value = 'container';
    }
    return $value;
}
endif;
// page layout sanitize
if( ! function_exists( 'news_box_page_layout_sanitize' ) ) :
function news_box_page_layout_sanitize($value){ 
    if(!in_array($value, array('right-sidebar','left-sidebar','full-width','full-center'))){
        $value = 'right-sidebar';
    }
    return $value;
}
endif;

// grid style sanitize
if( ! function_exists( 'newsbox_grid_style_select' ) ) :
function newsbox_grid_style_select($value){ 
    if(!in_array($value, array('one','two','three'))){
        $value = 'one';
    }
    return $value;
}
endif;
// grid column sanitize
if( ! function_exists( 'newsbox_grid_column_sani' ) ) :
function newsbox_grid_column_sani($value){ 
    if(!in_array($value, array('12','6','4','3'))){
        $value = '4';
    }
    return $value;
}
endif;

// blog style sanitize
if( ! function_exists( 'newsbonews_box_border_sanitize' ) ) :
function newsbonews_box_border_sanitize($value){ 
    if(!in_array($value, array('shadow','use','none'))){
        $value = 'none';
    }
    return $value;
}
endif;
// blog style sanitize
if( ! function_exists( 'newsbox_post_category_sanitize' ) ) :
function newsbox_post_category_sanitize($value){ 
    if(!in_array($value, array('one','all','none'))){
        $value = 'one';
    }
    return $value;
}
endif;
// blog style sanitize
if( ! function_exists( 'newsbox_post_title_position_sanitize' ) ) :
function newsbox_post_title_position_sanitize($value){ 
    if(!in_array($value, array('left','center','right'))){
        $value = 'center';
    }
    return $value;
}
endif;
// blog style sanitize
if( ! function_exists( 'newsbonews_box_head_position_sanitize' ) ) :
function newsbonews_box_head_position_sanitize($value){ 
    if(!in_array($value, array('left','center','right'))){
        $value = 'left';
    }
    return $value;
}
endif;
// blog title_img position
if( ! function_exists( 'newsbox_post_title_img_sanitize' ) ) :
function newsbox_post_title_img_sanitize($value){ 
    if(!in_array($value, array('top','bottom'))){
        $value = 'top';
    }
    return $value;
}
endif;

//blog header style
if( ! function_exists( 'news_bonews_box_heading_select' ) ) :
function news_bonews_box_heading_select($value){ 
    if(!in_array($value, array('classic','standard','standard-img','standard-bg'))){
        $value = 'standard';
    }
    return $value;
}
endif;

//blog header style
if( ! function_exists( 'news_bonews_box_headimg_src' ) ) :
function news_bonews_box_headimg_src($value){ 
    if( !in_array($value, array('feature-img','custom-img')) ){
        $value = 'feature-img';
    }
    return $value;
}
endif;

//blog header style
if( ! function_exists( 'news_box_img_top_bottom_sani' ) ) :
function news_box_img_top_bottom_sani($value){ 
    if( !in_array($value, array('top-img','bottom-img')) ){
        $value = 'bottom-img';
    }
    return $value;
}
endif;

//Archive header style
if( ! function_exists( 'news_box_archive_heading_select' ) ) :
function news_box_archive_heading_select($value){ 
    if(!in_array($value, array('classic','standard','standard-img','standard-bg'))){
        $value = 'standard';
    }
    return $value;
}
endif;
//Archive header style
if( ! function_exists( 'news_box_page_heading_select' ) ) :
function news_box_page_heading_select($value){ 
    if(!in_array($value, array('classic','standard','standard-img','standard-bg'))){
        $value = 'standard';
    }
    return $value;
}
endif;

if( ! function_exists( 'news_box_img_fourzero_img_use' ) ) :
function news_box_img_fourzero_img_use(){
    if(get_theme_mod('news_box_fourzerofour_img_use') == 'image') {
        return true;
    }else{
    return false;
    }

}
endif;

if( ! function_exists( 'news_box_img_fourzero_txt_use' ) ) :
function news_box_img_fourzero_txt_use(){
    if(get_theme_mod('news_box_fourzerofour_img_use') == 'text') {
        return true;
    }else{
    return false;
    }

}
endif;

//Sanitize footer text
if( ! function_exists( 'news_box_sanitize_footer_text' ) ) :
function news_box_sanitize_footer_text($value){ 
	if(empty($value)){
		$value = __('All Right Reserved @wp theme space 2019','news-box-pro');
	}
	return $value;
}
endif;

if( ! function_exists( 'news_box_footer_render' ) ) :
function news_box_footer_render() {
	$news_box_footer = get_theme_mod('news_box_footer_text', __('All Right Reserved @wp theme space 2019','news-box-pro'));

	return $news_box_footer;
}
endif;

// adctive call back function for header slider
if( ! function_exists( 'newsbox_header_social_show_hide' ) ) :
function newsbox_header_social_show_hide(){
    if(get_theme_mod('news_box_header_social') == '1') {
        return true;
    }else{
    return false;
    }

}
endif;
// adctive call back function for grid style
if( ! function_exists( 'newsbox_grid_style_show_hide' ) ) :
function newsbox_grid_style_show_hide(){
    if(get_theme_mod('news_bonews_box_style') == 'grid' || get_theme_mod('news_bonews_box_style') == 'grid-masonry') {
        return true;
    }else{
    return false;
    }

}
endif;
// adctive call back function for grid style
if( ! function_exists( 'newsbox_list_bottom_social_snz' ) ) :
function newsbox_list_bottom_social_snz(){
    if( get_theme_mod('news_bonews_box_style') == 'list' ) {
        return true;
    }else{
    return false;
    }

}
endif;


// topbar active
if( ! function_exists( 'newsbox_topbar_active' ) ) :
function newsbox_topbar_active(){
    if(get_theme_mod('news_box_top_bar') == 1) {
        return true;
    }else{
    return false;
    }

}
endif;
// topbar active
if( ! function_exists( 'newsbox_bottom_sec_cat_active' ) ) :
function newsbox_bottom_sec_cat_active(){
    if(get_theme_mod('news_box_bottom_post_from') == 'cat') {
        return true;
    }else{
    return false;
    }

}
endif;
// topbar active
if( ! function_exists( 'newsbox_tab_menu1' ) ) :
function newsbox_tab_menu1(){
    if(get_theme_mod('newsbox_tab1_menushow') == 1) {
        return true;
    }else{
    return false;
    }

}
endif;
// ads type code callback
if( ! function_exists( 'newsbox_ads_type_code' ) ) :
function newsbox_ads_type_code(){
    if(get_theme_mod('news_box_ads_type') == 'code') {
        return true;
    }else{
    return false;
    }

}
endif;
// ads type code callback two
if( ! function_exists( 'newsbox_ads_type_code2' ) ) :
function newsbox_ads_type_code2(){
    if(get_theme_mod('news_box_ads_type2') == 'code') {
        return true;
    }else{
    return false;
    }

}
endif;
// ads type code callback three
if( ! function_exists( 'newsbox_ads_type_code3' ) ) :
function newsbox_ads_type_code3(){
    if(get_theme_mod('news_box_ads_type3') == 'code') {
        return true;
    }else{
    return false;
    }

}
endif;

// ads type custom callback
if( ! function_exists( 'newsbox_ads_type_custom' ) ) :
function newsbox_ads_type_custom(){
    if(get_theme_mod('news_box_ads_type') == 'custom') {
        return true;
    }else{
    return false;
    }

}
endif;
// ads type custom callback two
if( ! function_exists( 'newsbox_ads_type_custom2' ) ) :
function newsbox_ads_type_custom2(){
    if(get_theme_mod('news_box_ads_type2') == 'custom') {
        return true;
    }else{
    return false;
    }

}
endif;
// ads type custom callback two
if( ! function_exists( 'newsbox_ads_type_custom3' ) ) :
function newsbox_ads_type_custom3(){
    if(get_theme_mod('news_box_ads_type3') == 'custom') {
        return true;
    }else{
    return false;
    }

}
endif;

// topbar active
if( ! function_exists( 'newsbox_topbar_mailactive' ) ) :
function newsbox_topbar_mailactive(){
    if(get_theme_mod('news_box_top_bar') == 1 && get_theme_mod('news_box_topbar_mail') == 1 ) {
        return true;
    }else{
    return false;
    }

}
endif;

// topbar phone active
if( ! function_exists( 'newsbox_topbar_phoneactive' ) ) :
function newsbox_topbar_phoneactive(){
    if(get_theme_mod('news_box_top_bar') == 1 && get_theme_mod('news_box_topbar_phone') == 1 ) {
        return true;
    }else{
    return false;
    }

}
endif;

//woocommerce cart style
if( ! function_exists( 'nbox_pro_woo_carticon_sanitize' ) ) :
function nbox_pro_woo_carticon_sanitize($value){ 
    if( !in_array($value, array('all','shop','hide')) ){
        $value = 'all';
    }
    return $value;
}
endif;

// adctive call back function for sns position
if( ! function_exists( 'newsbox_header_logo_position_call' ) ) :
function newsbox_header_logo_position_call(){
    if(get_theme_mod('news_box_header_style') == 'one') {
        return true;
    }else{
    return false;
    }

}
endif;

// adctive call back function for sns position
if( ! function_exists( 'newsbox_theme_color_calback' ) ) :
function newsbox_theme_color_calback(){
    if(get_theme_mod('news_box_theme_color') == 'custom') {
        return true;
    }else{
    return false;
    }

}
endif;

// adctive call back logo width
if( ! function_exists( 'news_box_logo_width_auto_calback' ) ) :
function news_box_logo_width_auto_calback(){
    if( get_theme_mod('news_box_logo_width_auto') ) {
        return false;
    }else{
    return true;
    }

}
endif;
// adctive call back logo height
if( ! function_exists( 'news_box_logo_height_auto_calback' ) ) :
function news_box_logo_height_auto_calback(){
    if( get_theme_mod('news_box_logo_height_auto') ) {
        return false;
    }else{
    return true;
    }

}
endif;

//call back function for post title background image
if( ! function_exists( 'newsbox_post_title_bg_image' ) ) :
function newsbox_post_title_bg_image(){
    if(get_theme_mod('news_bonews_box_heading') == 'standard-img' || get_theme_mod('news_bonews_box_heading') == 'standard-bg') {
        return true;
    }else{
    return false;
    }

}
endif;
//call back function for post title background image
if( ! function_exists( 'newsbox_post_title_topbottom_calback' ) ) :
function newsbox_post_title_topbottom_calback(){
    if(get_theme_mod('news_bonews_box_heading') == 'classic' ) {
        return true;
    }else{
    return false;
    }

}
endif;
//call back function for post title postition
if( ! function_exists( 'news_box_title_img_position_calback' ) ) :
function news_box_title_img_position_calback(){
    if( get_theme_mod('news_bonews_box_style') == 'simple-full' || get_theme_mod('news_bonews_box_style') == 'simple' ) {
        return true;
    }else{
    return false;
    }

}
endif;

// adctive call back function for overlay opacity
if( ! function_exists( 'newsbox_archive_img_head' ) ) :
function newsbox_archive_img_head(){
    if( get_theme_mod('news_box_archive_heading') == 'standard-img' || get_theme_mod('news_box_archive_heading') == 'standard-bg' ) {
        return true;
    }else{
    return false;
    }

}
endif;
// adctive call back function for overlay opacity
if( ! function_exists( 'newsbox_page_img_head' ) ) :
function newsbox_page_img_head(){
    if( get_theme_mod('newsbox_page_heading') == 'standard-img'|| get_theme_mod('newsbox_page_heading') == 'standard-bg' ) {
        return true;
    }else{
    return false;
    }

}
endif;