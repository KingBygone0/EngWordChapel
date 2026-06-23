<?php
/**
 * Pillars Section ("What We Do")
 *
 * The Emanu three-up "Services" cards, recast as the ministries of the Word
 * that define this church: prayer, teaching, and outreach.
 *
 * @package Engrafted_Chapel
 */

$ec_pillars = array(
    array(
        'icon'  => 'fas fa-hands-praying',
        'title' => __( 'Prayer &amp; Intercession', 'engrafted-chapel' ),
        'text'  => __( 'We believe in the power of prayer. Our gatherings give dedicated time to seek God, stand in the gap, and watch Him move.', 'engrafted-chapel' ),
        'url'   => home_url( '/events' ),
    ),
    array(
        'icon'  => 'fas fa-book-bible',
        'title' => __( 'Bible Study &amp; Teaching', 'engrafted-chapel' ),
        'text'  => __( 'The engrafted Word, rightly taught, transforms ordinary lives. We open the Scriptures with clarity so faith can take root and grow.', 'engrafted-chapel' ),
        'url'   => home_url( '/sermons' ),
    ),
    array(
        'icon'  => 'fas fa-hand-holding-heart',
        'title' => __( 'Outreach &amp; Community', 'engrafted-chapel' ),
        'text'  => __( 'Called to share His hope, we reach beyond our walls — proclaiming the gospel and loving our community in word and deed.', 'engrafted-chapel' ),
        'url'   => home_url( '/outreach' ),
    ),
);
?>

<section class="ec-section ec-section-light ec-pillars" id="what-we-do">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'What We Do', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'Connecting lives through the Word', 'engrafted-chapel' ); ?></h2>
            <p class="ec-section-desc"><?php esc_html_e( 'Three ministries carry the heartbeat of Engrafted Word Chapel — and there is a place for you in each one.', 'engrafted-chapel' ); ?></p>
        </div>

        <div class="ec-pillars-grid">
            <?php foreach ( $ec_pillars as $ec_pillar ) : ?>
            <article class="ec-pillar-card">
                <span class="ec-pillar-icon"><i class="<?php echo esc_attr( $ec_pillar['icon'] ); ?>" aria-hidden="true"></i></span>
                <h3><?php echo wp_kses_post( $ec_pillar['title'] ); ?></h3>
                <p><?php echo esc_html( wp_strip_all_tags( $ec_pillar['text'] ) ); ?></p>
                <a href="<?php echo esc_url( $ec_pillar['url'] ); ?>" class="ec-learn-more">
                    <?php esc_html_e( 'Read More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
