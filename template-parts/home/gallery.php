<?php
/**
 * Homepage Gallery preview — a strip of recent photos linking to the full
 * Gallery page. Renders nothing until photos have been added.
 *
 * @package Engrafted_Chapel
 */

$ec_q = ec_get_gallery( 8 );
if ( ! $ec_q->have_posts() ) {
    wp_reset_postdata();
    return;
}
$ec_gallery_url = home_url( '/gallery' );
?>

<section class="ec-section ec-section-white ec-home-gallery" id="gallery">
    <div class="ec-container">
        <div class="ec-section-header-row">
            <div>
                <span class="ec-section-label"><?php esc_html_e( 'Our Gallery', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Moments from our church family', 'engrafted-chapel' ); ?></h2>
            </div>
            <a href="<?php echo esc_url( $ec_gallery_url ); ?>" class="ec-view-all"><?php esc_html_e( 'View Full Gallery', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>

        <div class="ec-home-gallery-grid">
            <?php
            while ( $ec_q->have_posts() ) :
                $ec_q->the_post();
                if ( ! has_post_thumbnail() ) {
                    continue;
                }
                ?>
                <a class="ec-home-gallery-item" href="<?php echo esc_url( $ec_gallery_url ); ?>" aria-label="<?php esc_attr_e( 'View gallery', 'engrafted-chapel' ); ?>">
                    <?php the_post_thumbnail( 'medium', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title() ) ) ); ?>
                    <span class="ec-home-gallery-ov"><i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>
