<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bussiness_agency
*/
global $ample_business_header_image,$ample_business_header_style;
$ample_business_header_image = get_header_image();

if( $ample_business_header_image ){
	$ample_business_header_style = $ample_business_header_image;

} else{

	$ample_business_header_style = '';
}

$ample_business_breadcrump_option = ample_business_get_option('ample_business_breadcrumb_setting_option');


get_header(); ?>

	<!-- Start inner pager banner page -->
	<div id="" class="ample-inner-banner" style="background-image: url(<?php echo esc_url($ample_business_header_style); ?>);">

	<div class="container">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
		</div>
	</div>
	<!-- End inner pager banner page -->

	<!-- Start breadcrumb section -->
<?php
if ($ample_business_breadcrump_option == "enable") {
	?>
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumb-trail breadcrumbs" arial-label="Breadcrumbs" role="navigation">
				<ol class="breadcrumb trail-items">
					<li><?php breadcrumb_trail();?></li>
				</ol>
			</div>
		</div>
	</div>
	<!-- End breadcrumb section -->
	<?php } ?>

	<!-- Start innerpage content site -->
	<div id="content" class="site-content single-ample-page">
		<div class="container  clearfix">
			<div class="row">
				<!-- Start primary content area -->
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">




						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content','single' );

							the_post_navigation();

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div><!-- #primary -->

				<aside id="sidebar-primary secondary" class="widget-area sidebar" role="complementary">
					<section  class="widget ">
						<?php get_sidebar();?>
					</section>
				</aside>

			</div>
		</div>
	</div>

<?php

get_footer();
