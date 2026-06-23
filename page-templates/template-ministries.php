<?php
/**
 * Template Name: Ministries
 *
 * Rebuilt to mirror the Emanu "Services" page — a grid of cards with a circular
 * image, title, slogan and description, each filling with the crimson accent on
 * hover. Pulls from the Ministry CPT, with the church's real ministries as the
 * fallback so the page is populated even before any posts are added.
 *
 * @package Engrafted_Chapel
 */

get_header();

ec_page_header(
    get_the_title(),
    __( 'Ministries that serve every generation faithfully', 'engrafted-chapel' ),
    'ec-ph-ministries',
    __( '1 Corinthians 12:27 — One Body', 'engrafted-chapel' )
);

// Collect ministries from the CPT.
$ec_query = ec_get_ministries( -1 );
$ec_cards = array();
$ec_icons = array( 'fa-child', 'fa-fire', 'fa-dove', 'fa-hands-helping', 'fa-music', 'fa-hands-praying' );

if ( $ec_query->have_posts() ) {
    $ec_i = 0;
    while ( $ec_query->have_posts() ) {
        $ec_query->the_post();
        $ec_cards[] = array(
            'title'  => get_the_title(),
            'slogan' => get_post_meta( get_the_ID(), '_ec_ministry_slogan', true ),
            'text'   => wp_trim_words( get_the_excerpt(), 22 ),
            'url'    => get_permalink(),
            'img'    => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium' ) : '',
            'icon'   => $ec_icons[ $ec_i % count( $ec_icons ) ],
        );
        $ec_i++;
    }
    wp_reset_postdata();
}

// Fallback: the church's five ministries, shown until CPT posts are added.
if ( empty( $ec_cards ) ) {
    $ec_cards = array(
        array(
            'title'  => __( 'Engrafted Children', 'engrafted-chapel' ),
            'slogan' => __( 'Babes and Sucklings', 'engrafted-chapel' ),
            'text'   => __( 'Tutors and monitors who care for our children as their own, instilling biblical principles and values for a life of purpose, authority and dominion.', 'engrafted-chapel' ),
            'url'    => home_url( '/ministries' ), 'img' => '', 'icon' => 'fa-child',
        ),
        array(
            'title'  => __( 'Engrafted Youth', 'engrafted-chapel' ),
            'slogan' => __( 'Salt and Light', 'engrafted-chapel' ),
            'text'   => __( 'Students growing in their relationship with God through powerful worship, anointed messages and fellowship — because young people ARE the church.', 'engrafted-chapel' ),
            'url'    => home_url( '/ministries' ), 'img' => '', 'icon' => 'fa-fire',
        ),
        array(
            'title'  => __( 'Engrafted Ladies', 'engrafted-chapel' ),
            'slogan' => __( 'Daughters of Sarah', 'engrafted-chapel' ),
            'text'   => __( 'Women coming to a place of wholeness and obedience in Jesus Christ, where His abundant life ministers both to us and through us.', 'engrafted-chapel' ),
            'url'    => home_url( '/ministries' ), 'img' => '', 'icon' => 'fa-dove',
        ),
        array(
            'title'  => __( 'Engrafted Men', 'engrafted-chapel' ),
            'slogan' => __( 'Sacrifice and Service of Faith', 'engrafted-chapel' ),
            'text'   => __( 'We do not just talk — we act. No distance is too far and no task too great. That is the heart of the SSF.', 'engrafted-chapel' ),
            'url'    => home_url( '/ministries' ), 'img' => '', 'icon' => 'fa-hands-helping',
        ),
        array(
            'title'  => __( 'Word Impact Choir', 'engrafted-chapel' ),
            'slogan' => __( 'Life of Praise and Worship', 'engrafted-chapel' ),
            'text'   => __( 'Through training, weekly rehearsals and discipleship we ENCOURAGE, EQUIP and EXALT Christ with a life of praise and worship.', 'engrafted-chapel' ),
            'url'    => home_url( '/ministries' ), 'img' => '', 'icon' => 'fa-music',
        ),
    );
}
?>

<section class="ec-section ec-section-white ec-ministries-page">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'Connecting Lives Through Our Ministries', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'Find Your Place to Belong', 'engrafted-chapel' ); ?></h2>
            <p class="ec-section-desc"><?php esc_html_e( 'There is a place for everyone in the family of Engrafted Word Chapel. Discover where you can belong, grow and serve.', 'engrafted-chapel' ); ?></p>
        </div>

        <div class="ec-ministry-cards">
            <?php foreach ( $ec_cards as $ec_card ) : ?>
            <a class="ec-ministry-svc-card" href="<?php echo esc_url( $ec_card['url'] ); ?>">
                <span class="ec-ministry-svc-img<?php echo $ec_card['img'] ? '' : ' ec-ministry-svc-img-icon'; ?>">
                    <?php if ( $ec_card['img'] ) : ?>
                        <img src="<?php echo esc_url( $ec_card['img'] ); ?>" alt="<?php echo esc_attr( $ec_card['title'] ); ?>">
                    <?php else : ?>
                        <i class="fas <?php echo esc_attr( $ec_card['icon'] ); ?>" aria-hidden="true"></i>
                    <?php endif; ?>
                </span>
                <h3><?php echo esc_html( $ec_card['title'] ); ?></h3>
                <?php if ( ! empty( $ec_card['slogan'] ) ) : ?>
                <span class="ec-ministry-svc-slogan"><?php echo esc_html( $ec_card['slogan'] ); ?></span>
                <?php endif; ?>
                <p><?php echo esc_html( $ec_card['text'] ); ?></p>
                <span class="ec-ministry-svc-more"><?php esc_html_e( 'Read More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="ec-container">
    <div class="ec-cta-band">
        <h2><?php esc_html_e( 'Find your place to serve', 'engrafted-chapel' ); ?></h2>
        <p><?php esc_html_e( 'There is a ministry for every season of life. Reach out and we will help you get connected.', 'engrafted-chapel' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-gold"><?php esc_html_e( 'Get Connected', 'engrafted-chapel' ); ?></a>
    </div>
</div>

<?php get_footer(); ?>
