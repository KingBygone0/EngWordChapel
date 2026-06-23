<?php
/**
 * Single Event template — date/time/venue, full details and a sidebar, with a
 * grid of other upcoming events. Emanu skin throughout.
 *
 * @package Engrafted_Chapel
 */

get_header();

while ( have_posts() ) :
    the_post();

    $ec_id    = get_the_ID();
    $ec_date  = get_post_meta( $ec_id, '_ec_event_date', true );
    $ec_time  = get_post_meta( $ec_id, '_ec_event_time', true );
    $ec_venue = get_post_meta( $ec_id, '_ec_event_venue', true );
    $ec_day   = $ec_date ? gmdate( 'j', strtotime( $ec_date ) ) : '';
    $ec_month = $ec_date ? gmdate( 'M', strtotime( $ec_date ) ) : '';
    $ec_full  = $ec_date ? gmdate( 'l, F j, Y', strtotime( $ec_date ) ) : '';

    ec_page_header(
        get_the_title(),
        $ec_full ? $ec_full : __( 'Join us for this gathering', 'engrafted-chapel' ),
        'ec-ph-events',
        __( 'Ecclesiastes 3:1 — A Time for Everything', 'engrafted-chapel' )
    );
    ?>

    <section class="ec-section ec-section-white ec-single-event">
        <div class="ec-container">
            <div class="ec-min-grid">

                <article class="ec-min-main">
                    <div class="ec-sermon-media">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', array( 'class' => 'ec-sermon-cover' ) ); ?>
                        <?php else : ?>
                            <div class="ec-event-thumb-fallback ec-event-hero-fallback"><i class="fas fa-calendar-day" aria-hidden="true"></i></div>
                        <?php endif; ?>
                        <?php if ( $ec_date ) : ?>
                        <div class="ec-event-date-badge ec-event-date-badge-lg">
                            <span class="ec-month"><?php echo esc_html( $ec_month ); ?></span>
                            <span class="ec-day"><?php echo esc_html( $ec_day ); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <h2 class="ec-min-title"><?php the_title(); ?></h2>
                    <div class="ec-min-content"><?php the_content(); ?></div>

                    <div class="ec-min-share">
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'ec_event' ) ); ?>" class="ec-back-link"><i class="fas fa-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'All Events', 'engrafted-chapel' ); ?></a>
                    </div>
                </article>

                <aside class="ec-min-aside">
                    <div class="ec-min-card ec-min-detail">
                        <h3><?php esc_html_e( 'Event Details', 'engrafted-chapel' ); ?></h3>
                        <ul class="ec-min-detail-list">
                            <?php if ( $ec_full ) : ?>
                            <li><span class="ec-min-detail-ico"><i class="far fa-calendar" aria-hidden="true"></i></span><span><strong><?php esc_html_e( 'Date', 'engrafted-chapel' ); ?></strong><?php echo esc_html( $ec_full ); ?></span></li>
                            <?php endif; ?>
                            <?php if ( $ec_time ) : ?>
                            <li><span class="ec-min-detail-ico"><i class="far fa-clock" aria-hidden="true"></i></span><span><strong><?php esc_html_e( 'Time', 'engrafted-chapel' ); ?></strong><?php echo esc_html( $ec_time ); ?></span></li>
                            <?php endif; ?>
                            <li><span class="ec-min-detail-ico"><i class="fas fa-location-dot" aria-hidden="true"></i></span><span><strong><?php esc_html_e( 'Venue', 'engrafted-chapel' ); ?></strong><?php echo esc_html( $ec_venue ? $ec_venue : __( 'Engrafted Word Chapel', 'engrafted-chapel' ) ); ?></span></li>
                        </ul>
                    </div>

                    <div class="ec-min-card ec-min-join">
                        <span class="ec-min-join-ico"><i class="fas fa-hand-holding-heart" aria-hidden="true"></i></span>
                        <h3><?php esc_html_e( 'Be There', 'engrafted-chapel' ); ?></h3>
                        <p><?php esc_html_e( 'We would love to see you. Reach out with any questions about this gathering.', 'engrafted-chapel' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Contact Us', 'engrafted-chapel' ); ?></a>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    <?php
    $ec_more = new WP_Query( array(
        'post_type'           => 'ec_event',
        'posts_per_page'      => 3,
        'post__not_in'        => array( $ec_id ),
        'meta_key'            => '_ec_event_date',
        'orderby'             => 'meta_value',
        'order'               => 'ASC',
        'ignore_sticky_posts' => true,
    ) );
    if ( $ec_more->have_posts() ) :
        ?>
        <section class="ec-section ec-section-light">
            <div class="ec-container">
                <div class="ec-section-header">
                    <span class="ec-section-label"><?php esc_html_e( 'What\'s Next', 'engrafted-chapel' ); ?></span>
                    <h2 class="ec-section-title"><?php esc_html_e( 'More Events', 'engrafted-chapel' ); ?></h2>
                </div>
                <div class="ec-events-grid">
                    <?php
                    while ( $ec_more->have_posts() ) :
                        $ec_more->the_post();
                        $ec_d  = get_post_meta( get_the_ID(), '_ec_event_date', true );
                        $ec_dd = $ec_d ? gmdate( 'j', strtotime( $ec_d ) ) : '';
                        $ec_mm = $ec_d ? gmdate( 'M', strtotime( $ec_d ) ) : '';
                        ?>
                        <div class="ec-event-card">
                            <div class="ec-event-card-thumb">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                <?php else : ?>
                                    <div class="ec-event-thumb-fallback"><i class="fas fa-calendar-day" aria-hidden="true"></i></div>
                                <?php endif; ?>
                                <?php if ( $ec_d ) : ?>
                                <div class="ec-event-date-badge"><span class="ec-month"><?php echo esc_html( $ec_mm ); ?></span><span class="ec-day"><?php echo esc_html( $ec_dd ); ?></span></div>
                                <?php endif; ?>
                            </div>
                            <div class="ec-event-card-info">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="ec-learn-more"><?php esc_html_e( 'Event Details', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php
    endif;
    wp_reset_postdata();
    ?>

<?php endwhile; ?>

<?php get_footer(); ?>
