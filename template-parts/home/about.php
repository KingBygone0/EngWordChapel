<?php
/**
 * About Section (image + vision + animated stats)
 *
 * Mirrors the Emanu "About Us" block — two-column image/content with a vision
 * list and a band of counters — recast in the Engrafted dark/ember brand.
 *
 * @package Engrafted_Chapel
 */

$ec_about_img = get_theme_mod( 'ec_welcome_image' );

$ec_vision = array(
    get_theme_mod( 'ec_about_vision_1', __( 'Serving God through our generation.', 'engrafted-chapel' ) ),
    get_theme_mod( 'ec_about_vision_2', __( 'Impacting society through Christ.', 'engrafted-chapel' ) ),
    get_theme_mod( 'ec_about_vision_3', __( 'Manifesting the glory of our God.', 'engrafted-chapel' ) ),
);
$ec_vision = array_filter( $ec_vision );

// Founding year drives the "years of faithful ministry" counter so it stays true.
$ec_founded = (int) get_theme_mod( 'ec_about_founded_year', 2010 );
$ec_years   = max( 1, (int) gmdate( 'Y' ) - $ec_founded );
?>

<section class="ec-section ec-section-white ec-about" id="about">
    <div class="ec-container">
        <div class="ec-about-grid">
            <div class="ec-about-media">
                <?php if ( $ec_about_img ) : ?>
                    <img src="<?php echo esc_url( $ec_about_img ); ?>" alt="<?php esc_attr_e( 'The Engrafted Word Chapel family', 'engrafted-chapel' ); ?>" loading="lazy" decoding="async">
                <?php else : ?>
                    <div class="ec-about-media-fallback"><i class="fas fa-church" aria-hidden="true"></i></div>
                <?php endif; ?>
                <div class="ec-about-media-tag">
                    <span class="ec-about-tag-since"><?php esc_html_e( 'Since', 'engrafted-chapel' ); ?></span>
                    <span class="ec-about-tag-year"><?php echo esc_html( $ec_founded ); ?></span>
                </div>
            </div>

            <div class="ec-about-content">
                <span class="ec-section-label"><?php esc_html_e( 'About Engrafted Word Chapel', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title">
                    <?php
                    /* translators: the word "love" is rendered in the italic ember accent. */
                    $ec_heading = get_theme_mod( 'ec_about_heading', __( 'Degrafted from the world, engrafted into love.', 'engrafted-chapel' ) );
                    $ec_heading = str_replace( 'love', '<span class="ec-gold">love</span>', $ec_heading );
                    echo wp_kses_post( $ec_heading );
                    ?>
                </h2>
                <p><?php echo wp_kses_post( get_theme_mod( 'ec_about_text', __( 'What began as two friends praying together has grown into a scripturally, spiritually and physically healthy family — a place where love is both expressed and felt, and where the saving Word of God is grafted into ordinary lives.', 'engrafted-chapel' ) ) ); ?></p>

                <?php if ( $ec_vision ) : ?>
                <div class="ec-about-vision">
                    <h3 class="ec-about-vision-title"><?php esc_html_e( 'Our Vision', 'engrafted-chapel' ); ?></h3>
                    <ul>
                        <?php foreach ( $ec_vision as $ec_point ) : ?>
                            <li><i class="fas fa-leaf" aria-hidden="true"></i> <?php echo esc_html( $ec_point ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Learn More About Us', 'engrafted-chapel' ); ?></a>
            </div>
        </div>

        <div class="ec-stats-band ec-stats-band-wide">
            <div class="ec-stat">
                <div class="ec-stat-num" data-count-to="<?php echo esc_attr( $ec_years ); ?>" data-count-suffix="+"><?php echo esc_html( $ec_years ); ?>+</div>
                <div class="ec-stat-label"><?php esc_html_e( 'Years of Faithful Ministry', 'engrafted-chapel' ); ?></div>
            </div>
            <div class="ec-stat">
                <div class="ec-stat-num" data-count-to="5" data-count-suffix="+">5+</div>
                <div class="ec-stat-label"><?php esc_html_e( 'Active Ministries', 'engrafted-chapel' ); ?></div>
            </div>
            <div class="ec-stat">
                <div class="ec-stat-num" data-count-to="3">3</div>
                <div class="ec-stat-label"><?php esc_html_e( 'Weekly Gatherings', 'engrafted-chapel' ); ?></div>
            </div>
            <div class="ec-stat">
                <div class="ec-stat-num ec-stat-word"><?php esc_html_e( 'One', 'engrafted-chapel' ); ?></div>
                <div class="ec-stat-label"><?php esc_html_e( 'Family Walking Together in Christ', 'engrafted-chapel' ); ?></div>
            </div>
        </div>
    </div>
</section>
