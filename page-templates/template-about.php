<?php
/**
 * Template Name: About
 *
 * Rebuilt to mirror the Emanu "About Us" page layout (banner, story, beliefs,
 * values, pastor, impact, verse, FAQ, CTA) in the Engrafted/Emanu skin, using
 * the church's own story, mission, vision, beliefs and pastor.
 *
 * @package Engrafted_Chapel
 */

get_header();

$ec_contact     = ec_get_contact_info();
$ec_phones      = array_filter( $ec_contact['phones'] );
$ec_phone       = $ec_phones ? reset( $ec_phones ) : '';
$ec_about_img   = get_theme_mod( 'ec_welcome_image' );
$ec_pastor_name = get_theme_mod( 'ec_pastor_name', 'Rev. Clifford De-graft Ade' );
$ec_pastor_role = get_theme_mod( 'ec_pastor_title', 'Senior Pastor & Founder' );
$ec_founded     = (int) get_theme_mod( 'ec_about_founded_year', 2010 );
$ec_years       = max( 1, (int) gmdate( 'Y' ) - $ec_founded );
?>

<!-- BANNER -->
<div class="ec-page-header ec-ph-about ec-about-banner">
    <div class="ec-page-header-bg" style="background-image: url('<?php echo esc_url( ec_page_header_bg() ); ?>');"></div>
    <div class="ec-page-header-overlay"></div>
    <div class="ec-page-header-content">
        <h1><?php esc_html_e( 'About Us', 'engrafted-chapel' ); ?></h1>
        <nav class="ec-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'engrafted-chapel' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'engrafted-chapel' ); ?></a>
            <span aria-hidden="true">/</span>
            <span><?php esc_html_e( 'About Us', 'engrafted-chapel' ); ?></span>
        </nav>
    </div>
</div>

<!-- STORY -->
<section class="ec-section ec-section-white ec-about-story">
    <div class="ec-container">
        <div class="ec-about-story-grid">
            <div class="ec-about-story-content">
                <span class="ec-section-label"><?php esc_html_e( 'Our Story, Faith, Mission & Vision', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php echo esc_html( get_theme_mod( 'ec_ap_story_heading', 'Degrafted from the world, engrafted into Christ' ) ); ?></h2>
                <p><?php echo esc_html( get_theme_mod( 'ec_ap_story_text', 'Our story is rooted in a deep commitment to sharing God\'s love and guiding people toward a meaningful relationship with Christ. It began on the 9th of September, when two friends became prayer partners with Rev. Clifford De-graft Ade — and has grown into a scripturally, spiritually and physically healthy family where love is both expressed and felt.' ) ); ?></p>

                <div class="ec-mv-grid">
                    <div class="ec-mv-item">
                        <span class="ec-mv-icon"><i class="fas fa-bullseye" aria-hidden="true"></i></span>
                        <h3><?php esc_html_e( 'Our Mission', 'engrafted-chapel' ); ?></h3>
                        <p><?php echo esc_html( get_theme_mod( 'ec_ap_mission', 'To bring people to Jesus for restoration to the original God-ordained state of man, through the propagation of the Good News and the development of model New Testament Christians and churches.' ) ); ?></p>
                    </div>
                    <div class="ec-mv-item">
                        <span class="ec-mv-icon"><i class="fas fa-eye" aria-hidden="true"></i></span>
                        <h3><?php esc_html_e( 'Our Vision', 'engrafted-chapel' ); ?></h3>
                        <p><?php echo esc_html( get_theme_mod( 'ec_ap_vision', 'Serving God through our generation, impacting society through Christ, and manifesting the glory of our God in all the earth.' ) ); ?></p>
                    </div>
                </div>

                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Contact Us Now', 'engrafted-chapel' ); ?></a>
            </div>

            <div class="ec-about-story-media">
                <?php if ( $ec_about_img ) : ?>
                    <img src="<?php echo esc_url( $ec_about_img ); ?>" alt="<?php esc_attr_e( 'The Engrafted Word Chapel family', 'engrafted-chapel' ); ?>">
                <?php else : ?>
                    <div class="ec-about-media-fallback"><i class="fas fa-church" aria-hidden="true"></i></div>
                <?php endif; ?>
                <div class="ec-about-pastor-tag">
                    <span class="ec-about-pastor-avatar"><i class="fas fa-user" aria-hidden="true"></i></span>
                    <span class="ec-about-pastor-id">
                        <span class="ec-about-pastor-name"><?php echo esc_html( $ec_pastor_name ); ?></span>
                        <span class="ec-about-pastor-role"><?php echo esc_html( $ec_pastor_role ); ?></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHAT WE BELIEVE -->
<section class="ec-section ec-section-light ec-beliefs ec-about-beliefs">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'Christ-Centred Beliefs That Guide Our Lives', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'What We Believe', 'engrafted-chapel' ); ?></h2>
        </div>
        <div class="ec-beliefs-grid ec-beliefs-grid-3">
            <article class="ec-belief-card">
                <div class="ec-number">01</div>
                <h3><?php esc_html_e( 'One God, the Holy Trinity', 'engrafted-chapel' ); ?></h3>
                <p><?php esc_html_e( 'We believe in one God who exists eternally in three persons — Father, Son and Holy Spirit — one in the unity of the Godhead.', 'engrafted-chapel' ); ?></p>
            </article>
            <article class="ec-belief-card">
                <div class="ec-number">02</div>
                <h3><?php esc_html_e( 'Jesus Christ, Our Saviour', 'engrafted-chapel' ); ?></h3>
                <p><?php esc_html_e( 'His virgin birth, sinless life, atoning death, triumphant resurrection, ascension and abiding intercession, and His second coming.', 'engrafted-chapel' ); ?></p>
            </article>
            <article class="ec-belief-card">
                <div class="ec-number">03</div>
                <h3><?php esc_html_e( 'Authority of the Bible', 'engrafted-chapel' ); ?></h3>
                <p><?php esc_html_e( 'The divine inspiration and authority of the Holy Scriptures as the inspired, infallible and authoritative Word of God.', 'engrafted-chapel' ); ?></p>
            </article>
        </div>
        <div class="ec-text-center ec-mt-2">
            <span class="ec-about-foot-note"><?php esc_html_e( 'Core principles that define our spiritual path.', 'engrafted-chapel' ); ?></span>
            <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="ec-view-link"><?php esc_html_e( 'View Details', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
</section>

<!-- CHRISTIAN VALUES + CALL BOX -->
<section class="ec-section ec-section-white ec-about-values">
    <div class="ec-container">
        <div class="ec-values-grid">
            <div class="ec-values-content">
                <span class="ec-section-label"><?php esc_html_e( 'Our Christian Values That Lead Our Ministry', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Our Mission', 'engrafted-chapel' ); ?></h2>
                <p><?php esc_html_e( 'A HUMBLE person, willing to SACRIFICE, will SERVE God greatly. These values are the foundation of everything we do — guided by faith, love, compassion and integrity as we serve God and one another.', 'engrafted-chapel' ); ?></p>

                <ul class="ec-value-list">
                    <li>
                        <span class="ec-value-list-icon"><i class="fas fa-hands-praying" aria-hidden="true"></i></span>
                        <div><h3><?php esc_html_e( 'Humility', 'engrafted-chapel' ); ?></h3><p><?php esc_html_e( 'We walk humbly before God and man, knowing that all we have comes from Him.', 'engrafted-chapel' ); ?></p></div>
                    </li>
                    <li>
                        <span class="ec-value-list-icon"><i class="fas fa-fire" aria-hidden="true"></i></span>
                        <div><h3><?php esc_html_e( 'Sacrifice', 'engrafted-chapel' ); ?></h3><p><?php esc_html_e( 'We give of ourselves gladly for the sake of the Gospel and one another.', 'engrafted-chapel' ); ?></p></div>
                    </li>
                    <li>
                        <span class="ec-value-list-icon"><i class="fas fa-hand-holding-heart" aria-hidden="true"></i></span>
                        <div><h3><?php esc_html_e( 'Service', 'engrafted-chapel' ); ?></h3><p><?php esc_html_e( 'We serve God greatly by serving His people with love and excellence.', 'engrafted-chapel' ); ?></p></div>
                    </li>
                </ul>

                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Plan a Visit', 'engrafted-chapel' ); ?></a>
            </div>

            <aside class="ec-values-media">
                <div class="ec-values-img">
                    <?php if ( $ec_about_img ) : ?>
                        <img src="<?php echo esc_url( $ec_about_img ); ?>" alt="<?php esc_attr_e( 'Worship at Engrafted Word Chapel', 'engrafted-chapel' ); ?>">
                    <?php else : ?>
                        <div class="ec-about-media-fallback"><i class="fas fa-people-group" aria-hidden="true"></i></div>
                    <?php endif; ?>
                </div>
                <?php if ( $ec_phone ) : ?>
                <div class="ec-call-box">
                    <span class="ec-call-icon"><i class="fas fa-phone" aria-hidden="true"></i></span>
                    <div>
                        <span class="ec-call-label"><?php esc_html_e( 'Call us!', 'engrafted-chapel' ); ?></span>
                        <a class="ec-call-number" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $ec_phone ) ); ?>"><?php echo esc_html( $ec_phone ); ?></a>
                    </div>
                </div>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</section>

<!-- OUR PASTOR -->
<section class="ec-section ec-section-light ec-about-pastor">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'Meet Our Dedicated Church Leadership', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'Our Pastor', 'engrafted-chapel' ); ?></h2>
        </div>
        <div class="ec-pastor-feature">
            <div class="ec-pastor-feature-media">
                <?php
                $ec_pastor_img = get_theme_mod( 'ec_pastor_image' );
                if ( $ec_pastor_img ) :
                    ?>
                    <img src="<?php echo esc_url( $ec_pastor_img ); ?>" alt="<?php echo esc_attr( $ec_pastor_name ); ?>">
                <?php else : ?>
                    <div class="ec-about-media-fallback"><i class="fas fa-user-tie" aria-hidden="true"></i></div>
                <?php endif; ?>
                <div class="ec-pastor-social">
                    <?php foreach ( ec_get_social_links() as $ec_social ) : ?>
                        <a href="<?php echo esc_url( $ec_social['url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $ec_social['label'] ); ?>"><i class="fab <?php echo esc_attr( $ec_social['icon'] ); ?>" aria-hidden="true"></i></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="ec-pastor-feature-body">
                <h3><?php echo esc_html( $ec_pastor_name ); ?></h3>
                <span class="ec-pastor-feature-role"><?php echo esc_html( $ec_pastor_role ); ?></span>
                <?php
                $ec_pastor_bio_default = "A Ghanaian with Togolese heritage, born into a large family where he learned early what it means to live a collective life. He became a serious Christian during his secondary education and, in obedience to God's call, enrolled in Agape Bible College in 2005, graduating with a degree in Bible Ministry.\n\nDuring one of our prayer sessions, the phrase \"grafting the Word\" came to him — a study of Romans 11 and James 1:21 revealed that we are degrafted from the world of sin and engrafted into Christ through the preaching of His Word. From that revelation, Engrafted Word Chapel was born.";
                echo wpautop( esc_html( get_theme_mod( 'ec_pastor_bio', $ec_pastor_bio_default ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>
            </div>
        </div>
    </div>
</section>

<!-- CHURCH IMPACT -->
<section class="ec-section ec-section-white ec-about-impact">
    <div class="ec-container">
        <div class="ec-impact-grid">
            <div class="ec-impact-content">
                <span class="ec-section-label"><?php esc_html_e( 'Making a Difference Through Faithful Service', 'engrafted-chapel' ); ?></span>
                <h2 class="ec-section-title"><?php esc_html_e( 'Church Impact', 'engrafted-chapel' ); ?></h2>
                <p><?php esc_html_e( 'Through God\'s grace and the dedication of our members, our church continues to make a meaningful impact in the lives of individuals, families and the wider community.', 'engrafted-chapel' ); ?></p>
                <ul class="ec-impact-bullets">
                    <li><i class="fas fa-check" aria-hidden="true"></i> <?php esc_html_e( 'A family where the engrafted Word is grafted into ordinary lives.', 'engrafted-chapel' ); ?></li>
                    <li><i class="fas fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Ministries serving every generation — children, youth, women and men.', 'engrafted-chapel' ); ?></li>
                    <li><i class="fas fa-check" aria-hidden="true"></i> <?php esc_html_e( 'A seminary raising and approving ministers for the harvest.', 'engrafted-chapel' ); ?></li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Partner With Us', 'engrafted-chapel' ); ?></a>
            </div>
            <div class="ec-impact-stats">
                <div class="ec-stat"><div class="ec-stat-num" data-count-to="<?php echo esc_attr( $ec_years ); ?>" data-count-suffix="+"><?php echo esc_html( $ec_years ); ?>+</div><div class="ec-stat-label"><?php esc_html_e( 'Years of Faithful Ministry', 'engrafted-chapel' ); ?></div></div>
                <div class="ec-stat"><div class="ec-stat-num" data-count-to="5" data-count-suffix="+">5+</div><div class="ec-stat-label"><?php esc_html_e( 'Active Ministries', 'engrafted-chapel' ); ?></div></div>
                <div class="ec-stat"><div class="ec-stat-num" data-count-to="3">3</div><div class="ec-stat-label"><?php esc_html_e( 'Weekly Gatherings', 'engrafted-chapel' ); ?></div></div>
                <div class="ec-stat"><div class="ec-stat-num ec-stat-word"><?php esc_html_e( 'One', 'engrafted-chapel' ); ?></div><div class="ec-stat-label"><?php esc_html_e( 'Family in Christ', 'engrafted-chapel' ); ?></div></div>
            </div>
        </div>
    </div>
</section>

<!-- VERSE OF THE DAY -->
<section class="ec-verse-band">
    <div class="ec-container">
        <div class="ec-verse-inner">
            <span class="ec-section-label"><?php esc_html_e( 'Today\'s Scripture to Guide and Inspire You', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'Verse of the Day', 'engrafted-chapel' ); ?></h2>
            <blockquote class="ec-verse-quote">
                <?php esc_html_e( '“Wherefore lay apart all filthiness… and receive with meekness the engrafted word, which is able to save your souls.”', 'engrafted-chapel' ); ?>
                <cite><?php esc_html_e( 'James 1:21', 'engrafted-chapel' ); ?></cite>
            </blockquote>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'ec_sermon' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Listen to a Sermon', 'engrafted-chapel' ); ?></a>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="ec-section ec-section-white ec-about-faq">
    <div class="ec-container">
        <div class="ec-section-header">
            <span class="ec-section-label"><?php esc_html_e( 'Answers to the Questions You Might Have', 'engrafted-chapel' ); ?></span>
            <h2 class="ec-section-title"><?php esc_html_e( 'Frequently Asked Questions', 'engrafted-chapel' ); ?></h2>
        </div>
        <div class="ec-faq-list">
            <?php
            $ec_faq_fallback = array(
                1 => array( 'What time are your Sunday services?', 'Our Fresh Word Encounter runs every Sunday from 7:30 AM. During the week, join us for Bible Voice on Wednesday and Turning Point on Friday, both at 6:30 PM.' ),
                2 => array( 'Do you have programs for children and youth?', 'Yes. Engrafted Children nurtures our little ones with care and biblical values, while Engrafted Youth helps students grow in faith through worship, teaching and fellowship.' ),
                3 => array( 'How can I get involved in the church?', 'There is a place for everyone. Join one of our ministries — children, youth, women, men or the Word Impact Choir — or partner with our outreach and mission work. Reach out and we will help you find your fit.' ),
                4 => array( 'How can I request prayer or pastoral support?', 'We would love to pray with you. Contact the church office and our follow-up team will reach out to provide care, prayer and pastoral support.' ),
                5 => array( 'Do you offer giving or donations?', 'Yes. You can honour God with your tithes and offerings in person at any service, or give by mobile money and transfer — contact the office for current details.' ),
            );
            $ec_open = true;
            foreach ( $ec_faq_fallback as $ec_n => $ec_def ) :
                $ec_q = get_theme_mod( 'ec_faq_' . $ec_n . '_q', $ec_def[0] );
                $ec_a = get_theme_mod( 'ec_faq_' . $ec_n . '_a', $ec_def[1] );
                if ( '' === trim( (string) $ec_a ) || '' === trim( (string) $ec_q ) ) {
                    continue;
                }
                ?>
                <details class="ec-faq-item"<?php echo $ec_open ? ' open' : ''; ?>>
                    <summary><span><?php echo esc_html( $ec_q ); ?></span><i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="ec-faq-answer"><p><?php echo esc_html( $ec_a ); ?></p></div>
                </details>
                <?php $ec_open = false; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<div class="ec-container">
    <div class="ec-cta-band">
        <h2><?php esc_html_e( 'Come and worship with us', 'engrafted-chapel' ); ?></h2>
        <p><?php esc_html_e( 'You belong here. Plan your first visit and experience the Engrafted Word Chapel family for yourself.', 'engrafted-chapel' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-gold"><?php esc_html_e( 'Plan a Visit', 'engrafted-chapel' ); ?></a>
    </div>
</div>

<?php get_footer(); ?>
