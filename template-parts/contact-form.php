<?php
/**
 * Reusable contact form
 *
 * Posts to admin-post.php where ec_handle_contact_form() validates and emails it.
 *
 * @package Engrafted_Chapel
 */
?>
<div class="ec-contact-form-wrap">
    <?php if ( isset( $_GET['ec_contact'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
        <?php if ( 'success' === sanitize_key( wp_unslash( $_GET['ec_contact'] ) ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
            <div class="ec-form-notice ec-form-notice-success"><?php esc_html_e( 'Thank you! Your message has been sent. We\'ll be in touch soon.', 'engrafted-chapel' ); ?></div>
        <?php else : ?>
            <div class="ec-form-notice ec-form-notice-error"><?php esc_html_e( 'Sorry, your message could not be sent. Please check your details and try again.', 'engrafted-chapel' ); ?></div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ( shortcode_exists( 'contact-form-7' ) || shortcode_exists( 'wpforms' ) ) : ?>
        <p class="ec-text-center"><?php esc_html_e( 'Use your preferred form plugin to add a contact form here.', 'engrafted-chapel' ); ?></p>
    <?php else : ?>
        <form class="ec-contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
            <input type="hidden" name="action" value="ec_contact">
            <?php wp_nonce_field( 'ec_contact_form', 'ec_contact_nonce' ); ?>
            <p class="ec-hp-field" aria-hidden="true">
                <label><?php esc_html_e( 'Leave this field empty', 'engrafted-chapel' ); ?>
                    <input type="text" name="ec_hp" tabindex="-1" autocomplete="off">
                </label>
            </p>
            <div class="ec-form-row">
                <div class="ec-form-group">
                    <label for="ec-name"><?php esc_html_e( 'Your Name', 'engrafted-chapel' ); ?></label>
                    <input type="text" id="ec-name" name="name" required>
                </div>
                <div class="ec-form-group">
                    <label for="ec-email"><?php esc_html_e( 'Your Email', 'engrafted-chapel' ); ?></label>
                    <input type="email" id="ec-email" name="email" required>
                </div>
            </div>
            <div class="ec-form-group">
                <label for="ec-subject"><?php esc_html_e( 'Subject', 'engrafted-chapel' ); ?></label>
                <input type="text" id="ec-subject" name="subject">
            </div>
            <div class="ec-form-group">
                <label for="ec-message"><?php esc_html_e( 'Message', 'engrafted-chapel' ); ?></label>
                <textarea id="ec-message" name="message" required></textarea>
            </div>
            <div class="ec-text-center">
                <button type="submit" class="ec-btn-submit"><?php esc_html_e( 'Send Message', 'engrafted-chapel' ); ?></button>
            </div>
        </form>
    <?php endif; ?>
</div>
