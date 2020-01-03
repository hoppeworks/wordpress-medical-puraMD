<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bussiness_agency
 */
$description_from = ample_business_get_option( 'ample_business_blog_excerpt_option');
$description_length = ample_business_get_option( 'ample_business_description_length_option');

?>
<article id="post-<?php the_ID(); ?>"
         class="post type-post status-publish has-post-thumbnail hentry" <?php post_class(); ?>>

    <div class="entry-content">

        <div class="col-md-12">
            <div class="single-review">
                <div class="post-img">
                    <?php

                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', array('class' => 'img-fluid'));
                    }
                    ?>


                    <div class="post-info">
                        <p>
                            <span class="post-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date();?></a></span>
                            <span class="post-comments"><a href="<?php the_permalink(); ?>">    <?php the_author();?> </a></span>

                            <span class="post-social-links">
														<?php ample_business_entry_footer(); ?>
													</span>
                        </p>
                    </div>
                </div>
                <div class="post-content">
                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                    <p class="post-short-desc">

                        <?php

                        if($description_from=='content')
                        {
                            echo esc_html( wp_trim_words(get_the_content(),$description_length) );
                        }
                        else
                        {

                            echo esc_html( wp_trim_words(get_the_excerpt(),$description_length) );
                        }
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:','ample-business' ),
                            'after'  => '</div>',
                        ) );


                        ?>
                    </p>

                    <a href="<?php the_permalink();?>" class="continue-link"><?php esc_html_e('Continue Reading', 'ample-business'); ?></a>
                </div>
            </div><!-- /.single-review -->
        </div>






    </div>


</article><!-- #post-<?php the_ID(); ?> -->


