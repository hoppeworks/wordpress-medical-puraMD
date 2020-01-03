<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bussiness_agency
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>


<body <?php body_class('at-sticky-sidebar'); ?>>


<div id="page" class="site">
    <a class="skip-link screen-reader-text"
       href="#content"><?php esc_html_e('Skip to content', 'ample-business') ?></a>
    <a href="#" class="scrollup"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
    <header id="masthead" class="site-header" role="banner">
        <!-- Start Top header Section -->
        <?php
        /**
         * The template for displaying all pages.
         *
         * This is the template that displays all pages by default.
         * Please note that this is the WordPress construct of pages
         * and that other 'pages' on your WordPress site may use a
         * different template.
         *
         * @link https://codex.wordpress.org/Template_Hierarchy
         *
         * @subpackage Business agency
         */
        // retrieving Customizer Value
        $section_option = ample_business_get_option('ample_business_top_header_section');
        if ($section_option == 'show') {

            $ample_business_news_section_cat_id = ample_business_get_option('ample_business_news_cat_id');

            $ample_business_news_section_number = ample_business_get_option('ample_business_no_of_news');
            $ample_business_news_section_title = ample_business_get_option('ample_business_notice');




            ?>
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php

                            $ample_business_news_category = get_category($ample_business_news_section_cat_id);
                            if(!empty($ample_business_news_section_cat_id))
                            {

                                if (!empty($ample_business_news_section_cat_id)) {
                                    $count = $ample_business_news_category->category_count;
                                    $no_of_news = ample_business_get_option('ample_business_no_of_news');

                                    if ($count > 0 && $no_of_news > 0) {
                                        ?>
                                        <!-- Start top contact info Section -->


                                        <div class="ticker">
                                            <strong><?php echo esc_html($ample_business_news_section_title); ?>:</strong>
                                            <ul>
                                                <?php
                                                $i = 0;
                                                if (!empty($ample_business_news_section_cat_id)) {
                                                    $ample_business_home_news_section = array('cat' => $ample_business_news_section_cat_id, 'posts_per_page' => $ample_business_news_section_number);
                                                    $ample_business_home_news_section_query = new WP_Query($ample_business_home_news_section);
                                                    if ($ample_business_home_news_section_query->have_posts()) {
                                                        while ($ample_business_home_news_section_query->have_posts()) {
                                                            $ample_business_home_news_section_query->the_post();
                                                            ?>

                                                            <li><?php the_title(); ?></li>
                                                            <?php
                                                            $i++;
                                                        }

                                                    }
                                                    wp_reset_postdata();
                                                }
                                                ?>


                                            </ul>


                                        </div>

                                        <?php
                                    }


                                }
                            }



                            ?>


                        </div>
                        <!-- End top contact info Section -->


                        <!-- Start top social icon Section -->
                        <div class="col-xs-12 col-sm-6">

                            <?php
                            $ample_business_apply_button = ample_business_get_option('ample_business_button');
                            $ample_business_apply_link = ample_business_get_option('ample_business_apply_button_link');
                            if(!empty($ample_business_apply_link))

                            {?>
                                <div class="apply-now">
                                    <a href="<?php echo esc_url_raw(  $ample_business_apply_link); ?>"
                                       class="read-more-background"><?php echo  esc_html($ample_business_apply_button); ?>
                                    </a>

                                </div>
                            <?php } ?>

                            <div class="header-search">
                                <p class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></p>
                                <?php
                                ?>
                                <form action="<?php echo esc_url(home_url()) ?>" autocomplete="on" class="top-search">
                                    <input id="search" name="s" value="<?php echo get_search_query(); ?>" type="text" placeholder="<?php  esc_html__('search','ample-business');?>">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>

                            </div>



                        </div>
                        <!-- End top social icon Section -->


                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- End Top header Section -->
        <!-- Start logo and menu Section -->



        <header id="header" class="head" role="banner">
            <nav id="site-navigation" class="main-navigation navbar navbar-default navbar-menu" role="navigation">
                <div class="container">
                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <div class="visible-xs visible-sm  clearfix"><span id="showbutton" class="clearfix"><img
                                        class="img-responsive grow"
                                        src="<?php echo esc_html(get_template_directory_uri()); ?>/assets/images/button.png"
                                        alt=""/></span>
                            </div>
                        </button>
                        <div class="site-branding">
                            <?php
                            if (has_custom_logo()) { ?>
                                <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php the_custom_logo(); ?>
                                </a>
                            <?php } else {
                                if (is_front_page() && is_home()) : ?>
                                    <h1 class="site-title">
                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                    </h1>
                                <?php else : ?>
                                    <p class="site-title">
                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                    </p>
                                    <?php
                                endif;
                                $description = get_bloginfo('description', 'display');
                                if ($description || is_customize_preview()) : ?>
                                    <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                                    <?php
                                endif;
                            } ?>
                        </div><!-- .site-branding -->

                    </div>
                    <?php
                    $section_option_company_info = ample_business_get_option('ample_business_info_header_section');
                    $location_icon = ample_business_get_option('ample_business_info_header_section_location_icon');
                    $location = ample_business_get_option('ample_business_info_header_location');

                    $number_icon = ample_business_get_option('ample_business_info_header_section_phone_number_icon');
                    $number = ample_business_get_option('ample_business_info_header_phone_no');

                    $email_icon = ample_business_get_option('ample_business_email_icon');
                    $email = ample_business_get_option('ample_business_info_header_email');


                    if ($section_option_company_info == 'show') {
                        ?>

                        <div class="ample-business-info">
                            <ul class="contact-detail2">
                                <?php if (!empty( $location)){ ?>
                                    <li>
                                        <span class="icon-box--description"><a href="#"><i class="fa <?php echo esc_html($location_icon);?> fa-2x"></i> <?php echo esc_html( $location);?></a></span>
                                    </li>
                                <?php }if (!empty($number)){ ?>

                                    <li>
                                        <span class="icon-box--description"><a href="<?php echo esc_url('tel:' .$number) ?>"><i class="fa <?php echo  esc_html( $number_icon);?> fa-2x"></i> <?php echo esc_html( $number);?></a></span>
                                    </li>
                                <?php } if (!empty( $email)){
                                    ?>

                                    <li>
                                        <span class="icon-box--description"><a href="<?php echo esc_url('mailto:' .  $email); ?>"><i class="fa <?php echo esc_html( $email_icon);?> fa-2x"></i> <?php echo esc_html( $email);?></a></span>
                                    </li>
                                <?php } ?>

                            </ul>
                        </div>

                    <?php } ?>
                </div>
            </nav><!-- #site-navigation -->

            <div class="main-header">
                <div id="menu-bar" class="main-menu primary">
                    <div class="container">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown" data-animations="fadeIn">
                            <!-- Start Menu Section -->
                            <div class="menu">
                                <!--<nav id="site-navigation" class="main-navigation" role="navigation"> -->
                                <div class="nav-wrapper">
                                    <!-- for toogle menu -->

                                    <?php
                                    if (has_nav_menu('primary')) {
                                        wp_nav_menu(array(
                                                'theme_location' => 'primary',
                                                'menu_class' => 'main-nav',
                                                'depth' => 4,

                                            )
                                        );
                                    }
                                    ?>
                                    <?php
                                    $social_menu = ample_business_get_option('ample_business_social_link_hide_option');

                                    if ($social_menu == 1) {

                                        ?>
                                        <div class="top-header-socialicon">

                                            <?php
                                            if (has_nav_menu('social-link')) {
                                                wp_nav_menu(array('theme_location' => 'social-link', 'menu_class' => 'menu', 'menu_id' => 'menu-social-menu'));

                                            }
                                            ?>


                                        </div>

                                    <?php } ?>



                                </div>
                                <!-- </nav> -->

                            </div>
                            <!-- End Menu Section -->
                        </div>


                    </div>
                </div>
            </div>


        </header>

