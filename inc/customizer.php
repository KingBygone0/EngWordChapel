<?php
/**
 * Engrafted Chapel Customizer
 *
 * @package Engrafted_Chapel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Customizer Setup
 */
function ec_customizer( $wp_customize ) {

    // ============================================
    // THEME SETTINGS PANEL
    // ============================================
    $wp_customize->add_panel( 'ec_theme_settings', array(
        'title'       => __( 'Theme Settings', 'engrafted-chapel' ),
        'description' => __( 'Customize your church website', 'engrafted-chapel' ),
        'priority'    => 20,
    ) );

    // ============================================
    // GENERAL SETTINGS
    // ============================================
    $wp_customize->add_section( 'ec_general', array(
        'title'    => __( 'General Settings', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 10,
    ) );

    // Church Name
    $wp_customize->add_setting( 'ec_church_name', array(
        'default'           => 'Engrafted Word Chapel International',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ec_church_name', array(
        'label'   => __( 'Church Name', 'engrafted-chapel' ),
        'section' => 'ec_general',
        'type'    => 'text',
    ) );

    // Tagline
    $wp_customize->add_setting( 'ec_tagline', array(
        'default'           => 'A HUMBLE person, willing to SACRIFICE will SERVE God greatly.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ec_tagline', array(
        'label'   => __( 'Tagline', 'engrafted-chapel' ),
        'section' => 'ec_general',
        'type'    => 'text',
    ) );

    // Header CTA button — empty by default (hidden). Set text to show a button.
    $wp_customize->add_setting( 'ec_header_cta_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_header_cta_text', array(
        'label'       => __( 'Header Button Text', 'engrafted-chapel' ),
        'description' => __( 'Leave empty to hide the header button (e.g. "Donation").', 'engrafted-chapel' ),
        'section'     => 'ec_general',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'ec_header_cta_url', array(
        'default'           => home_url( '/contact' ),
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'ec_header_cta_url', array(
        'label'   => __( 'Header Button URL', 'engrafted-chapel' ),
        'section' => 'ec_general',
        'type'    => 'url',
    ) );

    // ============================================
    // HERO SECTION
    // ============================================
    $wp_customize->add_section( 'ec_hero', array(
        'title'    => __( 'Hero Section', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 20,
    ) );

    // Hero Background
    $wp_customize->add_setting( 'ec_hero_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ec_hero_bg', array(
        'label'    => __( 'Hero Background Image', 'engrafted-chapel' ),
        'section'  => 'ec_hero',
    ) ) );

    // Hero Subtitle
    $wp_customize->add_setting( 'ec_hero_subtitle', array(
        'default'           => __( 'Welcome to', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_hero_subtitle', array(
        'label'   => __( 'Hero Subtitle', 'engrafted-chapel' ),
        'section' => 'ec_hero',
        'type'    => 'text',
    ) );

    // Hero Badge (the pill above the headline)
    $wp_customize->add_setting( 'ec_hero_badge', array(
        'default'           => __( 'Growing Together in Christ', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_hero_badge', array(
        'label'       => __( 'Hero Badge', 'engrafted-chapel' ),
        'description' => __( 'Small pill label above the headline.', 'engrafted-chapel' ),
        'section'     => 'ec_hero',
        'type'        => 'text',
    ) );

    // Hero Headline — Line 1 (serif display)
    $wp_customize->add_setting( 'ec_hero_script_text', array(
        'default'           => __( 'A quiet refuge', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_hero_script_text', array(
        'label'       => __( 'Hero Headline — Line 1', 'engrafted-chapel' ),
        'description' => __( 'First line of the large serif headline (e.g. "A quiet refuge").', 'engrafted-chapel' ),
        'section'     => 'ec_hero',
        'type'        => 'text',
    ) );

    // Hero Headline — Line 2 (serif display)
    $wp_customize->add_setting( 'ec_hero_block_text', array(
        'default'           => __( 'in a loud world', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_hero_block_text', array(
        'label'       => __( 'Hero Headline — Line 2', 'engrafted-chapel' ),
        'description' => __( 'Second line of the headline (e.g. "in a loud world").', 'engrafted-chapel' ),
        'section'     => 'ec_hero',
        'type'        => 'text',
    ) );

    // Hero Title (legacy / fallback)
    $wp_customize->add_setting( 'ec_hero_title', array(
        'default'           => 'Leading people to love Jesus and love others.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_hero_title', array(
        'label'   => __( 'Hero Title (legacy)', 'engrafted-chapel' ),
        'section' => 'ec_hero',
        'type'    => 'text',
    ) );

    // Hero Tagline
    $wp_customize->add_setting( 'ec_hero_tagline', array(
        'default'           => 'A sanctuary for anyone seeking peace, meaning, and authentic connection. Slow down, breathe, and encounter the living Word.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_hero_tagline', array(
        'label'   => __( 'Hero Tagline', 'engrafted-chapel' ),
        'section' => 'ec_hero',
        'type'    => 'textarea',
    ) );

    // Button 1 Text
    $wp_customize->add_setting( 'ec_hero_btn1_text', array(
        'default'           => __( 'Plan a Visit', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_hero_btn1_text', array(
        'label'   => __( 'Button 1 Text', 'engrafted-chapel' ),
        'section' => 'ec_hero',
        'type'    => 'text',
    ) );

    // Button 1 URL
    $wp_customize->add_setting( 'ec_hero_btn1_url', array(
        'default'           => '#services',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'ec_hero_btn1_url', array(
        'label'   => __( 'Button 1 URL', 'engrafted-chapel' ),
        'section' => 'ec_hero',
        'type'    => 'url',
    ) );

    // Button 2 Text
    $wp_customize->add_setting( 'ec_hero_btn2_text', array(
        'default'           => __( 'Watch Sermons', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_hero_btn2_text', array(
        'label'   => __( 'Button 2 Text', 'engrafted-chapel' ),
        'section' => 'ec_hero',
        'type'    => 'text',
    ) );

    // Button 2 URL
    $wp_customize->add_setting( 'ec_hero_btn2_url', array(
        'default'           => '#welcome',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'ec_hero_btn2_url', array(
        'label'   => __( 'Button 2 URL', 'engrafted-chapel' ),
        'section' => 'ec_hero',
        'type'    => 'url',
    ) );

    // Hero Feature Highlights (the four-up bar beneath the hero)
    $ec_feature_defaults = array(
        1 => array( 'Real People', 'Authentic community for every season.' ),
        2 => array( 'Bible Centred', 'Relevant teaching that transforms.' ),
        3 => array( 'Serve Others', 'Live out your faith and make a difference.' ),
        4 => array( 'Upcoming Events', 'There\'s always something happening.' ),
    );
    foreach ( $ec_feature_defaults as $n => $vals ) {
        $wp_customize->add_setting( 'ec_feature_' . $n . '_title', array(
            'default'           => $vals[0],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ec_feature_' . $n . '_title', array(
            /* translators: %d: highlight number */
            'label'   => sprintf( __( 'Highlight %d Title', 'engrafted-chapel' ), $n ),
            'section' => 'ec_hero',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( 'ec_feature_' . $n . '_text', array(
            'default'           => $vals[1],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ec_feature_' . $n . '_text', array(
            /* translators: %d: highlight number */
            'label'   => sprintf( __( 'Highlight %d Text', 'engrafted-chapel' ), $n ),
            'section' => 'ec_hero',
            'type'    => 'text',
        ) );
    }

    // ============================================
    // WELCOME SECTION
    // ============================================
    $wp_customize->add_section( 'ec_welcome', array(
        'title'    => __( 'Welcome Section', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 30,
    ) );

    // Welcome Image
    $wp_customize->add_setting( 'ec_welcome_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ec_welcome_image', array(
        'label'    => __( 'Welcome Image', 'engrafted-chapel' ),
        'section'  => 'ec_welcome',
    ) ) );

    // Welcome Heading
    $wp_customize->add_setting( 'ec_welcome_heading', array(
        'default'           => __( 'You belong here. This is more than a church, it\'s a family.', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_welcome_heading', array(
        'label'   => __( 'Welcome Heading', 'engrafted-chapel' ),
        'section' => 'ec_welcome',
        'type'    => 'text',
    ) );

    // Welcome Text
    $wp_customize->add_setting( 'ec_welcome_text', array(
        'default'           => 'Our inception happened on the 9th of September when two friends decided to become prayer partners with Rev Clifford De-graft Ade. Since then, we have grown into a scriptural spiritual and physically healthy family where love is expressed and felt.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ec_welcome_text', array(
        'label'   => __( 'Welcome Text', 'engrafted-chapel' ),
        'section' => 'ec_welcome',
        'type'    => 'textarea',
    ) );

    // Welcome Quote
    $wp_customize->add_setting( 'ec_welcome_quote', array(
        'default'           => 'A HUMBLE person, willing to SACRIFICE will SERVE God greatly.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_welcome_quote', array(
        'label'   => __( 'Welcome Quote', 'engrafted-chapel' ),
        'section' => 'ec_welcome',
        'type'    => 'text',
    ) );

    // Pastor Name
    $wp_customize->add_setting( 'ec_pastor_name', array(
        'default'           => 'Rev. Clifford De-graft Ade',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_pastor_name', array(
        'label'   => __( 'Pastor Name', 'engrafted-chapel' ),
        'section' => 'ec_welcome',
        'type'    => 'text',
    ) );

    // Pastor Title
    $wp_customize->add_setting( 'ec_pastor_title', array(
        'default'           => 'Senior Pastor & Founder',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_pastor_title', array(
        'label'   => __( 'Pastor Title', 'engrafted-chapel' ),
        'section' => 'ec_welcome',
        'type'    => 'text',
    ) );

    // Pastor Photo (used on the About page leadership section)
    $wp_customize->add_setting( 'ec_pastor_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ec_pastor_image', array(
        'label'   => __( 'Pastor Photo', 'engrafted-chapel' ),
        'section' => 'ec_welcome',
    ) ) );

    // ============================================
    // ABOUT & AFFILIATIONS (Home v3)
    // ============================================
    $wp_customize->add_section( 'ec_about', array(
        'title'    => __( 'About & Affiliations', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 35,
    ) );

    $wp_customize->add_setting( 'ec_about_heading', array(
        'default'           => __( 'Degrafted from the world, engrafted into love.', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_about_heading', array(
        'label'       => __( 'About Heading', 'engrafted-chapel' ),
        'description' => __( 'The word "love" is shown in the italic ember accent.', 'engrafted-chapel' ),
        'section'     => 'ec_about',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'ec_about_text', array(
        'default'           => __( 'What began as two friends praying together has grown into a scripturally, spiritually and physically healthy family — a place where love is both expressed and felt, and where the saving Word of God is grafted into ordinary lives.', 'engrafted-chapel' ),
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ec_about_text', array(
        'label'   => __( 'About Text', 'engrafted-chapel' ),
        'section' => 'ec_about',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'ec_about_founded_year', array(
        'default'           => 2010,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'ec_about_founded_year', array(
        'label'       => __( 'Founding Year', 'engrafted-chapel' ),
        'description' => __( 'Drives the "Years of Faithful Ministry" counter and the image badge.', 'engrafted-chapel' ),
        'section'     => 'ec_about',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1900, 'max' => (int) gmdate( 'Y' ) ),
    ) );

    $ec_vision_defaults = array(
        1 => __( 'Serving God through our generation.', 'engrafted-chapel' ),
        2 => __( 'Impacting society through Christ.', 'engrafted-chapel' ),
        3 => __( 'Manifesting the glory of our God.', 'engrafted-chapel' ),
    );
    foreach ( $ec_vision_defaults as $ec_n => $ec_default ) {
        $wp_customize->add_setting( 'ec_about_vision_' . $ec_n, array(
            'default'           => $ec_default,
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ec_about_vision_' . $ec_n, array(
            /* translators: %d: vision point number */
            'label'   => sprintf( __( 'Vision Point %d', 'engrafted-chapel' ), $ec_n ),
            'section' => 'ec_about',
            'type'    => 'text',
        ) );
    }

    $ec_affil_defaults = array(
        1 => __( 'The Apostolic Church — Ghana', 'engrafted-chapel' ),
        2 => __( 'Agape Bible College', 'engrafted-chapel' ),
        3 => __( 'Mission Die Theological Seminary', 'engrafted-chapel' ),
        4 => __( 'Africa Association of Bible Schools', 'engrafted-chapel' ),
    );
    foreach ( $ec_affil_defaults as $ec_n => $ec_default ) {
        $wp_customize->add_setting( 'ec_affil_' . $ec_n, array(
            'default'           => $ec_default,
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ec_affil_' . $ec_n, array(
            /* translators: %d: affiliation number */
            'label'   => sprintf( __( 'Affiliation %d', 'engrafted-chapel' ), $ec_n ),
            'section' => 'ec_about',
            'type'    => 'text',
        ) );
    }

    // ============================================
    // SERVICE TIMES
    // ============================================
    $wp_customize->add_section( 'ec_services', array(
        'title'    => __( 'Service Times', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 40,
    ) );

    // Section Title
    $wp_customize->add_setting( 'ec_services_title', array(
        'default'           => __( 'Our Weekly Services', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_services_title', array(
        'label'   => __( 'Section Title', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    // Service 1
    $wp_customize->add_setting( 'ec_service_1_name', array(
        'default'           => 'Bible Voice',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_service_1_name', array(
        'label'   => __( 'Service 1 Name', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_service_1_day', array(
        'default'           => 'Wednesday',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_service_1_day', array(
        'label'   => __( 'Service 1 Day', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_service_1_time', array(
        'default'           => '6:30 PM - 8:30 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_service_1_time', array(
        'label'   => __( 'Service 1 Time', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    // Service 2
    $wp_customize->add_setting( 'ec_service_2_name', array(
        'default'           => 'Turning Point',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_service_2_name', array(
        'label'   => __( 'Service 2 Name', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_service_2_day', array(
        'default'           => 'Friday',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_service_2_day', array(
        'label'   => __( 'Service 2 Day', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_service_2_time', array(
        'default'           => '6:30 PM - 8:30 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_service_2_time', array(
        'label'   => __( 'Service 2 Time', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    // Service 3
    $wp_customize->add_setting( 'ec_service_3_name', array(
        'default'           => 'Fresh Word Encounter',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_service_3_name', array(
        'label'   => __( 'Service 3 Name', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_service_3_day', array(
        'default'           => 'Sunday',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_service_3_day', array(
        'label'   => __( 'Service 3 Day', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_service_3_time', array(
        'default'           => '7:30 AM - 11:30 AM',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_service_3_time', array(
        'label'   => __( 'Service 3 Time', 'engrafted-chapel' ),
        'section' => 'ec_services',
        'type'    => 'text',
    ) );

    // ============================================
    // SERMONS SECTION
    // ============================================
    $wp_customize->add_section( 'ec_sermons', array(
        'title'    => __( 'Latest Sermons', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 50,
    ) );

    $wp_customize->add_setting( 'ec_sermons_title', array(
        'default'           => __( 'Latest Sermons', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_sermons_title', array(
        'label'   => __( 'Section Title', 'engrafted-chapel' ),
        'section' => 'ec_sermons',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_sermons_desc', array(
        'default'           => __( 'Listen to our latest messages and grow in faith.', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_sermons_desc', array(
        'label'   => __( 'Section Description', 'engrafted-chapel' ),
        'section' => 'ec_sermons',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_sermons_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'ec_sermons_count', array(
        'label'       => __( 'Number of Sermons to Show', 'engrafted-chapel' ),
        'section'     => 'ec_sermons',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 12 ),
    ) );

    // ============================================
    // MINISTRIES SECTION
    // ============================================
    $wp_customize->add_section( 'ec_ministries', array(
        'title'    => __( 'Ministries Section', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 60,
    ) );

    $wp_customize->add_setting( 'ec_ministries_title', array(
        'default'           => __( 'Our Ministries', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_ministries_title', array(
        'label'   => __( 'Section Title', 'engrafted-chapel' ),
        'section' => 'ec_ministries',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_ministries_desc', array(
        'default'           => __( 'Discover where you can belong and grow.', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_ministries_desc', array(
        'label'   => __( 'Section Description', 'engrafted-chapel' ),
        'section' => 'ec_ministries',
        'type'    => 'text',
    ) );

    // ============================================
    // TESTIMONIES SECTION
    // ============================================
    $wp_customize->add_section( 'ec_testimonies', array(
        'title'    => __( 'Testimonies Section', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 70,
    ) );

    $wp_customize->add_setting( 'ec_testimonies_title', array(
        'default'           => __( 'Testimonies', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_testimonies_title', array(
        'label'   => __( 'Section Title', 'engrafted-chapel' ),
        'section' => 'ec_testimonies',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_testimonies_desc', array(
        'default'           => __( 'Hear how God is changing lives in our community.', 'engrafted-chapel' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_testimonies_desc', array(
        'label'   => __( 'Section Description', 'engrafted-chapel' ),
        'section' => 'ec_testimonies',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_testimonies_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'ec_testimonies_count', array(
        'label'       => __( 'Number of Testimonies to Show', 'engrafted-chapel' ),
        'section'     => 'ec_testimonies',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 12 ),
    ) );

    // ============================================
    // CONTACT SECTION
    // ============================================
    $wp_customize->add_section( 'ec_contact', array(
        'title'    => __( 'Contact Information', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 90,
    ) );

    $wp_customize->add_setting( 'ec_contact_address', array(
        'default'           => 'P.O. Box KN 5139 Kaneshie – Accra, Ghana',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_contact_address', array(
        'label'   => __( 'Address', 'engrafted-chapel' ),
        'section' => 'ec_contact',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_contact_email', array(
        'default'           => 'engwordchapel@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'ec_contact_email', array(
        'label'   => __( 'Email Address', 'engrafted-chapel' ),
        'section' => 'ec_contact',
        'type'    => 'email',
    ) );

    $wp_customize->add_setting( 'ec_contact_phone1', array(
        'default'           => '+233 243112227',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_contact_phone1', array(
        'label'   => __( 'Phone 1', 'engrafted-chapel' ),
        'section' => 'ec_contact',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_contact_phone2', array(
        'default'           => '+233 264112117',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_contact_phone2', array(
        'label'   => __( 'Phone 2', 'engrafted-chapel' ),
        'section' => 'ec_contact',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'ec_contact_phone3', array(
        'default'           => '+233 302952323',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'ec_contact_phone3', array(
        'label'   => __( 'Phone 3', 'engrafted-chapel' ),
        'section' => 'ec_contact',
        'type'    => 'text',
    ) );

    // Map Embed
    $wp_customize->add_setting( 'ec_contact_map', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'ec_contact_map', array(
        'label'       => __( 'Google Maps Embed Code', 'engrafted-chapel' ),
        'description' => __( 'Paste your Google Maps iframe embed code here.', 'engrafted-chapel' ),
        'section'     => 'ec_contact',
        'type'        => 'textarea',
    ) );

    // ============================================
    // SOCIAL MEDIA
    // ============================================
    $wp_customize->add_section( 'ec_social', array(
        'title'    => __( 'Social Media', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 100,
    ) );

    $social_defaults = array(
        'facebook'  => 'https://facebook.com/EngWordChapel',
        'twitter'   => 'https://twitter.com/EngWordChapel',
        'instagram' => 'https://instagram.com/engwordchapel_',
        'tiktok'    => 'https://tiktok.com/@engwordchapel',
        'youtube'   => '',
    );
    $platforms = ec_social_platforms();
    foreach ( $platforms as $key => $label ) {
        $wp_customize->add_setting( 'ec_social_' . $key, array(
            'default'           => isset( $social_defaults[ $key ] ) ? $social_defaults[ $key ] : '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'ec_social_' . $key, array(
            'label'   => $label,
            'section' => 'ec_social',
            'type'    => 'url',
        ) );
    }

    // ============================================
    // OUTREACH PAGE IMAGES
    // ============================================
    $wp_customize->add_section( 'ec_outreach', array(
        'title'    => __( 'Outreach Page', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 105,
    ) );
    $ec_outreach_imgs = array(
        'ec_outreach_img_1' => __( 'Intro Image', 'engrafted-chapel' ),
        'ec_outreach_img_2' => __( 'Evangelism Image', 'engrafted-chapel' ),
        'ec_outreach_img_3' => __( 'Follow-up & Visitation Image', 'engrafted-chapel' ),
    );
    foreach ( $ec_outreach_imgs as $ec_key => $ec_label ) {
        $wp_customize->add_setting( $ec_key, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $ec_key, array(
            'label'   => $ec_label,
            'section' => 'ec_outreach',
        ) ) );
    }

    // ============================================
    // ABOUT PAGE TEXT
    // ============================================
    $wp_customize->add_section( 'ec_about_page', array(
        'title'    => __( 'About Page', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 36,
    ) );

    $ec_about_fields = array(
        'ec_ap_story_heading' => array( 'label' => __( 'Story Heading', 'engrafted-chapel' ), 'type' => 'text', 'default' => 'Degrafted from the world, engrafted into Christ' ),
        'ec_ap_story_text'    => array( 'label' => __( 'Story Text', 'engrafted-chapel' ), 'type' => 'textarea', 'default' => 'Our story is rooted in a deep commitment to sharing God\'s love and guiding people toward a meaningful relationship with Christ. It began on the 9th of September, when two friends became prayer partners with Rev. Clifford De-graft Ade — and has grown into a scripturally, spiritually and physically healthy family where love is both expressed and felt.' ),
        'ec_ap_mission'       => array( 'label' => __( 'Mission', 'engrafted-chapel' ), 'type' => 'textarea', 'default' => 'To bring people to Jesus for restoration to the original God-ordained state of man, through the propagation of the Good News and the development of model New Testament Christians and churches.' ),
        'ec_ap_vision'        => array( 'label' => __( 'Vision', 'engrafted-chapel' ), 'type' => 'textarea', 'default' => 'Serving God through our generation, impacting society through Christ, and manifesting the glory of our God in all the earth.' ),
        'ec_pastor_bio'       => array( 'label' => __( 'Pastor Bio (blank line = new paragraph)', 'engrafted-chapel' ), 'type' => 'textarea', 'default' => "A Ghanaian with Togolese heritage, born into a large family where he learned early what it means to live a collective life. He became a serious Christian during his secondary education and, in obedience to God's call, enrolled in Agape Bible College in 2005, graduating with a degree in Bible Ministry.\n\nDuring one of our prayer sessions, the phrase \"grafting the Word\" came to him — a study of Romans 11 and James 1:21 revealed that we are degrafted from the world of sin and engrafted into Christ through the preaching of His Word. From that revelation, Engrafted Word Chapel was born." ),
    );
    foreach ( $ec_about_fields as $ec_id => $ec_f ) {
        $ec_san = ( 'textarea' === $ec_f['type'] ) ? 'sanitize_textarea_field' : 'sanitize_text_field';
        $wp_customize->add_setting( $ec_id, array( 'default' => $ec_f['default'], 'sanitize_callback' => $ec_san ) );
        $wp_customize->add_control( $ec_id, array( 'label' => $ec_f['label'], 'section' => 'ec_about_page', 'type' => $ec_f['type'] ) );
    }

    // FAQ (5 question/answer pairs).
    $ec_faq_defaults = array(
        1 => array( 'What time are your Sunday services?', 'Our Fresh Word Encounter runs every Sunday from 7:30 AM. During the week, join us for Bible Voice on Wednesday and Turning Point on Friday, both at 6:30 PM.' ),
        2 => array( 'Do you have programs for children and youth?', 'Yes. Engrafted Children nurtures our little ones with care and biblical values, while Engrafted Youth helps students grow in faith through worship, teaching and fellowship.' ),
        3 => array( 'How can I get involved in the church?', 'There is a place for everyone. Join one of our ministries — children, youth, women, men or the Word Impact Choir — or partner with our outreach and mission work. Reach out and we will help you find your fit.' ),
        4 => array( 'How can I request prayer or pastoral support?', 'We would love to pray with you. Contact the church office and our follow-up team will reach out to provide care, prayer and pastoral support.' ),
        5 => array( 'Do you offer giving or donations?', 'Yes. You can honour God with your tithes and offerings in person at any service, or give by mobile money and transfer — contact the office for current details.' ),
    );
    foreach ( $ec_faq_defaults as $ec_n => $ec_qa ) {
        $wp_customize->add_setting( 'ec_faq_' . $ec_n . '_q', array( 'default' => $ec_qa[0], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( 'ec_faq_' . $ec_n . '_q', array(
            /* translators: %d: FAQ number */
            'label' => sprintf( __( 'FAQ %d — Question', 'engrafted-chapel' ), $ec_n ), 'section' => 'ec_about_page', 'type' => 'text',
        ) );
        $wp_customize->add_setting( 'ec_faq_' . $ec_n . '_a', array( 'default' => $ec_qa[1], 'sanitize_callback' => 'sanitize_textarea_field' ) );
        $wp_customize->add_control( 'ec_faq_' . $ec_n . '_a', array(
            /* translators: %d: FAQ number */
            'label' => sprintf( __( 'FAQ %d — Answer (leave blank to hide)', 'engrafted-chapel' ), $ec_n ), 'section' => 'ec_about_page', 'type' => 'textarea',
        ) );
    }

    // ============================================
    // CONTACT PAGE TEXT
    // ============================================
    $wp_customize->add_section( 'ec_contact_page', array(
        'title'    => __( 'Contact Page', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 92,
    ) );
    $ec_contact_fields = array(
        'ec_cp_heading'      => array( 'label' => __( 'Heading', 'engrafted-chapel' ), 'type' => 'text', 'default' => 'Contact our church for prayer support' ),
        'ec_cp_intro'        => array( 'label' => __( 'Intro Text', 'engrafted-chapel' ), 'type' => 'textarea', 'default' => 'We would love to hear from you. Whether you have prayer requests, questions about our services, or want to get involved in our ministries, reach out any time.' ),
        'ec_cp_form_heading' => array( 'label' => __( 'Form Card Heading', 'engrafted-chapel' ), 'type' => 'text', 'default' => 'Share your prayer requests here' ),
        'ec_cp_map_heading'  => array( 'label' => __( 'Map Section Heading', 'engrafted-chapel' ), 'type' => 'text', 'default' => 'Find our church location easily' ),
        'ec_cp_map_intro'    => array( 'label' => __( 'Map Section Intro', 'engrafted-chapel' ), 'type' => 'textarea', 'default' => 'Our church is conveniently located in a peaceful and easily accessible area, making it simple for individuals and families to join us for worship and fellowship.' ),
    );
    foreach ( $ec_contact_fields as $ec_id => $ec_f ) {
        $ec_san = ( 'textarea' === $ec_f['type'] ) ? 'sanitize_textarea_field' : 'sanitize_text_field';
        $wp_customize->add_setting( $ec_id, array( 'default' => $ec_f['default'], 'sanitize_callback' => $ec_san ) );
        $wp_customize->add_control( $ec_id, array( 'label' => $ec_f['label'], 'section' => 'ec_contact_page', 'type' => $ec_f['type'] ) );
    }

    // ============================================
    // SECTION VISIBILITY
    // ============================================
    $wp_customize->add_section( 'ec_visibility', array(
        'title'    => __( 'Section Visibility', 'engrafted-chapel' ),
        'panel'    => 'ec_theme_settings',
        'priority' => 110,
    ) );

    $sections = array(
        'hero'         => __( 'Hero Banner', 'engrafted-chapel' ),
        'affiliations' => __( 'Affiliations Strip', 'engrafted-chapel' ),
        'about'        => __( 'About + Vision + Stats', 'engrafted-chapel' ),
        'pillars'      => __( 'What We Do (Pillars)', 'engrafted-chapel' ),
        'services'     => __( 'Service Times', 'engrafted-chapel' ),
        'beliefs'      => __( 'What We Believe', 'engrafted-chapel' ),
        'sermons'      => __( 'Latest Sermons', 'engrafted-chapel' ),
        'give'         => __( 'Give / Donation', 'engrafted-chapel' ),
        'events'       => __( 'Upcoming Events', 'engrafted-chapel' ),
        'ministries'   => __( 'Ministries', 'engrafted-chapel' ),
        'testimonies'  => __( 'Testimonies', 'engrafted-chapel' ),
        'blog'         => __( 'Latest Blog', 'engrafted-chapel' ),
        'gallery'      => __( 'Gallery Preview', 'engrafted-chapel' ),
        'newsletter'   => __( 'Newsletter', 'engrafted-chapel' ),
        'contact'      => __( 'Contact Section', 'engrafted-chapel' ),
    );

    foreach ( $sections as $key => $label ) {
        $wp_customize->add_setting( 'ec_show_' . $key, array(
            'default'           => true,
            'sanitize_callback' => 'ec_validate_boolean',
        ) );
        $wp_customize->add_control( 'ec_show_' . $key, array(
            'label'   => $label,
            'section' => 'ec_visibility',
            'type'    => 'checkbox',
        ) );
    }
}
add_action( 'customize_register', 'ec_customizer' );
