<?php
/**
 * Service Times Section
 *
 * @package Engrafted_Chapel
 */

$services = ec_get_services();
?>

<section class="ec-section ec-section-dark" id="services">
    <div class="ec-container">
        <div class="ec-services-row">
            <div class="ec-services-left">
                <span class="ec-section-label"><?php esc_html_e( 'Join Us', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php echo esc_html( get_theme_mod( 'ec_services_title', __( 'Service Times', 'engrafted-chapel' ) ) ); ?></h2>
                <p class="ec-section-desc"><?php esc_html_e( 'Join us in person for a time of worship, teaching, and community.', 'engrafted-chapel' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-outline">
                    <?php esc_html_e( 'Plan Your Visit', 'engrafted-chapel' ); ?>
                </a>
            </div>

            <div class="ec-services-right">
                <?php foreach ( $services as $service ) : ?>
                <div class="ec-service-card-alt">
                    <i class="far fa-clock"></i>
                    <div class="ec-time"><?php echo esc_html( strtok( $service['time'], ' ' ) ); ?> <span><?php echo esc_html( substr( strstr( $service['time'], ' ' ), 1 ) ); ?></span></div>
                    <h3><?php echo esc_html( $service['name'] ); ?></h3>
                    <p><?php echo esc_html( $service['day'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="ec-text-center ec-mt-2">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-view-link">
                <?php esc_html_e( 'View Location & Directions', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
