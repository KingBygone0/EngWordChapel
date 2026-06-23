<?php
/**
 * Template Name: Sermons
 * The template for the Sermons page
 *
 * @package Engrafted_Chapel
 */

get_header();

ec_page_header(
    get_the_title(),
    __( 'Grow in faith through the teaching of God\'s Word', 'engrafted-chapel' ),
    'ec-ph-sermons',
    __( 'Romans 10:17 — Faith Comes by Hearing', 'engrafted-chapel' )
);
?>

<div class="ec-container ec-page-content ec-page-sermons">
    <?php
    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    $sermon_query = new WP_Query( array(
        'post_type'      => 'ec_sermon',
        'posts_per_page' => 9,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
    ?>

    <?php if ( $sermon_query->have_posts() ) : ?>
        <div class="ec-sermons-archive">
            <?php while ( $sermon_query->have_posts() ) : $sermon_query->the_post(); ?>
                <?php ec_sermon_card( $sermon_query->post ); ?>
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
        <div class="ec-content-block ec-text-center">
            <h2><?php esc_html_e( 'No sermons yet', 'engrafted-chapel' ); ?></h2>
            <p><?php esc_html_e( 'New sermons will be added soon. Please check back later.', 'engrafted-chapel' ); ?></p>
        </div>
    <?php endif; wp_reset_postdata(); ?>

    <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>