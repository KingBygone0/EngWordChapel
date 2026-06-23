<?php
/**
 * Affiliations Strip
 *
 * The Emanu "partner logos" slot, reframed for a church: the fellowships and
 * institutions Engrafted Word Chapel is rooted in and accountable to. Text-set
 * rather than faux logos, so nothing here is invented imagery.
 *
 * @package Engrafted_Chapel
 */

$ec_affiliations = array(
    get_theme_mod( 'ec_affil_1', __( 'The Apostolic Church — Ghana', 'engrafted-chapel' ) ),
    get_theme_mod( 'ec_affil_2', __( 'Agape Bible College', 'engrafted-chapel' ) ),
    get_theme_mod( 'ec_affil_3', __( 'Mission Die Theological Seminary', 'engrafted-chapel' ) ),
    get_theme_mod( 'ec_affil_4', __( 'Africa Association of Bible Schools', 'engrafted-chapel' ) ),
);
$ec_affiliations = array_filter( $ec_affiliations );

if ( empty( $ec_affiliations ) ) {
    return;
}
?>

<section class="ec-affiliations" id="affiliations">
    <div class="ec-container">
        <span class="ec-affiliations-eyebrow"><?php esc_html_e( 'In fellowship & affiliation with', 'engrafted-chapel' ); ?></span>
        <ul class="ec-affiliations-list">
            <?php foreach ( $ec_affiliations as $ec_affil ) : ?>
                <li><?php echo esc_html( $ec_affil ); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
