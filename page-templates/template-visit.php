<?php
/**
 * Template Name: Plan Your Visit
 *
 * A newcomer-focused page: a warm intro, what to expect, when & where, a note
 * for families, and a clear first step. Built in the Emanu skin.
 *
 * @package Engrafted_Chapel
 */

get_header();

$ec_img      = get_theme_mod( 'ec_welcome_image' );
$ec_contact  = ec_get_contact_info();
$ec_services = ec_get_services();
$ec_map_q    = rawurlencode( get_theme_mod( 'ec_church_name', 'Engrafted Word Chapel International' ) . ' ' . $ec_contact['address'] );

ec_page_header(
    get_the_title(),
    __( 'Everything you need for your first time with us', 'engrafted-chapel' ),
    'ec-ph-about',
    __( 'We can\'t wait to meet you', 'engrafted-chapel' )
);
?>

<!-- Welcome intro -->
<section class="ec-section ec-section-white">
    <div class="ec-container">
        <div class="ec-about-grid">
            <div class="ec-about-media">
                <?php if ( $ec_img ) : ?>
                    <img src="<?php echo esc_url( $ec_img ); ?>" alt="<?php esc_attr_e( 'Worship at Engrafted Word Chapel', 'engrafted-chapel' ); ?>">
                <?php else : ?>
                    <div class="ec-about-media-fallback"><i class="fas fa-church" aria-hidden="true"></i></div>
                <?php endif; ?>
            </div>
            <div class="ec-about-content">
                <span class="ec-section-label"><?php esc_html_e( 'Welcome Home', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Your first time? You belong here.', 'engrafted-chapel' ); ?></h2>
                <p><?php esc_html_e( 'We know visiting a new church can feel a little daunting. Whoever you are and wherever you are from, you will be welcomed as family the moment you walk through the door. Here is what to expect when you join us.', 'engrafted-chapel' ); ?></p>
                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo esc_attr( $ec_map_q ); ?>" target="_blank" rel="noopener" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Get Directions', 'engrafted-chapel' ); ?></a>
            </div>
        </div>
    </div>
</section>

<!-- What to expect -->
<section class="ec-section ec-section-light ec-pillars">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'What to Expect', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'Relax — you are among family', 'engrafted-chapel' ); ?></h2>
        </div>
        <div class="ec-pillars-grid ec-visit-grid">
            <article class="ec-pillar-card">
                <span class="ec-pillar-icon"><i class="fas fa-shirt" aria-hidden="true"></i></span>
                <h3><?php esc_html_e( 'Come As You Are', 'engrafted-chapel' ); ?></h3>
                <p><?php esc_html_e( 'There is no dress code. Come comfortable — you will fit right in.', 'engrafted-chapel' ); ?></p>
            </article>
            <article class="ec-pillar-card">
                <span class="ec-pillar-icon"><i class="far fa-clock" aria-hidden="true"></i></span>
                <h3><?php esc_html_e( 'About Two Hours', 'engrafted-chapel' ); ?></h3>
                <p><?php esc_html_e( 'Our Sunday celebration runs roughly two hours of worship, the Word and prayer.', 'engrafted-chapel' ); ?></p>
            </article>
            <article class="ec-pillar-card">
                <span class="ec-pillar-icon"><i class="fas fa-handshake" aria-hidden="true"></i></span>
                <h3><?php esc_html_e( 'A Warm Welcome', 'engrafted-chapel' ); ?></h3>
                <p><?php esc_html_e( 'Our welcome team will greet you at the door, help you find a seat and answer your questions.', 'engrafted-chapel' ); ?></p>
            </article>
            <article class="ec-pillar-card">
                <span class="ec-pillar-icon"><i class="fas fa-dove" aria-hidden="true"></i></span>
                <h3><?php esc_html_e( 'Spirit &amp; Truth', 'engrafted-chapel' ); ?></h3>
                <p><?php esc_html_e( 'Expect heartfelt worship and practical, Bible-centred teaching you can carry into the week.', 'engrafted-chapel' ); ?></p>
            </article>
        </div>
    </div>
</section>

<!-- When & Where -->
<section class="ec-section ec-section-white">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'When &amp; Where', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'Join us this week', 'engrafted-chapel' ); ?></h2>
        </div>
        <div class="ec-mv-grid ec-visit-times">
            <?php foreach ( $ec_services as $ec_svc ) : ?>
            <div class="ec-mv-item">
                <span class="ec-mv-icon"><i class="far fa-calendar-check" aria-hidden="true"></i></span>
                <h3><?php echo esc_html( $ec_svc['name'] ); ?></h3>
                <p><strong><?php echo esc_html( $ec_svc['day'] ); ?></strong><br><?php echo esc_html( $ec_svc['time'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="ec-visit-where">
            <span class="ec-visit-where-ico"><i class="fas fa-location-dot" aria-hidden="true"></i></span>
            <div>
                <span class="ec-contact-item-label"><?php esc_html_e( 'Our Location', 'engrafted-chapel' ); ?></span>
                <span><?php echo esc_html( $ec_contact['address'] ); ?></span>
            </div>
            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo esc_attr( $ec_map_q ); ?>" target="_blank" rel="noopener" class="ec-btn ec-btn-outline"><?php esc_html_e( 'Get Directions', 'engrafted-chapel' ); ?></a>
        </div>
    </div>
</section>

<!-- For your family -->
<section class="ec-give">
    <div class="ec-container">
        <div class="ec-give-inner">
            <div class="ec-give-content">
                <span class="ec-section-label"><?php esc_html_e( 'For Your Family', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Your children are in great hands', 'engrafted-chapel' ); ?></h2>
                <p><?php esc_html_e( 'Engrafted Children offers a fun, safe and faith-filled environment where little ones are cared for and taught biblical values. Older students are welcomed into Engrafted Youth to grow in faith and friendship.', 'engrafted-chapel' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/ministries' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Explore Our Ministries', 'engrafted-chapel' ); ?></a>
            </div>
            <ul class="ec-give-ways">
                <li><span class="ec-give-way-icon"><i class="fas fa-child" aria-hidden="true"></i></span><div><h3><?php esc_html_e( 'Engrafted Children', 'engrafted-chapel' ); ?></h3><p><?php esc_html_e( 'Caring tutors and a safe space for babes and sucklings.', 'engrafted-chapel' ); ?></p></div></li>
                <li><span class="ec-give-way-icon"><i class="fas fa-fire" aria-hidden="true"></i></span><div><h3><?php esc_html_e( 'Engrafted Youth', 'engrafted-chapel' ); ?></h3><p><?php esc_html_e( 'Salt and light — students growing in Christ together.', 'engrafted-chapel' ); ?></p></div></li>
                <li><span class="ec-give-way-icon"><i class="fas fa-people-roof" aria-hidden="true"></i></span><div><h3><?php esc_html_e( 'A Family for Everyone', 'engrafted-chapel' ); ?></h3><p><?php esc_html_e( 'Women, men and music — there is a place for you.', 'engrafted-chapel' ); ?></p></div></li>
            </ul>
        </div>
    </div>
</section>

<!-- CTA -->
<div class="ec-container">
    <div class="ec-cta-band">
        <h2><?php esc_html_e( 'We\'ve saved you a seat', 'engrafted-chapel' ); ?></h2>
        <p><?php esc_html_e( 'Let us know you\'re coming and we\'ll look out for you — or just show up. Either way, we can\'t wait to meet you.', 'engrafted-chapel' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-gold"><?php esc_html_e( 'Let Us Know You\'re Coming', 'engrafted-chapel' ); ?></a>
    </div>
</div>

<?php get_footer(); ?>
