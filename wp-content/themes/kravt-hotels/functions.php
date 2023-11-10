<?php
/**
 * Kravt-Hotels functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kravt-Hotels
 */

// function attachment_cache_busting( $url ) {
//     return add_query_arg( 'v', time(), $url );
// }

// add_filter( 'wp_get_attachment_url', 'attachment_cache_busting' );
// ВЫКЛЮЧИТЬ ПЕРЕД СДАЧЕЙ ПРОЕКТА !

add_action('after_setup_theme', function () {
    show_admin_bar(false);
});

$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );

add_theme_support('menus');
add_theme_support( 'custom-logo' );
add_theme_support( 'post-thumbnails' );

/**
 * Enqueue scripts and styles.
 */

function kravthotels_scripts(){
    wp_enqueue_style('main-style', get_template_directory_uri() . '/build/css/style.css', array(), '1.2', 'all');
    wp_enqueue_script('main-js', get_template_directory_uri() . '/build/js/script.js', array('jquery'), '1.0.0', true);
};

// include custom jQuery
function shapeSpace_include_custom_jquery() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

add_action('wp_enqueue_scripts', 'kravthotels_scripts');

require get_template_directory() . '/simplehtmldom_1_9_1/simple_html_dom.php';
require get_template_directory() . '/blocks-custom/blocks.php';

/**
 * Allow files with diffefent ext in Media Library.
 */

function extra_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['txt'] = 'text/plain';
    $mimes['pdf'] = 'application/pdf';
    $mimes['doc'] = 'application/msword';
    $mimes['doc'] = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    return $mimes;
};
add_filter('upload_mimes', 'extra_mime_types');

//** Включение формата .webp./
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
};
add_filter('mime_types', 'webp_upload_mimes');


function add_help_menu() {
    add_menu_page(
        'Admin Help', // имя в меню
        'Admin Help Page', // title страницы
        'manage_options', // уровень доступа
        'admin_help', // slug страницы
        'render_help_page', // функция, отображающая собственно страницу
        'dashicons-editor-help', // иконка
        '100' // позиция в меню
    );
}

/*
 * Custom filter to remove default image sizes from WordPress.
 */


/* Add the following code in the theme's functions.php and disable any unset function as required */
function remove_default_image_sizes( $sizes ) {
  
    /* Default WordPress */
    unset( $sizes[ 'thumbnail' ]);       // Remove Thumbnail (150 x 150 hard cropped)
    unset( $sizes[ 'medium' ]);          // Remove Medium resolution (300 x 300 max height 300px)
    unset( $sizes[ 'medium_large' ]);    // Remove Medium Large (added in WP 4.4) resolution (768 x 0 infinite height)
    unset( $sizes[ 'large' ]);           // Remove Large resolution (1024 x 1024 max height 1024px)
    unset( $sizes[ '1536x1536' ]);           // Remove Large resolution (1536 x 864 max height 1536px)
    unset( $sizes[ '2048x2048' ]);           // Remove Large resolution (2048 x 2048 max height 2048px)
    
    /* With WooCommerce */
    unset( $sizes[ 'shop_thumbnail' ]);  // Remove Shop thumbnail (180 x 180 hard cropped)
    unset( $sizes[ 'shop_catalog' ]);    // Remove Shop catalog (300 x 300 hard cropped)
    unset( $sizes[ 'shop_single' ]);     // Shop single (600 x 600 hard cropped)
    
    return $sizes;
  }
  
  add_filter( 'intermediate_image_sizes_advanced', 'remove_default_image_sizes' );

add_action('admin_menu', 'add_help_menu');

function render_help_page() {
   echo '
   <script>
        window.open("https://dandy-kitty-e9f.notion.site/5daec81da1744df7ac00c2054f8e8a8a","_blank")
   </script>';
}

if( is_admin() ){

	add_filter( 'mod_rewrite_rules', 'block_nonexistent_files' );
	function block_nonexistent_files( $rules ) {

		$add_rules = '
		# 404 для несуществующих файлов.
		<IfModule mod_rewrite.c>
		RewriteEngine On
		RewriteBase /
		RewriteRule ^index\.php$ - [L]
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteCond %{REQUEST_URI} !^/robots\.txt$
		RewriteCond %{REQUEST_URI} \.(php|s?htm|shtml|css|js|yml|swp|txt|jpe?g|png|gif|ico|pdf)(.*)?$
		RewriteRule . - [R=404,L]
		</IfModule>
		';

		$add_rules = trim( $add_rules );
		$add_rules = preg_replace( '/^\t+/m', '', $add_rules );

		return "\n$add_rules\n\n" . $rules;
	}
}
