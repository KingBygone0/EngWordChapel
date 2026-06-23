<?php
/**
 * Give Section ("Donate Now")
 *
 * The Emanu donation block, reframed as an invitation to give in the church's
 * own voice. Giving details are intentionally not hard-coded here — the button
 * sends people to Contact, where current methods can be listed safely.
 *
 * @package Engrafted_Chapel
 */
?>

<section class="ec-give" id="give">
    <div class="ec-container">
        <div class="ec-give-inner">
            <div class="ec-give-content">
                <span class="ec-section-label"><?php esc_html_e( 'Give', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Sow into the work of the gospel', 'engrafted-chapel' ); ?></h2>
                <p><?php esc_html_e( 'Every tithe, offering and seed sown helps the engrafted Word reach further — supporting our ministries, our outreach, and the training of new ministers for the harvest.', 'engrafted-chapel' ); ?></p>
                <blockquote class="ec-give-verse">
                    <?php esc_html_e( '“Each one must give as he has decided in his heart, not reluctantly or under compulsion, for God loves a cheerful giver.”', 'engrafted-chapel' ); ?>
                    <cite><?php esc_html_e( '2 Corinthians 9:7', 'engrafted-chapel' ); ?></cite>
                </blockquote>
                <div class="ec-give-actions">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Ways to Give', 'engrafted-chapel' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-outline"><?php esc_html_e( 'Talk to Us', 'engrafted-chapel' ); ?></a>
                </div>
            </div>

            <ul class="ec-give-ways">
                <li>
                    <span class="ec-give-way-icon"><i class="fas fa-hand-holding-dollar" aria-hidden="true"></i></span>
                    <div>
                        <h3><?php esc_html_e( 'Tithes & Offerings', 'engrafted-chapel' ); ?></h3>
                        <p><?php esc_html_e( 'Honour God with the firstfruits of your increase, in person at any service.', 'engrafted-chapel' ); ?></p>
                    </div>
                </li>
                <li>
                    <span class="ec-give-way-icon"><i class="fas fa-mobile-screen-button" aria-hidden="true"></i></span>
                    <div>
                        <h3><?php esc_html_e( 'Mobile & Transfer', 'engrafted-chapel' ); ?></h3>
                        <p><?php esc_html_e( 'Give from anywhere. Contact the church office for current account details.', 'engrafted-chapel' ); ?></p>
                    </div>
                </li>
                <li>
                    <span class="ec-give-way-icon"><i class="fas fa-seedling" aria-hidden="true"></i></span>
                    <div>
                        <h3><?php esc_html_e( 'Mission Seed', 'engrafted-chapel' ); ?></h3>
                        <p><?php esc_html_e( 'Partner with our outreach and seminary to send the gospel to the lost.', 'engrafted-chapel' ); ?></p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
