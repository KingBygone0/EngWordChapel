<?php
/**
 * The main template file
 *
 * @package Engrafted_Chapel
 */

get_header();
?>

<div class="ec-container ec-mt-3 ec-mb-3">
    <div class="ec-row">
        <div class="ec-col-12">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/content/content', get_post_type() ); ?>
                <?php endwhile; ?>

                <?php the_posts_navigation(); ?>

            <?php else : ?>
                <?php get_template_part( 'template-parts/content/content', 'none' ); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>