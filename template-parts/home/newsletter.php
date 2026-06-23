<?php
/**
 * Newsletter Section
 *
 * @package Engrafted_Chapel
 */
?>

<section class="ec-newsletter" id="newsletter">
    <div class="ec-container">
        <div class="ec-newsletter-inner">
            <div class="ec-newsletter-icon">
                <i class="far fa-envelope"></i>
            </div>
            <div class="ec-newsletter-text">
                <h3><?php esc_html_e( 'Stay Connected', 'engrafted-chapel' ); ?></h3>
                <?php if ( isset( $_GET['ec_news'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
                    <?php if ( 'success' === sanitize_key( wp_unslash( $_GET['ec_news'] ) ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
                        <p><?php esc_html_e( 'You\'re subscribed. Thank you!', 'engrafted-chapel' ); ?></p>
                    <?php else : ?>
                        <p><?php esc_html_e( 'Subscription failed. Please enter a valid email and try again.', 'engrafted-chapel' ); ?></p>
                    <?php endif; ?>
                <?php else : ?>
                    <p><?php esc_html_e( 'Get the latest updates, events, and inspiration straight to your inbox.', 'engrafted-chapel' ); ?></p>
                <?php endif; ?>
            </div>
            <form class="ec-newsletter-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="ec_newsletter">
                <?php wp_nonce_field( 'ec_newsletter', 'ec_newsletter_nonce' ); ?>
                <span class="ec-hp-field" aria-hidden="true">
                    <label><?php esc_html_e( 'Leave this field empty', 'engrafted-chapel' ); ?>
                        <input type="text" name="ec_hp" tabindex="-1" autocomplete="off">
                    </label>
                </span>
                <input type="email" name="ec_news_email" placeholder="<?php esc_attr_e( 'Enter your email', 'engrafted-chapel' ); ?>" required>
                <button type="submit"><?php esc_html_e( 'Subscribe', 'engrafted-chapel' ); ?></button>
            </form>
        </div>
    </div>
</section>
