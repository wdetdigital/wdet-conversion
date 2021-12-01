<?php
/**
 * news-box-pro Theme Customizer
 *
 * @package news-box-pro
 */

/**
 * Add refresh support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'news_box_customize_register' ) ) :
function news_box_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

// Image logo height and width

    $wp_customize->add_setting( 'news_box_logo_width_auto' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_logo_width_auto', array(
        'label'      => __('Logo Auto width?', 'news-box-pro'),
        'description'=> __('You can set custom with logo or set auto width.', 'news-box-pro'),
        'section'    => 'title_tagline',
        'settings'   => 'news_box_logo_width_auto',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_logo_width' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_logo_width', array(
        'label'      => __('Set logo width', 'news-box-pro'),
        'description'=> __('Set width for logo. leave empty for auto width', 'news-box-pro'),
        'section'    => 'title_tagline',
        'settings'   => 'news_box_logo_width',
        'type'       => 'number',
        'active_callback' => 'news_box_logo_width_auto_calback',

    ) );

    $wp_customize->add_setting( 'news_box_logo_height_auto' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_logo_height_auto', array(
        'label'      => __('Logo Auto height?', 'news-box-pro'),
        'description'=> __('Set custom width for logo or set auto height. Width set by px', 'news-box-pro'),
        'section'    => 'title_tagline',
        'settings'   => 'news_box_logo_height_auto',
        'type'       => 'checkbox',

    ) );
    $wp_customize->add_setting( 'news_box_logo_height' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_logo_height', array(
        'label'      => __('Set logo height', 'news-box-pro'),
        'description'=> __('Set height for logo. Set height by px', 'news-box-pro'),
        'section'    => 'title_tagline',
        'settings'   => 'news_box_logo_height',
        'type'       => 'number',
        'active_callback' => 'news_box_logo_height_auto_calback',

    ) );


//header image option
    $wp_customize->add_setting( 'news_box_header_img_overlay' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_header_img_overlay_control', array(
        'label'      => __('Show Header image overlay?', 'news-box-pro'),
        'description'=> __('You can show or hide image ovelay by this option.', 'news-box-pro'),
        'section'    => 'header_image',
        'settings'   => 'news_box_header_img_overlay',
        'type'       => 'checkbox',
        
    ) );

 // typography options section
    $wp_customize->add_section('news_box_typography', array(
        'title' => __('Typography settings', 'news-box-pro'),
        'capability'     => 'edit_theme_options',
        'description'     => __('News Box theme typography settings ', 'news-box-pro'),

    ));
     $wp_customize->add_setting('news_box_font', array(
        'default'        => 'Open Sans',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_sanitize_font',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('news_box_font_control', array(
        'label'      => __('Site font', 'news-box-pro'),
        'description'     => __('Select your website font.', 'news-box-pro'),
        'section'    => 'news_box_typography',
        'settings'   => 'news_box_font',
        'type'       => 'select',
        'choices'    => array(
            'Poppins' => __('Poppins', 'news-box-pro'),
            'Roboto' => __('Roboto', 'news-box-pro'),
            'Roboto Slab' => __('Roboto Slab', 'news-box-pro'),
            'Open Sans' => __('Open Sans', 'news-box-pro'),
            'Lato' => __('Lato', 'news-box-pro'),
            'Montserrat' => __('Montserrat', 'news-box-pro'),
            'Roboto Condensed' => __('Roboto Condensed', 'news-box-pro'),
            'Source Sans Pro' => __('Source Sans Pro', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting('news_box_font_size', array(
        'default'        => '14',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_font_size_control', array(
        'label'      => __('Body font size', 'news-box-pro'),
        'description'     => __('Select your body font size.', 'news-box-pro'),
        'section'    => 'news_box_typography',
        'settings'   => 'news_box_font_size',
        'type'       => 'text',
    ));
     $wp_customize->add_setting('news_box_head_font', array(
        'default'        => 'Roboto Slab',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_sanitize_head_font',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_head_font_control', array(
        'label'      => __('Header font', 'news-box-pro'),
        'description'     => __('Select your website header font. The font work for all h1-h6 heading tag', 'news-box-pro'),
        'section'    => 'news_box_typography',
        'settings'   => 'news_box_head_font',
        'type'       => 'select',
        'choices'    => array(
            'Poppins' => __('Poppins', 'news-box-pro'),
            'Roboto' => __('Roboto', 'news-box-pro'),
            'Roboto Slab' => __('Roboto Slab', 'news-box-pro'),
            'Open Sans' => __('Open Sans', 'news-box-pro'),
            'Lato' => __('Lato', 'news-box-pro'),
            'Montserrat' => __('Montserrat', 'news-box-pro'),
            'Roboto Condensed' => __('Roboto Condensed', 'news-box-pro'),
            'Source Sans Pro' => __('Source Sans Pro', 'news-box-pro'),
        ),
    ));

    $wp_customize->add_setting('news_box_header_font_transform', array(
        'default'        => 'lowercase',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_header_transform',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_header_font_transform_control', array(
        'label'      => __('Text transport', 'news-box-pro'),
        'description'     => __('You can set header font uppercase or lowercase.', 'news-box-pro'),
        'section'    => 'news_box_typography',
        'settings'   => 'news_box_header_font_transform',
        'type'       => 'select',
        'choices'    => array(
            'none' => __('Standard', 'news-box-pro'),
            'uppercase' => __('Uppercase', 'news-box-pro'),
            'capitalize' => __('Capitalize', 'news-box-pro'),
        ),
    ));


    $wp_customize->add_setting('news_box_widget_head_fsize', array(
        'default'        => '16',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_widget_head_control', array(
        'label'      => __('Widget title font size', 'news-box-pro'),
        'description'     => __('Enter widget Title font size.', 'news-box-pro'),
        'section'    => 'news_box_typography',
        'settings'   => 'news_box_widget_head_fsize',
        'type'       => 'text',
    ));

//color settings
    $wp_customize->add_setting('news_box_theme_color', array(
        'default'       =>  'default',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_sanitize_themecolor',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_theme_color_control', array(
        'label'      => __('Theme color', 'news-box-pro'),
        'description'     => __('You can use default theme color or you may set your own color.', 'news-box-pro'),
        'section'    => 'colors',
        'settings'   => 'news_box_theme_color',
        'type'       => 'select',
        'choices'    => array(
            'default' => __('Default theme color', 'news-box-pro'),
            'custom' => __('Custom theme color', 'news-box-pro'),
        ),
    ));
        // Add setting
    $wp_customize->add_setting('news_box_primary_color', array(
        'default' => '#fff',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'news_box_primary_color', array(
                'label' => __('Theme primary color','news-box-pro'),
                'section' => 'colors',
                'active_callback' => 'newsbox_theme_color_calback',
            )
        )
    );
        // Add setting
    $wp_customize->add_setting('news_box_secondary_color', array(
        'default' => '#000',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'news_box_secondary_color', array(
                'label' => __('Theme secondary color','news-box-pro'),
                'section' => 'colors',
                'active_callback' => 'newsbox_theme_color_calback',
            )
        )
    );


//News Box pro header settings
    $wp_customize->add_panel( 'news_header_panel', array(
    'priority'       => 30,
    'title'          => __('Site header settings', 'news-box-pro'),
    'description'    => __('News Box pro theme blog settings', 'news-box-pro'),
    ) );

    $wp_customize->add_section( 'news_box_head_contaniner' , array(
        'title'             => __('Header container', 'news-box-pro'),
        'description'       => __('Set header container.', 'news-box-pro'),
        'panel'             =>'news_header_panel',
    ) );
     $wp_customize->add_setting('newsbox_head_container', array(
        'default'        => 'container-fluid',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_headcontainer_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_head_container_control', array(
        'label'      => __('Select header container', 'news-box-pro'),
        'description'     => __('Select default header container for your site. News Box pro support both container and container-fluid.', 'news-box-pro'),
        'section'    => 'news_box_head_contaniner',
        'settings'   => 'newsbox_head_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard container', 'news-box-pro'),
            'container-fluid' => __('Full width container', 'news-box-pro'),
        ),
    ));

    $wp_customize->add_section( 'news_box_header' , array(
        'title'             => __('Top bar settings', 'news-box-pro'),
        'description'       => __('For your site topbar settings.', 'news-box-pro'),
        'panel'             =>'news_header_panel',
    ) );

    $wp_customize->add_setting( 'news_box_top_bar' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_top_bar_control', array(
        'label'      => __('Header top bar', 'news-box-pro'),
        'description'=> __('You can show or hide header top bar.', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'news_box_top_bar',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_topbar_date' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       => 1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_topbar_date_control', array(
        'label'      => __('Top bar date', 'news-box-pro'),
        'description'=> __('You can show or hide top bar date feature.', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'news_box_topbar_date',
        'type'       => 'checkbox',
        'active_callback' => 'newsbox_topbar_active',

        
    ) );
    $wp_customize->add_setting( 'news_box_topbar_mail' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       => '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_topbar_mail_control', array(
        'label'      => __('Top bar Email address', 'news-box-pro'),
        'description'=> __('You can show or hide top bar email address.', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'news_box_topbar_mail',
        'type'       => 'checkbox',
        'active_callback' => 'newsbox_topbar_active',

        
    ) );
    $wp_customize->add_setting( 'news_box_email_input' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_email_input_control', array(
        'label'      => __('Enter Email address', 'news-box-pro'),
        'description'=> __('Write your email address for show top bar.', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'news_box_email_input',
        'type'       => 'text',
        'active_callback' => 'newsbox_topbar_mailactive',

    ) );
    $wp_customize->add_setting( 'news_box_topbar_phone' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       => '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_topbar_phone_control', array(
        'label'      => __('Top bar phone', 'news-box-pro'),
        'description'=> __('You can show or hide top bar phone number.', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'news_box_topbar_phone',
        'type'       => 'checkbox',
        'active_callback' => 'newsbox_topbar_active',

        
    ) );
    $wp_customize->add_setting( 'news_box_phone_input' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_phone_input_control', array(
        'label'      => __('Enter phone number', 'news-box-pro'),
        'description'=> __('Write your phone number for show top bar.', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'news_box_phone_input',
        'type'       => 'text',
        'active_callback' => 'newsbox_topbar_phoneactive',

    ) );
    $wp_customize->add_setting( 'news_box_header_search' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       => 1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_header_search_control', array(
        'label'      => __('Top bar search', 'news-box-pro'),
        'description'=> __('You can show or hide top bar header search', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'news_box_header_search',
        'type'       => 'checkbox',
        'active_callback' => 'newsbox_topbar_active',

        
    ) );
    $wp_customize->add_setting( 'news_box_header_social' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_header_social_control', array(
        'label'      => __('Top bar social icons', 'news-box-pro'),
        'description'=> __('You can show or hide header social icons', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'news_box_header_social',
        'type'       => 'checkbox',
        'active_callback' => 'newsbox_topbar_active',

        
    ) );
     // Header facebook url
     $wp_customize->add_setting('newsbox_header_facebook', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_header_facebook_control', array(
        'label'      => __('Top bar Facebook url', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'newsbox_header_facebook',
        'type'       => 'url',
        'active_callback' => 'newsbox_header_social_show_hide',
    ));
        // Header twitter url
     $wp_customize->add_setting('newsbox_header_twitter', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_header_twitter_control', array(
        'label'      => __('Top bar Twitter url', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'newsbox_header_twitter',
        'type'       => 'url',
        'active_callback' => 'newsbox_header_social_show_hide',
    ));

        // Header vk url
     $wp_customize->add_setting('newsbox_header_vk', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_header_vk_control', array(
        'label'      => __('Top bar VK url', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'newsbox_header_vk',
        'type'       => 'url',
        'active_callback' => 'newsbox_header_social_show_hide',
    ));
    // Youtube url
     $wp_customize->add_setting('newsbox_header_youtube', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_header_youtube_control', array(
        'label'      => __('Top bar Youtube url', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'newsbox_header_youtube',
        'type'       => 'url',
        'active_callback' => 'newsbox_header_social_show_hide',
    ));
     // Header linkedin url
     $wp_customize->add_setting('newsbox_header_vimeo', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_header_vimeo_control', array(
        'label'      => __('Top bar Vimeo url', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'newsbox_header_vimeo',
        'type'       => 'url',
        'active_callback' => 'newsbox_header_social_show_hide',
    ));

        // Header INSTAGRAM url
     $wp_customize->add_setting('newsbox_header_instagram', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_header_instagram_control', array(
        'label'      => __('Top bar Instagram url', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'newsbox_header_instagram',
        'type'       => 'url',
        'active_callback' => 'newsbox_header_social_show_hide',
    ));
    // Header pinterest url
     $wp_customize->add_setting('newsbox_header_pinterest', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_header_pinterest_control', array(
        'label'      => __('Top bar Pinterest url', 'news-box-pro'),
        'section'    => 'news_box_header',
        'settings'   => 'newsbox_header_pinterest',
        'type'       => 'url',
        'active_callback' => 'newsbox_header_social_show_hide',
    ));

/* News Box home page settings*/
    $wp_customize->add_panel( 'news_box_home', array(
    'priority'       => 30,
    'title'          => __('New Box Home Settings', 'news-box-pro'),
    'description'    => __('All News Box pro home settings', 'news-box-pro'),
    ) );

    $wp_customize->add_section( 'news_box_slider' , array(
        'title'             => __('Slider grid settings', 'news-box-pro'),
        'description'       => __('You can show or hide and change other options by this settings.', 'news-box-pro'),
        'panel'             =>'news_box_home',
        'priority'       => 10,
    ) );

    $wp_customize->add_setting( 'news_box_slider_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_show_control', array(
        'label'      => __('Home slider grid', 'news-box-pro'),
        'description'=> __('You can show or hide home main slider.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_show',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting('news_box_slider_cat', array(
        'default'       =>  'all',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_cat_select_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_slider_cat_control', array(
        'label'      => __('Select slider category', 'news-box-pro'),
        'description'     => __('Select category for the home slider.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_cat',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' , 'all', 'post'),
    ));
    $wp_customize->add_setting( 'news_box_slidernumber' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '4',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slidernumber_control', array(
        'label'      => __('Set slider number', 'news-box-pro'),
        'description'=> __('Set slider number for slider.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slidernumber',
        'type'       => 'number',
        
    ) );
    $wp_customize->add_setting( 'news_box_slider_dot' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_dot_control', array(
        'label'      => __('Home feature news slider dot', 'news-box-pro'),
        'description'=> __('You can show or hide feature news slider dot.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_dot',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_slider_nav' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_nav_control', array(
        'label'      => __('Home feature news slider nav', 'news-box-pro'),
        'description'=> __('You can show or hide feature news slider nav.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_nav',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_slider_meta' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_meta_control', array(
        'label'      => __('Home feature news slider post meta', 'news-box-pro'),
        'description'=> __('You can show or hide feature news slider post meta.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_meta',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_slider_grid' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  'all',
    'sanitize_callback' => 'news_box_cat_select_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_grid_control', array(
        'label'      => __('Select category for feature right grid', 'news-box-pro'),
        'description'=> __('You can select category or show latest post for feature right grid.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_grid',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' , 'all', 'post'),
        
    ) );
    $wp_customize->add_setting( 'news_box_slider_grid_number' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '4',
    'sanitize_callback' => 'news_box_slider_grid_number_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_grid_number_control', array(
        'label'      => __('Select feature right grid item number', 'news-box-pro'),
        'description'=> __('You can select two or four items for feature right grid.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_grid_number',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('One Items', 'news-box-pro'),
            '4' => __('Four Items', 'news-box-pro'),
        ),
        
    ) );
    $wp_customize->add_setting( 'news_box_slider_left_author' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_left_author_control', array(
        'label'      => __('Slider author', 'news-box-pro'),
        'description'=> __('You can show or hide slider author name.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_left_author',
        'type'       => 'checkbox',
    ) );
    $wp_customize->add_setting( 'news_box_slider_left_date' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_left_date_control', array(
        'label'      => __('Slider date', 'news-box-pro'),
        'description'=> __('You can show or hide slider date.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_left_date',
        'type'       => 'checkbox',
    ) );
    $wp_customize->add_setting( 'news_box_slider_grid_cat' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_meta_control', array(
        'label'      => __('Feature right grid category', 'news-box-pro'),
        'description'=> __('You can show or hide feature right grid category.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_grid_cat',
        'type'       => 'checkbox',
    ) );
    $wp_customize->add_setting( 'news_box_slider_img_zoom' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_slider_img_zoom_control', array(
        'label'      => __('Feature news image zoom', 'news-box-pro'),
        'description'=> __('Active or hide feature news section image zoom effect.', 'news-box-pro'),
        'section'    => 'news_box_slider',
        'settings'   => 'news_box_slider_img_zoom',
        'type'       => 'checkbox',
    ) );
    /*
    *
    * Home top video section
    *
    */
        $wp_customize->add_section( 'newsbox_top_video_section' , array(
        'title'             => __('Top video section', 'news-box-pro'),
        'description'       => __('You can show news video by this video section.', 'news-box-pro'),
        'panel'             =>'news_box_home',
    ) );

    $wp_customize->add_setting( 'news_box_topvideo_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_topvideo_show_control', array(
        'label'      => __('Top video section', 'news-box-pro'),
        'description'=> __('You can show or hide home top video section.', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'news_box_topvideo_show',
        'type'       => 'checkbox',
        
    ) );
     $wp_customize->add_setting( 'news_box_topvideo_title' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  __('Popular Videos','news-box-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_topvideo_title_control', array(
        'label'      => __('Section title', 'news-box-pro'),
        'description'=> __('Enter home top video section title.', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'news_box_topvideo_title',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting('news_box_topvideo_post_from', array(
        'default'       =>  'popular',
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'newsbox_sanitize_topvideo_type',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_topvideo_post_from_control', array(
        'label'      => __('Video show by', 'news-box-pro'),
        'description'     => __('top video section posts from', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'news_box_topvideo_post_from',
        'type'       => 'select',
        'choices'    => array(
            'latest' => __('Latest Video', 'news-box-pro'),
            'popular' => __('Popular Video', 'news-box-pro'),
        ),
    ));
 
    $wp_customize->add_setting( 'newsbox_topvideo_items' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  4,
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_topvideo_items_control', array(
        'label'      => __('Video number', 'news-box-pro'),
        'description'=> __('You can set video number by this settings.', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'newsbox_topvideo_items',
        'type'       => 'number',
        
    ) );
    $wp_customize->add_setting('newsbox_topvideo_column', array(
        'default'        => '3',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_bottom_column_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_topvideo_column_control', array(
        'label'      => __('Select column', 'news-box-pro'),
        'description'     => __('Select post column for top video section. News Box pro support 3 diffrent column.', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'newsbox_topvideo_column',
        'type'       => 'select',
        'choices'    => array(
            '6' => __('Two Column', 'news-box-pro'),
            '4' => __('Three Column', 'news-box-pro'),
            '3' => __('Four Column', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting('newsbox_topvideo_style', array(
        'default'        => 'two',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_preloader_style_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_topvideo_style_control', array(
        'label'      => __('Select style', 'news-box-pro'),
        'description'     => __('Select video style for top video section. News Box pro support 3 diffrent style.', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'newsbox_topvideo_style',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Style one', 'news-box-pro'),
            'two' => __('Style two', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'newsbox_topvideo_title_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_topvideo_title_show_control', array(
        'label'      => __('Video title show', 'news-box-pro'),
        'description'=> __('You can show or hide video title.', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'newsbox_topvideo_title_show',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'newsbox_topvideo_cat' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_topvideo_cat_control', array(
        'label'      => __('Show category', 'news-box-pro'),
        'description'=> __('You can show or hide posts category.', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'newsbox_topvideo_cat',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_topvideo_show_author' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_topvideo_show_author_control', array(
        'label'      => __('Show author', 'news-box-pro'),
        'description'=> __('You can show or hide video author.', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'news_box_topvideo_show_author',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'newsbox_topvideo_date' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_topvideo_date_control', array(
        'label'      => __('Show date', 'news-box-pro'),
        'description'=> __('You can show or hide videos date.', 'news-box-pro'),
        'section'    => 'newsbox_top_video_section',
        'settings'   => 'newsbox_topvideo_date',
        'type'       => 'checkbox',
        
    ) );

/*
* Home tab one
*/
    $wp_customize->add_section( 'news_box_tabh1' , array(
        'title'             => __('Home news tab section One', 'news-box-pro'),
        'description'       => __('You can show or hide tab section one.', 'news-box-pro'),
        'panel'             =>'news_box_home',
    ) );

    $wp_customize->add_setting( 'news_box_tab1_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab1_show_control', array(
        'label'      => __('Home news tab section one', 'news-box-pro'),
        'description'=> __('You can show or hide news tab section one.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_tab1_show',
        'type'       => 'checkbox',
        
    ) );
     $wp_customize->add_setting( 'newsbox_tab1_title' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  __('Hot Topics','news-box-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_tab1_title_control', array(
        'label'      => __('Section title', 'news-box-pro'),
        'description'=> __('News Box home tab one section title.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'newsbox_tab1_title',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting( 'newsbox_tab1_menushow' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_tab1_menushow_control', array(
        'label'      => __('Show tab menu', 'news-box-pro'),
        'description'=> __('You can show or hide this section tab menu.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'newsbox_tab1_menushow',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_tab1_cat' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  'all',
    'sanitize_callback' => 'news_box_cat_select_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab1_cat_control', array(
        'label'      => __('Select category for tab one', 'news-box-pro'),
        'description'=> __('You can select category or show latest post for new tab one.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_tab1_cat',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' , 'all', 'post'),
        
    ) );
    $wp_customize->add_setting( 'news_box_tab1_cat2' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab1_cat2_control', array(
        'label'      => __('Select category for tab two', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_tab1_cat2',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' ),
        'active_callback' => 'newsbox_tab_menu1',

        
    ) );
    $wp_customize->add_setting( 'news_box_tab1_cat3' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab1_cat3_control', array(
        'label'      => __('Select category for tab three', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_tab1_cat3',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' ),
        'active_callback' => 'newsbox_tab_menu1',

    ) );
    $wp_customize->add_setting( 'news_box_tab1_cat4' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab1_cat4_control', array(
        'label'      => __('Select category for tab four', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_tab1_cat4',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category'),
        'active_callback' => 'newsbox_tab_menu1',

    ) );
    $wp_customize->add_setting( 'news_box_tab1_cat5' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab1_cat5_control', array(
        'label'      => __('Select category for tab five', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_tab1_cat5',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' ),
        'active_callback' => 'newsbox_tab_menu1',
        
    ) );
     $wp_customize->add_setting( 'newsbox_tab1_postnumber' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  6,
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_tab1_postnumber_control', array(
        'label'      => __('Post number', 'news-box-pro'),
        'description'=> __('Select posts number for this tab. Default show 6 posts in this section.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'newsbox_tab1_postnumber',
        'type'       => 'number',
    ) );
    $wp_customize->add_setting('news_box_tab1_menu', array(
        'default'       =>  'one',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_tab_style_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_tab1_menu_control', array(
        'label'      => __('Tab menu Style', 'news-box-pro'),
        'description'     => __('Select tab menu style for your site. News Box Pro support three diffrent tab menu style.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_tab1_menu',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Style One', 'news-box-pro'),
            'two' => __('Style Two', 'news-box-pro'),
            'three' => __('Style Three', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting('news_box_tab1_style', array(
        'default'       =>  'one',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_tab_style_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_tab1_style_control', array(
        'label'      => __('Tab content Style', 'news-box-pro'),
        'description'     => __('Select tab content style for your site. News Box Pro support three diffrent tab content style.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_tab1_style',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Style One', 'news-box-pro'),
            'two' => __('Style Two', 'news-box-pro'),
            'three' => __('Style Three', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_tab1_date' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab1_date_control', array(
        'label'      => __('Show Date', 'news-box-pro'),
        'description'=> __('You can show or hide posts date for the news tab one.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_tab1_date',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_advance_options' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_advance_options_control', array(
        'label'      => __('Show Advance meta', 'news-box-pro'),
        'description'=> __('You can show or hide posts advance meta for the news tab one.', 'news-box-pro'),
        'section'    => 'news_box_tabh1',
        'settings'   => 'news_box_advance_options',
        'type'       => 'checkbox',
        
    ) );
/*
 * Home Advertisement section one
 *
*/

    $wp_customize->add_section( 'news_box_ads' , array(
        'title'             => __('Active Home Ads section one', 'news-box-pro'),
        'description'       => __('You can add custom ads link or google ads code for show ads in this section .', 'news-box-pro'),
        'panel'             =>'news_box_home',
    ) );

    $wp_customize->add_setting( 'news_box_ads_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_ads_show_control', array(
        'label'      => __('Home ads section one', 'news-box-pro'),
        'description'=> __('You can show or hide news home ads section one.', 'news-box-pro'),
        'section'    => 'news_box_ads',
        'settings'   => 'news_box_ads_show',
        'type'       => 'checkbox',
        
    ) );
     $wp_customize->add_setting( 'news_box_ads_title' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  __('Advertisement','news-box-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_ads_title_control', array(
        'label'      => __('Ads title', 'news-box-pro'),
        'description'=> __('Enter ads title. If you don\'t want to show title then leave empty. ', 'news-box-pro'),
        'section'    => 'news_box_ads',
        'settings'   => 'news_box_ads_title',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting('news_box_ads_type', array(
        'default'       =>  'custom',
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_ads_type_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_ads_type_control', array(
        'label'      => __('Select ads type', 'news-box-pro'),
        'description'     => __('You can add custom banner or Google and other ads code.', 'news-box-pro'),
        'section'    => 'news_box_ads',
        'settings'   => 'news_box_ads_type',
        'type'       => 'radio',
        'choices'    => array(
            'custom' => __('Custom Banner', 'news-box-pro'),
            'code' => __('Ads code', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_ads_code' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
   // 'sanitize_callback' => 'wp_kses_post',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_ads_code_control', array(
        'label'      => __('Enter Google or other ads code.', 'news-box-pro'),
        'description'=> __('You can add Google or other ads code for show ads banner. Banner size should be 728px*90px', 'news-box-pro'),
        'section'    => 'news_box_ads',
        'settings'   => 'news_box_ads_code',
        'type'       => 'textarea',
        'active_callback' => 'newsbox_ads_type_code',
    ) );

   $wp_customize->add_setting('newsbox_ads_custom_img', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => news_box_sanitize_image( 'newsbox_ads_custom_img' ),
        'transport' => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'newsbox_ads_custom_img_control', array(
        'label' => __( 'Upload ads banner image', 'news-box-pro' ),
        'description' => __( 'Upload your ads banner image. Image size should be 728px width and 90px height.', 'news-box-pro' ),
        'section'    => 'news_box_ads',
        'settings'   => 'newsbox_ads_custom_img',
        'mime_type' => 'image',
        'active_callback' => 'newsbox_ads_type_custom',
    ) ) );

     $wp_customize->add_setting('newsbox_ads_custom_url', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_ads_custom_url_control', array(
        'label'      => __('Custom url', 'news-box-pro'),
        'description' => __( 'Custom url for ads banner.', 'news-box-pro' ),
        'section'    => 'news_box_ads',
        'settings'   => 'newsbox_ads_custom_url',
        'type'       => 'url',
        'active_callback' => 'newsbox_ads_type_custom',
    ));

/*
* Home tab two
*/
    $wp_customize->add_section( 'news_box_tabh2' , array(
        'title'             => __('Home news tab section two', 'news-box-pro'),
        'description'       => __('You can show or hide tab section two.', 'news-box-pro'),
        'panel'             =>'news_box_home',
    ) );

    $wp_customize->add_setting( 'news_box_tab2_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab2_show_control', array(
        'label'      => __('Home news tab section two', 'news-box-pro'),
        'description'=> __('You can show or hide news tab section two.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_tab2_show',
        'type'       => 'checkbox',
        
    ) );
     $wp_customize->add_setting( 'newsbox_tab2_title' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  __('Hot Topics','news-box-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_tab2_title_control', array(
        'label'      => __('Section title', 'news-box-pro'),
        'description'=> __('News Box home tab two section title.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'newsbox_tab2_title',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting( 'newsbox_tab2_menushow' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_tab2_menushow_control', array(
        'label'      => __('Show tab menu', 'news-box-pro'),
        'description'=> __('You can show or hide this section tab menu.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'newsbox_tab2_menushow',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_tab2_cat' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  'all',
    'sanitize_callback' => 'news_box_cat_select_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab2_cat_control', array(
        'label'      => __('Select category for tab two', 'news-box-pro'),
        'description'=> __('You can select category or show latest post for new tab two.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_tab2_cat',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' , 'all', 'post'),
        
    ) );
    $wp_customize->add_setting( 'news_box_tab2_cat2' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab2_cat2_control', array(
        'label'      => __('Select category for tab two', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_tab2_cat2',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' ),
        'active_callback' => 'newsbox_tab_menu1',

        
    ) );
    $wp_customize->add_setting( 'news_box_tab2_cat3' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab2_cat3_control', array(
        'label'      => __('Select category for tab three', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_tab2_cat3',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' ),
        'active_callback' => 'newsbox_tab_menu1',

    ) );
    $wp_customize->add_setting( 'news_box_tab2_cat4' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab2_cat4_control', array(
        'label'      => __('Select category for tab four', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_tab2_cat4',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category'),
        'active_callback' => 'newsbox_tab_menu1',

    ) );
    $wp_customize->add_setting( 'news_box_tab2_cat5' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab2_cat5_control', array(
        'label'      => __('Select category for tab five', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_tab2_cat5',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' ),
        'active_callback' => 'newsbox_tab_menu1',
        
    ) );
     $wp_customize->add_setting( 'newsbox_tab2_postnumber' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  6,
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_tab2_postnumber_control', array(
        'label'      => __('Post number', 'news-box-pro'),
        'description'=> __('Select posts number for this tab. Default show 6 posts in this section.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'newsbox_tab2_postnumber',
        'type'       => 'number',
    ) );
    $wp_customize->add_setting('news_box_tab2_menu', array(
        'default'       =>  'one',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_tab_style_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_tab2_menu_control', array(
        'label'      => __('Tab menu Style', 'news-box-pro'),
        'description'     => __('Select tab menu style for your site. News Box Pro support three diffrent tab menu style.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_tab2_menu',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Style One', 'news-box-pro'),
            'two' => __('Style Two', 'news-box-pro'),
            'three' => __('Style Three', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting('news_box_tab2_style', array(
        'default'       =>  'one',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_tab_style_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_tab2_style_control', array(
        'label'      => __('Tab content Style', 'news-box-pro'),
        'description'     => __('Select tab content style for your site. News Box Pro support three diffrent tab content style.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_tab2_style',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Style One', 'news-box-pro'),
            'two' => __('Style Two', 'news-box-pro'),
            'three' => __('Style Three', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_tab2_date' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab2_date_control', array(
        'label'      => __('Show Date', 'news-box-pro'),
        'description'=> __('You can show or hide posts date for the news tab two.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_tab2_date',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_advance2_options' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_advance2_options_control', array(
        'label'      => __('Show Advance meta', 'news-box-pro'),
        'description'=> __('You can show or hide posts advance meta for the news tab two.', 'news-box-pro'),
        'section'    => 'news_box_tabh2',
        'settings'   => 'news_box_advance2_options',
        'type'       => 'checkbox',
        
    ) );

/*
 * Home Advertisement section two
 *
*/

    $wp_customize->add_section( 'news_box_ads2' , array(
        'title'             => __('Active Home Ads section two', 'news-box-pro'),
        'description'       => __('You can add custom ads link or google ads code for show ads in this section .', 'news-box-pro'),
        'panel'             =>'news_box_home',
    ) );

    $wp_customize->add_setting( 'news_box_ads_show2' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_ads_show2_control', array(
        'label'      => __('Home ads section two', 'news-box-pro'),
        'description'=> __('You can show or hide news home ads section one.', 'news-box-pro'),
        'section'    => 'news_box_ads2',
        'settings'   => 'news_box_ads_show2',
        'type'       => 'checkbox',
        
    ) );
     $wp_customize->add_setting( 'news_box_ads_title2' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  __('Advertisement','news-box-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_ads_title2_control', array(
        'label'      => __('Ads title', 'news-box-pro'),
        'description'=> __('Enter ads title. If you don\'t want to show title then leave empty. ', 'news-box-pro'),
        'section'    => 'news_box_ads2',
        'settings'   => 'news_box_ads_title2',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting('news_box_ads_type2', array(
        'default'       =>  'custom',
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_ads_type_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_ads_type2_control', array(
        'label'      => __('Select ads type', 'news-box-pro'),
        'description'     => __('You can add custom banner or Google and other ads code.', 'news-box-pro'),
        'section'    => 'news_box_ads2',
        'settings'   => 'news_box_ads_type2',
        'type'       => 'radio',
        'choices'    => array(
            'custom' => __('Custom Banner', 'news-box-pro'),
            'code' => __('Ads code', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_ads_code2' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
   // 'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_ads_code2_control', array(
        'label'      => __('Enter Google or other ads code.', 'news-box-pro'),
        'description'=> __('You can add Google or other ads code for show ads banner. Banner size should be 728px*90px', 'news-box-pro'),
        'section'    => 'news_box_ads2',
        'settings'   => 'news_box_ads_code2',
        'type'       => 'textarea',
        'active_callback' => 'newsbox_ads_type_code2',
    ) );

   $wp_customize->add_setting('newsbox_ads_custom_img2', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => news_box_sanitize_image( 'newsbox_ads_custom_img' ),
        'transport' => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'newsbox_ads_custom_img2_control', array(
        'label' => __( 'Upload ads banner image', 'news-box-pro' ),
        'description' => __( 'Upload your ads banner image. Image size should be 728px width and 90px height.', 'news-box-pro' ),
        'section'    => 'news_box_ads2',
        'settings'   => 'newsbox_ads_custom_img2',
        'mime_type' => 'image',
        'active_callback' => 'newsbox_ads_type_custom2',
    ) ) );

     $wp_customize->add_setting('newsbox_ads_custom_url2', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_ads_custom_url2_control', array(
        'label'      => __('Custom url', 'news-box-pro'),
        'description' => __( 'Custom url for ads banner.', 'news-box-pro' ),
        'section'    => 'news_box_ads2',
        'settings'   => 'newsbox_ads_custom_url2',
        'type'       => 'url',
        'active_callback' => 'newsbox_ads_type_custom2',
    ));

/*
* Home tab three
*/
    $wp_customize->add_section( 'news_box_tabh3' , array(
        'title'             => __('Home news tab section three', 'news-box-pro'),
        'description'       => __('You can show or hide tab section three.', 'news-box-pro'),
        'panel'             =>'news_box_home',
    ) );

    $wp_customize->add_setting( 'news_box_tab3_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab3_show_control', array(
        'label'      => __('Home news tab section three', 'news-box-pro'),
        'description'=> __('You can show or hide news tab section three.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_tab3_show',
        'type'       => 'checkbox',
        
    ) );
     $wp_customize->add_setting( 'newsbox_tab3_title' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  __('Hot Topics','news-box-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_tab3_title_control', array(
        'label'      => __('Section title', 'news-box-pro'),
        'description'=> __('News Box home tab three section title.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'newsbox_tab3_title',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting( 'newsbox_tab3_menushow' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_tab3_menushow_control', array(
        'label'      => __('Show tab menu', 'news-box-pro'),
        'description'=> __('You can show or hide this section tab menu.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'newsbox_tab3_menushow',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_tab3_cat' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  'all',
    'sanitize_callback' => 'news_box_cat_select_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab3_cat_control', array(
        'label'      => __('Select category for tab three', 'news-box-pro'),
        'description'=> __('You can select category or show latest post for new tab three.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_tab3_cat',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' , 'all', 'post'),
        
    ) );
    $wp_customize->add_setting( 'news_box_tab3_cat2' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab3_cat2_control', array(
        'label'      => __('Select category for tab two', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_tab3_cat2',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' ),
        'active_callback' => 'newsbox_tab_menu1',

        
    ) );
    $wp_customize->add_setting( 'news_box_tab3_cat3' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab3_cat3_control', array(
        'label'      => __('Select category for tab three', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_tab3_cat3',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' ),
        'active_callback' => 'newsbox_tab_menu1',

    ) );
    $wp_customize->add_setting( 'news_box_tab3_cat4' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab3_cat4_control', array(
        'label'      => __('Select category for tab four', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_tab3_cat4',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category'),
        'active_callback' => 'newsbox_tab_menu1',

    ) );
    $wp_customize->add_setting( 'news_box_tab3_cat5' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'news_box_empty_cat_sanitize',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab3_cat5_control', array(
        'label'      => __('Select category for tab five', 'news-box-pro'),
        'description'=> __('Select a category for show the tab.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_tab3_cat5',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category' ),
        'active_callback' => 'newsbox_tab_menu1',
        
    ) );
     $wp_customize->add_setting( 'newsbox_tab3_postnumber' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  6,
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_tab3_postnumber_control', array(
        'label'      => __('Post number', 'news-box-pro'),
        'description'=> __('Select posts number for this tab. Default show 6 posts in this section.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'newsbox_tab3_postnumber',
        'type'       => 'number',
    ) );
    $wp_customize->add_setting('news_box_tab3_menu', array(
        'default'       =>  'one',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_tab_style_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_tab3_menu_control', array(
        'label'      => __('Tab menu Style', 'news-box-pro'),
        'description'     => __('Select tab menu style for your site. News Box Pro support three diffrent tab menu style.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_tab3_menu',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Style One', 'news-box-pro'),
            'two' => __('Style Two', 'news-box-pro'),
            'three' => __('Style Three', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting('news_box_tab3_style', array(
        'default'       =>  'one',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_tab_style_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_tab3_style_control', array(
        'label'      => __('Tab content Style', 'news-box-pro'),
        'description'     => __('Select tab content style for your site. News Box Pro support three diffrent tab content style.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_tab3_style',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Style One', 'news-box-pro'),
            'two' => __('Style Two', 'news-box-pro'),
            'three' => __('Style Three', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_tab3_date' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_tab3_date_control', array(
        'label'      => __('Show Date', 'news-box-pro'),
        'description'=> __('You can show or hide posts date for the news tab three.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_tab3_date',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_advance_options3' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_advance_options3_control', array(
        'label'      => __('Show Advance meta', 'news-box-pro'),
        'description'=> __('You can show or hide posts advance meta for the news tab three.', 'news-box-pro'),
        'section'    => 'news_box_tabh3',
        'settings'   => 'news_box_advance_options3',
        'type'       => 'checkbox',
        
    ) );

/*
 * Home Advertisement section three
 *
*/
    $wp_customize->add_section( 'news_box_ads3' , array(
        'title'             => __('Active Home Ads section three', 'news-box-pro'),
        'description'       => __('You can add custom ads link or google ads code for show ads in this section .', 'news-box-pro'),
        'panel'             =>'news_box_home',
    ) );

    $wp_customize->add_setting( 'news_box_ads_show3' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_ads_show3_control', array(
        'label'      => __('Home ads section three', 'news-box-pro'),
        'description'=> __('You can show or hide news home ads section three.', 'news-box-pro'),
        'section'    => 'news_box_ads3',
        'settings'   => 'news_box_ads_show3',
        'type'       => 'checkbox',
        
    ) );
     $wp_customize->add_setting( 'news_box_ads_title3' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  __('Advertisement','news-box-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_ads_title3_control', array(
        'label'      => __('Ads title', 'news-box-pro'),
        'description'=> __('Enter ads title. If you don\'t want to show title then leave empty. ', 'news-box-pro'),
        'section'    => 'news_box_ads3',
        'settings'   => 'news_box_ads_title3',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting('news_box_ads_type3', array(
        'default'       =>  'custom',
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_ads_type_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_ads_type3_control', array(
        'label'      => __('Select ads type', 'news-box-pro'),
        'description'     => __('You can add custom banner or Google and other ads code.', 'news-box-pro'),
        'section'    => 'news_box_ads3',
        'settings'   => 'news_box_ads_type3',
        'type'       => 'radio',
        'choices'    => array(
            'custom' => __('Custom Banner', 'news-box-pro'),
            'code' => __('Ads code', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_ads_code3' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    //'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_ads_code3_control', array(
        'label'      => __('Enter Google or other ads code.', 'news-box-pro'),
        'description'=> __('You can add Google or other ads code for show ads banner. Banner size should be 728px*90px', 'news-box-pro'),
        'section'    => 'news_box_ads3',
        'settings'   => 'news_box_ads_code3',
        'type'       => 'textarea',
        'active_callback' => 'newsbox_ads_type_code3',
    ) );

   $wp_customize->add_setting('newsbox_ads_custom_img3', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => news_box_sanitize_image( 'newsbox_ads_custom_img' ),
        'transport' => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'newsbox_ads_custom_img3_control', array(
        'label' => __( 'Upload ads banner image', 'news-box-pro' ),
        'description' => __( 'Upload your ads banner image. Image size should be 728px width and 90px height.', 'news-box-pro' ),
        'section'    => 'news_box_ads3',
        'settings'   => 'newsbox_ads_custom_img3',
        'mime_type' => 'image',
        'active_callback' => 'newsbox_ads_type_custom3',
    ) ) );

     $wp_customize->add_setting('newsbox_ads_custom_url3', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_ads_custom_url3_control', array(
        'label'      => __('Custom url', 'news-box-pro'),
        'description' => __( 'Custom url for ads banner.', 'news-box-pro' ),
        'section'    => 'news_box_ads3',
        'settings'   => 'newsbox_ads_custom_url3',
        'type'       => 'url',
        'active_callback' => 'newsbox_ads_type_custom3',
    ));


/*
* Home latest blog section
*
*/
    $wp_customize->add_section( 'news_box_hlatest' , array(
        'title'             => __('Home latest blog section', 'news-box-pro'),
        'description'       => __('Latest posts settings here.', 'news-box-pro'),
        'panel'             =>'news_box_home',
    ) );
    $wp_customize->add_setting( 'news_box_laetst_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_laetst_show', array(
        'label'      => __('Show Latest news section', 'news-box-pro'),
        'description'=> __('You can show or latest news section.', 'news-box-pro'),
        'section'    => 'news_box_hlatest',
        'settings'   => 'news_box_laetst_show',
        'type'       => 'checkbox',
        
    ) );

/*
* Home Bottom section
*
*/
    $wp_customize->add_section( 'news_box_hbottom' , array(
        'title'             => __('Home Bottom section', 'news-box-pro'),
        'description'       => __('Show latest post or categories post by this section.', 'news-box-pro'),
        'panel'             =>'news_box_home',
    ) );

    $wp_customize->add_setting( 'news_box_bottom_show' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_bottom_show_control', array(
        'label'      => __('Show this section', 'news-box-pro'),
        'description'=> __('You can show or hide bottom section.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'news_box_bottom_show',
        'type'       => 'checkbox',
        
    ) );
     $wp_customize->add_setting( 'news_box_bottom_title' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  __('Popular News','news-box-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_bottom_title_control', array(
        'label'      => __('Section title', 'news-box-pro'),
        'description'=> __('Enter home bottom section title.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'news_box_bottom_title',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting('news_box_bottom_post_from', array(
        'default'       =>  'popular',
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'news_box_sanitize_bottom_spost',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_bottom_post_from_control', array(
        'label'      => __('Posts type', 'news-box-pro'),
        'description'     => __('Bottom section posts from', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'news_box_bottom_post_from',
        'type'       => 'select',
        'choices'    => array(
            'latest' => __('Latest post', 'news-box-pro'),
            'popular' => __('Popular Post', 'news-box-pro'),
            'cat' => __('Category Post', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting('news_box_bottom_category', array(
        'default'       =>  'all',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'transport'           => 'refresh',
        'sanitize_callback' => 'news_box_cat_select_sanitize',
    ));
    $wp_customize->add_control('news_box_bottom_category_control', array(
        'label'      => __('Select category', 'news-box-pro'),
        'description'     => __('You can show latest posts or category posts by this settings.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'news_box_bottom_category',
        'active_callback'   => 'newsbox_bottom_sec_cat_active',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category','all')

    ));
    $wp_customize->add_setting( 'newsbox_bottom_items' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  4,
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_bottom_items_control', array(
        'label'      => __('Popular items number', 'news-box-pro'),
        'description'=> __('You can set posts number by this settings.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'newsbox_bottom_items',
        'type'       => 'number',
       // 'input_attrs' => array( 'min' => 2, 'max' => 20, 'step'  => 1, 'class'  => 'xslider' ),
        
    ) );
    $wp_customize->add_setting('newsbox_bottoms_column', array(
        'default'        => '3',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_bottom_column_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_bottoms_column_control', array(
        'label'      => __('Select column', 'news-box-pro'),
        'description'     => __('Select post column for bottom section. News Box pro support 3 diffrent column.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'newsbox_bottoms_column',
        'type'       => 'select',
        'choices'    => array(
            '6' => __('Two Column', 'news-box-pro'),
            '4' => __('Three Column', 'news-box-pro'),
            '3' => __('Four Column', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting('news_box_bottoms_style', array(
        'default'        => 'two',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_preloader_style_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_bottoms_style_control', array(
        'label'      => __('Select style', 'news-box-pro'),
        'description'     => __('Select post style for bottom section. News Box pro support 2 diffrent bottom section.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'news_box_bottoms_style',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Style one', 'news-box-pro'),
            'two' => __('Style two', 'news-box-pro'),
            'three' => __('Style three', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_bottom_show_author' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_bottom_show_author_control', array(
        'label'      => __('Show author', 'news-box-pro'),
        'description'=> __('You can show or hide posts author.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'news_box_bottom_show_author',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'newsbox_feature_bottom_date' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_feature_bottom_date_control', array(
        'label'      => __('Show date', 'news-box-pro'),
        'description'=> __('You can show or hide posts date.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'newsbox_feature_bottom_date',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'newsbox_bottom_advance' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_bottom_advance_control', array(
        'label'      => __('Show advance options', 'news-box-pro'),
        'description'=> __('You can show or hide posts advance options.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'newsbox_bottom_advance',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'newsbox_bottom_imghover' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_bottom_imghover_control', array(
        'label'      => __('Active image hover', 'news-box-pro'),
        'description'=> __('You can acitve or hide posts image hover.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'newsbox_bottom_imghover',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'newsbox_bottom_redmore' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_bottom_redmore_control', array(
        'label'      => __('Active redmore', 'news-box-pro'),
        'description'=> __('You can show or hide redmore.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'newsbox_bottom_redmore',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'newsbox_bottom_border' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_bottom_border_control', array(
        'label'      => __('Bottom border', 'news-box-pro'),
        'description'=> __('You can show or hide bottom border.', 'news-box-pro'),
        'section'    => 'news_box_hbottom',
        'settings'   => 'newsbox_bottom_border',
        'type'       => 'checkbox',
        
    ) );

// Start blog settings
    $wp_customize->add_panel( 'news_bonews_box_panel', array(
    'priority'       => 75,
    'title'          => __('Site blog settings', 'news-box-pro'),
    'description'    => __('News Box pro theme blog settings', 'news-box-pro'),
    ) );


    $wp_customize->add_section( 'news_box_header_logo' , array(
        'title'             => __('Logo and menu', 'news-box-pro'),
        'description'       => __('For logo and menu settings.', 'news-box-pro'),
        'panel'             =>'news_header_panel',
    ) );

    //header style
    $wp_customize->add_setting('news_box_header_style', array(
        'default'       =>  'one',
        'capability'     => 'edit_theme_options',
        'description'     => __('News Box pro Header options section', 'news-box-pro'),
        'sanitize_callback' => 'news_box_sanitize_site_header',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('news_box_header_style_control', array(
        'label'      => __('Header style', 'news-box-pro'),
        'description'     => __('Select header style for your site. News Box Pro support two diffrent header style.', 'news-box-pro'),
        'section'    => 'news_box_header_logo',
        'settings'   => 'news_box_header_style',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Style One', 'news-box-pro'),
            'two' => __('Style Two', 'news-box-pro'),
        ),
    ));

    $wp_customize->add_setting('newsbox_header_logo_position', array(
        'title' => __('Site Header settings', 'news-box-pro'),
        'default'       =>  'left',
        'capability'     => 'edit_theme_options',
        'description'     => __('News Box pro Header options section', 'news-box-pro'),
        'sanitize_callback' => 'news_box_sanitize_logo_position',


    ));
    $wp_customize->add_control('newsbox_header_logo_position_control', array(
        'label'      => __('Header site logo position.', 'news-box-pro'),
        'description'     => __('You can change header logo left to center or right.', 'news-box-pro'),
        'section'    => 'news_box_header_logo',
        'settings'   => 'newsbox_header_logo_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'news-box-pro'),
            'center' => __('Center', 'news-box-pro'),
            'right' => __('Right', 'news-box-pro'),
        ),
        'active_callback' => 'newsbox_header_logo_position_call',

    ));

$wp_customize->add_setting( 'news_box_logo_section_padding' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  0,
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
) );
$wp_customize->add_control( 'news_box_logo_section_padding_control', array(
    'label'      => __('Logo section padding', 'news-box-pro'),
    'description'=> __('You can reduce or increase logo section padding by this number field.', 'news-box-pro'),
    'section'    => 'news_box_header_logo',
    'settings'   => 'news_box_logo_section_padding',
    'type'       => 'range',
    'input_attrs' => array( 'min' => 0, 'max' => 200, 'step'  => 1, 'class'  => 'xslider' ),
    'active_callback' => 'newsbox_header_logo_position_call',

    
) );

    $wp_customize->add_setting('newsbox_header_menu_position', array(
        'title' => __('Site Header settings', 'news-box-pro'),
        'default'       =>  'left',
        'capability'     => 'edit_theme_options',
        'description'     => __('News Box pro Header options section', 'news-box-pro'),
        'sanitize_callback' => 'news_box_sanitize_menu_position',

    ));
    $wp_customize->add_control('newsbox_header_menu_position_control', array(
        'label'      => __('Main menu position.', 'news-box-pro'),
        'description'     => __('You can change main menu position left or center.', 'news-box-pro'),
        'section'    => 'news_box_header_logo',
        'settings'   => 'newsbox_header_menu_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'news-box-pro'),
            'center' => __('Center', 'news-box-pro'),
        ),
        'active_callback' => 'newsbox_header_logo_position_call',

    ));

    $wp_customize->add_setting( 'news_box_sticky_menu' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_sticky_menu_control', array(
        'label'      => __('Active sticky menu ', 'news-box-pro'),
        'description'=> __('Active sticky header menu.', 'news-box-pro'),
        'section'    => 'news_box_header_logo',
        'settings'   => 'news_box_sticky_menu',
        'type'       => 'checkbox',
        
    ) );
    // News Ticker settings 
    $wp_customize->add_section( 'news_box_news_ticker' , array(
        'title'             => __('News ticker', 'news-box-pro'),
        'description'       => __('Customze header news ticker.', 'news-box-pro'),
        'panel'             =>'news_header_panel',
    ) );

    $wp_customize->add_setting('newsbox_ticker_visibility', array(
        'default'       =>  'show-home',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'transport'           => 'refresh',
        'sanitize_callback' => 'news_box_sanitize_ticker',
    ));
    $wp_customize->add_control('newsbox_ticker_visibility_control', array(
        'label'      => __('News Ticker visibility', 'news-box-pro'),
        'description'     => __('News ticker show hide option.', 'news-box-pro'),
        'section'    => 'news_box_news_ticker',
        'settings'   => 'newsbox_ticker_visibility',
        'type'       => 'select',
        'choices'    => array(
            'show-home' => __('Show only home', 'news-box-pro'),
            'show' => __('Show in all pages', 'news-box-pro'),
            'hide' => __('Hide', 'news-box-pro'),
        ),

    ));
     $wp_customize->add_setting( 'newsbox_ticker_label' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  __('BREAKING NEWS','news-box-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_ticker_label_control', array(
        'label'      => __('News ticker label', 'news-box-pro'),
        'description'=> __('News ticker label set by the text field.', 'news-box-pro'),
        'section'    => 'news_box_news_ticker',
        'settings'   => 'newsbox_ticker_label',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting('newsbox_ticker_category', array(
        'default'       =>  'all',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'transport'           => 'refresh',
        'sanitize_callback' => 'news_box_cat_select_sanitize',
    ));
    $wp_customize->add_control('newsbox_ticker_category_control', array(
        'label'      => __('News Ticker items source', 'news-box-pro'),
        'description'     => __('You can show latest posts or category posts by this settings.', 'news-box-pro'),
        'section'    => 'news_box_news_ticker',
        'settings'   => 'newsbox_ticker_category',
        'type'       => 'select',
        'choices'    => news_box_get_term_options( 'category','all')

    ));
    $wp_customize->add_setting( 'newsbox_ticker_number' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '10',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'newsbox_ticker_number_control', array(
        'label'      => __('Post Number', 'news-box-pro'),
        'description'=> __('Select how many posts show in the section.', 'news-box-pro'),
        'section'    => 'news_box_news_ticker',
        'settings'   => 'newsbox_ticker_number',
        'type'       => 'number',
    ) );
         //post time
    $wp_customize->add_setting('news_box_ticker_show_control', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_ticker_show_control', array(
        'label'      => __('Show news ticker control?', 'news-box-pro'),
        'section'    => 'news_box_news_ticker',
        'settings'   => 'news_box_ticker_show_control',
        'type'       => 'checkbox',
    ));
         //post time
    $wp_customize->add_setting('news_box_ticker_text_direction', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_ticker_text_direction_control', array(
        'label'      => __('News ticker RTL Support?', 'news-box-pro'),
        'section'    => 'news_box_news_ticker',
        'settings'   => 'news_box_ticker_text_direction',
        'type'       => 'checkbox',
    ));

	

    //Blog option section
    $wp_customize->add_section('news_bonews_box', array(
        'title' => __('Blog settings', 'news-box-pro'),
        'capability'     => 'edit_theme_options',
        'description'     => __('News Box pro theme blog settings', 'news-box-pro'),
        'panel'     => 'news_bonews_box_panel',

    ));
        // Site container select
    $wp_customize->add_setting('news_box_site_container', array(
        'default'        => 'container-fluid',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbonews_box_container_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_site_container_control', array(
        'label'      => __('Select site container', 'news-box-pro'),
        'description'     => __('Select default page container for your site. News Box pro support both container and container-fluid.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_site_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard container', 'news-box-pro'),
            'container-fluid' => __('Full width container', 'news-box-pro'),
        ),
    ));
    //Blog layout select
    $wp_customize->add_setting('news_bonews_box_layout', array(
        'default'        => 'right-sidebar',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbonews_box_layout_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_bonews_box_layout_control', array(
        'label'      => __('Select blog layout', 'news-box-pro'),
        'description'     => __('Select blog layout for your site. News Box pro support 3 diffrent blog layout.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_bonews_box_layout',
        'type'       => 'select',
        'choices'    => array(
            'right-sidebar' => __('Right sidebar', 'news-box-pro'),
            'left-sidebar' => __('Left sidebar', 'news-box-pro'),
            'full-width' => __('Full width', 'news-box-pro'),
            'full-center' => __('Center full width', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_bonews_box_title' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_bonews_box_title_control', array(
        'label'      => __('Enter blog home title', 'news-box-pro'),
        'description'=> __('You can add blog home title by this text field. If you dont\'t want to add title then just keep empty the field.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_bonews_box_title',
        'type'       => 'text',
    ) );
    $wp_customize->add_setting( 'news_bonews_box_desc' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_bonews_box_desc_control', array(
        'label'      => __('Enter blog home description', 'news-box-pro'),
        'description'=> __('You can add blog home description by this text field. If you dont\'t want to add description then just keep empty the field.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_bonews_box_desc',
        'type'       => 'textarea',
    ) );
          // post title position
    $wp_customize->add_setting('newsbonews_box_head_position', array(
        'default'        => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbonews_box_head_position_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbonews_box_head_position_control', array(
        'label'      => __('Blog home title position', 'news-box-pro'),
        'description'     => __('Set blog home title position.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'newsbonews_box_head_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Header position left', 'news-box-pro'),
            'center' => __('Header position center', 'news-box-pro'),
            'right' => __('Header position right', 'news-box-pro'),
        ),
    ));

    //Blog style select
    $wp_customize->add_setting('news_bonews_box_style', array(
        'default'        => 'grid-masonry',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbonews_box_style_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_bonews_box_style_control', array(
        'label'      => __('Select blog style', 'news-box-pro'),
        'description'     => __('Select blog style for your site. News Box pro support 5 diffrent blog style.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_bonews_box_style',
        'type'       => 'select',
        'choices'    => array(
            'simple-full' => __('Simple full blog style', 'news-box-pro'),
            'simple' => __('Simple short blog style', 'news-box-pro'),
            'list' => __('List blog style', 'news-box-pro'),
            'grid' => __('Grid blog style', 'news-box-pro'),
            'grid-masonry' => __('Grid with masonry blog style', 'news-box-pro'),
        ),
    ));
     //post time
    $wp_customize->add_setting('news_box_list_bsocial', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_list_bsocial_control', array(
        'label'      => __('Show list post bottom sicial?', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_list_bsocial',
        'type'       => 'checkbox',
        'active_callback' => 'newsbox_list_bottom_social_snz',

        
    ));
    //grid style select
    $wp_customize->add_setting('news_box_grid_style', array(
        'default'        => 'one',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_grid_style_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_grid_style_control', array(
        'label'      => __('Select grid style', 'news-box-pro'),
        'description'     => __('Select grid style for your site. News Box pro support 3 diffrent grid style.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_grid_style',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Grid style one', 'news-box-pro'),
            'two' => __('Grid style two', 'news-box-pro'),
            'three' => __('Grid style three', 'news-box-pro'),
        ),
        'active_callback' => 'newsbox_grid_style_show_hide',
    ));
    //grid column
    $wp_customize->add_setting('news_box_grid_column', array(
        'default'        => '4',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_grid_column_sani',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_grid_column_control', array(
        'label'      => __('Select grid column', 'news-box-pro'),
        'description'     => __('Select grid column for your site. News Box pro support 4 diffrent grid column.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_grid_column',
        'type'       => 'select',
        'choices'    => array(
            '12' => __('One column grid', 'news-box-pro'),
            '6' => __('Two column grid', 'news-box-pro'),
            '4' => __('Three column grid', 'news-box-pro'),
            '3' => __('Four column grid', 'news-box-pro'),
        ),
        'active_callback' => 'newsbox_grid_style_show_hide',
    ));
    //use shadow or border
    $wp_customize->add_setting('news_bonews_box_border', array(
        'default'        => 'shadow',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbonews_box_border_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_bonews_box_border_control', array(
        'label'      => __('Select single blog border style', 'news-box-pro'),
        'description'     => __('You can use shadow or border every single blog. You can also hide this feature by 3rd option.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_bonews_box_border',
        'type'       => 'select',
        'choices'    => array(
            'shadow' => __('Use shadow in single blog', 'news-box-pro'),
            'use' => __('Use border in single blog', 'news-box-pro'),
            'none' => __('No shadow or border in single blog', 'news-box-pro'),
        ),
    ));
        // post title position
    $wp_customize->add_setting('news_box_title_position', array(
        'default'        => 'center',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_post_title_position_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_title_position_control', array(
        'label'      => __('Set post title position', 'news-box-pro'),
        'description'     => __('Set your post title position as your choice.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_title_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Title position left', 'news-box-pro'),
            'center' => __('Title position center', 'news-box-pro'),
            'right' => __('Title position right', 'news-box-pro'),
        ),
    ));
       // post title and image position
    $wp_customize->add_setting('news_box_title_img_position', array(
        'default'        => 'top',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_post_title_img_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_title_img_position_control', array(
        'label'      => __('Post title and image position', 'news-box-pro'),
        'description'     => __('Set post title and image position. some blog style not support this feature.', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_title_img_position',
        'type'       => 'select',
        'choices'    => array(
            'top' => __('Title top of the image', 'news-box-pro'),
            'bottom' => __('Title bottom of the image', 'news-box-pro'),
        ),
        'active_callback' => 'news_box_title_img_position_calback',

    ));

     //post time
    $wp_customize->add_setting('news_box_post_time', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_time_control', array(
        'label'      => __('Show post time?', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_post_time',
        'type'       => 'checkbox',
        
    ));
     //post category
    $wp_customize->add_setting('news_box_post_cat', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_cat_control', array(
        'label'      => __('Show post category?', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_post_cat',
        'type'       => 'checkbox',
        
    ));
     //post time
    $wp_customize->add_setting('news_box_post_author', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_author_control', array(
        'label'      => __('Show post author name?', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_post_author',
        'type'       => 'checkbox',
        
    ));
     //Read more button show
    $wp_customize->add_setting('news_box_grid_readmore', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_grid_readmore_control', array(
        'label'      => __('Show post read more button?', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_grid_readmore',
        'type'       => 'checkbox',
        
    ));

     //post word count
    $wp_customize->add_setting('news_box_wordcount', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_wordcount_control', array(
        'label'      => __('Show post word count icon?', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_wordcount',
        'type'       => 'checkbox',
        
    ));
     //post reading time
    $wp_customize->add_setting('news_box_readingtime', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_readingtime_control', array(
        'label'      => __('Show post reading time?', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_readingtime',
        'type'       => 'checkbox',
        
    ));
   
     //post qr code
    $wp_customize->add_setting('news_box_post_qrcode', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_qrcode_control', array(
        'label'      => __('Show post QR code image?', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_post_qrcode',
        'type'       => 'checkbox',
        
    ));
     //post qr code
    $wp_customize->add_setting('news_box_post_social', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_social_control', array(
        'label'      => __('Show post share button?', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_post_social',
        'type'       => 'checkbox',
        
    ));
     //post qr code
    $wp_customize->add_setting('news_box_post_like_icon', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_like_icon_control', array(
        'label'      => __('Show post like icons?', 'news-box-pro'),
        'description'      => __('Need to active plugin for show like icon ', 'news-box-pro'),
        'section'    => 'news_bonews_box',
        'settings'   => 'news_box_post_like_icon',
        'type'       => 'checkbox',
        
    ));

    // single blog settins
    $wp_customize->add_section('news_bonews_box_single', array(
        'title' => __('Single Blog settings', 'news-box-pro'),
        'capability'     => 'edit_theme_options',
        'description'     => __('News Box pro theme blog settings', 'news-box-pro'),
        'panel'     => 'news_bonews_box_panel',

    ));
     $wp_customize->add_setting('news_box_sblog_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_sblog_container_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_sblog_container_control', array(
        'label'      => __('Select single blog container', 'news-box-pro'),
        'description'     => __('Select single blog page container for your site. News Box pro support both container and container-fluid.', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_box_sblog_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard container', 'news-box-pro'),
            'container-fluid' => __('Full width container', 'news-box-pro'),
        ),
    ));
        //Blog layout select
    $wp_customize->add_setting('news_box_sblog_layout', array(
        'default'        => 'full-width',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_sblog_layout_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_sblog_layout_control', array(
        'label'      => __('Select single blog layout', 'news-box-pro'),
        'description'     => __('Select single blog layout for your site. News Box pro support 3 diffrent blog layout.', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_box_sblog_layout',
        'type'       => 'select',
        'choices'    => array(
            'right-sidebar' => __('Right sidebar', 'news-box-pro'),
            'left-sidebar' => __('Left sidebar', 'news-box-pro'),
            'full-width' => __('Full width', 'news-box-pro'),
            'full-center' => __('Center full width', 'news-box-pro'),
        ),
    ));
     $wp_customize->add_setting('news_bonews_box_heading', array(
        'default'        => 'standard',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_bonews_box_heading_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_bonews_box_heading_control', array(
        'label'      => __('Select single blog heading', 'news-box-pro'),
        'description'     => __('Select single blog header by this setting.', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_bonews_box_heading',
        'type'       => 'select',
        'choices'    => array(
            'classic' => __('Classic style', 'news-box-pro'),
            'standard' => __('Standard style', 'news-box-pro'),
            'standard-img' => __('Image background style', 'news-box-pro'),
            'standard-bg' => __('Image with white background', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_bonews_box_head_padding' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  70,
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
) );
$wp_customize->add_control( 'news_bonews_box_head_padding_control', array(
    'label'      => __('Single blog header padding', 'news-box-pro'),
    'description'=> __('Set single blog header padding by this option. minmum padding 0 and maximum padding 200px', 'news-box-pro'),
    'section'    => 'news_bonews_box_single',
    'settings'   => 'news_bonews_box_head_padding',
    'type'       => 'range',
    'input_attrs' => array( 'min' => 20, 'max' => 200, 'step'  => 1, 'class'  => 'xslider' )
    
) );
     $wp_customize->add_setting('news_box_img_top_bottom', array(
        'default'        => 'bottom-img',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_img_top_bottom_sani',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_img_top_bottom_control', array(
        'label'      => __('Set title and feature image position', 'news-box-pro'),
        'description'     => __('You can set title top of the image or set title bottom of the image.', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_box_img_top_bottom',
        'type'       => 'select',
        'choices'    => array(
            'top-img' => __('Title bottom of the image', 'news-box-pro'),
            'bottom-img' => __('Title top of the image', 'news-box-pro'),
        ),
        'active_callback' => 'newsbox_post_title_topbottom_calback',

    ));

    $wp_customize->add_setting('news_bonews_box_heading_img_src', array(
        'default'        => 'feature-img',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_bonews_box_headimg_src',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_bonews_box_heading_img_src_control', array(
        'label'      => __('Select title image source', 'news-box-pro'),
        'description'     => __('You can use feature image as background image or you can upload custom image.', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_bonews_box_heading_img_src',
        'type'       => 'select',
        'choices'    => array(
            'feature-img' => __('Use feature image', 'news-box-pro'),
            'custom-img' => __('Upload custom image', 'news-box-pro'),
        ),
        'active_callback' => 'newsbox_post_title_bg_image',

    ));

     // header image upload field
    $wp_customize->add_setting('news_bonews_box_head_img', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => news_box_sanitize_image( 'news_bonews_box_head_img' ),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'news_bonews_box_head_img_control', array(
        'label' => __( 'Upload header background image', 'news-box-pro' ),
        'description' => __( 'Upload single blog header image. Image size should be 1800px width and 300px height.', 'news-box-pro' ),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_bonews_box_head_img',
        'mime_type' => 'image',
        'active_callback' => 'newsbox_post_title_bg_image',

    ) ) );

    /*
    * image overlay color
    */
    // Add setting
    $wp_customize->add_setting('news_bonews_box_overlay_color', array(
        'default' => '#000',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'news_bonews_box_overlay_color', array(
                'label' => __('Single blog Header overlay Color','news-box-pro'),
                'section' => 'news_bonews_box_single',
                'active_callback' => 'newsbox_post_title_bg_image',

            )
        )
    );
    // image header color
    $wp_customize->add_setting('news_bonews_box_header_color', array(
        'default' => '#fff',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'news_bonews_box_header_color', array(
                'label' => __('Single blog Header text Color','news-box-pro'),
                'section' => 'news_bonews_box_single',

            )
        )
    );
   
    // image overlay opacity
    $wp_customize->add_setting( 'news_bonews_box_overlay_opacity' , array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  7,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_bonews_box_overlay_opacity_control', array(
        'label'      => __('Single blog header ovelay opacity', 'news-box-pro'),
        'description'=> __('Set Single blog header image overlay opacity', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_bonews_box_overlay_opacity',
        'type'       => 'range',
        'input_attrs' => array( 'min' => 0, 'max' => 99, 'step'  => 1, 'class'  => 'xslider' ),
        'active_callback' => 'newsbox_post_title_bg_image',
        
    ) );
      //Single post time
    $wp_customize->add_setting('newsbox_single_post_time', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_single_post_time_control', array(
        'label'      => __('Show single post time?', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'newsbox_single_post_time',
        'type'       => 'checkbox',
        
    ));
     //Single post category
    $wp_customize->add_setting('newsbox_single_post_cat', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_single_post_cat_control', array(
        'label'      => __('Show single post category?', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'newsbox_single_post_cat',
        'type'       => 'checkbox',
        
    ));
     //show single post tag
    $wp_customize->add_setting('news_box_post_single_tag', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_single_tag_control', array(
        'label'      => __('Show single post tag?', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_box_post_single_tag',
        'type'       => 'checkbox',
        
    ));
     //show single post tag
    $wp_customize->add_setting('news_box_post_single_author', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_single_author_control', array(
        'label'      => __('Show single post author bio?', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_box_post_single_author',
        'type'       => 'checkbox',
        
    ));
     //show single post tag
    $wp_customize->add_setting('news_box_post_single_related', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_single_related_control', array(
        'label'      => __('Show related posts in single post?', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_box_post_single_related',
        'type'       => 'checkbox',
        
    ));
     //show single post tag
    $wp_customize->add_setting('news_box_post_single_nextprev', array(
        'default'        => 1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_post_single_nextprev_control', array(
        'label'      => __('Show next and previous post in single post?', 'news-box-pro'),
        'section'    => 'news_bonews_box_single',
        'settings'   => 'news_box_post_single_nextprev',
        'type'       => 'checkbox',
        
    ));



// All acrive page panel
    $wp_customize->add_panel( 'newsbox_general_panel', array(
    'priority'       => 80,
    'title'          => __('General settings', 'news-box-pro'),
    'description'    => __('X Blog genetal settings section', 'news-box-pro'),
) );

     //Genarel settings section
    $wp_customize->add_section('news_box_prescroll_section', array(
        'title' => __('Preloader and scrollup', 'news-box-pro'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Site preloader and scrollup settings', 'news-box-pro'),
        'panel'             => 'newsbox_general_panel',


    ));
    // site preloader
    $wp_customize->add_setting('news_box_show_preloader', array(
        'default'       =>  1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
         'transport' => 'refresh',

    ));
    $wp_customize->add_control('news_box_show_preloader_control', array(
        'label'      => __('Site preloader', 'news-box-pro'),
        'description'     => __('Warning: if you don\'t use preloader then some home page item show bad before load full page.', 'news-box-pro'),
        'section'    => 'news_box_prescroll_section',
        'settings'   => 'news_box_show_preloader',
        'type'       => 'checkbox',
        
    ));
     //preloader style select
    $wp_customize->add_setting('news_box_preloader_style', array(
        'default'        => 'two',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_preloader_style_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_preloader_style_control', array(
        'label'      => __('Select preloader style', 'news-box-pro'),
        'description'     => __('Select preloader style for your site. News Box pro support 4 diffrent preloader style.', 'news-box-pro'),
        'section'    => 'news_box_prescroll_section',
        'settings'   => 'news_box_preloader_style',
        'type'       => 'select',
        'choices'    => array(
            'one' => __('Preloader style one', 'news-box-pro'),
            'two' => __('Preloader style two', 'news-box-pro'),
            'three' => __('Preloader style three', 'news-box-pro'),
            'four' => __('Preloader style four', 'news-box-pro'),
            'five' => __('Preloader style four', 'news-box-pro'),
        ),
    ));
    // site scrollUp
    $wp_customize->add_setting('news_box_scrollup', array(
        'default'       =>  1,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
         'transport' => 'refresh',

    ));
    $wp_customize->add_control('news_box_scrollup_control', array(
        'label'      => __('Site scrollup', 'news-box-pro'),
        'description'     => __('You can show or hide feature by this checkbox.', 'news-box-pro'),

        'section'    => 'news_box_prescroll_section',
        'settings'   => 'news_box_scrollup',
        'type'       => 'checkbox',
        
    ));

/*
 * archive page section
*/
    $wp_customize->add_section('news_box_archive', array(
        'title' => __('Archive and serarch title ', 'news-box-pro'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Archive and search page title setting.', 'news-box-pro'),
        'panel'             => 'newsbox_general_panel',


    ));
    // archive header style
    $wp_customize->add_setting('news_box_archive_heading', array(
        'default'        => 'standard',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_archive_heading_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_archive_heading_control', array(
        'label'      => __('Select page header style', 'news-box-pro'),
        'description'     => __('Select page header style by this setting. Author archive header don\'t effect by this setting.', 'news-box-pro'),
        'section'    => 'news_box_archive',
        'settings'   => 'news_box_archive_heading',
        'type'       => 'select',
        'choices'    => array(
            'classic' => __('Classic style', 'news-box-pro'),
            'standard' => __('Standard style', 'news-box-pro'),
            'standard-img' => __('Standard with image style', 'news-box-pro'),
            'standard-bg' => __('Image with white background', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_archive_head_padding' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  70,
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_archive_head_padding_control', array(
        'label'      => __('Page header padding', 'news-box-pro'),
        'description'=> __('Set page header padding by this option. minmum padding 20 and maximum padding 200px', 'news-box-pro'),
        'section'    => 'news_box_archive',
        'settings'   => 'news_box_archive_head_padding',
        'type'       => 'range',
        'input_attrs' => array( 'min' => 20, 'max' => 200, 'step'  => 1, 'class'  => 'xslider' )
        
    ) );

     // Search page header image upload field
    $wp_customize->add_setting('news_box_search_head_img', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => news_box_sanitize_image( 'news_box_search_head_img' ),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'news_box_search_head_img_control', array(
        'label' => __( 'Search page header background image', 'news-box-pro' ),
        'description' => __( 'Upload search page header image. Image size should be 1800px width and 400px height.', 'news-box-pro' ),
        'section'    => 'news_box_archive',
        'settings'   => 'news_box_search_head_img',
        'mime_type' => 'image',
        'active_callback' => 'newsbox_archive_img_head',

    ) ) );
     // Archive page header image upload field
    $wp_customize->add_setting('news_box_archive_head_img', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => news_box_sanitize_image( 'news_box_archive_head_img' ),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'news_box_archive_head_img_control', array(
        'label' => __( 'Archive header background image', 'news-box-pro' ),
        'description' => __( 'Upload archive header image. Image size should be 1800px width and 200px height.', 'news-box-pro' ),
        'section'    => 'news_box_archive',
        'settings'   => 'news_box_archive_head_img',
        'mime_type' => 'image',
        'active_callback' => 'newsbox_archive_img_head',

    ) ) );
     // Default page header image upload field
    $wp_customize->add_setting('news_box_author_archive_head_img', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => news_box_sanitize_image( 'news_box_author_archive_head_img' ),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'news_box_author_archive_head_img_control', array(
        'label' => __( 'Author archive header background image', 'news-box-pro' ),
        'description' => __( 'Upload author archive page header image.', 'news-box-pro' ),
        'section'    => 'news_box_archive',
        'settings'   => 'news_box_author_archive_head_img',
        'mime_type' => 'image',
        'active_callback' => 'newsbox_archive_img_head',

    ) ) );

    // image overlay color
    $wp_customize->add_setting('news_box_archive_overlay_color', array(
        'default' => '#000',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'news_box_archive_overlay_color', array(
                'label' => __('Page Header overlay Color','news-box-pro'),
                'section' => 'news_box_archive',
                'active_callback' => 'newsbox_archive_img_head',

            )
        )
    );
    // image header color
    $wp_customize->add_setting('news_box_archive_header_color', array(
        'default' => '#fff',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'news_box_archive_header_color', array(
                'label' => __('Page Header text Color','news-box-pro'),
                'section' => 'news_box_archive',
                'active_callback' => 'newsbox_archive_img_head',

            )
        )
    );
         // image header color
    $wp_customize->add_setting('news_box_author_desc_color', array(
        'default' => '#fff',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'news_box_author_desc_color', array(
                'label' => __('Archive description text color','news-box-pro'),
                'section' => 'news_box_archive',
                'active_callback' => 'newsbox_archive_img_head',

            )
        )
    );
   
    // image overlay opacity
    $wp_customize->add_setting( 'news_box_archive_overlay_opacity' , array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  70,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_archive_overlay_opacity_control', array(
        'label'      => __('Page header ovelay opacity', 'news-box-pro'),
        'description'=> __('Set Page header image overlay opacity', 'news-box-pro'),
        'section'    => 'news_box_archive',
        'settings'   => 'news_box_archive_overlay_opacity',
        'type'       => 'range',
        'input_attrs' => array( 'min' => 0, 'max' => 99, 'step'  => 1, 'class'  => 'xslider' ),
        'active_callback' => 'newsbox_archive_img_head',
        
    ) );
     $wp_customize->add_setting( 'news_box_author_desc' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_author_desc_control', array(
        'label'      => __('Show author description?', 'news-box-pro'),
        'description'=> __('You can show or hide author description from author page.', 'news-box-pro'),
        'section'    => 'news_box_archive',
        'settings'   => 'news_box_author_desc',
        'type'       => 'checkbox',
        
    ) );
    $wp_customize->add_setting( 'news_box_author_social' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  1,
    'sanitize_callback' => 'absint',
    'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_author_social_control', array(
        'label'      => __('Active author social', 'news-box-pro'),
        'description'=> __('Active author social share site.', 'news-box-pro'),
        'section'    => 'news_box_archive',
        'settings'   => 'news_box_author_social',
        'type'       => 'checkbox',
        
    ) );

/*
 * page setting section
*/

    $wp_customize->add_section('newsbox_page_settings', array(
        'title' => __('page settings', 'news-box-pro'),
        'capability'     => 'edit_theme_options',
        'description'     => __('News Box pro page settings section', 'news-box-pro'),
        'panel'             => 'newsbox_general_panel',


    ));
            // Site container select
    $wp_customize->add_setting('news_box_page_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'newsbox_page_container_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_page_container_control', array(
        'label'      => __('Select page container', 'news-box-pro'),
        'description'     => __('Select default page container for your site page. News Box pro support both container and container-fluid.', 'news-box-pro'),
        'section'    => 'newsbox_page_settings',
        'settings'   => 'news_box_page_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard container', 'news-box-pro'),
            'container-fluid' => __('Full width page', 'news-box-pro'),
        ),
    ));
        //Blog style select
    $wp_customize->add_setting('news_box_page_layout', array(
        'default'        => 'right-sidebar',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_page_layout_sanitize',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_page_layout_control', array(
        'label'      => __('Select page layout', 'news-box-pro'),
        'description'     => __('Select default page layout for your site. News Box pro support 3 diffrent page layout.', 'news-box-pro'),
        'section'    => 'newsbox_page_settings',
        'settings'   => 'news_box_page_layout',
        'type'       => 'select',
        'choices'    => array(
            'right-sidebar' => __('Right sidebar', 'news-box-pro'),
            'left-sidebar' => __('Left sidebar', 'news-box-pro'),
            'full-width' => __('Full width', 'news-box-pro'),
            'full-center' => __('Center full width', 'news-box-pro'),
        ),
    ));
    // author archive header style
    $wp_customize->add_setting('newsbox_page_heading', array(
        'default'        => 'standard',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_page_heading_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('newsbox_page_heading_control', array(
        'label'      => __('Select page heading style', 'news-box-pro'),
        'description'     => __('Select page header style by this setting.', 'news-box-pro'),
        'section'    => 'newsbox_page_settings',
        'settings'   => 'newsbox_page_heading',
        'type'       => 'select',
        'choices'    => array(
            'classic' => __('Classic style', 'news-box-pro'),
            'standard' => __('Standard style', 'news-box-pro'),
            'standard-img' => __('Standard with image style', 'news-box-pro'),
            'standard-bg' => __('Image with white background', 'news-box-pro'),
        ),
    ));
    $wp_customize->add_setting( 'news_box_page_head_padding' , array(
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'default'       =>  70,
    'sanitize_callback' => 'sanitize_text_field',
    'transport'     => 'refresh',
) );
$wp_customize->add_control( 'news_box_page_head_padding_control', array(
    'label'      => __('Page header padding', 'news-box-pro'),
    'description'=> __('Set page header padding by this option. minmum padding 20 and maximum padding 200px', 'news-box-pro'),
    'section'    => 'newsbox_page_settings',
    'settings'   => 'news_box_page_head_padding',
    'type'       => 'range',
    'input_attrs' => array( 'min' => 20, 'max' => 200, 'step'  => 1, 'class'  => 'xslider' )
    
) );

     // header image upload field
    $wp_customize->add_setting('news_box_page_head_img', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => news_box_sanitize_image( 'news_box_author_archive_head_img' ),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'news_box_page_head_img_control', array(
        'label' => __( 'Author archive header background image', 'news-box-pro' ),
        'description' => __( 'Upload author archive header image. Image size should be 1800px width and 200px height.', 'news-box-pro' ),
        'section'    => 'newsbox_page_settings',
        'settings'   => 'news_box_page_head_img',
        'mime_type' => 'image',
        'active_callback' => 'newsbox_page_img_head',

    ) ) );

    // header text color
    $wp_customize->add_setting('news_box_page_header_color', array(
        'default' => '#fff',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'news_box_page_header_color', array(
                'label' => __('Page header text Color','news-box-pro'),
                'section' => 'newsbox_page_settings',
                'active_callback' => 'newsbox_page_img_head',

            )
        )
    );

    //  image overlay color
    $wp_customize->add_setting('news_box_page_overlay_color', array(
        'default' => '#000',
        'type' =>'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'news_box_page_overlay_color', array(
                'label' => __('Page Header overlay Color','news-box-pro'),
                'section' => 'newsbox_page_settings',
                'active_callback' => 'newsbox_page_img_head',

            )
        )
    );
    // image overlay opacity
    $wp_customize->add_setting( 'news_box_page_overlay_opacity' , array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  70,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'     => 'refresh',
    ) );
    $wp_customize->add_control( 'news_box_page_overlay_opacity_opacity', array(
        'label'      => __('Page header ovelay opacity', 'news-box-pro'),
        'description'=> __('Set page header image overlay opacity', 'news-box-pro'),
        'section'    => 'newsbox_page_settings',
        'settings'   => 'news_box_page_overlay_opacity',
        'type'       => 'range',
        'input_attrs' => array( 'min' => 0, 'max' => 99, 'step'  => 1, 'class'  => 'xslider' ),
        'active_callback' => 'newsbox_page_img_head',
        
    ) );
    $wp_customize->add_section('news_box_rtl_support', array(
        'title' => __('Active RTL Language Support', 'news-box-pro'),
        'capability'     => 'edit_theme_options',
        'description'    => __('You can active RTL language support for RTL supported language.', 'news-box-pro'),
        'panel'             => 'newsbox_general_panel',


    ));
    $wp_customize->add_setting('news_box_rtl_on', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
         'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_rtl_on_control', array(
        'label'      => __('Active RTL language support?', 'news-box-pro'),
        'section'    => 'news_box_rtl_support',
        'settings'   => 'news_box_rtl_on',
        'type'       => 'checkbox',
    ));



/*
 * Add News Box pro 404 page section
*/
    $wp_customize->add_section('news_box_fourzerofour_page_section', array(
        'title' => __('Site 404 page', 'news-box-pro'),
        'capability'     => 'edit_theme_options',
        'description'    => __('News Box pro 404 page options section', 'news-box-pro'),

    ));

     $wp_customize->add_setting('news_box_fourzerofour_img_use', array(
        'default'    => 'text',
        'capability'  => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_fourzerofour_type',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_fourzerofour_img_use_control', array(
        'label'      => __('Select 404 text type', 'news-box-pro'),
        'description'    => __('You can add your own image for 404 page or you can use text.', 'news-box-pro'),
        'section'    => 'news_box_fourzerofour_page_section',
        'settings'   => 'news_box_fourzerofour_img_use',
        'type'       => 'select',
        'choices'    => array(
            'text' => __('404 text', 'news-box-pro'),
            'image' => __('404 image', 'news-box-pro'),
        ),
        
    ));
    $wp_customize->add_setting('news_box_fourzerofour_txt', array(
        'default' => '404',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_fourzerofour_txt_control', array(
        'label'      => __('404 text', 'news-box-pro'),
        'description'    => __('Enter 404 text', 'news-box-pro'),
        'section'    => 'news_box_fourzerofour_page_section',
        'settings'   => 'news_box_fourzerofour_txt',
        'type'       => 'text',
        'active_callback' => 'news_box_img_fourzero_txt_use',

    ));
    $wp_customize->add_setting('news_box_fourzerofour_img', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => news_box_sanitize_image('news_box_fourzerofour_img'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'news_box_fourzerofour_img_control', array(
        'label' => __( '404 page image', 'news-box-pro' ),
        'description' => __( 'Uplad 404 page image. Image size should be small.', 'news-box-pro' ),
        'section'    => 'news_box_fourzerofour_page_section',
        'settings'   => 'news_box_fourzerofour_img',
        'mime_type' => 'image',
        'active_callback' => 'news_box_img_fourzero_img_use',
    ) ) );
  
    $wp_customize->add_setting('news_box_fourzerofour_heading', array(
        'default' =>  __('page not found.','news-box-pro'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_fourzerofour_heading_control', array(
        'label'      => __('404 page heading', 'news-box-pro'),
        'description'    => __('Write 404 page headeing text', 'news-box-pro'),
        'section'    => 'news_box_fourzerofour_page_section',
        'settings'   => 'news_box_fourzerofour_heading',
        'type'       => 'text',
    ));
    
    $wp_customize->add_setting('news_box_fourzerofour_desc', array(
        'default' =>  __('This page you are looking for could not be founded.','news-box-pro'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_fourzerofour_desc_control', array(
        'label'      => __('404 page description', 'news-box-pro'),
        'description'    => __('Write 404 page description', 'news-box-pro'),
        'section'    => 'news_box_fourzerofour_page_section',
        'settings'   => 'news_box_fourzerofour_desc',
        'type'       => 'textarea',
    ));
    $wp_customize->add_setting('news_box_fourzerofour_search', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  1,
        'sanitize_callback' => 'absint',
         'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_fourzerofour_search_control', array(
        'label'      => __('Display 404 page search field?', 'news-box-pro'),
        'section'    => 'news_box_fourzerofour_page_section',
        'settings'   => 'news_box_fourzerofour_search',
        'type'       => 'checkbox',
    ));


		

//News Box pro footer settings

	$wp_customize->add_section('news_box_footer', array(
		'title' => __('Site Footer settings', 'news-box-pro'),
		'capability'     => 'edit_theme_options',
		'description'     => __('News Box pro Footer options section', 'news-box-pro'),

	));
	
	// Footer top widget column
	$wp_customize->add_setting('news_box_footer_top_widget_column', array(
        'default'        => 'three',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_sanitize_footer_widget_column',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_footer_top_widget_column_control', array(
        'label'      => __('Footer top widget column', 'news-box-pro'),
        'description'     => __('Set site footer widget column. Need to add widget items in this position for display widget.', 'news-box-pro'),
        'section'    => 'news_box_footer',
        'settings'   => 'news_box_footer_top_widget_column',
        'type'       => 'select',
        'choices'    => array(
            'two' => __('Two column', 'news-box-pro'),
            'three' => __('Three column', 'news-box-pro'),
            'four' => __('Four column', 'news-box-pro'),
        ),
    )); 
    // Footer middle widget column
    $wp_customize->add_setting('news_box_footer_middle_widget_column', array(
        'default'        => 'three',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_sanitize_footer_widget_column',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_footer_middle_widget_column_control', array(
        'label'      => __('Footer middle widget column', 'news-box-pro'),
        'description'     => __('Set site footer widget column. Need to add widget items in this position for display widget.', 'news-box-pro'),
        'section'    => 'news_box_footer',
        'settings'   => 'news_box_footer_middle_widget_column',
        'type'       => 'select',
        'choices'    => array(
            'two' => __('Two column', 'news-box-pro'),
            'three' => __('Three column', 'news-box-pro'),
            'four' => __('Four column', 'news-box-pro'),
        ),
    ));

    $wp_customize->add_setting('news_box_footer_position', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'news_box_sanitize_theme_footer_style',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_footer_position_control', array(
        'label'      => __('Footer bottom style', 'news-box-pro'),
        'description'     => __('Select site footer style.', 'news-box-pro'),
        'section'    => 'news_box_footer',
        'settings'   => 'news_box_footer_position',
        'type'       => 'select',
        'choices'    => array(
            'default' => __('Default Footer', 'news-box-pro'),
            'center' => __('Center Footer', 'news-box-pro'),
        ),
    ));
	    // Footer text change
     $wp_customize->add_setting('news_box_footer_text', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'		=>  __('All Right Reserved wp theme space 2019','news-box-pro'),
        'sanitize_callback' => 'news_box_sanitize_footer_text',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('news_box_footer_text_control', array(
        'label'      => __('Footer text', 'news-box-pro'),
        'description'     => __('Html tag support the field. You can see full HTML result after save text.', 'news-box-pro'),
        'section'    => 'news_box_footer',
        'settings'   => 'news_box_footer_text',
        'type'       => 'textarea',
    ));


    //woocommerce section
    $wp_customize->add_section('nbox_pro_woocommerce', array(
        'title' => __('News Box woocommerce settings', 'news-box-pro'),
        'capability'     => 'edit_theme_options',
        'description'     => __('News Box pro theme Woocommerce options section', 'news-box-pro'),
        'panel'     => 'woocommerce',
    ));
    $wp_customize->add_setting('nbox_pro_cart_icon', array(
        'default'       =>  'all',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'nbox_pro_woo_carticon_sanitize',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('nbox_pro_cart_icon_control', array(
        'label'      => __('Cart icon show', 'news-box-pro'),
        'description'     => __('You can show cart icon for all page or only shop page or you can hide the icon for all page.', 'news-box-pro'),
        'section'    => 'nbox_pro_woocommerce',
        'settings'   => 'nbox_pro_cart_icon',
        'type'       => 'select',
        'choices'    => array(
            'all' => __('Show all pages', 'news-box-pro'),
            'shop' => __('Show only shop page', 'news-box-pro'),
            'hide' => __('Hide all pages', 'news-box-pro'),
        ),
    ));









	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'news_box_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'news_box_customize_partial_blogdescription',
		) );
		$wp_customize->selective_refresh->add_partial( 'news_box_footer_text', array(
            'selector'        => '.site-info .copyright',
            'render_callback' => 'news_box_footer_render',
        ) );
	}
}
add_action( 'customize_register', 'news_box_customize_register' );
endif;
/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function news_box_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function news_box_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function news_box_customize_preview_js() {
	wp_enqueue_script( 'news-box-pro-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'news_box_customize_preview_js' );
