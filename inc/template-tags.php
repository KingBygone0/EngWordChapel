<?php
/**
 * Template Tags
 *
 * @package Engrafted_Chapel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Posted on / by
 */
function ec_posted_on() {
    $time_string = '<time datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time datetime="%1$s">%2$s</time><time datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_html( get_the_modified_date() )
    );

    printf(
        '<span class="posted-on">%1$s</span>',
        $time_string
    );
}

/**
 * Post thumbnail
 */
function ec_post_thumbnail() {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) :
        ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail( 'large', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
        </div>
    <?php else : ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php the_post_thumbnail( 'medium_large', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
        </a>
    <?php
    endif;
}

/**
 * Entry footer
 */
function ec_entry_footer() {
    if ( 'post' === get_post_type() ) {
        $categories_list = get_the_category_list( esc_html__( ', ', 'engrafted-chapel' ) );
        if ( $categories_list ) {
            printf( '<span class="cat-links">%1$s</span>', $categories_list );
        }

        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'engrafted-chapel' ) );
        if ( $tags_list ) {
            printf( '<span class="tags-links">%1$s</span>', $tags_list );
        }
    }

    edit_post_link(
        sprintf(
            wp_kses(
                __( 'Edit <span class="screen-reader-text">%s</span>', 'engrafted-chapel' ),
                array( 'span' => array( 'class' => array() ) )
            ),
            get_the_title()
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

/**
 * Display ministry card
 */
function ec_ministry_card( $ministry ) {
    $slogan = get_post_meta( $ministry->ID, '_ec_ministry_slogan', true );
    ?>
    <div class="ec-ministry-card">
        <div class="ec-ministry-icon">
            <i class="fas fa-users"></i>
        </div>
        <h3><?php echo esc_html( get_the_title( $ministry->ID ) ); ?></h3>
        <?php if ( $slogan ) : ?>
            <p class="ec-ministry-slogan"><?php echo esc_html( $slogan ); ?></p>
        <?php endif; ?>
        <p><?php echo esc_html( wp_trim_words( get_the_excerpt( $ministry->ID ), 15 ) ); ?></p>
        <a href="<?php echo esc_url( get_permalink( $ministry->ID ) ); ?>" class="ec-ministry-link">
            <?php esc_html_e( 'Learn More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    <?php
}

/**
 * Display sermon card
 */
function ec_sermon_card( $post ) {
    $speaker = get_post_meta( $post->ID, '_ec_sermon_speaker', true );
    $video   = get_post_meta( $post->ID, '_ec_sermon_video', true );
    ?>
    <div class="ec-sermon-card">
        <div class="ec-sermon-thumb">
            <?php if ( has_post_thumbnail( $post->ID ) ) : ?>
                <?php echo get_the_post_thumbnail( $post->ID, 'medium_large' ); ?>
            <?php else : ?>
                <div style="width:100%;height:220px;background:linear-gradient(135deg,#1a1a2e,#2a2a48);display:flex;align-items:center;justify-content:center;color:#c9a84c;font-size:3rem;">
                    <i class="fas fa-cross"></i>
                </div>
            <?php endif; ?>
            <?php if ( $video ) : ?>
                <a href="<?php echo esc_url( $video ); ?>" class="ec-sermon-play" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Watch Sermon', 'engrafted-chapel' ); ?>">
                    <i class="fas fa-play"></i>
                </a>
            <?php endif; ?>
        </div>
        <div class="ec-sermon-info">
            <div class="ec-sermon-date"><?php echo get_the_date( 'M j, Y', $post->ID ); ?></div>
            <h3 class="ec-sermon-title"><a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo esc_html( get_the_title( $post->ID ) ); ?></a></h3>
            <?php if ( $speaker ) : ?>
                <p class="ec-sermon-speaker"><i class="fas fa-user"></i> <?php echo esc_html( $speaker ); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Display event item
 */
function ec_event_item( $post ) {
    $date  = get_post_meta( $post->ID, '_ec_event_date', true );
    $time  = get_post_meta( $post->ID, '_ec_event_time', true );
    $venue = get_post_meta( $post->ID, '_ec_event_venue', true );

    $day   = $date ? gmdate( 'd', strtotime( $date ) ) : '';
    $month = $date ? gmdate( 'M', strtotime( $date ) ) : '';
    ?>
    <div class="ec-event-item">
        <div class="ec-event-date">
            <span class="ec-day"><?php echo esc_html( $day ); ?></span>
            <span class="ec-month"><?php echo esc_html( $month ); ?></span>
        </div>
        <div class="ec-event-info">
            <h3><a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo esc_html( get_the_title( $post->ID ) ); ?></a></h3>
            <div class="ec-event-meta">
                <?php if ( $time ) : ?>
                    <span><i class="far fa-clock"></i> <?php echo esc_html( $time ); ?></span>
                <?php endif; ?>
                <?php if ( $venue ) : ?>
                    <span><i class="fas fa-map-marker-alt"></i> <?php echo esc_html( $venue ); ?></span>
                <?php endif; ?>
            </div>
            <p><?php echo esc_html( wp_trim_words( get_the_excerpt( $post->ID ), 20 ) ); ?></p>
        </div>
    </div>
    <?php
}
