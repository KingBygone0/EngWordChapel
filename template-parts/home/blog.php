<?php
/**
 * Latest Blog Section
 *
 * The Emanu "Latest Blog" three-up grid, pulling the church's most recent
 * standard posts. Renders nothing if there are no published posts yet.
 *
 * @package Engrafted_Chapel
 */

$ec_blog_query = new WP_Query( array(
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
) );

if ( ! $ec_blog_query->have_posts() ) {
    wp_reset_postdata();
    return;
}
?>

<section class="ec-section ec-section-light ec-blog" id="blog">
    <div class="ec-container">
        <div class="ec-section-header-row">
            <div>
                <span class="ec-section-label"><?php esc_html_e( 'From the Journal', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Latest Blog', 'engrafted-chapel' ); ?></h2>
            </div>
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog' ) ); ?>" class="ec-view-all">
                <?php esc_html_e( 'View All Posts', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

        <div class="ec-blog-grid">
            <?php while ( $ec_blog_query->have_posts() ) : $ec_blog_query->the_post(); ?>
            <article class="ec-blog-card">
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
                        <?php
                        $ec_cats = get_the_category();
                        if ( ! empty( $ec_cats ) ) :
                            ?>
                            <span class="ec-dot"></span>
                            <span><?php echo esc_html( $ec_cats[0]->name ); ?></span>
                        <?php endif; ?>
                    </div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="ec-learn-more">
                        <?php esc_html_e( 'Read More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>
