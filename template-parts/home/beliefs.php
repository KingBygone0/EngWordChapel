<?php
/**
 * Beliefs Section ("What We Believe")
 *
 * The Emanu "What We Believe" block, populated with the church's own confession.
 * Reuses the shared .ec-belief-card component used on the About / Bible College
 * pages so the styling stays consistent across the site.
 *
 * @package Engrafted_Chapel
 */

$ec_beliefs = array(
    array(
        'title' => __( 'One God, the Holy Trinity', 'engrafted-chapel' ),
        'text'  => __( 'The oneness of God — the unity of the Godhead and the trinity of the persons therein.', 'engrafted-chapel' ),
    ),
    array(
        'title' => __( 'The Holy Scriptures', 'engrafted-chapel' ),
        'text'  => __( 'The divine inspiration and authority of the Bible as the inspired, infallible Word of God.', 'engrafted-chapel' ),
    ),
    array(
        'title' => __( 'Jesus Christ', 'engrafted-chapel' ),
        'text'  => __( 'His virgin birth, sinless life, atoning death, resurrection, ascension and second coming.', 'engrafted-chapel' ),
    ),
    array(
        'title' => __( 'Salvation by Grace', 'engrafted-chapel' ),
        'text'  => __( 'Justification and sanctification through the finished work of Christ, received by faith.', 'engrafted-chapel' ),
    ),
);
?>

<section class="ec-section ec-section-white ec-beliefs" id="beliefs">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'What We Believe', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'One church, anchored in the faith', 'engrafted-chapel' ); ?></h2>
            <p class="ec-section-desc"><?php esc_html_e( 'Everything we do is centred on Jesus Christ and the truth of His Word. These are the convictions we hold in common.', 'engrafted-chapel' ); ?></p>
        </div>

        <div class="ec-beliefs-grid">
            <?php $ec_i = 0; foreach ( $ec_beliefs as $ec_belief ) : $ec_i++; ?>
            <article class="ec-belief-card">
                <div class="ec-number"><?php echo esc_html( sprintf( '%02d', $ec_i ) ); ?></div>
                <h3><?php echo esc_html( $ec_belief['title'] ); ?></h3>
                <p><?php echo esc_html( $ec_belief['text'] ); ?></p>
            </article>
            <?php endforeach; ?>
        </div>

        <div class="ec-text-center ec-mt-2">
            <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="ec-view-link">
                <?php esc_html_e( 'Read our full statement of faith', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>
