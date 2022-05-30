<?php

/**
 * Plugin Name: Custom contact form
 * Description: Custom contact form
 * Author URI:  https://t.me/Maryna_Far
 * Author:      Maryna Fartushna
 * Version:     1.0.1
 * Text Domain: ccf
 * Domain Path: /languages/
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CCF_PLUGIN_URL', __FILE__ );

require_once plugin_dir_path( __FILE__ ) . '/inc/init.php';

require_once plugin_dir_path( __FILE__ ) . '/admin/admin.php';

require_once plugin_dir_path( __FILE__ ) . '/inc/ajax_callback.php';

require_once plugin_dir_path( __FILE__ ) . '/inc/render_shortcode.php';