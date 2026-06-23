<?php
/**
 * Engrafted Chapel Theme Functions
 *
 * @package Engrafted_Chapel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define theme constants
if ( ! defined( 'EC_VERSION' ) ) {
    define( 'EC_VERSION', '2.4.6' );
}
if ( ! defined( 'EC_THEME_DIR' ) ) {
    define( 'EC_THEME_DIR', get_template_directory() );
}
if ( ! defined( 'EC_THEME_URI' ) ) {
    define( 'EC_THEME_URI', get_template_directory_uri() );
}

/**
 * Theme Setup
 */
function ec_setup() {
    // Add theme support
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ) );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Register menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'engrafted-chapel' ),
        'footer'  => esc_html__( 'Footer Menu', 'engrafted-chapel' ),
    ) );

    // Set content width
    if ( ! isset( $content_width ) ) {
        $content_width = 1200;
    }
}
add_action( 'after_setup_theme', 'ec_setup' );

/**
 * Enqueue Scripts and Styles
 */
function ec_scripts() {
    // Google Fonts — Emanu pairing: Phudu (display) + Instrument Sans (body).
    wp_enqueue_style(
        'ec-google-fonts',
        'https://fonts.googleapis.com/css2?family=Phudu:wght@300..900&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Font Awesome (CDN for icons)
    wp_enqueue_style(
        'ec-font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );

    // Main theme stylesheet
    wp_enqueue_style(
        'ec-style',
        get_stylesheet_uri(),
        array(),
        EC_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'ec-main',
        EC_THEME_URI . '/assets/js/main.js',
        array(),
        EC_VERSION,
        true
    );

    // Pass theme options to JS
    wp_localize_script( 'ec-main', 'ec_theme', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ) );

    // Comment reply script on single posts
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ec_scripts' );

/**
 * Register Widget Areas
 */
function ec_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 1', 'engrafted-chapel' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'First footer widget area', 'engrafted-chapel' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 2', 'engrafted-chapel' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Second footer widget area', 'engrafted-chapel' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 3', 'engrafted-chapel' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Third footer widget area', 'engrafted-chapel' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'ec_widgets_init' );

// ============================================
// CUSTOM POST TYPES
// ============================================

/**
 * Register Sermon Post Type
 */
function ec_register_sermon_post_type() {
    $labels = array(
        'name'                  => _x( 'Sermons', 'Post type general name', 'engrafted-chapel' ),
        'singular_name'         => _x( 'Sermon', 'Post type singular name', 'engrafted-chapel' ),
        'menu_name'             => _x( 'Sermons', 'Admin Menu', 'engrafted-chapel' ),
        'add_new'               => __( 'Add New', 'engrafted-chapel' ),
        'add_new_item'          => __( 'Add New Sermon', 'engrafted-chapel' ),
        'edit_item'             => __( 'Edit Sermon', 'engrafted-chapel' ),
        'new_item'              => __( 'New Sermon', 'engrafted-chapel' ),
        'view_item'             => __( 'View Sermon', 'engrafted-chapel' ),
        'search_items'          => __( 'Search Sermons', 'engrafted-chapel' ),
        'not_found'             => __( 'No sermons found', 'engrafted-chapel' ),
        'not_found_in_trash'    => __( 'No sermons found in Trash', 'engrafted-chapel' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'sermon' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-video',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'ec_sermon', $args );
}
add_action( 'init', 'ec_register_sermon_post_type' );

/**
 * Register Event Post Type
 */
function ec_register_event_post_type() {
    $labels = array(
        'name'                  => _x( 'Events', 'Post type general name', 'engrafted-chapel' ),
        'singular_name'         => _x( 'Event', 'Post type singular name', 'engrafted-chapel' ),
        'menu_name'             => _x( 'Events', 'Admin Menu', 'engrafted-chapel' ),
        'add_new'               => __( 'Add New', 'engrafted-chapel' ),
        'add_new_item'          => __( 'Add New Event', 'engrafted-chapel' ),
        'edit_item'             => __( 'Edit Event', 'engrafted-chapel' ),
        'new_item'              => __( 'New Event', 'engrafted-chapel' ),
        'view_item'             => __( 'View Event', 'engrafted-chapel' ),
        'search_items'          => __( 'Search Events', 'engrafted-chapel' ),
        'not_found'             => __( 'No events found', 'engrafted-chapel' ),
        'not_found_in_trash'    => __( 'No events found in Trash', 'engrafted-chapel' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'event' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'ec_event', $args );
}
add_action( 'init', 'ec_register_event_post_type' );

/**
 * Register Testimony Post Type
 */
function ec_register_testimony_post_type() {
    $labels = array(
        'name'                  => _x( 'Testimonies', 'Post type general name', 'engrafted-chapel' ),
        'singular_name'         => _x( 'Testimony', 'Post type singular name', 'engrafted-chapel' ),
        'menu_name'             => _x( 'Testimonies', 'Admin Menu', 'engrafted-chapel' ),
        'add_new'               => __( 'Add New', 'engrafted-chapel' ),
        'add_new_item'          => __( 'Add New Testimony', 'engrafted-chapel' ),
        'edit_item'             => __( 'Edit Testimony', 'engrafted-chapel' ),
        'new_item'              => __( 'New Testimony', 'engrafted-chapel' ),
        'view_item'             => __( 'View Testimony', 'engrafted-chapel' ),
        'search_items'          => __( 'Search Testimonies', 'engrafted-chapel' ),
        'not_found'             => __( 'No testimonies found', 'engrafted-chapel' ),
        'not_found_in_trash'    => __( 'No testimonies found in Trash', 'engrafted-chapel' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimony' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'ec_testimony', $args );
}
add_action( 'init', 'ec_register_testimony_post_type' );

/**
 * Register Ministry Post Type
 */
function ec_register_ministry_post_type() {
    $labels = array(
        'name'                  => _x( 'Ministries', 'Post type general name', 'engrafted-chapel' ),
        'singular_name'         => _x( 'Ministry', 'Post type singular name', 'engrafted-chapel' ),
        'menu_name'             => _x( 'Ministries', 'Admin Menu', 'engrafted-chapel' ),
        'add_new'               => __( 'Add New', 'engrafted-chapel' ),
        'add_new_item'          => __( 'Add New Ministry', 'engrafted-chapel' ),
        'edit_item'             => __( 'Edit Ministry', 'engrafted-chapel' ),
        'new_item'              => __( 'New Ministry', 'engrafted-chapel' ),
        'view_item'             => __( 'View Ministry', 'engrafted-chapel' ),
        'search_items'          => __( 'Search Ministries', 'engrafted-chapel' ),
        'not_found'             => __( 'No ministries found', 'engrafted-chapel' ),
        'not_found_in_trash'    => __( 'No ministries found in Trash', 'engrafted-chapel' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'ministry' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'ec_ministry', $args );
}
add_action( 'init', 'ec_register_ministry_post_type' );

/**
 * Register Gallery Post Type — one photo per item (set as Featured Image).
 */
function ec_register_gallery_post_type() {
    $labels = array(
        'name'               => _x( 'Gallery', 'Post type general name', 'engrafted-chapel' ),
        'singular_name'      => _x( 'Photo', 'Post type singular name', 'engrafted-chapel' ),
        'menu_name'          => _x( 'Gallery', 'Admin Menu', 'engrafted-chapel' ),
        'add_new'            => __( 'Add Photo', 'engrafted-chapel' ),
        'add_new_item'       => __( 'Add New Photo', 'engrafted-chapel' ),
        'edit_item'          => __( 'Edit Photo', 'engrafted-chapel' ),
        'new_item'           => __( 'New Photo', 'engrafted-chapel' ),
        'view_item'          => __( 'View Photo', 'engrafted-chapel' ),
        'search_items'       => __( 'Search Photos', 'engrafted-chapel' ),
        'not_found'          => __( 'No photos found', 'engrafted-chapel' ),
        'not_found_in_trash' => __( 'No photos found in Trash', 'engrafted-chapel' ),
    );

    register_post_type( 'ec_gallery', array(
        'labels'        => $labels,
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'has_archive'   => false,
        'rewrite'       => array( 'slug' => 'gallery-photo' ),
        'menu_position' => 9,
        'menu_icon'     => 'dashicons-format-gallery',
        'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
        'show_in_rest'  => true,
    ) );
}
add_action( 'init', 'ec_register_gallery_post_type' );

/**
 * Get gallery photos (ordered by menu order, then newest).
 */
function ec_get_gallery( $count = -1 ) {
    return new WP_Query( array(
        'post_type'      => 'ec_gallery',
        'posts_per_page' => $count,
        'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
    ) );
}

// ============================================
// ALBUMS — one album per Sunday, many photos each
// ============================================

/**
 * Register the Albums custom post type. Each album is a dated collection of
 * photos (e.g. "Sunday Service — June 22, 2026"). Photos are attached through
 * the "Album Photos" meta box; the Featured Image acts as the album cover.
 */
function ec_register_album_post_type() {
    $labels = array(
        'name'               => __( 'Albums', 'engrafted-chapel' ),
        'singular_name'      => __( 'Album', 'engrafted-chapel' ),
        'add_new'            => __( 'Add New', 'engrafted-chapel' ),
        'add_new_item'       => __( 'Add New Album', 'engrafted-chapel' ),
        'edit_item'          => __( 'Edit Album', 'engrafted-chapel' ),
        'new_item'           => __( 'New Album', 'engrafted-chapel' ),
        'view_item'          => __( 'View Album', 'engrafted-chapel' ),
        'all_items'          => __( 'All Albums', 'engrafted-chapel' ),
        'menu_name'          => __( 'Albums', 'engrafted-chapel' ),
        'search_items'       => __( 'Search Albums', 'engrafted-chapel' ),
        'not_found'          => __( 'No albums found', 'engrafted-chapel' ),
        'not_found_in_trash' => __( 'No albums found in Trash', 'engrafted-chapel' ),
    );

    register_post_type( 'ec_album', array(
        'labels'        => $labels,
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'has_archive'   => false,
        'rewrite'       => array( 'slug' => 'album' ),
        'menu_position' => 9,
        'menu_icon'     => 'dashicons-images-alt2',
        'supports'      => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' ),
        'show_in_rest'  => true,
    ) );
}
add_action( 'init', 'ec_register_album_post_type' );

/**
 * Get albums (newest first; a tie is broken by menu order).
 */
function ec_get_albums( $count = -1 ) {
    return new WP_Query( array(
        'post_type'      => 'ec_album',
        'posts_per_page' => $count,
        'orderby'        => array( 'date' => 'DESC', 'menu_order' => 'ASC' ),
    ) );
}

/**
 * Return the ordered list of attachment IDs saved for an album.
 *
 * @param int $album_id Album post ID.
 * @return int[] Attachment IDs (empty if none).
 */
function ec_album_image_ids( $album_id ) {
    $stored = get_post_meta( $album_id, '_ec_album_images', true );
    if ( empty( $stored ) ) {
        return array();
    }
    $ids = is_array( $stored ) ? $stored : explode( ',', $stored );
    return array_values( array_filter( array_map( 'absint', $ids ) ) );
}

/**
 * Register the "Album Photos" meta box.
 */
function ec_album_add_meta_box() {
    add_meta_box(
        'ec_album_photos',
        __( 'Album Photos', 'engrafted-chapel' ),
        'ec_album_render_meta_box',
        'ec_album',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ec_album_add_meta_box' );

/**
 * Render the multi-image picker meta box.
 *
 * @param WP_Post $post Current album.
 */
function ec_album_render_meta_box( $post ) {
    wp_nonce_field( 'ec_album_save', 'ec_album_nonce' );
    $ids = ec_album_image_ids( $post->ID );
    ?>
    <p class="description">
        <?php esc_html_e( 'Add this Sunday\'s photos here. Click "Add Photos" to upload or select many at once, then drag the thumbnails to reorder. The first photo (or the Featured Image, if set) is used as the album cover.', 'engrafted-chapel' ); ?>
    </p>
    <div class="ec-album-photos-field">
        <ul class="ec-album-photos-list" id="ec-album-photos-list">
            <?php foreach ( $ids as $id ) : $thumb = wp_get_attachment_image_url( $id, 'thumbnail' ); ?>
                <?php if ( $thumb ) : ?>
                    <li class="ec-album-photo" data-id="<?php echo esc_attr( $id ); ?>">
                        <img src="<?php echo esc_url( $thumb ); ?>" alt="">
                        <button type="button" class="ec-album-photo-remove" aria-label="<?php esc_attr_e( 'Remove photo', 'engrafted-chapel' ); ?>">&times;</button>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <p>
            <button type="button" class="button button-primary" id="ec-album-add-photos">
                <span class="dashicons dashicons-plus" style="vertical-align:text-top;"></span>
                <?php esc_html_e( 'Add Photos', 'engrafted-chapel' ); ?>
            </button>
            <button type="button" class="button" id="ec-album-clear-photos">
                <?php esc_html_e( 'Clear All', 'engrafted-chapel' ); ?>
            </button>
        </p>
        <input type="hidden" name="ec_album_images" id="ec-album-images" value="<?php echo esc_attr( implode( ',', $ids ) ); ?>">
    </div>
    <?php
}

/**
 * Save the album photo IDs.
 *
 * @param int $post_id Album ID.
 */
function ec_album_save_meta( $post_id ) {
    if ( ! isset( $_POST['ec_album_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['ec_album_nonce'] ), 'ec_album_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $raw = isset( $_POST['ec_album_images'] ) ? sanitize_text_field( wp_unslash( $_POST['ec_album_images'] ) ) : '';
    $ids = array_values( array_filter( array_map( 'absint', explode( ',', $raw ) ) ) );

    if ( $ids ) {
        update_post_meta( $post_id, '_ec_album_images', $ids );
        // Use the first photo as the cover when none has been set.
        if ( ! has_post_thumbnail( $post_id ) ) {
            set_post_thumbnail( $post_id, $ids[0] );
        }
    } else {
        delete_post_meta( $post_id, '_ec_album_images' );
    }
}
add_action( 'save_post_ec_album', 'ec_album_save_meta' );

/**
 * Load the media library + album picker script on the album edit screen.
 *
 * @param string $hook Current admin page.
 */
function ec_album_admin_scripts( $hook ) {
    if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
        return;
    }
    $screen = get_current_screen();
    if ( ! $screen || 'ec_album' !== $screen->post_type ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_style(
        'ec-album-admin',
        EC_THEME_URI . '/assets/css/admin-album.css',
        array(),
        EC_VERSION
    );
    wp_enqueue_script(
        'ec-album-admin',
        EC_THEME_URI . '/assets/js/admin-album.js',
        array( 'jquery', 'jquery-ui-sortable' ),
        EC_VERSION,
        true
    );
    wp_localize_script( 'ec-album-admin', 'ecAlbum', array(
        'title'  => __( 'Add Photos to Album', 'engrafted-chapel' ),
        'button' => __( 'Add to Album', 'engrafted-chapel' ),
    ) );
}
add_action( 'admin_enqueue_scripts', 'ec_album_admin_scripts' );

/**
 * Render an album card (used on the Albums listing page).
 *
 * @param WP_Post $album Album post.
 */
function ec_album_card( $album ) {
    $count = count( ec_album_image_ids( $album->ID ) );
    $url   = get_permalink( $album->ID );
    ?>
    <a class="ec-album-card" href="<?php echo esc_url( $url ); ?>">
        <div class="ec-album-card-cover">
            <?php if ( has_post_thumbnail( $album->ID ) ) : ?>
                <?php echo get_the_post_thumbnail( $album->ID, 'medium_large', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title( $album->ID ) ) ) ); ?>
            <?php else : ?>
                <div class="ec-album-card-fallback"><i class="fas fa-camera" aria-hidden="true"></i></div>
            <?php endif; ?>
            <?php if ( $count ) : ?>
                <span class="ec-album-card-count"><i class="fas fa-images" aria-hidden="true"></i> <?php echo esc_html( $count ); ?></span>
            <?php endif; ?>
        </div>
        <div class="ec-album-card-info">
            <span class="ec-album-card-date"><i class="far fa-calendar" aria-hidden="true"></i> <?php echo esc_html( get_the_date( 'F j, Y', $album->ID ) ); ?></span>
            <h3 class="ec-album-card-title"><?php echo esc_html( get_the_title( $album->ID ) ); ?></h3>
        </div>
    </a>
    <?php
}

// ============================================
// CUSTOM TAXONOMIES
// ============================================

/**
 * Register Sermon Series Taxonomy
 */
function ec_register_sermon_taxonomies() {
    $labels = array(
        'name'          => _x( 'Sermon Series', 'taxonomy general name', 'engrafted-chapel' ),
        'singular_name' => _x( 'Series', 'taxonomy singular name', 'engrafted-chapel' ),
        'menu_name'     => __( 'Series', 'engrafted-chapel' ),
    );

    register_taxonomy( 'ec_sermon_series', array( 'ec_sermon' ), array(
        'labels'       => $labels,
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'sermon-series' ),
        'show_in_rest' => true,
    ) );

    $speaker_labels = array(
        'name'          => _x( 'Speakers', 'taxonomy general name', 'engrafted-chapel' ),
        'singular_name' => _x( 'Speaker', 'taxonomy singular name', 'engrafted-chapel' ),
        'menu_name'     => __( 'Speakers', 'engrafted-chapel' ),
    );

    register_taxonomy( 'ec_sermon_speaker', array( 'ec_sermon' ), array(
        'labels'       => $speaker_labels,
        'hierarchical' => false,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'speaker' ),
        'show_in_rest' => true,
    ) );
}
add_action( 'init', 'ec_register_sermon_taxonomies' );

// ============================================
// HELPER FUNCTIONS
// ============================================

/**
 * Get sermons
 */
function ec_get_sermons( $count = 3 ) {
    $args = array(
        'post_type'      => 'ec_sermon',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    return new WP_Query( $args );
}

/**
 * Get upcoming events
 *
 * Orders by the event date meta (soonest first) and only returns events
 * whose date is today or later, so the homepage shows genuinely upcoming items.
 */
function ec_get_events( $count = 6 ) {
    $args = array(
        'post_type'      => 'ec_event',
        'posts_per_page' => $count,
        'meta_key'       => '_ec_event_date',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => '_ec_event_date',
                'value'   => gmdate( 'Y-m-d' ),
                'compare' => '>=',
                'type'    => 'DATE',
            ),
        ),
    );

    return new WP_Query( $args );
}

/**
 * Validate boolean (compatible with all WordPress versions)
 */
function ec_validate_boolean( $value ) {
    if ( is_bool( $value ) ) {
        return $value;
    }
    if ( is_string( $value ) ) {
        $value = strtolower( $value );
        if ( in_array( $value, array( 'false', '0', 'no', 'off' ), true ) ) {
            return false;
        }
    }
    return (bool) $value;
}

/**
 * Get testimonies
 */
function ec_get_testimonies( $count = 3 ) {
    $args = array(
        'post_type'      => 'ec_testimony',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    return new WP_Query( $args );
}

/**
 * Get ministries
 */
function ec_get_ministries( $count = -1 ) {
    $args = array(
        'post_type'      => 'ec_ministry',
        'posts_per_page' => $count,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );

    return new WP_Query( $args );
}

/**
 * Get customizer option
 */
function ec_get_option( $option, $default = '' ) {
    $value = get_theme_mod( $option, $default );
    return $value;
}

/**
 * Social icons array
 */
function ec_social_platforms() {
    return array(
        'facebook'  => __( 'Facebook', 'engrafted-chapel' ),
        'twitter'   => __( 'Twitter/X', 'engrafted-chapel' ),
        'instagram' => __( 'Instagram', 'engrafted-chapel' ),
        'tiktok'    => __( 'TikTok', 'engrafted-chapel' ),
        'youtube'   => __( 'YouTube', 'engrafted-chapel' ),
    );
}

// ============================================
// ADMIN META BOXES
// ============================================

/**
 * Add meta box for event date
 */
function ec_add_event_meta_box() {
    add_meta_box(
        'ec_event_details',
        __( 'Event Details', 'engrafted-chapel' ),
        'ec_event_meta_box_callback',
        'ec_event',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ec_add_event_meta_box' );

function ec_event_meta_box_callback( $post ) {
    wp_nonce_field( 'ec_event_meta', 'ec_event_meta_nonce' );

    $date  = get_post_meta( $post->ID, '_ec_event_date', true );
    $time  = get_post_meta( $post->ID, '_ec_event_time', true );
    $venue = get_post_meta( $post->ID, '_ec_event_venue', true );
    ?>
    <p>
        <label for="ec_event_date"><?php _e( 'Event Date:', 'engrafted-chapel' ); ?></label><br>
        <input type="date" id="ec_event_date" name="ec_event_date" value="<?php echo esc_attr( $date ); ?>" style="width:100%;">
    </p>
    <p>
        <label for="ec_event_time"><?php _e( 'Event Time:', 'engrafted-chapel' ); ?></label><br>
        <input type="text" id="ec_event_time" name="ec_event_time" value="<?php echo esc_attr( $time ); ?>" style="width:100%;" placeholder="e.g. 6:00 PM - 8:00 PM">
    </p>
    <p>
        <label for="ec_event_venue"><?php _e( 'Venue:', 'engrafted-chapel' ); ?></label><br>
        <input type="text" id="ec_event_venue" name="ec_event_venue" value="<?php echo esc_attr( $venue ); ?>" style="width:100%;" placeholder="e.g. Main Sanctuary">
    </p>
    <?php
}

function ec_save_event_meta( $post_id ) {
    if ( ! isset( $_POST['ec_event_meta_nonce'] ) || ! wp_verify_nonce( $_POST['ec_event_meta_nonce'], 'ec_event_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['ec_event_date'] ) ) {
        update_post_meta( $post_id, '_ec_event_date', sanitize_text_field( $_POST['ec_event_date'] ) );
    }
    if ( isset( $_POST['ec_event_time'] ) ) {
        update_post_meta( $post_id, '_ec_event_time', sanitize_text_field( $_POST['ec_event_time'] ) );
    }
    if ( isset( $_POST['ec_event_venue'] ) ) {
        update_post_meta( $post_id, '_ec_event_venue', sanitize_text_field( $_POST['ec_event_venue'] ) );
    }
}
add_action( 'save_post', 'ec_save_event_meta' );

/**
 * Add meta box for sermon details
 */
function ec_add_sermon_meta_box() {
    add_meta_box(
        'ec_sermon_details',
        __( 'Sermon Details', 'engrafted-chapel' ),
        'ec_sermon_meta_box_callback',
        'ec_sermon',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ec_add_sermon_meta_box' );

function ec_sermon_meta_box_callback( $post ) {
    wp_nonce_field( 'ec_sermon_meta', 'ec_sermon_meta_nonce' );

    $speaker    = get_post_meta( $post->ID, '_ec_sermon_speaker', true );
    $verse      = get_post_meta( $post->ID, '_ec_sermon_verse', true );
    $video_url  = get_post_meta( $post->ID, '_ec_sermon_video', true );
    $audio_url  = get_post_meta( $post->ID, '_ec_sermon_audio', true );
    ?>
    <p>
        <label for="ec_sermon_speaker"><?php _e( 'Speaker:', 'engrafted-chapel' ); ?></label><br>
        <input type="text" id="ec_sermon_speaker" name="ec_sermon_speaker" value="<?php echo esc_attr( $speaker ); ?>" style="width:100%;">
    </p>
    <p>
        <label for="ec_sermon_verse"><?php _e( 'Scripture Reference:', 'engrafted-chapel' ); ?></label><br>
        <input type="text" id="ec_sermon_verse" name="ec_sermon_verse" value="<?php echo esc_attr( $verse ); ?>" style="width:100%;" placeholder="e.g. John 3:16">
    </p>
    <p>
        <label for="ec_sermon_video"><?php _e( 'Video URL:', 'engrafted-chapel' ); ?></label><br>
        <input type="url" id="ec_sermon_video" name="ec_sermon_video" value="<?php echo esc_url( $video_url ); ?>" style="width:100%;" placeholder="Facebook, YouTube or Vimeo URL">
        <span class="description"><?php _e( 'Use the video\'s permalink — e.g. https://www.facebook.com/EngWordChapel/videos/1234567890/ (open the video on facebook.com and copy the address bar URL). Do NOT use a Reel link, a "Copy link" share link, or an fb.watch/ short link — Facebook can\'t embed those and shows "video unavailable". YouTube/Vimeo URLs also work.', 'engrafted-chapel' ); ?></span>
    </p>
    <p>
        <label for="ec_sermon_audio"><?php _e( 'Audio URL:', 'engrafted-chapel' ); ?></label><br>
        <input type="url" id="ec_sermon_audio" name="ec_sermon_audio" value="<?php echo esc_url( $audio_url ); ?>" style="width:100%;" placeholder="Direct audio file URL">
    </p>
    <?php
}

function ec_save_sermon_meta( $post_id ) {
    if ( ! isset( $_POST['ec_sermon_meta_nonce'] ) || ! wp_verify_nonce( $_POST['ec_sermon_meta_nonce'], 'ec_sermon_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array( 'ec_sermon_speaker', 'ec_sermon_verse', 'ec_sermon_video', 'ec_sermon_audio' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post', 'ec_save_sermon_meta' );

/**
 * Whether a URL points to a Facebook video or live stream.
 *
 * @param string $url Candidate URL.
 * @return bool
 */
function ec_is_facebook_video_url( $url ) {
    $host = wp_parse_url( (string) $url, PHP_URL_HOST );
    if ( ! $host ) {
        return false;
    }
    $host = strtolower( $host );
    foreach ( array( 'facebook.com', 'fb.watch', 'fb.me' ) as $needle ) {
        if ( false !== strpos( $host, $needle ) ) {
            return true;
        }
    }
    return false;
}

/**
 * Build the embed HTML for a sermon video URL.
 *
 * WordPress dropped free Facebook oEmbed in 5.5, so Facebook video / Live URLs
 * are embedded with the token-free plugin iframe; everything else (YouTube,
 * Vimeo, …) still uses WordPress oEmbed. Wrap the result in `.ec-sermon-video`
 * for the responsive 16:9 frame. Returns '' when nothing can be embedded.
 *
 * @param string $url Video URL.
 * @return string Embed HTML, or ''.
 */
function ec_sermon_video_embed( $url ) {
    $url = trim( (string) $url );
    if ( '' === $url ) {
        return '';
    }

    if ( ec_is_facebook_video_url( $url ) ) {
        // Normalise to a clean canonical link when a numeric video id is present
        // (strips slugs / tracking params that trigger "video unavailable").
        $href = $url;
        $fb_id = '';
        if ( preg_match( '#/videos/(?:[^/]+/)?(\d+)#', $url, $m ) || preg_match( '#/reel/(\d+)#', $url, $m ) ) {
            $fb_id = $m[1];
        } else {
            $q = wp_parse_url( $url, PHP_URL_QUERY );
            if ( $q ) {
                parse_str( $q, $args );
                if ( ! empty( $args['v'] ) && ctype_digit( (string) $args['v'] ) ) {
                    $fb_id = $args['v'];
                }
            }
        }
        if ( $fb_id ) {
            $href = 'https://www.facebook.com/watch/?v=' . $fb_id;
        }
        $src = 'https://www.facebook.com/plugins/video.php?href=' . rawurlencode( $href ) . '&show_text=false';
        return sprintf(
            '<iframe src="%s" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" title="%s"></iframe>',
            esc_url( $src ),
            esc_attr__( 'Sermon video', 'engrafted-chapel' )
        );
    }

    return (string) wp_oembed_get( $url );
}

/**
 * Add meta box for ministry details
 */
function ec_add_ministry_meta_box() {
    add_meta_box(
        'ec_ministry_details',
        __( 'Ministry Details', 'engrafted-chapel' ),
        'ec_ministry_meta_box_callback',
        'ec_ministry',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ec_add_ministry_meta_box' );

function ec_ministry_meta_box_callback( $post ) {
    wp_nonce_field( 'ec_ministry_meta', 'ec_ministry_meta_nonce' );

    $slogan = get_post_meta( $post->ID, '_ec_ministry_slogan', true );
    $leader = get_post_meta( $post->ID, '_ec_ministry_leader', true );
    $email  = get_post_meta( $post->ID, '_ec_ministry_email', true );
    ?>
    <p>
        <label for="ec_ministry_slogan"><?php _e( 'Slogan:', 'engrafted-chapel' ); ?></label><br>
        <input type="text" id="ec_ministry_slogan" name="ec_ministry_slogan" value="<?php echo esc_attr( $slogan ); ?>" style="width:100%;" placeholder="e.g. Salt and Light">
    </p>
    <p>
        <label for="ec_ministry_leader"><?php _e( 'Leader Name:', 'engrafted-chapel' ); ?></label><br>
        <input type="text" id="ec_ministry_leader" name="ec_ministry_leader" value="<?php echo esc_attr( $leader ); ?>" style="width:100%;">
    </p>
    <p>
        <label for="ec_ministry_email"><?php _e( 'Contact Email:', 'engrafted-chapel' ); ?></label><br>
        <input type="email" id="ec_ministry_email" name="ec_ministry_email" value="<?php echo esc_attr( $email ); ?>" style="width:100%;">
    </p>
    <?php
}

function ec_save_ministry_meta( $post_id ) {
    if ( ! isset( $_POST['ec_ministry_meta_nonce'] ) || ! wp_verify_nonce( $_POST['ec_ministry_meta_nonce'], 'ec_ministry_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array( 'ec_ministry_slogan', 'ec_ministry_leader', 'ec_ministry_email' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post', 'ec_save_ministry_meta' );

// ============================================
// FORM HANDLERS
// ============================================

/**
 * Handle contact form submissions.
 *
 * Validates the nonce, rejects bots via a honeypot, sanitizes the input and
 * emails the message to the church contact address, then redirects back with a
 * status flag the template uses to show a success/error notice.
 */
function ec_handle_contact_form() {
    $redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );

    // Verify nonce.
    if ( ! isset( $_POST['ec_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ec_contact_nonce'] ) ), 'ec_contact_form' ) ) {
        wp_safe_redirect( add_query_arg( 'ec_contact', 'error', $redirect ) . '#contact' );
        exit;
    }

    // Honeypot: a real user never fills this. Pretend success so bots move on.
    if ( ! empty( $_POST['ec_hp'] ) ) {
        wp_safe_redirect( add_query_arg( 'ec_contact', 'success', $redirect ) . '#contact' );
        exit;
    }

    // Support both the simple {name} form and the {first_name,last_name,phone} prayer form.
    $name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    if ( empty( $name ) ) {
        $first = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
        $last  = isset( $_POST['last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) : '';
        $name  = trim( $first . ' ' . $last );
    }
    $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( empty( $name ) || ! is_email( $email ) || empty( $message ) ) {
        wp_safe_redirect( add_query_arg( 'ec_contact', 'error', $redirect ) . '#contact' );
        exit;
    }

    $to            = get_theme_mod( 'ec_contact_email', get_option( 'admin_email' ) );
    $mail_subject  = $subject ? $subject : __( 'New message from your website', 'engrafted-chapel' );
    $body          = sprintf(
        /* translators: 1: sender name, 2: sender email, 3: sender phone, 4: message body */
        __( "You received a new message from your website contact form.\n\nName: %1\$s\nEmail: %2\$s\nPhone: %3\$s\n\nMessage:\n%4\$s", 'engrafted-chapel' ),
        $name,
        $email,
        $phone ? $phone : __( '(not provided)', 'engrafted-chapel' ),
        $message
    );
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

    $sent = wp_mail( $to, $mail_subject, $body, $headers );

    wp_safe_redirect( add_query_arg( 'ec_contact', $sent ? 'success' : 'error', $redirect ) . '#contact' );
    exit;
}
add_action( 'admin_post_ec_contact', 'ec_handle_contact_form' );
add_action( 'admin_post_nopriv_ec_contact', 'ec_handle_contact_form' );

/**
 * Handle newsletter sign-ups.
 *
 * Emails the new subscriber address to the church contact address. For a full
 * mailing list, connect a service (Mailchimp, etc.) inside this function.
 */
function ec_handle_newsletter() {
    $redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );

    if ( ! isset( $_POST['ec_newsletter_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ec_newsletter_nonce'] ) ), 'ec_newsletter' ) ) {
        wp_safe_redirect( add_query_arg( 'ec_news', 'error', $redirect ) . '#newsletter' );
        exit;
    }

    if ( ! empty( $_POST['ec_hp'] ) ) {
        wp_safe_redirect( add_query_arg( 'ec_news', 'success', $redirect ) . '#newsletter' );
        exit;
    }

    $email = isset( $_POST['ec_news_email'] ) ? sanitize_email( wp_unslash( $_POST['ec_news_email'] ) ) : '';

    if ( ! is_email( $email ) ) {
        wp_safe_redirect( add_query_arg( 'ec_news', 'error', $redirect ) . '#newsletter' );
        exit;
    }

    $to = get_theme_mod( 'ec_contact_email', get_option( 'admin_email' ) );
    wp_mail(
        $to,
        __( 'New newsletter subscriber', 'engrafted-chapel' ),
        sprintf(
            /* translators: %s: subscriber email address */
            __( 'New newsletter subscriber: %s', 'engrafted-chapel' ),
            $email
        )
    );

    wp_safe_redirect( add_query_arg( 'ec_news', 'success', $redirect ) . '#newsletter' );
    exit;
}
add_action( 'admin_post_ec_newsletter', 'ec_handle_newsletter' );
add_action( 'admin_post_nopriv_ec_newsletter', 'ec_handle_newsletter' );

// ============================================
// THEME ACTIVATION — AUTO-CREATE PAGES & MENU
// ============================================

/**
 * The pages this theme ships templates for.
 *
 * @return array slug => array( title, template )
 */
function ec_default_pages() {
    return array(
        'about'         => array( 'title' => __( 'About Us', 'engrafted-chapel' ),       'template' => 'page-templates/template-about.php' ),
        'visit'         => array( 'title' => __( 'Plan Your Visit', 'engrafted-chapel' ), 'template' => 'page-templates/template-visit.php' ),
        'ministries'    => array( 'title' => __( 'Ministries', 'engrafted-chapel' ),     'template' => 'page-templates/template-ministries.php' ),
        'outreach'      => array( 'title' => __( 'Outreach', 'engrafted-chapel' ),       'template' => 'page-templates/template-outreach.php' ),
        'events'        => array( 'title' => __( 'Events', 'engrafted-chapel' ),         'template' => 'page-templates/template-events.php' ),
        'sermons'       => array( 'title' => __( 'Sermons', 'engrafted-chapel' ),        'template' => 'page-templates/template-sermons.php' ),
        'gallery'       => array( 'title' => __( 'Gallery', 'engrafted-chapel' ),        'template' => 'page-templates/template-gallery.php' ),
        'contact'       => array( 'title' => __( 'Contact', 'engrafted-chapel' ),        'template' => 'page-templates/template-contact.php' ),
    );
}

/**
 * Create the theme's pages (if missing) and assign each its template.
 * Idempotent: existing pages are reused and simply re-templated if needed.
 */
function ec_install_pages() {
    foreach ( ec_default_pages() as $slug => $data ) {
        $existing = get_page_by_path( $slug );
        $content  = ec_page_default_content( $slug );

        if ( $existing ) {
            // Ensure the right template is assigned.
            if ( get_page_template_slug( $existing->ID ) !== $data['template'] ) {
                update_post_meta( $existing->ID, '_wp_page_template', $data['template'] );
            }
            // Pre-fill body content only if the page is still empty (never overwrite edits).
            if ( $content && '' === trim( (string) $existing->post_content ) ) {
                wp_update_post( array(
                    'ID'           => $existing->ID,
                    'post_content' => $content,
                ) );
            }
            continue;
        }

        $page_id = wp_insert_post( array(
            'post_title'   => $data['title'],
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => $content,
        ) );

        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', $data['template'] );
        }
    }

    ec_install_menu();

    flush_rewrite_rules();

    update_option( 'ec_pages_installed', EC_VERSION );
}

/**
 * Build a primary menu from the created pages and assign it to the primary
 * location — but never overwrite a menu the user has already set up.
 */
function ec_install_menu() {
    $menu_name = __( 'Primary Menu', 'engrafted-chapel' );
    $menu      = wp_get_nav_menu_object( $menu_name );

    if ( ! $menu ) {
        $menu_id = wp_create_nav_menu( $menu_name );
    } else {
        $menu_id = $menu->term_id;
    }

    if ( is_wp_error( $menu_id ) ) {
        return;
    }

    // Ensure the menu has a Home item and each default page — adding only what's
    // missing, so it never duplicates and self-heals when new pages are added.
    $items        = wp_get_nav_menu_items( $menu_id );
    $existing_ids = array();
    $has_home     = false;
    if ( $items ) {
        foreach ( $items as $it ) {
            if ( 'post_type' === $it->type ) {
                $existing_ids[] = (int) $it->object_id;
            }
            if ( untrailingslashit( $it->url ) === untrailingslashit( home_url( '/' ) ) ) {
                $has_home = true;
            }
        }
    }

    if ( ! $has_home ) {
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'  => __( 'Home', 'engrafted-chapel' ),
            'menu-item-url'    => home_url( '/' ),
            'menu-item-status' => 'publish',
        ) );
    }

    foreach ( array( 'about', 'visit', 'ministries', 'outreach', 'events', 'gallery', 'contact' ) as $slug ) {
        $page = get_page_by_path( $slug );
        if ( $page && ! in_array( (int) $page->ID, $existing_ids, true ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => get_the_title( $page->ID ),
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $page->ID,
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ) );
        }
    }

    // Assign to the primary location only if nothing is assigned yet.
    $locations = get_theme_mod( 'nav_menu_locations', array() );
    if ( empty( $locations['primary'] ) ) {
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
}

// Run on theme activation.
add_action( 'after_switch_theme', 'ec_install_pages' );

/**
 * Fallback installer: if the theme is already active (so after_switch_theme
 * won't fire), create the pages the first time an admin loads the dashboard.
 */
function ec_maybe_install_pages() {
    if ( get_option( 'ec_pages_installed' ) === EC_VERSION ) {
        return;
    }
    ec_install_pages();
}
add_action( 'admin_init', 'ec_maybe_install_pages' );

// ============================================
// CUSTOMIZER
// ============================================
require EC_THEME_DIR . '/inc/customizer.php';

// ============================================
// TEMPLATE FUNCTIONS
// ============================================
require EC_THEME_DIR . '/inc/template-functions.php';
require EC_THEME_DIR . '/inc/template-tags.php';
require EC_THEME_DIR . '/inc/default-content.php';
require EC_THEME_DIR . '/inc/seo.php';
require EC_THEME_DIR . '/inc/performance.php';
require EC_THEME_DIR . '/inc/demo-import.php';
