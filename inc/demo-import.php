<?php
/**
 * One-click demo content: import the church's bundled photos into the Media
 * Library, create Gallery items, and assign hero / about / pastor / outreach
 * images — automatically, the first time the theme runs in the dashboard.
 *
 * Idempotent: each photo is imported once (tracked by `_ec_src` meta), Gallery
 * items aren't duplicated, and image settings are only filled when still empty,
 * so it never overwrites the church's own choices. Resumable if it times out.
 *
 * @package Engrafted_Chapel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Run the bundled-photo import once (guarded by an option flag).
 */
function ec_import_demo_photos() {
    if ( ! is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
        return;
    }
    if ( get_option( 'ec_demo_photos_imported' ) ) {
        return;
    }

    // If the site already has gallery photos (migrated or populated site),
    // skip the bundled demo import entirely so we never create duplicates.
    $existing = get_posts( array( 'post_type' => 'ec_gallery', 'posts_per_page' => 1, 'fields' => 'ids', 'no_found_rows' => true ) );
    if ( $existing ) {
        update_option( 'ec_demo_photos_imported', EC_VERSION );
        return;
    }

    $dir = EC_THEME_DIR . '/assets/images/gallery/';
    if ( ! is_dir( $dir ) ) {
        update_option( 'ec_demo_photos_imported', EC_VERSION );
        return;
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    @set_time_limit( 0 ); // phpcs:ignore

    // Which photo fills which image slot (only set if the slot is still empty).
    $pastor_base = '679689714_26653804900948012_2947702376161313564_n.jpg';
    $slot_map    = array(
        '473194246_918251840434193_8871017215649561282_n.jpg' => array( 'ec_hero_bg' ),
        '472831059_918260343766676_4232066882456457647_n.jpg' => array( 'ec_welcome_image' ),
        '473706789_920699810189396_6705923348889381149_n.jpg' => array( 'ec_outreach_img_1' ),
        '475069019_929517585974285_436559226267261058_n.jpg'  => array( 'ec_outreach_img_2' ),
        '473617452_919057967020247_6318110215078638606_n.jpg' => array( 'ec_outreach_img_3' ),
    );

    $files = glob( $dir . '*.jpg' );
    if ( empty( $files ) ) {
        update_option( 'ec_demo_photos_imported', EC_VERSION );
        return;
    }
    sort( $files );
    $order = 1;

    foreach ( $files as $file ) {
        $base = basename( $file );

        // Reuse an existing attachment if this photo was already imported.
        $found = get_posts( array(
            'post_type'      => 'attachment',
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'meta_key'       => '_ec_src',
            'meta_value'     => $base,
            'no_found_rows'  => true,
        ) );
        $aid = $found ? (int) $found[0] : 0;

        if ( ! $aid ) {
            $up   = wp_upload_dir();
            if ( ! empty( $up['error'] ) ) {
                continue;
            }
            $dest = trailingslashit( $up['path'] ) . wp_unique_filename( $up['path'], $base );
            if ( ! @copy( $file, $dest ) ) { // phpcs:ignore
                continue;
            }
            $type = wp_check_filetype( $dest );
            $aid  = wp_insert_attachment( array(
                'post_mime_type' => $type['type'],
                'post_title'     => ( $base === $pastor_base ) ? 'Rev. Clifford De-graft Ade' : 'Engrafted Word Chapel',
                'post_status'    => 'inherit',
            ), $dest );
            if ( is_wp_error( $aid ) || ! $aid ) {
                continue;
            }
            wp_update_attachment_metadata( $aid, wp_generate_attachment_metadata( $aid, $dest ) );
            update_post_meta( $aid, '_ec_src', $base );
        }

        $url = wp_get_attachment_url( $aid );

        // Pastor photo: fills the pastor slot, not a Gallery item.
        if ( $base === $pastor_base ) {
            if ( $url && ! get_theme_mod( 'ec_pastor_image' ) ) {
                set_theme_mod( 'ec_pastor_image', $url );
            }
            continue;
        }

        // Create a Gallery item for this photo (once).
        $has_item = get_posts( array(
            'post_type'      => 'ec_gallery',
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'meta_key'       => '_thumbnail_id',
            'meta_value'     => $aid,
            'no_found_rows'  => true,
        ) );
        if ( ! $has_item ) {
            $pid = wp_insert_post( array(
                'post_type'   => 'ec_gallery',
                'post_status' => 'publish',
                'post_title'  => __( 'Worship & Fellowship', 'engrafted-chapel' ),
                'menu_order'  => $order,
            ) );
            if ( $pid && ! is_wp_error( $pid ) ) {
                set_post_thumbnail( $pid, $aid );
            }
        }
        $order++;

        // Fill any image slot this photo maps to (only if empty).
        if ( $url && isset( $slot_map[ $base ] ) ) {
            foreach ( $slot_map[ $base ] as $mod ) {
                if ( ! get_theme_mod( $mod ) ) {
                    set_theme_mod( $mod, $url );
                }
            }
        }
    }

    update_option( 'ec_demo_photos_imported', EC_VERSION );
}
add_action( 'admin_init', 'ec_import_demo_photos' );
