<?php
/**
 * The Header for our theme.
 * @package Construction Realestate
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'construction-realestate' ) ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header role="banner">
  <div id="header">
    <a class="screen-reader-text skip-link" href="#skip_content"><?php esc_html_e( 'Skip to content', 'construction-realestate' ); ?></a>
    <div class="top_headbar">
      <div class="socialbox">
        <?php if( get_theme_mod( 'construction_realestate_cont_facebook') != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_facebook','' ) ); ?>"><i class="fab fa-facebook-f"></i><span class="screen-reader-text"><?php esc_attr_e( 'Facebook','construction-realestate' );?></span></a>
        <?php } ?>
        <?php if( get_theme_mod( 'construction_realestate_cont_twitter' ) != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_twitter','' ) ); ?>"><i class="fab fa-twitter" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Twitter','construction-realestate' );?></span></a>
        <?php } ?>
        <?php if( get_theme_mod( 'construction_realestate_google_plus') != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_google_plus','' ) ); ?>"><i class="fab fa-google-plus-g" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Google','construction-realestate' );?></span></a>
        <?php } ?>
        <?php if( get_theme_mod( 'construction_realestate_pinterest') != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_pinterest','' ) ); ?>"><i class="fab fa-pinterest" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Pinterest','construction-realestate' );?></span></a>
        <?php } ?>
        <?php if( get_theme_mod( 'construction_realestate_tumblr') != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_tumblr','' ) ); ?>"><i class="fab fa-tumblr" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Tumblr','construction-realestate' );?></span></a>
        <?php } ?>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 logo_bar">
          <div class="logo">
            <?php if ( has_custom_logo() ) : ?>
              <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>
            <?php $blog_info = get_bloginfo( 'name' ); ?>
            <?php if ( ! empty( $blog_info ) ) : ?>
              <?php if ( is_front_page() && is_home() ) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
              <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
              <?php endif; ?>
            <?php endif; ?>
            <?php
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) :
              ?>
            <p class="site-description">
              <?php echo esc_html($description); ?>
            </p>
            <?php endif; ?>    
          </div>     
        </div>
        <div class="col-lg-8 col-md-8 row contact">
          <div class="col-lg-4 col-md-4">
            <?php if( get_theme_mod( 'construction_realestate_location','' ) != '') { ?>
              <div class="row">
                <div class="col-lg-2 col-md-4 p-0">
                  <img src="<?php echo esc_attr( get_template_directory_uri()) ?>/images/Location-Icon.png" role="img" alt="<?php esc_html_e( 'Location Image', 'construction-realestate' ); ?>">
                </div>
                <div class="col-lg-10 col-md-8 p-0">
                  <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_location','') ); ?></p>
                  <p><?php echo esc_html( get_theme_mod('construction_realestate_location1','') ); ?></p>         
                </div>
              </div>
            <?php }?>
          </div>
          <div class="col-lg-4 col-md-4">
            <?php if( get_theme_mod( 'construction_realestate_time','' ) != '') { ?>
              <div class="row">
                <div class="col-lg-2 col-md-4 p-0">
                  <img src="<?php echo esc_attr( get_template_directory_uri() ) ?>/images/Time-Icon.png" role="img" alt="<?php esc_html_e( 'Time Image', 'construction-realestate' ); ?>">
                </div>
                <div class="col-lg-10 col-md-8 p-0">              
                  <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_time','') ); ?></p>
                  <p><?php echo esc_html( get_theme_mod('construction_realestate_time1','') ); ?></p>             
                </div>
              </div>
            <?php }?>
          </div>
          <div class="col-lg-4 col-md-4">
            <?php if( get_theme_mod( 'construction_realestate_number','' ) != '') { ?>
              <div class="row">
                <div class="col-lg-2 col-md-4 p-0">
                  <img src="<?php echo esc_attr( get_template_directory_uri() ) ?>/images/Call-Icon.png" role="img" alt="<?php esc_html_e( 'Phone Image', 'construction-realestate' ); ?>">
                </div>
                <div class="col-lg-10 col-md-8 p-0">            
                  <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_number','') ); ?></p>
                  <p><?php echo esc_html( get_theme_mod('construction_realestate_number1','') ); ?></p>        
                </div>
              </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
    <div class="toggle-menu responsive-menu">
      <button role="tab" onclick="resMenu_open()"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','construction-realestate'); ?></span>
      </button>
    </div>
    <div id="navbar-header" class="menu-brand">
      <div id="search">
        <?php get_search_form(); ?>
      </div>
      <nav id="site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'construction-realestate' ); ?>">
        <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="resMenu_close()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','construction-realestate'); ?></span></a>
        <?php 
          wp_nav_menu( array( 
            'theme_location' => 'primary',
            'container_class' => 'main-menu-navigation clearfix' ,
            'menu_class' => 'clearfix',
            'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
            'fallback_cb' => 'wp_page_menu',
          ) ); 
        ?>
      </nav>
      <?php if( get_theme_mod( 'construction_realestate_location','' ) != '') { ?>
        <div class="construction-location">
          <div class="row">
            <div class="col-lg-2 col-md-4 col-3">
              <img src="<?php echo esc_attr( get_template_directory_uri()) ?>/images/Location-Icon.png" role="img" alt="<?php esc_html_e( 'Location Image', 'construction-realestate' ); ?>">
            </div>
            <div class="col-lg-10 col-md-8 col-9">
              <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_location','') ); ?></p>
              <p><?php echo esc_html( get_theme_mod('construction_realestate_location1','') ); ?></p>         
            </div>
          </div>
        </div>
      <?php }?>
      <?php if( get_theme_mod( 'construction_realestate_time','' ) != '') { ?>
        <div class="construction-time">
          <div class="row">
            <div class="col-lg-2 col-md-4 col-3">
              <img src="<?php echo esc_attr( get_template_directory_uri() ) ?>/images/Time-Icon.png" role="img" alt="<?php esc_html_e( 'Time Image', 'construction-realestate' ); ?>">
            </div>
            <div class="col-lg-10 col-md-8 col-9">              
              <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_time','') ); ?></p>
              <p><?php echo esc_html( get_theme_mod('construction_realestate_time1','') ); ?></p>
            </div>
          </div>
        </div>
      <?php }?>
      <?php if( get_theme_mod( 'construction_realestate_number','' ) != '') { ?>
        <div class="construction-number">
          <div class="row">
            <div class="col-lg-2 col-md-4 col-3">
              <img src="<?php echo esc_attr( get_template_directory_uri() ) ?>/images/Call-Icon.png" role="img" alt="<?php esc_html_e( 'Phone Image', 'construction-realestate' ); ?>">
            </div>
            <div class="col-lg-10 col-md-8 col-9">            
              <p class="f_para"><?php echo esc_html( get_theme_mod('construction_realestate_number','') ); ?></p>
              <p><?php echo esc_html( get_theme_mod('construction_realestate_number1','') ); ?></p>        
            </div>
          </div>
        </div>
      <?php }?>
      <div class="socialbox">
        <?php if( get_theme_mod( 'construction_realestate_cont_facebook') != '') { ?>
          <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_facebook','' ) ); ?>"><i class="fab fa-facebook-f"></i><span class="screen-reader-text"><?php esc_attr_e( 'Facebook','construction-realestate' );?></span></a>
          <?php } ?>
          <?php if( get_theme_mod( 'construction_realestate_cont_twitter' ) != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_cont_twitter','' ) ); ?>"><i class="fab fa-twitter" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Twitter','construction-realestate' );?></span></a>
          <?php } ?>
          <?php if( get_theme_mod( 'construction_realestate_google_plus') != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_google_plus','' ) ); ?>"><i class="fab fa-google-plus-g" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Google','construction-realestate' );?></span></a>
          <?php } ?>
          <?php if( get_theme_mod( 'construction_realestate_pinterest') != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_pinterest','' ) ); ?>"><i class="fab fa-pinterest" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Pinterest','construction-realestate' );?></span></a>
          <?php } ?>
          <?php if( get_theme_mod( 'construction_realestate_tumblr') != '') { ?>
            <a href="<?php echo esc_url( get_theme_mod( 'construction_realestate_tumblr','' ) ); ?>"><i class="fab fa-tumblr" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Tumblr','construction-realestate' );?></span></a>
        <?php } ?>
      </div>
    </div>
  </div>
</header>