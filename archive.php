<?php
/**
 * Archive template — sermons, events, blog categories/tags. Renders the right
 * card grid for the post type being listed. Emanu skin throughout.
 *
 * @package Engrafted_Chapel
 */

get_header();

$ec_pt = get_post_type();

if ( is_post_type_archive( 'ec_sermon' ) ) {
    ec_page_header( __( 'Sermons', 'engrafted-chapel' ), __( 'Grow in faith through the teaching of God\'s Word', 'engrafted-chapel' ), 'ec-ph-sermons', __( 'Romans 10:17 — Faith Comes by Hearing', 'engrafted-chapel' ) );
} elseif ( is_post_type_archive( 'ec_event' ) ) {
    ec_page_header( __( 'Events', 'engrafted-chapel' ), __( 'Join us for our upcoming events and programs', 'engrafted-chapel' ), 'ec-ph-events', __( 'Ecclesiastes 3:1 — A Time for Everything', 'engrafted-chapel' ) );
} else {
    ec_page_header( wp_strip_all_tags( get_the_archive_title() ), wp_strip_all_tags( get_the_archive_description() ), 'ec-ph-sermons', __( 'From the Journal', 'engrafted-chapel' ) );
}
?>

<section class="ec-section ec-section-white">
    <div class="ec-container">
        <?php if ( have_posts() ) : ?>

            <?php if ( 'ec_sermon' === $ec_pt ) : ?>
                <div class="ec-sermon-grid">
                    <?php while ( have_posts() ) : the_post(); ec_sermon_card( get_post() ); endwhile; ?>
                </div>

            <?php elseif ( 'ec_event' === $ec_pt ) : ?>
                <div class="ec-events-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        $ec_d  = get_post_meta( get_the_ID(), '_ec_event_date', true );
                        $ec_dd = $ec_d ? gmdate( 'j', strtotime( $ec_d ) ) : '';
                        $ec_mm = $ec_d ? gmdate( 'M', strtotime( $ec_d ) ) : '';
                        ?>
                        <div class="ec-event-card">
                            <div class="ec-event-card-thumb">
                                <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium' ); else : ?><div class="ec-event-thumb-fallback"><i class="fas fa-calendar-day" aria-hidden="true"></i></div><?php endif; ?>
                                <?php if ( $ec_d ) : ?><div class="ec-event-date-badge"><span class="ec-month"><?php echo esc_html( $ec_mm ); ?></span><span class="ec-day"><?php echo esc_html( $ec_dd ); ?></span></div><?php endif; ?>
                            </div>
                            <div class="ec-event-card-info">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="ec-learn-more"><?php esc_html_e( 'Event Details', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

            <?php else : ?>
                <div class="ec-blog-grid">
                    <?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content/content', 'card' ); endwhile; ?>
                </div>
            <?php endif; ?>

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
                <h2 class="ec-section-title"><?php esc_html_e( 'Nothing here yet', 'engrafted-chapel' ); ?></h2>
                <p class="ec-section-desc" style="margin:0 auto;"><?php esc_html_e( 'Please check back soon.', 'engrafted-chapel' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
