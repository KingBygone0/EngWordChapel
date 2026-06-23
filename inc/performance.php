<?php
/**
 * Front-end performance: resource hints, non-render-blocking webfonts & icon
 * CSS, deferred JS, and an LCP preload for the hero image. These remove the
 * main render-blocking requests so the page paints fast.
 *
 * @package Engrafted_Chapel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Preconnect to the font / icon CDNs so their connections open early.
 */
function ec_resource_hints( $urls, $relation ) {
    if ( 'preconnect' === $relation ) {
        $urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous' );
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = 'https://cdnjs.cloudflare.com';
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'ec_resource_hints', 10, 2 );

/**
 * Load the webfont + Font Awesome stylesheets without blocking first paint
 * (media="print" → swap to "all" on load), with a <noscript> fallback.
 */
function ec_async_styles( $html, $handle ) {
    $async = array( 'ec-google-fonts', 'ec-font-awesome' );
    if ( ! in_array( $handle, $async, true ) ) {
        return $html;
    }
    $noscript = '<noscript>' . str_replace( array( " media='print'", ' media="print"' ), '', $html ) . '</noscript>';
    $html     = str_replace( array( "media='all'", 'media="all"' ), 'media="print" onload="this.media=\'all\'"', $html );
    // If WP didn't emit a media attribute, add the print/onload directly.
    if ( false === strpos( $html, 'onload=' ) ) {
        $html = str_replace( ' />', ' media="print" onload="this.media=\'all\'" />', $html );
    }
    return $html . $noscript;
}
add_filter( 'style_loader_tag', 'ec_async_styles', 10, 2 );

/**
 * Defer the theme's JavaScript so it never blocks rendering.
 */
function ec_defer_scripts( $tag, $handle ) {
    if ( 'ec-main' === $handle && false === strpos( $tag, 'defer' ) ) {
        $tag = str_replace( ' src=', ' defer src=', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'ec_defer_scripts', 10, 2 );

/*
 * Note: the hero image is the LCP element and is served as a responsive,
 * right-sized <img> with fetchpriority="high" (see template-parts/home/hero.php),
 * so a separate full-resolution preload is intentionally NOT used — that would
 * fight the srcset and double-download.
 */
