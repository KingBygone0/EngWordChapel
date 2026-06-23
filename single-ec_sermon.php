<?php
/**
 * Single Sermon template — video/audio, scripture, speaker and full message,
 * with a details sidebar and a grid of more sermons. Emanu skin throughout.
 *
 * @package Engrafted_Chapel
 */

get_header();

while ( have_posts() ) :
    the_post();

    $ec_id      = get_the_ID();
    $ec_speaker = get_post_meta( $ec_id, '_ec_sermon_speaker', true );
    $ec_verse   = get_post_meta( $ec_id, '_ec_sermon_verse', true );
    $ec_video   = get_post_meta( $ec_id, '_ec_sermon_video', true );
    $ec_audio   = get_post_meta( $ec_id, '_ec_sermon_audio', true );

    ec_page_header(
        get_the_title(),
        $ec_speaker ? sprintf( __( 'with %s', 'engrafted-chapel' ), $ec_speaker ) : __( 'Grow in faith through the Word', 'engrafted-chapel' ),
        'ec-ph-sermons',
        __( 'Romans 10:17 — Faith Comes by Hearing', 'engrafted-chapel' )
    );
    ?>

    <section class="ec-section ec-section-white ec-single-sermon">
        <div class="ec-container">
            <div class="ec-min-grid">

                <article class="ec-min-main">
                    <div class="ec-sermon-media">
                        <?php
                        $ec_embed = ec_sermon_video_embed( $ec_video );
                        if ( $ec_embed ) :
                            ?>
                            <div class="ec-sermon-video"><?php echo $ec_embed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                        <?php elseif ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', array( 'class' => 'ec-sermon-cover' ) ); ?>
                            <?php if ( $ec_video ) : ?><a class="ec-sermon-watch" href="<?php echo esc_url( $ec_video ); ?>" target="_blank" rel="noopener"><i class="fas fa-play" aria-hidden="true"></i> <?php esc_html_e( 'Watch', 'engrafted-chapel' ); ?></a><?php endif; ?>
                        <?php else : ?>
                            <div class="ec-sermon-media-fallback"><i class="fas fa-cross" aria-hidden="true"></i></div>
                        <?php endif; ?>
                    </div>

                    <div class="ec-sermon-meta-row">
                        <?php if ( $ec_speaker ) : ?><span><i class="fas fa-user" aria-hidden="true"></i> <?php echo esc_html( $ec_speaker ); ?></span><?php endif; ?>
                        <span><i class="far fa-calendar" aria-hidden="true"></i> <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                        <?php if ( $ec_verse ) : ?><span><i class="fas fa-book-bible" aria-hidden="true"></i> <?php echo esc_html( $ec_verse ); ?></span><?php endif; ?>
                    </div>

                    <h2 class="ec-min-title"><?php the_title(); ?></h2>

                    <?php if ( $ec_audio ) : ?>
                    <div class="ec-sermon-audio">
                        <span class="ec-sermon-audio-label"><i class="fas fa-headphones" aria-hidden="true"></i> <?php esc_html_e( 'Listen to the message', 'engrafted-chapel' ); ?></span>
                        <audio controls preload="none" src="<?php echo esc_url( $ec_audio ); ?>"></audio>
                    </div>
                    <?php endif; ?>

                    <div class="ec-min-content"><?php the_content(); ?></div>

                    <div class="ec-min-share">
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'ec_sermon' ) ); ?>" class="ec-back-link"><i class="fas fa-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'All Sermons', 'engrafted-chapel' ); ?></a>
                    </div>
                </article>

                <aside class="ec-min-aside">
                    <div class="ec-min-card ec-min-detail">
                        <h3><?php esc_html_e( 'Sermon Details', 'engrafted-chapel' ); ?></h3>
                        <ul class="ec-min-detail-list">
                            <?php if ( $ec_speaker ) : ?>
                            <li><span class="ec-min-detail-ico"><i class="fas fa-user" aria-hidden="true"></i></span><span><strong><?php esc_html_e( 'Speaker', 'engrafted-chapel' ); ?></strong><?php echo esc_html( $ec_speaker ); ?></span></li>
                            <?php endif; ?>
                            <li><span class="ec-min-detail-ico"><i class="far fa-calendar" aria-hidden="true"></i></span><span><strong><?php esc_html_e( 'Date', 'engrafted-chapel' ); ?></strong><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></span></li>
                            <?php if ( $ec_verse ) : ?>
                            <li><span class="ec-min-detail-ico"><i class="fas fa-book-bible" aria-hidden="true"></i></span><span><strong><?php esc_html_e( 'Scripture', 'engrafted-chapel' ); ?></strong><?php echo esc_html( $ec_verse ); ?></span></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="ec-min-card ec-min-join">
                        <span class="ec-min-join-ico"><i class="fas fa-church" aria-hidden="true"></i></span>
                        <h3><?php esc_html_e( 'Worship With Us', 'engrafted-chapel' ); ?></h3>
                        <p><?php esc_html_e( 'Hear the Word preached live. Plan your visit and join the family this week.', 'engrafted-chapel' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Plan a Visit', 'engrafted-chapel' ); ?></a>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    <?php
    $ec_more = new WP_Query( array(
        'post_type'           => 'ec_sermon',
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
                    <span class="ec-section-label"><?php esc_html_e( 'Keep Listening', 'engrafted-chapel' ); ?></span>
                    <h2 class="ec-section-title"><?php esc_html_e( 'More Sermons', 'engrafted-chapel' ); ?></h2>
                </div>
                <div class="ec-sermon-grid">
                    <?php while ( $ec_more->have_posts() ) : $ec_more->the_post(); ec_sermon_card( get_post() ); endwhile; ?>
                </div>
            </div>
        </section>
        <?php
    endif;
    wp_reset_postdata();
    ?>

<?php endwhile; ?>

<?php get_footer(); ?>
