<?php
/**
 * Lightweight SEO & social meta: description, Open Graph, Twitter Card,
 * theme colour, a branded fallback favicon, and sensible mail headers.
 * Keeps the theme launch-ready without requiring an SEO plugin (if the church
 * later installs Yoast/Rank Math, those plugins manage their own tags).
 *
 * @package Engrafted_Chapel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Build a clean meta description for the current view.
 */
function ec_meta_description() {
    $desc = '';

    if ( is_front_page() ) {
        $desc = get_theme_mod( 'ec_hero_tagline', '' );
        if ( ! $desc ) {
            $desc = get_bloginfo( 'description' );
        }
    } elseif ( is_singular() ) {
        $post = get_queried_object();
        if ( $post && has_excerpt( $post->ID ) ) {
            $desc = get_the_excerpt( $post->ID );
        } elseif ( $post ) {
            $desc = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 30 );
        }
    } elseif ( is_category() || is_tag() || is_tax() ) {
        $desc = wp_strip_all_tags( term_description() );
    } elseif ( is_post_type_archive() ) {
        $desc = wp_strip_all_tags( get_the_post_type_description() );
    }

    if ( ! $desc ) {
        $desc = get_bloginfo( 'description' );
    }
    if ( ! $desc ) {
        /* translators: %s: church name */
        $desc = sprintf( __( '%s — a place to worship, grow in faith, and serve with love. Join us for uplifting worship, biblical teaching, and a loving community.', 'engrafted-chapel' ), get_theme_mod( 'ec_church_name', 'Engrafted Word Chapel' ) );
    }

    return trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( (string) $desc ) ) );
}

/**
 * The best share image for the current view (featured image, else the hero).
 */
function ec_share_image() {
    if ( is_singular() && has_post_thumbnail() ) {
        $src = get_the_post_thumbnail_url( get_queried_object_id(), 'large' );
        if ( $src ) {
            return $src;
        }
    }
    return get_theme_mod( 'ec_hero_bg', EC_THEME_URI . '/assets/images/hero-bg.jpg' );
}

/**
 * Output the SEO / social meta tags in <head>.
 */
function ec_seo_meta() {
    $desc      = ec_meta_description();
    $title     = wp_get_document_title();
    $site_name = get_bloginfo( 'name' );
    $image     = ec_share_image();
    $is_post   = is_singular() && ! is_front_page();
    $url       = $is_post ? get_permalink() : home_url( '/' );

    echo "\n<!-- Engrafted Chapel SEO -->\n";
    if ( $desc ) {
        printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
    }
    printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $url ) );

    // Open Graph.
    printf( '<meta property="og:type" content="%s">' . "\n", $is_post ? 'article' : 'website' );
    printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( $site_name ) );
    printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
    if ( $desc ) {
        printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
    }
    printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
    if ( $image ) {
        printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
    }

    // Twitter.
    printf( '<meta name="twitter:card" content="%s">' . "\n", $image ? 'summary_large_image' : 'summary' );
    printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
    if ( $desc ) {
        printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $desc ) );
    }
    if ( $image ) {
        printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image ) );
    }
    echo "<!-- /Engrafted Chapel SEO -->\n";
}
add_action( 'wp_head', 'ec_seo_meta', 5 );

/**
 * Church structured data (Schema.org JSON-LD): name, contact, address, social
 * profiles and service times. Helps Google show a rich result with the church's
 * hours and location. Output once, site-wide.
 */
function ec_church_schema() {
    if ( is_admin() ) {
        return;
    }
    $contact = ec_get_contact_info();
    $phones  = array_filter( $contact['phones'] );

    $social = array();
    foreach ( ec_get_social_links() as $s ) {
        if ( ! empty( $s['url'] ) ) {
            $social[] = $s['url'];
        }
    }

    $logo = has_site_icon() ? get_site_icon_url( 512 ) : EC_THEME_URI . '/assets/images/logo-white.png';

    // Service times → openingHoursSpecification.
    $hours = array();
    if ( function_exists( 'ec_get_services' ) ) {
        foreach ( ec_get_services() as $svc ) {
            $parts = array_map( 'trim', explode( '-', (string) $svc['time'] ) );
            if ( count( $parts ) === 2 && $parts[0] && $parts[1] ) {
                $opens  = gmdate( 'H:i', strtotime( $parts[0] ) );
                $closes = gmdate( 'H:i', strtotime( $parts[1] ) );
                $hours[] = array(
                    '@type'     => 'OpeningHoursSpecification',
                    'dayOfWeek' => 'https://schema.org/' . ucfirst( strtolower( trim( $svc['day'] ) ) ),
                    'opens'     => $opens,
                    'closes'    => $closes,
                    'name'      => $svc['name'],
                );
            }
        }
    }

    $data = array(
        '@context' => 'https://schema.org',
        '@type'    => 'Church',
        'name'     => get_bloginfo( 'name' ),
        'url'      => home_url( '/' ),
        'logo'     => $logo,
        'image'    => ec_share_image(),
        'email'    => $contact['email'],
        'address'  => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => $contact['address'],
            'addressLocality' => 'Accra',
            'addressCountry'  => 'GH',
        ),
    );
    $desc = get_bloginfo( 'description' );
    if ( $desc ) {
        $data['description'] = $desc;
    }
    if ( $phones ) {
        $data['telephone'] = reset( $phones );
    }
    if ( $social ) {
        $data['sameAs'] = array_values( array_unique( $social ) );
    }
    if ( $hours ) {
        $data['openingHoursSpecification'] = $hours;
    }

    echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
}
add_action( 'wp_head', 'ec_church_schema', 20 );

/**
 * Brand colour + a fallback favicon (only when no Site Icon has been set in
 * Appearance → Customize → Site Identity, which is always preferable).
 */
function ec_head_branding() {
    echo '<meta name="theme-color" content="#0a0a0a">' . "\n";
    if ( ! has_site_icon() ) {
        printf( '<link rel="icon" type="image/svg+xml" href="%s">' . "\n", esc_url( EC_THEME_URI . '/assets/images/favicon.svg' ) );
    }
}
add_action( 'wp_head', 'ec_head_branding', 2 );

/**
 * Sensible default From header so form mail isn't sent as "wordpress@…".
 * (For reliable delivery on live hosting, install an SMTP plugin.)
 */
function ec_mail_from_name() {
    return get_theme_mod( 'ec_church_name', 'Engrafted Word Chapel' );
}
add_filter( 'wp_mail_from_name', 'ec_mail_from_name' );

function ec_mail_from( $from ) {
    $host = wp_parse_url( home_url(), PHP_URL_HOST );
    $host = preg_replace( '/^www\./', '', (string) $host );
    if ( $host && false === strpos( $host, '.local' ) ) {
        return 'noreply@' . $host;
    }
    return $from;
}
add_filter( 'wp_mail_from', 'ec_mail_from' );
