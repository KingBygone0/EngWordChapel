<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Engrafted_Chapel
 */
?>

<div class="ec-content-block ec-text-center">
    <h2><?php esc_html_e( 'Nothing Found', 'engrafted-chapel' ); ?></h2>
    <p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'engrafted-chapel' ); ?></p>
    <?php get_search_form(); ?>
</div>
