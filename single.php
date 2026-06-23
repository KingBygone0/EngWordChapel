<?php
/**
 * Single post template (blog). Clean editorial layout in the Emanu skin.
 *
 * @package Engrafted_Chapel
 */

get_header();

while ( have_posts() ) :
    the_post();

    $ec_cats = get_the_category();
    $ec_cat  = ! empty( $ec_cats ) ? $ec_cats[0]->name : __( 'Journal', 'engrafted-chapel' );

    ec_page_header(
        get_the_title(),
        get_the_date( 'F j, Y' ),
        'ec-ph-sermons',
        $ec_cat
    );
    ?>

    <section class="ec-section ec-section-white ec-single-post">
        <div class="ec-container ec-post-narrow">

            <div class="ec-post-meta-row">
                <span><i class="far fa-calendar" aria-hidden="true"></i> <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                <span><i class="far fa-user" aria-hidden="true"></i> <?php the_author(); ?></span>
                <?php if ( ! empty( $ec_cats ) ) : ?><span><i class="fas fa-tag" aria-hidden="true"></i> <?php echo esc_html( $ec_cat ); ?></span><?php endif; ?>
            </div>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="ec-post-cover"><?php the_post_thumbnail( 'large' ); ?></div>
            <?php endif; ?>

            <div class="ec-min-content ec-post-body">
                <?php
                the_content();
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'engrafted-chapel' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div>

            <?php
            $ec_tags = get_the_tag_list( '<div class="ec-post-tags">', '', '</div>' );
            if ( $ec_tags ) {
                echo wp_kses_post( $ec_tags );
            }
            ?>

            <div class="ec-min-share">
                <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' ) ); ?>" class="ec-back-link"><i class="fas fa-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Back to Blog', 'engrafted-chapel' ); ?></a>
            </div>

            <div class="ec-post-nav">
                <?php
                previous_post_link( '<span class="ec-post-nav-prev">%link</span>', '<i class="fas fa-arrow-left" aria-hidden="true"></i> %title' );
                next_post_link( '<span class="ec-post-nav-next">%link</span>', '%title <i class="fas fa-arrow-right" aria-hidden="true"></i>' );
                ?>
            </div>

            <?php
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
            ?>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>
