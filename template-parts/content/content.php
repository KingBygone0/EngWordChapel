<?php
/**
 * Template part for displaying posts
 *
 * @package Engrafted_Chapel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'ec-content-block' ); ?>>
    <header class="entry-header">
        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
    </header>
    <?php ec_post_thumbnail(); ?>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    <footer class="entry-footer">
        <?php ec_entry_footer(); ?>
    </footer>
</article>
