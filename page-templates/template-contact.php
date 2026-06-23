<?php
/**
 * Template Name: Contact
 *
 * Rebuilt to mirror the Emanu contact layout: a two-column "Get in Touch" block
 * (church details + a prayer-request form card) followed by a full-width map.
 *
 * @package Engrafted_Chapel
 */

get_header();

$contact = ec_get_contact_info();
$phones  = array_filter( $contact['phones'] );
$map     = get_theme_mod( 'ec_contact_map' );

ec_page_header(
    get_the_title(),
    __( 'We would love to hear from you', 'engrafted-chapel' ),
    'ec-ph-contact',
    __( 'Jeremiah 33:3 — Call to Me', 'engrafted-chapel' )
);

// Success / error notice flag from the form handler.
$ec_sent = isset( $_GET['ec_contact'] ) ? sanitize_key( wp_unslash( $_GET['ec_contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
?>

<section class="ec-section ec-section-white ec-contact-main" id="contact">
    <div class="ec-container">
        <div class="ec-contact-layout">

            <div class="ec-contact-info">
                <span class="ec-eyebrow-pill"><span class="ec-eyebrow-dot" aria-hidden="true"></span><?php esc_html_e( 'Get in Touch', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php echo esc_html( get_theme_mod( 'ec_cp_heading', 'Contact our church for prayer support' ) ); ?></h2>
                <p class="ec-contact-intro"><?php echo esc_html( get_theme_mod( 'ec_cp_intro', 'We would love to hear from you. Whether you have prayer requests, questions about our services, or want to get involved in our ministries, reach out any time.' ) ); ?></p>

                <div class="ec-contact-divider"></div>

                <div class="ec-contact-items">
                    <div class="ec-contact-item">
                        <span class="ec-contact-item-ico"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                        <div>
                            <span class="ec-contact-item-label"><?php esc_html_e( 'Email Address', 'engrafted-chapel' ); ?></span>
                            <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a>
                        </div>
                    </div>

                    <?php if ( $phones ) : ?>
                    <div class="ec-contact-item">
                        <span class="ec-contact-item-ico"><i class="fas fa-phone" aria-hidden="true"></i></span>
                        <div>
                            <span class="ec-contact-item-label"><?php esc_html_e( 'Phone Number', 'engrafted-chapel' ); ?></span>
                            <?php foreach ( $phones as $phone ) : ?>
                                <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="ec-contact-item ec-contact-item-wide">
                        <span class="ec-contact-item-ico"><i class="fas fa-location-dot" aria-hidden="true"></i></span>
                        <div>
                            <span class="ec-contact-item-label"><?php esc_html_e( 'Our Location', 'engrafted-chapel' ); ?></span>
                            <span><?php echo esc_html( $contact['address'] ); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ec-contact-form-card">
                <h3><?php echo esc_html( get_theme_mod( 'ec_cp_form_heading', 'Share your prayer requests here' ) ); ?></h3>

                <?php if ( 'success' === $ec_sent ) : ?>
                    <div class="ec-form-notice ec-form-notice-success"><?php esc_html_e( 'Thank you! Your message has been received. We will be in touch soon.', 'engrafted-chapel' ); ?></div>
                <?php elseif ( 'error' === $ec_sent ) : ?>
                    <div class="ec-form-notice ec-form-notice-error"><?php esc_html_e( 'Sorry, your message could not be sent. Please check your details and try again.', 'engrafted-chapel' ); ?></div>
                <?php endif; ?>

                <form class="ec-prayer-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="ec_contact">
                    <?php wp_nonce_field( 'ec_contact_form', 'ec_contact_nonce' ); ?>
                    <span class="ec-hp-field" aria-hidden="true">
                        <label><?php esc_html_e( 'Leave this field empty', 'engrafted-chapel' ); ?><input type="text" name="ec_hp" tabindex="-1" autocomplete="off"></label>
                    </span>

                    <div class="ec-prayer-row">
                        <input type="text" name="first_name" aria-label="<?php esc_attr_e( 'First Name', 'engrafted-chapel' ); ?>" placeholder="<?php esc_attr_e( 'First Name', 'engrafted-chapel' ); ?>" required>
                        <input type="text" name="last_name" aria-label="<?php esc_attr_e( 'Last Name', 'engrafted-chapel' ); ?>" placeholder="<?php esc_attr_e( 'Last Name', 'engrafted-chapel' ); ?>">
                    </div>
                    <div class="ec-prayer-row">
                        <input type="tel" name="phone" aria-label="<?php esc_attr_e( 'Phone Number', 'engrafted-chapel' ); ?>" placeholder="<?php esc_attr_e( 'Phone Number', 'engrafted-chapel' ); ?>">
                        <input type="email" name="email" aria-label="<?php esc_attr_e( 'Email Address', 'engrafted-chapel' ); ?>" placeholder="<?php esc_attr_e( 'Email Address', 'engrafted-chapel' ); ?>" required>
                    </div>
                    <textarea name="message" rows="4" aria-label="<?php esc_attr_e( 'Message', 'engrafted-chapel' ); ?>" placeholder="<?php esc_attr_e( 'Message', 'engrafted-chapel' ); ?>" required></textarea>

                    <button type="submit" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Send Message', 'engrafted-chapel' ); ?></button>
                </form>
            </div>

        </div>
    </div>
</section>

<section class="ec-section ec-section-light ec-contact-map-section">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-eyebrow-pill"><span class="ec-eyebrow-dot" aria-hidden="true"></span><?php esc_html_e( 'Where We Are Located', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php echo esc_html( get_theme_mod( 'ec_cp_map_heading', 'Find our church location easily' ) ); ?></h2>
            <p class="ec-section-desc"><?php echo esc_html( get_theme_mod( 'ec_cp_map_intro', 'Our church is conveniently located in a peaceful and easily accessible area, making it simple for individuals and families to join us for worship and fellowship.' ) ); ?></p>
        </div>

        <div class="ec-map-embed">
            <?php if ( $map ) : ?>
                <?php echo wp_kses( $map, array( 'iframe' => array( 'src' => array(), 'width' => array(), 'height' => array(), 'style' => array(), 'allowfullscreen' => array(), 'loading' => array(), 'referrerpolicy' => array(), 'title' => array() ) ) ); ?>
            <?php else : ?>
                <iframe
                    title="<?php esc_attr_e( 'Engrafted Word Chapel International location map', 'engrafted-chapel' ); ?>"
                    src="https://www.google.com/maps?q=Engrafted%20Word%20Chapel%20Int%27l&output=embed"
                    width="100%" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
