<?php
/**
 * The Footer
 *
 * Newsletter band, a four-column link/info grid and a centred copyright bar —
 * laid out like the Emanu footer, populated with the church's own details.
 *
 * @package Engrafted_Chapel
 */

$social_links = ec_get_social_links();
$contact      = ec_get_contact_info();
$phones       = array_filter( $contact['phones'] );
$phone        = $phones ? reset( $phones ) : '';
$services     = ec_get_services();
$church_name  = get_theme_mod( 'ec_church_name', 'Engrafted Word Chapel International' );
$ec_news      = isset( $_GET['ec_news'] ) ? sanitize_key( wp_unslash( $_GET['ec_news'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
?>
</div><!-- .ec-page-wrap -->

<footer class="ec-footer" id="footer">

    <div class="ec-container">

        <!-- Newsletter band -->
        <div class="ec-footer-newsletter">
            <h2 class="ec-footer-news-title"><?php esc_html_e( 'Receive spiritual encouragement in your inbox today!', 'engrafted-chapel' ); ?></h2>
            <div class="ec-footer-news-side">
                <span class="ec-footer-news-label"><?php esc_html_e( 'Newsletter Subscription', 'engrafted-chapel' ); ?></span>
                <form class="ec-footer-news-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="ec_newsletter">
                    <?php wp_nonce_field( 'ec_newsletter', 'ec_newsletter_nonce' ); ?>
                    <span class="ec-hp-field" aria-hidden="true"><label><?php esc_html_e( 'Leave this field empty', 'engrafted-chapel' ); ?><input type="text" name="ec_hp" tabindex="-1" autocomplete="off"></label></span>
                    <input type="email" name="ec_news_email" placeholder="<?php esc_attr_e( 'Enter Your E-mail', 'engrafted-chapel' ); ?>" required>
                    <button type="submit" aria-label="<?php esc_attr_e( 'Subscribe', 'engrafted-chapel' ); ?>"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                </form>
                <?php if ( 'success' === $ec_news ) : ?>
                    <span class="ec-footer-news-note"><?php esc_html_e( 'You\'re subscribed. Thank you!', 'engrafted-chapel' ); ?></span>
                <?php elseif ( 'error' === $ec_news ) : ?>
                    <span class="ec-footer-news-note ec-footer-news-note-error"><?php esc_html_e( 'Please enter a valid email and try again.', 'engrafted-chapel' ); ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="ec-footer-divider"></div>

        <!-- Columns -->
        <div class="ec-footer-widgets">

            <div class="ec-footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ec-logo-link ec-footer-brandmark">
                    <?php if ( has_custom_logo() ) : ?>
                        <img src="<?php echo esc_url( ec_logo_url() ); ?>" alt="<?php echo esc_attr( $church_name ); ?>" class="ec-footer-logo">
                    <?php else : ?>
                        <?php ec_brand_logo(); ?>
                    <?php endif; ?>
                </a>
                <ul class="ec-footer-contact-list">
                    <?php if ( $phone ) : ?>
                    <li>
                        <span class="ec-footer-contact-ico"><i class="fas fa-phone" aria-hidden="true"></i></span>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                    </li>
                    <?php endif; ?>
                    <li>
                        <span class="ec-footer-contact-ico"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                        <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a>
                    </li>
                </ul>
            </div>

            <div class="ec-footer-widget">
                <h4><?php esc_html_e( 'Quick Links', 'engrafted-chapel' ); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'engrafted-chapel' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About Us', 'engrafted-chapel' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/ministries' ) ); ?>"><?php esc_html_e( 'Our Ministries', 'engrafted-chapel' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'ec_sermon' ) ? get_post_type_archive_link( 'ec_sermon' ) : home_url( '/sermons' ) ); ?>"><?php esc_html_e( 'Sermons', 'engrafted-chapel' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact Us', 'engrafted-chapel' ); ?></a></li>
                </ul>
            </div>

            <div class="ec-footer-widget">
                <h4><?php esc_html_e( 'Our Services', 'engrafted-chapel' ); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/events' ) ); ?>"><?php esc_html_e( 'Prayer and Intercession', 'engrafted-chapel' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'ec_sermon' ) ? get_post_type_archive_link( 'ec_sermon' ) : home_url( '/sermons' ) ); ?>"><?php esc_html_e( 'Bible Study and Teaching', 'engrafted-chapel' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/outreach' ) ); ?>"><?php esc_html_e( 'Outreach and Community', 'engrafted-chapel' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/ministries' ) ); ?>"><?php esc_html_e( 'Children\'s Church', 'engrafted-chapel' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/ministries' ) ); ?>"><?php esc_html_e( 'Youth Ministry Service', 'engrafted-chapel' ); ?></a></li>
                </ul>
            </div>

            <div class="ec-footer-widget ec-footer-times">
                <h4><?php esc_html_e( 'Service Times', 'engrafted-chapel' ); ?></h4>
                <ul class="ec-footer-times-list">
                    <?php foreach ( $services as $service ) : ?>
                    <li><?php echo esc_html( sprintf( '%1$s (%2$s): %3$s', $service['name'], $service['day'], $service['time'] ) ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php if ( ! empty( $social_links ) ) : ?>
                <div class="ec-footer-social">
                    <?php foreach ( $social_links as $key => $social ) : ?>
                    <a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $social['label'] ); ?>">
                        <i class="fab <?php echo esc_attr( $social['icon'] ); ?>" aria-hidden="true"></i>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div class="ec-footer-bottom">
        <div class="ec-container">
            <p>
                <?php
                /* translators: %1$s: year, %2$s: church name */
                printf( esc_html__( 'Copyright © %1$s %2$s. All rights reserved.', 'engrafted-chapel' ), esc_html( gmdate( 'Y' ) ), esc_html( $church_name ) );
                ?>
            </p>
        </div>
    </div>
</footer>

<div class="ec-video-modal" id="ec-video-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Video player', 'engrafted-chapel' ); ?>">
    <button class="ec-video-modal-close" type="button" aria-label="<?php esc_attr_e( 'Close', 'engrafted-chapel' ); ?>"><i class="fas fa-xmark" aria-hidden="true"></i></button>
    <div class="ec-video-modal-inner">
        <div class="ec-video-modal-frame"></div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
