<?php
/**
 * Template Name: Gallery
 *
 * The church photo hub. Shows photo Albums (one per Sunday/event) as cards, and
 * — if any standalone highlight photos exist — a masonry grid with a lightbox.
 *
 * Albums:    dashboard → Albums → Add New → "Add Photos" → Publish.
 * Highlights: dashboard → Gallery → Add Photo → set the Featured Image.
 *
 * @package Engrafted_Chapel
 */

get_header();

ec_page_header(
    get_the_title(),
    __( 'Moments from our worship, fellowship and life together', 'engrafted-chapel' ),
    'ec-ph-about',
    __( 'Psalm 150:6 — Let Everything Praise the Lord', 'engrafted-chapel' )
);

$ec_albums = ec_get_albums( -1 );
$ec_q      = ec_get_gallery( -1 );

// Capture up front — have_posts() returns false once a loop is consumed.
$ec_has_albums     = $ec_albums->have_posts();
$ec_has_highlights = $ec_q->have_posts();
?>

<section class="ec-section ec-section-white ec-gallery-page">
    <div class="ec-container">

        <?php
        // Optional intro text from the page editor.
        while ( have_posts() ) {
            the_post();
            if ( trim( get_the_content() ) ) {
                echo '<div class="ec-section-header"><div class="ec-content-block">';
                the_content();
                echo '</div></div>';
            }
        }
        ?>

        <?php if ( $ec_has_albums ) : ?>
            <div class="ec-gallery-block">
                <div class="ec-section-header-row">
                    <div>
                        <span class="ec-section-label"><?php esc_html_e( 'Photo Albums', 'engrafted-chapel' ); ?></span>
                        <h2 class="ec-section-title"><?php esc_html_e( 'Browse by Sunday', 'engrafted-chapel' ); ?></h2>
                    </div>
                </div>
                <div class="ec-album-grid">
                    <?php
                    while ( $ec_albums->have_posts() ) :
                        $ec_albums->the_post();
                        ec_album_card( get_post() );
                    endwhile;
                    ?>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <?php if ( $ec_has_highlights ) : ?>
            <div class="ec-gallery-block">
                <?php if ( $ec_has_albums ) : ?>
                    <div class="ec-section-header-row">
                        <div>
                            <span class="ec-section-label"><?php esc_html_e( 'Highlights', 'engrafted-chapel' ); ?></span>
                            <h2 class="ec-section-title"><?php esc_html_e( 'Photo Highlights', 'engrafted-chapel' ); ?></h2>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="ec-gallery-grid">
                    <?php
                    while ( $ec_q->have_posts() ) :
                        $ec_q->the_post();
                        if ( ! has_post_thumbnail() ) {
                            continue;
                        }
                        $ec_full = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        $ec_cap  = get_the_title();
                        ?>
                        <a class="ec-gallery-item" href="<?php echo esc_url( $ec_full ); ?>" data-lightbox data-caption="<?php echo esc_attr( $ec_cap ); ?>">
                            <?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy', 'alt' => esc_attr( $ec_cap ) ) ); ?>
                            <span class="ec-gallery-zoom"><i class="fas fa-magnifying-glass-plus" aria-hidden="true"></i></span>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <?php if ( ! $ec_has_albums && ! $ec_has_highlights ) : ?>
            <div class="ec-text-center">
                <h2 class="ec-section-title"><?php esc_html_e( 'Photos coming soon', 'engrafted-chapel' ); ?></h2>
                <p class="ec-section-desc" style="margin:0 auto;"><?php esc_html_e( 'Add a Sunday album from the dashboard under Albums → Add New.', 'engrafted-chapel' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<div class="ec-lightbox" id="ec-lightbox" aria-hidden="true" role="dialog" aria-label="<?php esc_attr_e( 'Photo viewer', 'engrafted-chapel' ); ?>">
    <button class="ec-lightbox-close" type="button" aria-label="<?php esc_attr_e( 'Close', 'engrafted-chapel' ); ?>"><i class="fas fa-xmark" aria-hidden="true"></i></button>
    <button class="ec-lightbox-nav ec-lightbox-prev" type="button" aria-label="<?php esc_attr_e( 'Previous', 'engrafted-chapel' ); ?>"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>
    <figure class="ec-lightbox-figure">
        <img class="ec-lightbox-img" src="" alt="">
        <figcaption class="ec-lightbox-caption"></figcaption>
    </figure>
    <button class="ec-lightbox-nav ec-lightbox-next" type="button" aria-label="<?php esc_attr_e( 'Next', 'engrafted-chapel' ); ?>"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>
</div>

<?php get_footer(); ?>
