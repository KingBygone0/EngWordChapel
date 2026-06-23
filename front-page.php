<?php
/**
 * The front page template
 *
 * Section lineup mirrors the Emanu "Home v3" layout, recast in the Engrafted
 * Word Chapel dark/ember brand. Each section is individually toggle-able from
 * Appearance → Customize → Section Visibility.
 *
 * @package Engrafted_Chapel
 */

get_header();

/**
 * Homepage section order. Each entry maps a Customizer visibility key to its
 * template part; new Emanu-style sections sit alongside the originals.
 */
$ec_home_sections = array(
    'hero'         => 'hero',          // Hero banner
    'about'        => 'about',         // About + vision + animated stats
    'pillars'      => 'pillars',       // "What We Do" service cards
    'services'     => 'services',      // Weekly service times
    'beliefs'      => 'beliefs',       // What We Believe
    'sermons'      => 'sermons',       // Latest sermons
    'give'         => 'give',          // Giving / donation
    'events'       => 'events',        // Upcoming events
    'ministries'   => 'ministries',    // Ministries
    'testimonies'  => 'testimonies',   // Testimonies grid
    'blog'         => 'blog',          // Latest blog posts
    'gallery'      => 'gallery',       // Gallery photo preview
);

foreach ( $ec_home_sections as $ec_key => $ec_part ) {
    if ( ec_section_enabled( $ec_key ) ) {
        get_template_part( 'template-parts/home/' . $ec_part );
    }
}

get_footer();
