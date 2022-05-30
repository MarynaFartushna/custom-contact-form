<?php

if ( wp_doing_ajax() ) {

	add_action( 'wp_ajax_send_form', 'send_form' );
	add_action( 'wp_ajax_nopriv_send_form', 'send_form' );

}

function send_form() {

	check_ajax_referer( 'ccf_nonce', 'security', false );

	if ( empty( $_POST["name"] ) ) {
		echo "Insert your name please";
		wp_die();
	}

	if ( ! filter_var( $_POST["email"], FILTER_VALIDATE_EMAIL ) ) {
		echo 'Insert your email please';
		wp_die();
	}

	if ( empty( $_POST["phone"] ) ) {
		echo "Insert your phone please";
		wp_die();
	}

	global $wpdb;

	$table_name = $wpdb->prefix . "ccf_data";

	$wpdb->insert( $table_name, array(
		'name'  => $_POST["name"],
		'email' => $_POST["email"],
		'phone' => $_POST["phone"],
		'date'  => current_time( 'mysql' ),
	) );

// mb sent mail to admin
//	$to = 'maryna.fartushna@gmail.com';
//	$subject = 'New form';
//	$body = 'From: ' . $_POST['name'] . '\n';
//	$body .= 'Email: ' . $_POST['name'] . '\n';
//	$body .= 'Phone: ' . $_POST['phone'] . '\n';
//	$headers = array( 'Content-Type: text/html; charset=UTF-8' );

//	wp_mail( $to, $subject, $body, $headers );

	wp_die();

}