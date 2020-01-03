<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package Construction Realestate
 */
get_header(); ?>

<main id="skip_content" role="main" class="content_box main-wrapper">
    <div class="container page-content">
        <h1><?php printf( '<strong>%s</strong> %s', esc_html__( '404', 'construction-realestate' ), esc_html__( 'Not Found', 'construction-realestate' ) ) ?></h1>
        <p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn', 'construction-realestate' ); ?></p>
        <p class="text-404"><?php esc_html_e( 'Dont worry it happens to the best of us.', 'construction-realestate' ); ?></p>
        <div class="read-moresec">
            <a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right"><?php esc_html_e( 'Back to Home Page', 'construction-realestate' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Back to Home Page', 'construction-realestate' ); ?></span></a>
        </div>
        <div class="clearfix"></div>
    </div>
</main>

<?php get_footer(); ?>