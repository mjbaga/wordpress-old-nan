<?php

require_once dirname( __FILE__ ) . '/includes/theme-config.php';
require_once dirname( __FILE__ ) . '/vendor/autoload.php';

/** Returns Theme Directory Path */
function nan_theme_path () {
    return get_template_directory(__FILE__);
}

/**
 * Autoloader for classes
 *
 * @param string $className Name of the class that shall be loaded
 */
function nan_theme_autoload ($className) {

    $filepath = nan_theme_path() . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($filepath))
        require_once($filepath);
}

spl_autoload_register('nan_theme_autoload');

/**
 *
 * @param String $path Path to template
 * @param Array $data Array containing all the data to be rendered. Should not have numeric keys.
 * @param type $echo  To echo the html or to return it as a string
 * @return mixed string containing html if echo is false and will print the content if echo is true.
 * @since 0.1.0
 */
function nan_theme_render( $slug, $name = null, $data = array(), $var_name = 'data', $echo = true ) {
    global $wp_query;

    $wp_query->query_vars[ $var_name ] = (object) $data;
    ob_start();
    get_template_part( $slug, $name );

    $out = ob_get_clean();
    if( $echo === true ) {
        echo $out;
    } else {
        return $out;
    }
}

function nan_get_assets_url() {
    return THEME_URL . '/assets';
}

/**
 * Enqueue styles and scripts conditionally.
 * @since 0.1.0
 */
if( !function_exists( 'enqueue_nan_styles_and_scripts' ) ):

	function enqueue_nan_styles_and_scripts() {
	  
	    //header styles and scripts scripts
	    wp_enqueue_style( 'nan_main', ASSETS_URL . '/notAnoobie/styles/main.css' );
	    wp_enqueue_script( 'nan_jquery', ASSETS_URL . '/notAnoobie/scripts/vendor/jquery.js', array(), false, false );

	    // //footer scripts
	    wp_enqueue_script( 'nan_main', ASSETS_URL . '/notAnoobie/scripts/main.js', array(), false, true );
	}

endif;

add_action( 'wp_enqueue_scripts', 'enqueue_nan_styles_and_scripts' );

/**
 * Register menus
 * @since 0.1.0
 */
function register_nan_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu' ),
        'footer' => __( 'Footer Menu' ),
        'legal' => __( 'Legal Menu' ),
        'social' => __( 'Social Links Menu' ),
        'mobile_main' => __( 'Mobile Main Menu' ),
        'mobile_legal' => __( 'Mobile Legal Menu' )
    ) );
}
add_action( 'after_setup_theme', 'register_nan_menus' );

/**
 * Register widget areas
 * @since 0.1.0
 */
if( !function_exists( 'arcc_widgets_init' ) ):

function nan_widgets_init() {

	register_sidebar( array(
	    'name' => 'Header widget',
	    'description' => __( 'Appears in all templates, used to house the search widget' ),
	    'id' => 'header_widget',
	    'before_widget' => '',
	    'after_widget' => '',
	) );

    register_sidebar( array(
        'name' => 'Breadcrumbs widget',
        'description' => __( 'Appears in all templates except homepage before title' ),
        'id' => 'breadcrumbs_widget',
        'before_widget' => '<div class="breadcrumbs">',
        'after_widget' => '</div>',
    ) );

    register_sidebar( array(
        'name' => 'Homepage Articles Widget',
        'description' => __( 'Appears in the Homepage articles section' ),
        'id' => 'hp_articles_widget',
        'before_widget' => '',
        'after_widget' => '',
    ) );

    register_sidebar( array(
        'name' => 'Homepage Tip of the Day',
        'description' => __( 'Appears in the Homepage tip of the day section' ),
        'id' => 'hp_tip_widget',
        'before_widget' => '',
        'after_widget' => '',
    ) );

    register_sidebar( array(
        'name' => 'Articles Widget',
        'description' => __( 'Appears at the bottom of detail pages.' ),
        'id' => 'articles_widget',
        'before_widget' => '',
        'after_widget' => '',
    ) );

	register_sidebar( array(
	    'name' => 'Footer Top widget',
	    'description' => __( 'Appears in all templates footer bottom section' ),
	    'id' => 'footer_top_widget',
	    'before_widget' => '',
	    'after_widget' => '',
	) );

    register_sidebar( array(
        'name' => 'Footer Bottom widget',
        'description' => __( 'Appears in all templates footer bottom section' ),
        'id' => 'footer_bottom_widget',
        'before_widget' => '',
        'after_widget' => '',
    ) );

}
endif;

add_action( 'widgets_init', 'nan_widgets_init' );

/**
 * Parses the html of given sidebar
 * 
 * @param string $sidebar
 * @return string
 * @since 0.1.0
 */
function nan_parse_sidebar( $sidebar ) {
    $html = '';
    if( is_active_sidebar( $sidebar ) ) {
        ob_start();
        dynamic_sidebar( $sidebar )
;        $html = ob_get_clean();
    }
    return $html;
}

remove_action('wp_head', 'wp_generator');

add_filter( 'style_loader_src',  'sdt_remove_ver_css_js', 9999, 2 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999, 2 );

function sdt_remove_ver_css_js( $src, $handle ) 
{
    $handles_with_version = array( 'style' ); // <-- Adjust to your needs!

    if ( strpos( $src, 'ver=' ) && ! in_array( $handle, $handles_with_version, true ) )
        $src = remove_query_arg( 'ver', $src );

    return $src;
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// Add social-media__item class to all anchor tags if add_social_item_class is not empty
function nan_menu_add_social_menu_class( $atts, $item, $args ) {
    $class = '';
    $target = '';
    if( !empty( $args->add_social_item_class ) ) {
        $class = '';
        $target = '_blank';
    } else {
        $class = 'nav__item';
    }
    $atts['class'] = $class;
    $atts['target'] = $target;
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'nan_menu_add_social_menu_class', 10, 3 );

/**
 * Add menu icon class
 * @since 0.1.0
 */
function nan_theme_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
    if ( is_array( $_REQUEST['menu-item-icon-class']) ) {
        $icon_class_value = $_REQUEST['menu-item-icon-class'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_icon_class', $icon_class_value );
    }
}
add_action( 'wp_update_nav_menu_item', 'nan_theme_update_custom_nav_fields', 10, 3 );

function nan_theme_add_custom_nav_fields( $menu_item ) {
    $menu_item->icon_class = get_post_meta( $menu_item->ID, '_menu_item_icon_class', true );
    return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'nan_theme_add_custom_nav_fields' );

// Walker to add icon class to wordpress admin
function nan_theme_edit_walker( $walker, $menu_id ) {
    return '\\NaNThemeComponents\\Shared\\Walkers\\WalkerAdmin';
}
add_filter( 'wp_edit_nav_menu_walker', 'nan_theme_edit_walker', 10, 2 );

// Add icon to title and add span outside title based on arguments
function nan_theme_nav_menu_item_title( $title, $item, $args, $depth ) {

	if( !empty( $args->hide_item_title ) ) {
		$title = '<span class="visuallyhidden">' . $title . '</span>';
	}

	if( !empty( $item->icon_class ) && !empty( $args->show_icons_after_title ) ) {
		$title .= '<i class="' . $item->icon_class . '"></i>';
	}

	if( !empty( $item->icon_class ) && $args->show_icons_before_title ) {
		$title = '<i class="icon ' . $item->icon_class . '"></i><span>' . $title . '</span>';
	}

	if( $args->theme_location == 'mobile_legal' ) {
		$title .= '<i class="icon-arrow-right"></i>';
	}

	return $title; 
}
         
add_filter( 'nav_menu_item_title', 'nan_theme_nav_menu_item_title', 10, 4 );

add_action( 'init', array( '\\NaNThemeComponents\\Pages\\Homepage', 'register_fields' ) );

add_action( 'init', array( '\\NaNThemeComponents\\Posts\\Categories\\Category', 'init_post' ) );
add_action( 'init', array( '\\NaNThemeComponents\\Posts\\Categories\\Category', 'register_fields' ) );

add_action( 'init', array( '\\NaNThemeComponents\\Posts\\PartnerLogos\\PartnerLogo', 'init_post' ) );
add_action( 'init', array( '\\NaNThemeComponents\\Posts\\PartnerLogos\\PartnerLogo', 'register_fields' ) );

/**
 * Registers logo for footer
 * @return null
 */
function register_footer_widgets() {
    register_widget( '\\NaNThemeComponents\\Posts\\PartnerLogos\\Widget' );
    add_action( 'init', array( '\\NaNThemeComponents\\Posts\\PartnerLogos\\Widget', 'register_fields' ) );
    register_widget( '\\NaNThemeComponents\\Widgets\\SocialIcons\\Widget' );
    add_action( 'init', array( '\\NaNThemeComponents\\Widgets\\SocialIcons\\Widget', 'register_fields' ) );
}

if(class_exists('\\NaNThemeComponents\\Posts\\PartnerLogos\\Widget')) {
    add_action( 'widgets_init', 'register_footer_widgets' );
}

add_filter( 'manage_posts_columns', 'nan_add_id_column', 5 );
add_action( 'manage_posts_custom_column', 'nan_id_column_content', 5, 2 );

function nan_add_id_column( $columns ) {
    $columns['post_id'] = 'ID';
    return $columns;
}

function nan_id_column_content( $column, $id ) {
    if( 'post_id' == $column ) {
        echo $id;
    }
}

/* Automatically set the image Title, Alt-Text, Caption & Description upon upload
--------------------------------------------------------------------------------------*/
add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );
function my_set_image_meta_upon_image_upload( $post_ID ) {

    // Check if uploaded file is an image, else do nothing

    if ( wp_attachment_is_image( $post_ID ) ) {

        $my_image_title = get_post( $post_ID )->post_title;

        // Sanitize the title:  remove hyphens, underscores & extra spaces:
        $my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );

        // Sanitize the title:  capitalize first letter of every word (other letters lower case):
        $my_image_title = ucwords( strtolower( $my_image_title ) );

        // Create an array with the image meta (Title, Caption, Description) to be updated
        // Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
        $my_image_meta = array(
            'ID'        => $post_ID,            // Specify the image (ID) to be updated
            'post_title'    => $my_image_title,     // Set image Title to sanitized title
            'post_excerpt'  => $my_image_title,     // Set image Caption (Excerpt) to sanitized title
            'post_content'  => $my_image_title,     // Set image Description (Content) to sanitized title
        );

        // Set the image Alt-Text
        update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

        // Set the image meta (e.g. Title, Excerpt, Content)
        wp_update_post( $my_image_meta );

    } 
}

// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
 
// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
