<?php
/**
 * Contact Section
 *
 * @package Engrafted_Chapel
 */

$contact = ec_get_contact_info();
$map     = get_theme_mod( 'ec_contact_map' );
?>

<section class="ec-section" id="contact">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'Get in Touch', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'Contact Us', 'engrafted-chapel' ); ?></h2>
            <p class="ec-section-desc"><?php esc_html_e( 'We would love to hear from you. Reach out to us through any of the channels below.', 'engrafted-chapel' ); ?></p>
        </div>

        <div class="ec-contact-grid">
            <div class="ec-contact-card">
                <div class="ec-contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3><?php esc_html_e( 'Address', 'engrafted-chapel' ); ?></h3>
                <p><?php echo esc_html( $contact['address'] ); ?></p>
            </div>
            <div class="ec-contact-card">
                <div class="ec-contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3><?php esc_html_e( 'Email', 'engrafted-chapel' ); ?></h3>
                <p><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p>
            </div>
            <div class="ec-contact-card">
                <div class="ec-contact-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h3><?php esc_html_e( 'Phone', 'engrafted-chapel' ); ?></h3>
                <p>
                    <?php foreach ( array_filter( $contact['phones'] ) as $phone ) : ?>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a><br>
                    <?php endforeach; ?>
                </p>
            </div>
        </div>

        <?php if ( $map ) : ?>
        <div class="ec-map-embed">
            <?php echo wp_kses_post( $map ); ?>
        </div>
        <?php endif; ?>

        <div class="ec-mt-3">
            <h3 class="ec-section-title ec-text-center"><?php esc_html_e( 'Send us a Message', 'engrafted-chapel' ); ?></h3>
            <?php get_template_part( 'template-parts/contact-form' ); ?>
        </div>
    </div>
</section>
