<?php

register_activation_hook( CCF_PLUGIN_URL, 'ccf_plugin_activation' );

register_deactivation_hook( CCF_PLUGIN_URL, 'ccf_plugin_deactivation' );

register_uninstall_hook( CCF_PLUGIN_URL, 'ccf_plugin_uninstall' );

function ccf_plugin_activation() {

	ccf_create_db_table();

}

function ccf_plugin_deactivation() {

}

function ccf_plugin_uninstall() {

	//mb delete all data
//	ccf_delete_db_table();

}

function ccf_create_db_table() {

	global $wpdb;

	$table_name = $wpdb->prefix . 'ccf_data';

	if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
    		email VARCHAR(255) NOT NULL,
    		phone VARCHAR(255) NOT NULL,
            date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

	}

}

function ccf_delete_db_table() {

	global $wpdb;

	$table_name = $wpdb->prefix . 'ccf_data';

	$sql = "DROP TABLE IF EXISTS $table_name";

	$wpdb->query( $sql );

}

add_action( 'wp_enqueue_scripts', 'ccf_enqueue_scripts' );

function ccf_enqueue_scripts() {

	wp_enqueue_style( 'ccf_main_css', plugin_dir_url( CCF_PLUGIN_URL ) . 'assets/css/main.css' );
	wp_enqueue_script( 'ccf_main_js', plugin_dir_url( CCF_PLUGIN_URL ) . 'assets/js/main.js', array( 'jquery' ) );
	wp_enqueue_script( 'ccf_phone_mask', plugin_dir_url( CCF_PLUGIN_URL ) . '/assets/lib/phonemask/phone-mask.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jq_phone_mask', '//cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js', array( 'jquery' ) );
	wp_localize_script( 'ccf_main_js', 'ajax_ccf', array(
		'ajaxurl'    => admin_url( 'admin-ajax.php' ),
		'ajax_nonce' => wp_create_nonce( "ccf_nonce" )
	) );

}

add_action( 'plugins_loaded', function(){
	load_plugin_textdomain( 'ccf', false, dirname( plugin_basename(CCF_PLUGIN_URL) ) . '/languages' );
} );