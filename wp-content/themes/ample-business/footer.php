<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bussiness_agency
 */
$copyright = ample_business_get_option('ample_business_copyright');
if( is_active_sidebar('footer1') || is_active_sidebar('footer2') || is_active_sidebar('footer3') || is_active_sidebar('footer4')|| is_active_sidebar('footerinfo'))
{
	?>

	<aside id="footer-widget" class="widget-area ample-business-topfooter" role="complementary">
		<div class="info-section footerwidgets">

		<?php dynamic_sidebar('footerinfo');
		?>
		</div>
	    <?php
		if (is_active_sidebar('footer1') || is_active_sidebar('footer2') || is_active_sidebar('footer3') || is_active_sidebar('footer4')) { ?>
		<section class="middle-footer">
			<div class="container">
				<div class="row footerwidgets">
					<div class="col-xs-12 col-sm-6 col-md-3 wow slideInDown text-left" data-wow-duration="2s">
						<?php dynamic_sidebar('footer1'); ?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 wow slideInDown text-left" data-wow-duration="2s">
						<section id="" class="widget-area footer-widgets widget-footer-bottom">
							<?php dynamic_sidebar('footer2'); ?>
						</section>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 wow slideInDown text-left" data-wow-duration="2s">
						<section id="" class="widget-area footer-widgets widget-footer-bottom">
							<?php dynamic_sidebar('footer3'); ?>
						</section>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 wow slideInDown text-left" data-wow-duration="2s">
						<section id="" class="widget-area footer-widgets widget-footer-bottom">
							<?php dynamic_sidebar('footer4'); ?>
						</section>
					</div>
				</div>
			</div>
		</section>
		<?php } ?>
	</aside>
	<?php
}
?>
	<footer id="colophon" class="site-footer bottom-footer" role="contentinfo">
		<div class="container">
			<div class="copyright">

				<p><?php echo wp_kses_post($copyright); ?> |
					<a href="<?php echo esc_url( __( 'https://www.amplethemes.com/', 'ample-business' ) ); ?>"
                    ><?php
						/* translators: %s: CMS name, i.e. WordPress. */
						printf( esc_html__( ' Design & develop by AmpleThemes %s', 'ample-business' ), '' );
						?></a>	</p>
				
			</div>

		</div>
	</footer>
<?php wp_footer(); ?>
</body>
</html>
