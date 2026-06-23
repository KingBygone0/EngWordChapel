<?php
/**
 * Hero Section — Emanu "Home v3" two-column dark layout.
 *
 * Left: badge, headline, intro, two highlights, CTA. Right: rounded image.
 * The whole section is a near-black band with a faint hexagon texture; the
 * fixed header sits transparently on top of it.
 *
 * @package Engrafted_Chapel
 */

$image     = get_theme_mod( 'ec_hero_bg', EC_THEME_URI . '/assets/images/hero-bg.jpg' );
$badge     = get_theme_mod( 'ec_hero_badge', __( 'Growing Together in Christ', 'engrafted-chapel' ) );
$line1     = get_theme_mod( 'ec_hero_script_text', __( 'Welcome to Engrafted Word', 'engrafted-chapel' ) );
$line2     = get_theme_mod( 'ec_hero_block_text', __( 'Chapel International', 'engrafted-chapel' ) );
$tagline   = get_theme_mod( 'ec_hero_tagline', __( 'A place where faith grows, hearts are healed, and lives are transformed. Join us for uplifting worship, inspiring messages, and a loving community that walks together.', 'engrafted-chapel' ) );
$btn_text  = get_theme_mod( 'ec_hero_btn1_text', __( 'Join Our Church', 'engrafted-chapel' ) );
$btn_url   = get_theme_mod( 'ec_hero_btn1_url', '#about' );

// Two highlight call-outs (icon + label) — the first two hero features.
$features  = array_slice( ec_get_hero_features(), 0, 2 );
?>

<section class="ec-hero ec-hero-split" id="home">
    <div class="ec-hero-pattern" aria-hidden="true"></div>

    <div class="ec-container ec-hero-grid">
        <div class="ec-hero-col-text">
            <?php if ( $badge ) : ?>
            <span class="ec-hero-badge"><span class="ec-hero-badge-dot" aria-hidden="true"></span><?php echo esc_html( $badge ); ?></span>
            <?php endif; ?>

            <h1 class="ec-hero-heading">
                <span><?php echo esc_html( $line1 ); ?></span>
                <span><?php echo esc_html( $line2 ); ?></span>
            </h1>

            <p class="ec-hero-desc"><?php echo esc_html( $tagline ); ?></p>

            <?php if ( $features ) : ?>
            <div class="ec-hero-highlights">
                <?php foreach ( $features as $feature ) : ?>
                <div class="ec-hero-highlight">
                    <span class="ec-hero-highlight-icon"><i class="<?php echo esc_attr( $feature['icon'] ); ?>" aria-hidden="true"></i></span>
                    <h4><?php echo esc_html( $feature['title'] ); ?></h4>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <a href="<?php echo esc_url( $btn_url ); ?>" class="ec-btn ec-btn-orange ec-hero-cta">
                <?php echo esc_html( $btn_text ); ?> <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
            </a>
        </div>

        <div class="ec-hero-col-media">
            <div class="ec-hero-image">
                <?php
                // Serve a right-sized, responsive image (srcset) so mobile loads a
                // small version — this is the LCP element, so keep it light.
                $ec_hero_id = $image ? attachment_url_to_postid( $image ) : 0;
                if ( $ec_hero_id ) {
                    echo wp_get_attachment_image( $ec_hero_id, 'large', false, array(
                        'alt'           => esc_attr__( 'Inside our sanctuary', 'engrafted-chapel' ),
                        'fetchpriority' => 'high',
                        'decoding'      => 'async',
                        'sizes'         => '(max-width: 992px) 92vw, 600px',
                    ) );
                } elseif ( $image ) {
                    printf( '<img src="%s" alt="%s" fetchpriority="high" decoding="async">', esc_url( $image ), esc_attr__( 'Inside our sanctuary', 'engrafted-chapel' ) );
                } else {
                    echo '<div class="ec-hero-image-fallback"><i class="fas fa-church" aria-hidden="true"></i></div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>
