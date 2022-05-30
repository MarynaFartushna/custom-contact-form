<?php

function ccf_render_shortcode() {

	ob_start(); ?>

    <div class="ccf_wrapper">

        <form action="" method="post" id="ccf">
            <div class="form-field">
                <label><?php _e( 'Name', 'ccf' ); ?>: </label>
                <input name="name" type="text" placeholder="<?php _e( 'Type your name', 'ccf' ); ?>" required>
            </div>
            <div class="form-field">
                <label><?php _e( 'Email', 'ccf' ); ?>: </label>
                <input name="email" type="email" placeholder="<?php _e( 'Type a valid email', 'ccf' ); ?>" required>
            </div>
            <div class="form-field">
                <label><?php _e( 'Phone', 'ccf' ); ?>: </label>
                <input name="phone" type="tel" placeholder="<?php _e( 'Type your phone', 'ccf' ); ?>" required>

            </div>
            <button type="submit" class="ccf-submit" disabled="disabled"><?php _e( 'Send', 'ccf' ); ?></button>

            <div class="success_msg" style="display: none">
	            <?php _e( 'Message Sent Successfully', 'ccf' ); ?>
            </div>

            <div class="error_msg" style="display: none">
	            <?php _e( 'Message Not Sent, There is some error.', 'ccf' ); ?>
            </div>
        </form>

    </div>

	<?php return ob_get_clean();

}

add_shortcode( 'custom_form', 'ccf_render_shortcode' );