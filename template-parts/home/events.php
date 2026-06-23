<?php
/**
 * Upcoming Events Section
 *
 * @package Engrafted_Chapel
 */

$event_query = ec_get_events( 4 );
?>

<section class="ec-section ec-section-light" id="events">
    <div class="ec-container">
        <div class="ec-section-header-row">
            <div>
                <span class="ec-section-label"><?php esc_html_e( 'What\'s Happening', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Upcoming Events', 'engrafted-chapel' ); ?></h2>
            </div>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'ec_event' ) ); ?>" class="ec-view-all">
                <?php esc_html_e( 'View All Events', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <?php if ( $event_query->have_posts() ) : ?>
        <div class="ec-events-grid">
            <?php while ( $event_query->have_posts() ) : $event_query->the_post(); ?>
                <?php
                $date  = get_post_meta( get_the_ID(), '_ec_event_date', true );
                $time  = get_post_meta( get_the_ID(), '_ec_event_time', true );
                $day   = $date ? gmdate( 'j', strtotime( $date ) ) : '';
                $month = $date ? gmdate( 'M', strtotime( $date ) ) : '';
                ?>
                <div class="ec-event-card">
                    <div class="ec-event-card-thumb">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium' ); ?>
                        <?php else : ?>
                            <div style="width:100%;height:160px;background:linear-gradient(135deg,#1a1a2e,#2a2a48);display:flex;align-items:center;justify-content:center;color:#c9a84c;font-size:2rem;">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
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
                        <?php if ( $time ) : ?>
                        <div class="ec-event-time"><?php echo esc_html( $time ); ?></div>
                        <?php endif; ?>
                        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 12 ) ); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php else : ?>
        <div class="ec-events-grid">
            <?php
            $default_events = array(
                array( 'title' => 'STANDOFF', 'desc' => 'A special time of prayer and fasting. 11th - 31st January. 6PM Each Night.', 'month' => 'JAN', 'day' => '11' ),
                array( 'title' => 'RECOVERY', 'desc' => 'Monthly prayer and healing service. Last Wednesday, Thursday, Friday of Each Month.', 'month' => 'MON', 'day' => 'L' ),
                array( 'title' => 'WHEN I SEE THE BLOOD', 'desc' => 'Passover celebration. 31st March - 4th April. 6 PM Each Night.', 'month' => 'MAR', 'day' => '31' ),
                array( 'title' => 'RELOAD', 'desc' => 'Mid-year spiritual refresh. 1st - 30th June. 6 PM Each Night.', 'month' => 'JUN', 'day' => '01' ),
            );
            foreach ( $default_events as $event ) :
            ?>
            <div class="ec-event-card">
                <div class="ec-event-card-thumb">
                    <div style="width:100%;height:160px;background:linear-gradient(135deg,#1a1a2e,#2a2a48);display:flex;align-items:center;justify-content:center;color:#c9a84c;font-size:2rem;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="ec-event-date-badge">
                        <span class="ec-month"><?php echo esc_html( $event['month'] ); ?></span>
                        <span class="ec-day"><?php echo esc_html( $event['day'] ); ?></span>
                    </div>
                </div>
                <div class="ec-event-card-info">
                    <h3><?php echo esc_html( $event['title'] ); ?></h3>
                    <p><?php echo esc_html( $event['desc'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</section>
