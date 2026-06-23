<?php
/**
 * Template Functions
 *
 * @package Engrafted_Chapel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check if a homepage section is enabled
 */
function ec_section_enabled( $section ) {
    return get_theme_mod( 'ec_show_' . $section, true );
}

/**
 * Get customizer option with fallback
 */
function ec_get_theme_mod( $key, $default = '' ) {
    return get_theme_mod( $key, $default );
}

/**
 * Get social media links
 */
function ec_get_social_links() {
    $platforms = ec_social_platforms();
    $defaults  = array(
        'facebook'  => 'https://facebook.com/EngWordChapel',
        'twitter'   => 'https://twitter.com/EngWordChapel',
        'instagram' => 'https://instagram.com/engwordchapel_',
        'tiktok'    => 'https://tiktok.com/@engwordchapel',
    );
    $links = array();
    foreach ( $platforms as $key => $label ) {
        $url = get_theme_mod( 'ec_social_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
        if ( $url ) {
            $links[ $key ] = array(
                'url'   => $url,
                'label' => $label,
                'icon'  => 'fa-' . $key,
            );
        }
    }
    return $links;
}

/**
 * Get service times
 */
function ec_get_services() {
    return array(
        array(
            'name' => ec_get_theme_mod( 'ec_service_1_name', 'Bible Voice' ),
            'day'  => ec_get_theme_mod( 'ec_service_1_day', 'Wednesday' ),
            'time' => ec_get_theme_mod( 'ec_service_1_time', '6:30 PM - 8:30 PM' ),
            'icon' => 'fa-book-open',
        ),
        array(
            'name' => ec_get_theme_mod( 'ec_service_2_name', 'Turning Point' ),
            'day'  => ec_get_theme_mod( 'ec_service_2_day', 'Friday' ),
            'time' => ec_get_theme_mod( 'ec_service_2_time', '6:30 PM - 8:30 PM' ),
            'icon' => 'fa-pray',
        ),
        array(
            'name' => ec_get_theme_mod( 'ec_service_3_name', 'Fresh Word Encounter' ),
            'day'  => ec_get_theme_mod( 'ec_service_3_day', 'Sunday' ),
            'time' => ec_get_theme_mod( 'ec_service_3_time', '7:30 AM - 10:30 AM' ),
            'icon' => 'fa-church',
        ),
    );
}

/**
 * Get contact info
 */
function ec_get_contact_info() {
    return array(
        'address' => ec_get_theme_mod( 'ec_contact_address', 'P.O. Box KN 5139 Kaneshie – Accra, Ghana' ),
        'email'   => ec_get_theme_mod( 'ec_contact_email', 'engwordchapel@gmail.com' ),
        'phones'  => array(
            ec_get_theme_mod( 'ec_contact_phone1', '+233 243112227' ),
            ec_get_theme_mod( 'ec_contact_phone2', '+233 264112117' ),
            ec_get_theme_mod( 'ec_contact_phone3', '+233 302952323' ),
        ),
    );
}

/**
 * Get page header background
 */
function ec_page_header_bg() {
    if ( has_post_thumbnail() ) {
        return get_the_post_thumbnail_url( get_the_ID(), 'full' );
    }
    return EC_THEME_URI . '/assets/images/page-header-bg.jpg';
}

/**
 * Get the site logo URL.
 *
 * Uses the WordPress Custom Logo if the user has set one, otherwise falls back
 * to the bundled Engrafted Word Chapel ("The Wordhouse") logo.
 */
function ec_logo_url() {
    if ( has_custom_logo() ) {
        $logo_id = get_theme_mod( 'custom_logo' );
        $src     = wp_get_attachment_image_src( $logo_id, 'full' );
        if ( $src ) {
            return $src[0];
        }
    }
    return EC_THEME_URI . '/assets/images/logo-white.png';
}

/**
 * Hero feature highlights (the four-up bar beneath the hero headline).
 */
function ec_get_hero_features() {
    $defaults = array(
        array( 'icon' => 'fas fa-user-friends',       'title' => __( 'Real People', 'engrafted-chapel' ),     'text' => __( 'Authentic community for every season.', 'engrafted-chapel' ) ),
        array( 'icon' => 'fas fa-book-open',           'title' => __( 'Bible Centred', 'engrafted-chapel' ),    'text' => __( 'Relevant teaching that transforms.', 'engrafted-chapel' ) ),
        array( 'icon' => 'fas fa-hand-holding-heart',  'title' => __( 'Serve Others', 'engrafted-chapel' ),     'text' => __( 'Live out your faith and make a difference.', 'engrafted-chapel' ) ),
        array( 'icon' => 'far fa-calendar-alt',        'title' => __( 'Upcoming Events', 'engrafted-chapel' ),  'text' => __( 'There\'s always something happening.', 'engrafted-chapel' ) ),
    );

    $features = array();
    foreach ( $defaults as $i => $d ) {
        $n          = $i + 1;
        $features[] = array(
            'icon'  => $d['icon'],
            'title' => ec_get_theme_mod( 'ec_feature_' . $n . '_title', $d['title'] ),
            'text'  => ec_get_theme_mod( 'ec_feature_' . $n . '_text', $d['text'] ),
        );
    }
    return $features;
}

/**
 * Render a standardized page header (hero band) for inner pages.
 *
 * The eyebrow is the theme's signature device — a scripture reference or short
 * line that ties each page to the church's Word-centred identity.
 *
 * @param string $title    Heading text.
 * @param string $subtitle Optional subheading.
 * @param string $variant  Optional modifier class for per-page theming.
 * @param string $eyebrow  Optional eyebrow line (e.g. a scripture reference).
 */
function ec_page_header( $title, $subtitle = '', $variant = '', $eyebrow = '' ) {
    $bg_url = ec_page_header_bg();
    ?>
    <div class="ec-page-header <?php echo esc_attr( $variant ); ?>">
        <?php if ( $bg_url ) : ?>
            <div class="ec-page-header-bg" style="background-image: url('<?php echo esc_url( $bg_url ); ?>');"></div>
        <?php endif; ?>
        <div class="ec-page-header-overlay"></div>
        <div class="ec-page-header-content">
            <?php if ( $eyebrow ) : ?>
                <span class="ec-page-header-eyebrow"><i class="fas fa-leaf" aria-hidden="true"></i> <?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>
            <h1><?php echo esc_html( $title ); ?></h1>
            <?php if ( $subtitle ) : ?>
                <p><?php echo esc_html( $subtitle ); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Output the theme's built-in brand lockup: a crimson church badge plus the
 * church wordmark. Used in the header/footer when no Custom Logo is set. The
 * wordmark colour adapts to the header state via CSS; the badge stays crimson.
 */
function ec_brand_logo() {
    $name = get_theme_mod( 'ec_church_name', 'Engrafted Word Chapel International' );
    $sub  = '';
    if ( preg_match( '/^(.*?)\s+(International|Int\'l|Intl)\.?$/i', $name, $m ) ) {
        $name = $m[1];
        $sub  = __( 'International', 'engrafted-chapel' );
    }
    ?>
    <span class="ec-brand-mark" aria-hidden="true">
        <img src="<?php echo esc_url( EC_THEME_URI . '/assets/images/logo-white.png' ); ?>" alt="" class="ec-brand-mark-img">
    </span>
    <span class="ec-brand-text">
        <span class="ec-brand-name"><?php echo esc_html( $name ); ?></span>
        <?php if ( $sub ) : ?><span class="ec-brand-sub"><?php echo esc_html( $sub ); ?></span><?php endif; ?>
    </span>
    <?php
}

/**
 * Display a navigation menu with custom markup
 */
function ec_nav_menu() {
    wp_nav_menu( array(
        'theme_location'  => 'primary',
        'menu_id'         => 'primary-menu',
        'container'       => false,
        'items_wrap'      => '<ul>%3$s</ul>',
        'fallback_cb'     => false,
    ) );
}
