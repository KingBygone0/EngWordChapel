<?php
/**
 * Testimonies Section (multi-card)
 *
 * Mirrors the Emanu testimonial grid — a row of quote cards with a rating,
 * the testimony, and the person's name/role — in the Engrafted dark/ember brand.
 * Pulls from the Testimony CPT, with sensible fallbacks before any are added.
 *
 * @package Engrafted_Chapel
 */

$ec_t_query  = ec_get_testimonies( get_theme_mod( 'ec_testimonies_count', 3 ) );
$ec_stories  = array();

if ( $ec_t_query->have_posts() ) {
    while ( $ec_t_query->have_posts() ) {
        $ec_t_query->the_post();
        $ec_excerpt = trim( (string) get_the_excerpt() );
        $ec_stories[] = array(
            'text' => wp_trim_words( wp_strip_all_tags( get_the_content() ), 38 ),
            'name' => get_the_title(),
            'role' => $ec_excerpt !== '' ? $ec_excerpt : __( 'Church Member', 'engrafted-chapel' ),
        );
    }
}
wp_reset_postdata();

if ( empty( $ec_stories ) ) {
    $ec_stories = array(
        array(
            'text' => __( 'Engrafted Word Chapel has been a place where my faith has grown, I have made lifelong friends, and found my purpose. I came feeling lost and left it carrying hope.', 'engrafted-chapel' ),
            'name' => __( 'Sarah J.', 'engrafted-chapel' ),
            'role' => __( 'Member since 2015', 'engrafted-chapel' ),
        ),
        array(
            'text' => __( 'Since I joined this church my life has been transformed. The teaching of the Word strengthened my faith and gave me clear direction for the road ahead.', 'engrafted-chapel' ),
            'name' => __( 'John K.', 'engrafted-chapel' ),
            'role' => __( 'Engrafted Men — SSF', 'engrafted-chapel' ),
        ),
        array(
            'text' => __( 'The youth ministry gave me a sense of belonging and helped me grow spiritually. Through mentorship I found my calling and the courage to follow it.', 'engrafted-chapel' ),
            'name' => __( 'Abena M.', 'engrafted-chapel' ),
            'role' => __( 'Engrafted Youth', 'engrafted-chapel' ),
        ),
    );
}
?>

<section class="ec-section ec-section-white ec-testimonials" id="testimonies">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'Testimonies', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php echo esc_html( get_theme_mod( 'ec_testimonies_title', __( 'Lives changed by the Word', 'engrafted-chapel' ) ) ); ?></h2>
            <p class="ec-section-desc"><?php echo esc_html( get_theme_mod( 'ec_testimonies_desc', __( 'Hear how God is at work in our church family.', 'engrafted-chapel' ) ) ); ?></p>
        </div>

        <div class="ec-testimonial-grid">
            <?php foreach ( $ec_stories as $ec_story ) : ?>
            <figure class="ec-tcard">
                <div class="ec-tcard-stars" aria-label="<?php esc_attr_e( 'Five out of five', 'engrafted-chapel' ); ?>">
                    <?php for ( $ec_s = 0; $ec_s < 5; $ec_s++ ) : ?><i class="fas fa-star" aria-hidden="true"></i><?php endfor; ?>
                </div>
                <blockquote class="ec-tcard-text"><?php echo esc_html( $ec_story['text'] ); ?></blockquote>
                <figcaption class="ec-tcard-author">
                    <span class="ec-tcard-avatar"><?php echo esc_html( mb_substr( $ec_story['name'], 0, 1 ) ); ?></span>
                    <span class="ec-tcard-id">
                        <span class="ec-tcard-name"><?php echo esc_html( $ec_story['name'] ); ?></span>
                        <span class="ec-tcard-role"><?php echo esc_html( $ec_story['role'] ); ?></span>
                    </span>
                </figcaption>
            </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>
