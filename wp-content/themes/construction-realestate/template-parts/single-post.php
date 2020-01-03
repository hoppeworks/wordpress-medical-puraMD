<?php
/**
 * The template part for displaying single-post
 *
 * @package Construction Realestate
 * @subpackage construction_realestate
 * @since 1.0
 */
?>
<?php 
  $archive_year  = get_the_time('Y'); 
  $archive_month = get_the_time('m'); 
  $archive_day   = get_the_time('d'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-services'); ?>>
	<h1><?php the_title();?></h1>
	<?php if( get_theme_mod( 'construction_realestate_metafields_date',true) != '' || get_theme_mod( 'construction_realestate_metafields_author',true) != '' || get_theme_mod( 'construction_realestate_metafields_comment',true) != '') { ?>
		<div class="metabox">
			<?php if( get_theme_mod( 'construction_realestate_metafields_date',true) != '') { ?>
				<i class="far fa-calendar-alt"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
			<?php }?>
			<?php if( get_theme_mod( 'construction_realestate_metafields_author',true) != '') { ?>
				<i class="fas fa-user"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></span>
			<?php }?>
			<?php if( get_theme_mod( 'construction_realestate_metafields_comment',true) != '') { ?>
				<i class="fas fa-comments"></i><span class="entry-comments"> <?php comments_number( __('0 Comment', 'construction-realestate'), __('0 Comments', 'construction-realestate'), __('% Comments', 'construction-realestate') ); ?></span>
			<?php }?>
		</div>
	<?php }?>
	<?php if(has_post_thumbnail()) { ?>
		<div class="feature-box">	
			<?php the_post_thumbnail(); ?> 
		</div>
		<hr>					
	<?php } ?>		
	    <div class="new-text">
	      <?php the_content();?>
	    </div>
	    <div class="tags"><?php the_tags(); ?></div>
	<?php
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'construction-realestate' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'construction-realestate' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
			
		if ( is_singular( 'attachment' ) ) {
			// Parent post navigation.
			the_post_navigation( array(
				'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'construction-realestate' ),
			) );
		} elseif ( is_singular( 'post' ) ) {
			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next page', 'construction-realestate' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'construction-realestate' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous page', 'construction-realestate' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'construction-realestate' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
		}

		echo '<div class="clearfix"></div>'; ?>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
	}?>	
</article>