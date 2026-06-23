<?php
/**
 * Blog post card (used in archive, blog index and search results).
 *
 * @package Engrafted_Chapel
 */

$ec_cats = get_the_category();
?>
<article <?php post_class( 'ec-blog-card' ); ?>>
    <a class="ec-blog-thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large' ); ?>
        <?php else : ?>
            <span class="ec-blog-thumb-fallback"><i class="fas fa-feather-pointed" aria-hidden="true"></i></span>
        <?php endif; ?>
    </a>
    <div class="ec-blog-info">
        <div class="ec-blog-meta">
            <span><i class="far fa-calendar" aria-hidden="true"></i> <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
            <?php if ( ! empty( $ec_cats ) ) : ?>
                <span class="ec-dot"></span><span><?php echo esc_html( $ec_cats[0]->name ); ?></span>
            <?php endif; ?>
        </div>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
        <a href="<?php the_permalink(); ?>" class="ec-learn-more"><?php esc_html_e( 'Read More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
    </div>
</article>
