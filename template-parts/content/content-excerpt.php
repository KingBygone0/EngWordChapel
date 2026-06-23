<?php
/**
 * Template part for displaying post excerpts
 *
 * @package Engrafted_Chapel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'ec-sermon-card' ); ?>>
    <div class="ec-sermon-thumb">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large' ); ?>
        <?php else : ?>
            <div style="width:100%;height:220px;background:linear-gradient(135deg,#1a1a2e,#2a2a48);display:flex;align-items:center;justify-content:center;color:#c9a84c;font-size:3rem;">
                <i class="fas fa-cross"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="ec-sermon-info">
        <div class="ec-sermon-date"><?php echo get_the_date( 'M j, Y' ); ?></div>
        <h3 class="ec-sermon-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?></p>
    </div>
</article>
