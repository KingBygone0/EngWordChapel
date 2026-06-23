<?php
/**
 * Search results. Card grid of matches across the site.
 *
 * @package Engrafted_Chapel
 */

get_header();

global $wp_query;
$ec_count = (int) $wp_query->found_posts;

ec_page_header(
    /* translators: %s: search query */
    sprintf( __( 'Search results for “%s”', 'engrafted-chapel' ), get_search_query() ),
    /* translators: %d: number of results */
    sprintf( _n( '%d result found', '%d results found', $ec_count, 'engrafted-chapel' ), $ec_count ),
    'ec-ph-sermons',
    __( 'Search', 'engrafted-chapel' )
);
?>

<section class="ec-section ec-section-white">
    <div class="ec-container">

        <form role="search" method="get" class="ec-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search the site…', 'engrafted-chapel' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'engrafted-chapel' ); ?>">
            <button type="submit"><i class="fas fa-magnifying-glass" aria-hidden="true"></i> <?php esc_html_e( 'Search', 'engrafted-chapel' ); ?></button>
        </form>

        <?php if ( have_posts() ) : ?>
            <div class="ec-blog-grid ec-mt-2">
                <?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content/content', 'card' ); endwhile; ?>
            </div>
            <div class="ec-archive-pagination">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                ) );
                ?>
            </div>
        <?php else : ?>
            <div class="ec-text-center ec-mt-3">
                <h2 class="ec-section-title"><?php esc_html_e( 'No matches found', 'engrafted-chapel' ); ?></h2>
                <p class="ec-section-desc" style="margin:0 auto;"><?php esc_html_e( 'Try a different word, or explore the site from the menu above.', 'engrafted-chapel' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
