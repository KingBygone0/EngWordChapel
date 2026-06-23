<?php
/**
 * Single Album — the photos from one Sunday/event in a masonry grid with the
 * shared lightbox. Photos come from the "Album Photos" meta box. Emanu skin.
 *
 * @package Engrafted_Chapel
 */

get_header();

while ( have_posts() ) :
    the_post();

    $ec_id     = get_the_ID();
    $ec_images = ec_album_image_ids( $ec_id );

    ec_page_header(
        get_the_title(),
        get_the_date( 'l, F j, Y' ),
        'ec-ph-about',
        __( 'Photo Album', 'engrafted-chapel' )
    );
    ?>

    <section class="ec-section ec-section-white ec-single-album">
        <div class="ec-container">

            <?php if ( trim( get_the_content() ) ) : ?>
                <div class="ec-section-header"><div class="ec-content-block"><?php the_content(); ?></div></div>
            <?php endif; ?>

            <?php if ( $ec_images ) : ?>
                <div class="ec-gallery-grid">
                    <?php
                    foreach ( $ec_images as $ec_img_id ) :
                        $ec_full = wp_get_attachment_image_url( $ec_img_id, 'full' );
                        if ( ! $ec_full ) {
                            continue;
                        }
                        $ec_cap = wp_get_attachment_caption( $ec_img_id );
                        if ( ! $ec_cap ) {
                            $ec_cap = get_the_title();
                        }
                        ?>
                        <a class="ec-gallery-item" href="<?php echo esc_url( $ec_full ); ?>" data-lightbox data-caption="<?php echo esc_attr( $ec_cap ); ?>">
                            <?php echo wp_get_attachment_image( $ec_img_id, 'medium_large', false, array( 'loading' => 'lazy', 'alt' => esc_attr( $ec_cap ) ) ); ?>
                            <span class="ec-gallery-zoom"><i class="fas fa-magnifying-glass-plus" aria-hidden="true"></i></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="ec-text-center">
                    <p class="ec-section-desc" style="margin:0 auto;"><?php esc_html_e( 'No photos in this album yet.', 'engrafted-chapel' ); ?></p>
                </div>
            <?php endif; ?>

            <div class="ec-min-share" style="margin-top:2.5rem;">
                <a href="<?php echo esc_url( home_url( '/gallery' ) ); ?>" class="ec-back-link"><i class="fas fa-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Back to Gallery', 'engrafted-chapel' ); ?></a>
            </div>
        </div>
    </section>

    <?php
    // More albums.
    $ec_more = new WP_Query( array(
        'post_type'           => 'ec_album',
        'posts_per_page'      => 3,
        'post__not_in'        => array( $ec_id ),
        'orderby'             => 'date',
        'order'               => 'DESC',
        'ignore_sticky_posts' => true,
    ) );
    if ( $ec_more->have_posts() ) :
        ?>
        <section class="ec-section ec-section-light">
            <div class="ec-container">
                <div class="ec-section-header">
                    <span class="ec-section-label"><?php esc_html_e( 'Keep Looking Back', 'engrafted-chapel' ); ?></span>
                    <h2 class="ec-section-title"><?php esc_html_e( 'More Albums', 'engrafted-chapel' ); ?></h2>
                </div>
                <div class="ec-album-grid">
                    <?php while ( $ec_more->have_posts() ) : $ec_more->the_post(); ec_album_card( get_post() ); endwhile; ?>
                </div>
            </div>
        </section>
        <?php
    endif;
    wp_reset_postdata();
    ?>

<?php endwhile; ?>

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
