<?php
/**
 * Template Name: Events
 *
 * Card-grid layout of upcoming events in the Emanu skin, with a fallback to the
 * church's recurring programmes when no event posts have been added yet.
 *
 * @package Engrafted_Chapel
 */

get_header();

ec_page_header(
    get_the_title(),
    __( 'Join us for our upcoming events and programs', 'engrafted-chapel' ),
    'ec-ph-events',
    __( 'Ecclesiastes 3:1 — A Time for Everything', 'engrafted-chapel' )
);

$paged       = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$event_query = new WP_Query( array(
    'post_type'      => 'ec_event',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'meta_key'       => '_ec_event_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
) );
?>

<section class="ec-section ec-section-white ec-page-events">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'What\'s Happening', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'Upcoming Events & Programs', 'engrafted-chapel' ); ?></h2>
            <p class="ec-section-desc"><?php esc_html_e( 'There is always something happening at Engrafted Word Chapel. Come and be part of it.', 'engrafted-chapel' ); ?></p>
        </div>

        <?php if ( $event_query->have_posts() ) : ?>
            <div class="ec-events-grid">
                <?php
                while ( $event_query->have_posts() ) :
                    $event_query->the_post();
                    $date  = get_post_meta( get_the_ID(), '_ec_event_date', true );
                    $time  = get_post_meta( get_the_ID(), '_ec_event_time', true );
                    $venue = get_post_meta( get_the_ID(), '_ec_event_venue', true );
                    $day   = $date ? gmdate( 'j', strtotime( $date ) ) : '';
                    $month = $date ? gmdate( 'M', strtotime( $date ) ) : '';
                    ?>
                    <div class="ec-event-card">
                        <div class="ec-event-card-thumb">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium' ); ?>
                            <?php else : ?>
                                <div class="ec-event-thumb-fallback"><i class="fas fa-calendar-day" aria-hidden="true"></i></div>
                            <?php endif; ?>
                            <?php if ( $date ) : ?>
                            <div class="ec-event-date-badge">
                                <span class="ec-month"><?php echo esc_html( $month ); ?></span>
                                <span class="ec-day"><?php echo esc_html( $day ); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="ec-event-card-info">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="ec-event-meta-row">
                                <?php if ( $time ) : ?><span><i class="far fa-clock" aria-hidden="true"></i> <?php echo esc_html( $time ); ?></span><?php endif; ?>
                                <?php if ( $venue ) : ?><span><i class="fas fa-location-dot" aria-hidden="true"></i> <?php echo esc_html( $venue ); ?></span><?php endif; ?>
                            </div>
                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="ec-learn-more"><?php esc_html_e( 'Event Details', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __( 'Previous', 'engrafted-chapel' ),
                'next_text' => __( 'Next', 'engrafted-chapel' ) . ' <i class="fas fa-chevron-right"></i>',
            ) );
            ?>
        <?php else : ?>
            <div class="ec-events-grid">
                <?php
                $default_events = array(
                    array( 'title' => 'Standoff', 'desc' => 'A special time of prayer and fasting. 11th – 31st January, 6 PM each night.', 'month' => 'JAN', 'day' => '11', 'meta' => '6:00 PM nightly' ),
                    array( 'title' => 'Recovery', 'desc' => 'Monthly prayer and healing service — the last Wednesday, Thursday and Friday of each month.', 'month' => 'MON', 'day' => '★', 'meta' => 'Monthly' ),
                    array( 'title' => 'When I See The Blood', 'desc' => 'Our Passover celebration. 31st March – 4th April, 6 PM each night.', 'month' => 'MAR', 'day' => '31', 'meta' => '6:00 PM nightly' ),
                    array( 'title' => 'Reload', 'desc' => 'A mid-year spiritual refresh. 1st – 30th June, 6 PM each night.', 'month' => 'JUN', 'day' => '01', 'meta' => '6:00 PM nightly' ),
                    array( 'title' => 'Fresh Word Encounter', 'desc' => 'Our main Sunday celebration — uplifting worship and the engrafted Word.', 'month' => 'SUN', 'day' => '✦', 'meta' => '7:30 AM' ),
                    array( 'title' => 'Bible Voice', 'desc' => 'Midweek teaching to ground your faith in the Word of God.', 'month' => 'WED', 'day' => '✦', 'meta' => '6:30 PM' ),
                );
                foreach ( $default_events as $event ) :
                    ?>
                    <div class="ec-event-card">
                        <div class="ec-event-card-thumb">
                            <div class="ec-event-thumb-fallback"><i class="fas fa-calendar-day" aria-hidden="true"></i></div>
                            <div class="ec-event-date-badge">
                                <span class="ec-month"><?php echo esc_html( $event['month'] ); ?></span>
                                <span class="ec-day"><?php echo esc_html( $event['day'] ); ?></span>
                            </div>
                        </div>
                        <div class="ec-event-card-info">
                            <h3><?php echo esc_html( $event['title'] ); ?></h3>
                            <div class="ec-event-meta-row"><span><i class="far fa-clock" aria-hidden="true"></i> <?php echo esc_html( $event['meta'] ); ?></span></div>
                            <p><?php echo esc_html( $event['desc'] ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="ec-text-center ec-mt-2 ec-events-note"><?php esc_html_e( 'These are our recurring programmes. Dated events will appear here as they are scheduled.', 'engrafted-chapel' ); ?></p>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</section>

<div class="ec-container">
    <div class="ec-cta-band">
        <h2><?php esc_html_e( 'Never miss a gathering', 'engrafted-chapel' ); ?></h2>
        <p><?php esc_html_e( 'Plan your visit and join us for worship, teaching and community throughout the week.', 'engrafted-chapel' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-gold"><?php esc_html_e( 'Plan Your Visit', 'engrafted-chapel' ); ?></a>
    </div>
</div>

<?php get_footer(); ?>
