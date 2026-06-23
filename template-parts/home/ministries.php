<?php
/**
 * Ministries Section
 *
 * @package Engrafted_Chapel
 */

$ministry_query = ec_get_ministries( 4 );
?>

<section class="ec-section ec-section-dark" id="ministries">
    <div class="ec-container">
        <div class="ec-section-header-row">
            <div>
                <span class="ec-section-label"><?php esc_html_e( 'Get Involved', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php echo esc_html( get_theme_mod( 'ec_ministries_title', __( 'Ministries', 'engrafted-chapel' ) ) ); ?></h2>
            </div>
            <a href="<?php echo esc_url( home_url( '/ministries' ) ); ?>" class="ec-view-all">
                <?php esc_html_e( 'View All Ministries', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="ec-ministry-grid-alt">
            <?php if ( $ministry_query->have_posts() ) : ?>
                <?php while ( $ministry_query->have_posts() ) : $ministry_query->the_post(); ?>
                    <?php
                    $slogan = get_post_meta( get_the_ID(), '_ec_ministry_slogan', true );
                    $icons  = array( 'fa-child', 'fa-fire', 'fa-female', 'fa-male', 'fa-music', 'fa-hands-helping' );
                    $icon   = $icons[ $ministry_query->current_post % count( $icons ) ];
                    ?>
                    <div class="ec-ministry-card-alt">
                        <i class="fas <?php echo esc_attr( $icon ); ?>"></i>
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?></p>
                        <a href="<?php the_permalink(); ?>" class="ec-learn-more">
                            <?php esc_html_e( 'Learn More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="ec-ministry-card-alt">
                    <i class="fas fa-child"></i>
                    <h3><?php esc_html_e( 'Kids', 'engrafted-chapel' ); ?></h3>
                    <p><?php esc_html_e( 'Fun and faith-filled environments for children to grow.', 'engrafted-chapel' ); ?></p>
                    <a href="#" class="ec-learn-more"><?php esc_html_e( 'Learn More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="ec-ministry-card-alt">
                    <i class="fas fa-fire"></i>
                    <h3><?php esc_html_e( 'Youth', 'engrafted-chapel' ); ?></h3>
                    <p><?php esc_html_e( 'Helping students build a relationship with Jesus.', 'engrafted-chapel' ); ?></p>
                    <a href="#" class="ec-learn-more"><?php esc_html_e( 'Learn More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="ec-ministry-card-alt">
                    <i class="fas fa-users"></i>
                    <h3><?php esc_html_e( 'Groups', 'engrafted-chapel' ); ?></h3>
                    <p><?php esc_html_e( 'Find community and grow in your faith together.', 'engrafted-chapel' ); ?></p>
                    <a href="#" class="ec-learn-more"><?php esc_html_e( 'Learn More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="ec-ministry-card-alt">
                    <i class="fas fa-hand-holding-heart"></i>
                    <h3><?php esc_html_e( 'Outreach', 'engrafted-chapel' ); ?></h3>
                    <p><?php esc_html_e( 'Loving our community and making a difference.', 'engrafted-chapel' ); ?></p>
                    <a href="#" class="ec-learn-more"><?php esc_html_e( 'Learn More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
