<?php
/**
 * 404 — page not found. Friendly, on-brand, with a search and quick links.
 *
 * @package Engrafted_Chapel
 */

get_header();

ec_page_header(
    __( 'Page Not Found', 'engrafted-chapel' ),
    __( 'The page you are looking for has moved or no longer exists', 'engrafted-chapel' ),
    'ec-ph-sermons',
    __( 'Error 404', 'engrafted-chapel' )
);
?>

<section class="ec-section ec-section-white">
    <div class="ec-container ec-text-center ec-404">
        <div class="ec-404-code">404</div>
        <h2 class="ec-section-title"><?php esc_html_e( 'We couldn\'t find that page', 'engrafted-chapel' ); ?></h2>
        <p class="ec-section-desc" style="margin:0 auto 2rem;"><?php esc_html_e( 'But there is still plenty to explore. Search below or head back home.', 'engrafted-chapel' ); ?></p>

        <form role="search" method="get" class="ec-search-form ec-search-form-center" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search the site…', 'engrafted-chapel' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'engrafted-chapel' ); ?>">
            <button type="submit"><i class="fas fa-magnifying-glass" aria-hidden="true"></i></button>
        </form>

        <div class="ec-404-links">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Back to Home', 'engrafted-chapel' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-outline"><?php esc_html_e( 'Contact Us', 'engrafted-chapel' ); ?></a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
