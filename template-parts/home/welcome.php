<?php
/**
 * Welcome Section
 *
 * @package Engrafted_Chapel
 */

$welcome_img = get_theme_mod( 'ec_welcome_image' );
?>

<section class="ec-section ec-section-white" id="welcome">
    <div class="ec-container">
        <div class="ec-welcome">
            <div class="ec-welcome-content">
                <span class="ec-section-label"><?php echo esc_html( get_theme_mod( 'ec_church_name', 'Engrafted Word Chapel' ) ); ?></span>
                <h2 class="ec-section-title">
                    <?php
                    $heading = get_theme_mod( 'ec_welcome_heading', 'You belong here. This is more than a church, it\'s a family.' );
                    // Wrap "family" in gold cursive
                    $heading = str_replace( 'family', '<span class="ec-gold">family.</span>', $heading );
                    echo wp_kses_post( $heading );
                    ?>
                </h2>
                <p><?php echo wp_kses_post( get_theme_mod( 'ec_welcome_text', 'No matter where you are in life, you have a place here. We are a community of imperfect people following a perfect Savior.' ) ); ?></p>
                <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="ec-btn-small">
                    <?php esc_html_e( 'Learn More About Us', 'engrafted-chapel' ); ?>
                </a>
            </div>

            <?php if ( $welcome_img ) : ?>
            <div class="ec-welcome-image">
                <img src="<?php echo esc_url( $welcome_img ); ?>" alt="<?php esc_attr_e( 'Welcome to our church', 'engrafted-chapel' ); ?>">
            </div>
            <?php else : ?>
            <div class="ec-welcome-image">
                <div style="width:100%;height:450px;background:linear-gradient(135deg,#1a1a2e,#2a2a48);border-radius:12px;display:flex;align-items:center;justify-content:center;color:#c9a84c;font-size:5rem;box-shadow:0 20px 60px rgba(0,0,0,0.15);">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
