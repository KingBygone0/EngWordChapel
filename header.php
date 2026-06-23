<?php
/**
 * The Header
 *
 * @package Engrafted_Chapel
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<button class="ec-menu-toggle" id="ec-menu-toggle" aria-controls="ec-main-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Menu', 'engrafted-chapel' ); ?>">
    <span></span>
    <span></span>
    <span></span>
</button>

<header class="ec-header" id="ec-header">
    <div class="ec-header-inner">
        <div class="ec-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="ec-logo-link">
                <?php if ( has_custom_logo() ) : ?>
                    <img src="<?php echo esc_url( ec_logo_url() ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'ec_church_name', 'Engrafted Word Chapel' ) ); ?>" class="ec-logo-img">
                <?php else : ?>
                    <?php ec_brand_logo(); ?>
                <?php endif; ?>
            </a>
        </div>

        <nav class="ec-main-nav" id="ec-main-nav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'items_wrap'     => '<ul>%3$s</ul>',
                'fallback_cb'    => function() {
                    echo '<ul>';
                    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'engrafted-chapel' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . esc_html__( 'About', 'engrafted-chapel' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/ministries' ) ) . '">' . esc_html__( 'Ministries', 'engrafted-chapel' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/outreach' ) ) . '">' . esc_html__( 'Outreach', 'engrafted-chapel' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/events' ) ) . '">' . esc_html__( 'Events', 'engrafted-chapel' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">' . esc_html__( 'Contact', 'engrafted-chapel' ) . '</a></li>';
                    echo '</ul>';
                },
            ) );
            ?>
        </nav>

        <?php
        // Header button — only rendered when text is set (Appearance →
        // Customize → General → "Header Button Text"). Empty hides it.
        $ec_cta_text = trim( (string) get_theme_mod( 'ec_header_cta_text', '' ) );
        if ( '' !== $ec_cta_text ) :
            ?>
            <div class="ec-header-cta">
                <a href="<?php echo esc_url( get_theme_mod( 'ec_header_cta_url', home_url( '/contact' ) ) ); ?>" class="ec-btn-new">
                    <?php echo esc_html( $ec_cta_text ); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</header>

<div class="ec-page-wrap">
