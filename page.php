<?php
/**
 * The template for displaying all pages
 *
 * @package Engrafted_Chapel
 */

get_header();
?>

<?php if ( has_post_thumbnail() ) : ?>
<div class="ec-page-header">
    <div class="ec-page-header-bg" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>');"></div>
    <div class="ec-page-header-overlay"></div>
    <div class="ec-page-header-content">
        <h1><?php the_title(); ?></h1>
    </div>
</div>
<?php endif; ?>

<div class="ec-container ec-page-content">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="ec-content-block">
            <?php the_content(); ?>
            <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'engrafted-chapel' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>
        <?php if ( comments_open() || get_comments_number() ) : ?>
            <?php comments_template(); ?>
        <?php endif; ?>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>