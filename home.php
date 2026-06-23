<?php
/**
 * Blog index (the Posts page). Card grid in the Emanu skin.
 *
 * @package Engrafted_Chapel
 */

get_header();

ec_page_header(
    single_post_title( '', false ) ? single_post_title( '', false ) : __( 'Blog', 'engrafted-chapel' ),
    __( 'Insights and inspiration from the Engrafted Word Chapel family', 'engrafted-chapel' ),
    'ec-ph-sermons',
    __( 'From the Journal', 'engrafted-chapel' )
);
?>

<section class="ec-section ec-section-white">
    <div class="ec-container">
        <?php if ( have_posts() ) : ?>
            <div class="ec-blog-grid">
                <?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content/content', 'card' ); endwhile; ?>
            </div>
            <div class="ec-archive-pagination">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                ) );
                ?>
            </div>
        <?php else : ?>
            <div class="ec-text-center">
                <h2 class="ec-section-title"><?php esc_html_e( 'No posts yet', 'engrafted-chapel' ); ?></h2>
                <p class="ec-section-desc" style="margin:0 auto;"><?php esc_html_e( 'Our first articles are on the way. Please check back soon.', 'engrafted-chapel' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
