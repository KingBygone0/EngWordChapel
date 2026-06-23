<?php
/**
 * Latest Sermons Section
 *
 * @package Engrafted_Chapel
 */

$sermon_query = ec_get_sermons( get_theme_mod( 'ec_sermons_count', 3 ) );
?>

<section class="ec-section ec-section-white" id="sermons">
    <div class="ec-container">
        <div class="ec-section-header-row">
            <div>
                <span class="ec-section-label"><?php esc_html_e( 'Watch & Listen', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php echo esc_html( get_theme_mod( 'ec_sermons_title', __( 'Latest Sermons', 'engrafted-chapel' ) ) ); ?></h2>
            </div>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'ec_sermon' ) ); ?>" class="ec-view-all">
                <?php esc_html_e( 'View All Sermons', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <?php if ( $sermon_query->have_posts() ) : ?>
        <div class="ec-sermon-grid">
            <?php while ( $sermon_query->have_posts() ) : $sermon_query->the_post(); ?>
                <?php
                $speaker = get_post_meta( get_the_ID(), '_ec_sermon_speaker', true );
                $video   = get_post_meta( get_the_ID(), '_ec_sermon_video', true );
                ?>
                <div class="ec-sermon-card">
                    <div class="ec-sermon-thumb">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium_large' ); ?>
                        <?php else : ?>
                            <div style="width:100%;height:200px;background:linear-gradient(135deg,#1a1a2e,#2a2a48);display:flex;align-items:center;justify-content:center;color:#c9a84c;font-size:3rem;">
                                <i class="fas fa-cross"></i>
                            </div>
                        <?php endif; ?>
                        <div class="ec-sermon-play-overlay">
                            <?php if ( $video ) : ?>
                            <a href="<?php echo esc_url( $video ); ?>" target="_blank" rel="noopener noreferrer" class="ec-sermon-play-btn" aria-label="<?php esc_attr_e( 'Watch Sermon', 'engrafted-chapel' ); ?>">
                                <i class="fas fa-play"></i>
                            </a>
                            <?php else : ?>
                            <a href="<?php the_permalink(); ?>" class="ec-sermon-play-btn" aria-label="<?php esc_attr_e( 'Watch Sermon', 'engrafted-chapel' ); ?>">
                                <i class="fas fa-play"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ec-sermon-info">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="ec-sermon-meta">
                            <?php if ( $speaker ) : ?>
                            <span><?php echo esc_html( $speaker ); ?></span>
                            <span class="ec-dot"></span>
                            <?php endif; ?>
                            <span><?php echo get_the_date( 'M j, Y' ); ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php else : ?>
        <div class="ec-text-center ec-mt-2">
            <p><?php esc_html_e( 'New sermons coming soon. Stay tuned!', 'engrafted-chapel' ); ?></p>
        </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</section>
