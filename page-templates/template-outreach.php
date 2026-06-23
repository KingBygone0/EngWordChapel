<?php
/**
 * Template Name: Outreach
 *
 * Image-rich outreach page: intro, the two arms of outreach (Evangelism and
 * Follow-up & Visitation) as alternating image/text sections, and a CTA.
 * Images are set in Customize → Outreach Page.
 *
 * @package Engrafted_Chapel
 */

get_header();

ec_page_header(
    get_the_title(),
    __( 'Sharing the hope and love of Christ — within and beyond the church', 'engrafted-chapel' ),
    'ec-ph-outreach',
    __( 'Mark 16:15 — Go Into All the World', 'engrafted-chapel' )
);

$ec_img1 = get_theme_mod( 'ec_outreach_img_1' );
$ec_img2 = get_theme_mod( 'ec_outreach_img_2' );
$ec_img3 = get_theme_mod( 'ec_outreach_img_3' );

if ( ! function_exists( 'ec_outreach_media' ) ) {
    function ec_outreach_media( $url, $icon ) {
        if ( $url ) {
            printf( '<img src="%s" alt="">', esc_url( $url ) );
        } else {
            printf( '<div class="ec-about-media-fallback"><i class="fas %s" aria-hidden="true"></i></div>', esc_attr( $icon ) );
        }
    }
}
?>

<!-- Intro -->
<section class="ec-section ec-section-white ec-outreach-intro">
    <div class="ec-container">
        <div class="ec-out-grid">
            <div class="ec-out-media"><?php ec_outreach_media( $ec_img1, 'fa-hand-holding-heart' ); ?></div>
            <div class="ec-out-body">
                <span class="ec-section-label"><?php esc_html_e( 'Outreach &amp; Mission', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'So that those who are lost will be found', 'engrafted-chapel' ); ?></h2>
                <p><?php esc_html_e( 'We are called as followers of Christ to share His message of hope and love, leading others into a life-changing personal relationship with Him — both within and beyond the walls of the church.', 'engrafted-chapel' ); ?></p>
                <ul class="ec-about-vision" style="list-style:none;">
                    <li style="display:flex;gap:0.6rem;align-items:baseline;padding:0.35rem 0;"><i class="fas fa-leaf" style="color:var(--em-accent);"></i> <?php esc_html_e( 'Proclaiming the gospel to the lost in our community.', 'engrafted-chapel' ); ?></li>
                    <li style="display:flex;gap:0.6rem;align-items:baseline;padding:0.35rem 0;"><i class="fas fa-leaf" style="color:var(--em-accent);"></i> <?php esc_html_e( 'Caring for every newcomer so no one slips through the cracks.', 'engrafted-chapel' ); ?></li>
                    <li style="display:flex;gap:0.6rem;align-items:baseline;padding:0.35rem 0;"><i class="fas fa-leaf" style="color:var(--em-accent);"></i> <?php esc_html_e( 'Equipping the church to share their faith with confidence.', 'engrafted-chapel' ); ?></li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Get Involved', 'engrafted-chapel' ); ?></a>
            </div>
        </div>
    </div>
</section>

<!-- Arm 1: Evangelism -->
<section class="ec-section ec-section-light">
    <div class="ec-container">
        <div class="ec-out-grid">
            <div class="ec-out-media"><?php ec_outreach_media( $ec_img2, 'fa-bullhorn' ); ?></div>
            <div class="ec-out-body">
                <span class="ec-section-label"><?php esc_html_e( 'Easy Yoke', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Evangelism', 'engrafted-chapel' ); ?></h2>
                <p><?php esc_html_e( 'Christ calls us to share His promise of eternal love and life. Our Evangelism Ministry partners with the Mission Ministry to reach people who may not yet know that Jesus loves them and has a plan for their lives.', 'engrafted-chapel' ); ?></p>
                <p><?php esc_html_e( 'Our core team is trained using the “Sharing Jesus Without Fear” curriculum, and we are equipping other ministries to share their faith with confidence and grace.', 'engrafted-chapel' ); ?></p>
                <blockquote class="ec-give-verse" style="border-left:4px solid var(--em-accent);"><?php esc_html_e( 'We proclaim the gospel and salvation of Jesus Christ — both within and outside the church — so that those who are lost will be found.', 'engrafted-chapel' ); ?></blockquote>
            </div>
        </div>
    </div>
</section>

<!-- Arm 2: Follow-up & Visitation -->
<section class="ec-section ec-section-white">
    <div class="ec-container">
        <div class="ec-out-grid ec-out-grid-rev">
            <div class="ec-out-media"><?php ec_outreach_media( $ec_img3, 'fa-people-carry-box' ); ?></div>
            <div class="ec-out-body">
                <span class="ec-section-label"><?php esc_html_e( 'Lighter Burden', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Follow-up &amp; Visitation', 'engrafted-chapel' ); ?></h2>
                <p><?php esc_html_e( 'This department conducts intensive visitation and follow-up of newcomers and members alike. We provide care and support for recent guests and absent members, helping to integrate every newcomer into the life of the church family.', 'engrafted-chapel' ); ?></p>
                <p><?php esc_html_e( 'We also keep careful records of converts and members so that no one slips through the cracks — every soul matters, and every person is followed up with love.', 'engrafted-chapel' ); ?></p>
            </div>
        </div>
    </div>
</section>

<div class="ec-container">
    <div class="ec-cta-band">
        <h2><?php esc_html_e( 'Join the mission', 'engrafted-chapel' ); ?></h2>
        <p><?php esc_html_e( 'Whether you want to share your faith or help care for our newcomers, there\'s a place for you in outreach. Reach out and get involved.', 'engrafted-chapel' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-gold"><?php esc_html_e( 'Get Involved', 'engrafted-chapel' ); ?></a>
    </div>
</div>

<?php get_footer(); ?>
