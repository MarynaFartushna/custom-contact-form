<?php

// adding admin menu page
add_action( 'admin_menu', 'ccf_add_pages' );

function ccf_add_pages() {

	add_menu_page( 'Contacts list', 'Contacts list', 8, __FILE__, 'ccf_toplevel_page', 'dashicons-list-view', 21 );

}

function ccf_toplevel_page() {

	global $wpdb;
	$table_name = $wpdb->prefix . 'ccf_data';

	$results = $wpdb->get_results( "SELECT * FROM {$table_name}", OBJECT );

	?>
    <div class="wrap">

        <h1 class="wp-heading-inline"><?php _e( 'Contacts list', 'ccf' ); ?></h1>

        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
            <tr>
                <th scope="col" id="name" class="manage-column column-name column-primary"><?php _e( 'Name', 'ccf' ); ?></th>
                <th scope="col" id="email" class="manage-column column-email"><?php _e( 'Email', 'ccf' ); ?></th>
                <th scope="col" id="phone" class="manage-column column-phone"><?php _e( 'Phone', 'ccf' ); ?></th>
                <th scope="col" id="date" class="manage-column column-date"><?php _e( 'Date', 'ccf' ); ?></th>
            </tr>
            </thead>

			<?php if ( ! empty( $results ) ) : ?>

                <tbody id="the-list">

				<?php foreach ( $results as $row ) : ?>

                    <tr>
                        <td class="name column-name has-row-actions column-primary" data-colname="Name">
                            <?php echo $row->name; ?>
                        </td>
                        <td class="count column-email" data-colname="Email">
                            <a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a>
                        </td>
                        <td class="count column-phone" data-colname="Phone">
	                        <?php echo $row->phone; ?>
                        </td>
                        <td class="count column-date" data-colname="Date">
	                        <?php echo $row->date; ?>
                        </td>
                    </tr>

				<?php endforeach; ?>

                </tbody>

			<?php endif; ?>

            <tfoot>
            <tr>
                <th scope="col" id="name" class="manage-column column-name column-primary"><?php _e( 'Name', 'ccf' ); ?></th>
                <th scope="col" id="email" class="manage-column column-email"><?php _e( 'Email', 'ccf' ); ?></th>
                <th scope="col" id="phone" class="manage-column column-phone"><?php _e( 'Phone', 'ccf' ); ?></th>
                <th scope="col" id="date" class="manage-column column-date"><?php _e( 'Date', 'ccf' ); ?></th>
            </tr>
            </tfoot>
        </table>
    </div>

	<?php

}
