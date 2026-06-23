<?php
/**
 * Single Ministry template.
 *
 * A dedicated, editorial layout for one ministry: a banner with its slogan, a
 * two-column body (hero image / lead / full story + a details & "get connected"
 * sidebar) and a grid of the other ministries to explore. Emanu skin throughout.
 *
 * @package Engrafted_Chapel
 */

get_header();

while ( have_posts() ) :
    the_post();

    $ec_id      = get_the_ID();
    $ec_slug    = get_post_field( 'post_name', $ec_id );
    $ec_slogan  = get_post_meta( $ec_id, '_ec_ministry_slogan', true );
    $ec_leader  = get_post_meta( $ec_id, '_ec_ministry_leader', true );
    $ec_email   = get_post_meta( $ec_id, '_ec_ministry_email', true );

    $ec_icon_map = array(
        'engrafted-children' => 'fa-child',
        'engrafted-youth'    => 'fa-fire',
        'engrafted-ladies'   => 'fa-dove',
        'engrafted-men'      => 'fa-hands-helping',
        'word-impact-choir'  => 'fa-music',
    );
    $ec_icon = isset( $ec_icon_map[ $ec_slug ] ) ? $ec_icon_map[ $ec_slug ] : 'fa-people-group';

    // Banner.
    ec_page_header(
        get_the_title(),
        $ec_slogan ? $ec_slogan : __( 'A place to belong, grow and serve', 'engrafted-chapel' ),
        'ec-ph-ministries',
        __( 'Our Ministries', 'engrafted-chapel' )
    );
    ?>

    <section class="ec-section ec-section-white ec-min-single">
        <div class="ec-container">
            <div class="ec-min-grid">

                <article class="ec-min-main">
                    <div class="ec-min-hero">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', array( 'class' => 'ec-min-hero-img' ) ); ?>
                        <?php else : ?>
                            <div class="ec-min-hero-fallback"><i class="fas <?php echo esc_attr( $ec_icon ); ?>" aria-hidden="true"></i></div>
                        <?php endif; ?>
                    </div>

                    <?php if ( $ec_slogan ) : ?>
                        <span class="ec-min-eyebrow"><i class="fas fa-leaf" aria-hidden="true"></i> <?php echo esc_html( $ec_slogan ); ?></span>
                    <?php endif; ?>

                    <h2 class="ec-min-title"><?php the_title(); ?></h2>

                    <div class="ec-min-content">
                        <?php the_content(); ?>
                    </div>

                    <div class="ec-min-share">
                        <a href="<?php echo esc_url( home_url( '/ministries' ) ); ?>" class="ec-back-link"><i class="fas fa-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'All Ministries', 'engrafted-chapel' ); ?></a>
                    </div>
                </article>

                <aside class="ec-min-aside">
                    <div class="ec-min-card ec-min-detail">
                        <h3><?php esc_html_e( 'Ministry at a Glance', 'engrafted-chapel' ); ?></h3>
                        <ul class="ec-min-detail-list">
                            <li>
                                <span class="ec-min-detail-ico"><i class="fas fa-quote-left" aria-hidden="true"></i></span>
                                <span><strong><?php esc_html_e( 'Slogan', 'engrafted-chapel' ); ?></strong><?php echo esc_html( $ec_slogan ? $ec_slogan : __( 'Serving God together', 'engrafted-chapel' ) ); ?></span>
                            </li>
                            <?php if ( $ec_leader ) : ?>
                            <li>
                                <span class="ec-min-detail-ico"><i class="fas fa-user" aria-hidden="true"></i></span>
                                <span><strong><?php esc_html_e( 'Led by', 'engrafted-chapel' ); ?></strong><?php echo esc_html( $ec_leader ); ?></span>
                            </li>
                            <?php endif; ?>
                            <li>
                                <span class="ec-min-detail-ico"><i class="fas fa-church" aria-hidden="true"></i></span>
                                <span><strong><?php esc_html_e( 'Gather', 'engrafted-chapel' ); ?></strong><?php esc_html_e( 'Every Sunday & midweek services', 'engrafted-chapel' ); ?></span>
                            </li>
                            <li>
                                <span class="ec-min-detail-ico"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                                <span><strong><?php esc_html_e( 'Connect', 'engrafted-chapel' ); ?></strong>
                                    <?php
                                    $ec_contact_email = $ec_email ? $ec_email : get_theme_mod( 'ec_contact_email', 'engwordchapel@gmail.com' );
                                    ?>
                                    <a href="mailto:<?php echo esc_attr( $ec_contact_email ); ?>"><?php echo esc_html( $ec_contact_email ); ?></a>
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="ec-min-card ec-min-join">
                        <span class="ec-min-join-ico"><i class="fas fa-hand-holding-heart" aria-hidden="true"></i></span>
                        <h3><?php esc_html_e( 'Get Connected', 'engrafted-chapel' ); ?></h3>
                        <p><?php esc_html_e( 'There is a place for you here. Reach out and we will help you take your next step.', 'engrafted-chapel' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="ec-btn ec-btn-orange"><?php esc_html_e( 'Join This Ministry', 'engrafted-chapel' ); ?></a>
                    </div>

                    <?php
                    $ec_others = ec_get_ministries( -1 );
                    if ( $ec_others->have_posts() ) :
                        ?>
                        <div class="ec-min-card ec-min-nav">
                            <h3><?php esc_html_e( 'Other Ministries', 'engrafted-chapel' ); ?></h3>
                            <ul class="ec-min-nav-list">
                                <?php
                                while ( $ec_others->have_posts() ) :
                                    $ec_others->the_post();
                                    if ( get_the_ID() === $ec_id ) {
                                        continue;
                                    }
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span> <i class="fas fa-arrow-right" aria-hidden="true"></i></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                        <?php
                    endif;
                    wp_reset_postdata();
                    ?>
                </aside>

            </div>
        </div>
    </section>

    <?php
    // Explore other ministries — cards.
    $ec_related = ec_get_ministries( -1 );
    $ec_rel_icons = array(
        'engrafted-children' => 'fa-child',
        'engrafted-youth'    => 'fa-fire',
        'engrafted-ladies'   => 'fa-dove',
        'engrafted-men'      => 'fa-hands-helping',
        'word-impact-choir'  => 'fa-music',
    );
    if ( $ec_related->have_posts() ) :
        ?>
        <section class="ec-section ec-section-light ec-min-related">
            <div class="ec-container">
                <div class="ec-section-header">
                    <span class="ec-section-label"><?php esc_html_e( 'Keep Exploring', 'engrafted-chapel' ); ?></span>
                    <h2 class="ec-section-title"><?php esc_html_e( 'Discover More Ministries', 'engrafted-chapel' ); ?></h2>
                </div>
                <div class="ec-ministry-cards">
                    <?php
                    $ec_shown = 0;
                    while ( $ec_related->have_posts() && $ec_shown < 3 ) :
                        $ec_related->the_post();
                        if ( get_the_ID() === $ec_id ) {
                            continue;
                        }
                        $ec_shown++;
                        $ec_r_slug   = get_post_field( 'post_name', get_the_ID() );
                        $ec_r_icon   = isset( $ec_rel_icons[ $ec_r_slug ] ) ? $ec_rel_icons[ $ec_r_slug ] : 'fa-people-group';
                        $ec_r_slogan = get_post_meta( get_the_ID(), '_ec_ministry_slogan', true );
                        $ec_r_img    = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium' ) : '';
                        ?>
                        <a class="ec-ministry-svc-card" href="<?php the_permalink(); ?>">
                            <span class="ec-ministry-svc-img<?php echo $ec_r_img ? '' : ' ec-ministry-svc-img-icon'; ?>">
                                <?php if ( $ec_r_img ) : ?>
                                    <img src="<?php echo esc_url( $ec_r_img ); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php else : ?>
                                    <i class="fas <?php echo esc_attr( $ec_r_icon ); ?>" aria-hidden="true"></i>
                                <?php endif; ?>
                            </span>
                            <h3><?php the_title(); ?></h3>
                            <?php if ( $ec_r_slogan ) : ?>
                                <span class="ec-ministry-svc-slogan"><?php echo esc_html( $ec_r_slogan ); ?></span>
                            <?php endif; ?>
                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
                            <span class="ec-ministry-svc-more"><?php esc_html_e( 'Read More', 'engrafted-chapel' ); ?> <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i></span>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php
    endif;
    wp_reset_postdata();
    ?>

<?php endwhile; ?>

<?php get_footer(); ?>
