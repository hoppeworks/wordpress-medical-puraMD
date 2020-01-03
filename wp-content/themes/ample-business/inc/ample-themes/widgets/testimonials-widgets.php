<?php
if (!class_exists('Ample_Business_Testimonials_Widget')) {
    class Ample_Business_Testimonials_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'title' => esc_html__('Our Testimonials', 'ample-business'),
                'sub-title' => '',
                'resources' => '',
                'features_background' => '',

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'business_testimonials_widget',
                esc_html__('AB : Testimonials Widget', 'ample-business'),
                array('description' => esc_html__('Business Testimonials Section', 'ample-business'))
            );
        }
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $title = esc_attr( $instance['title'] );
            $resources   = ( ! empty( $instance['resources'] ) ) ? $instance['resources'] : array();
            $features_background   = esc_url( $instance['features_background'] );

            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'ample-business'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo  esc_attr($title); ?>">
            </p>


            <span class="at-ample-additional">
            <!--repeater-->
            <label><?php _e( 'Select Pages', 'ample-business' ); ?>:</label>
            <br/>
            <small><?php _e( 'Add Page and Remove. Please do not forget to add Icon on selected pages.', 'ample-business' ); ?></small>

                <?php
                if  ( count( $resources ) >=  1 && is_array( $resources ) )
                {

                    $selected = $resources['main'];

                }

                else
                {
                    $selected = "";
                }

                $repeater_id   = $this->get_field_id( 'resources' ).'-main';
                $repeater_name = $this->get_field_name( 'resources'). '[main]';

                $args = array(
                    'selected'          => $selected,
                    'name'              => $repeater_name,
                    'id'                => $repeater_id,
                    'class'             => 'widefat pt-select',
                    'show_option_none'  => __( 'Select Page', 'ample-business'),
                    'option_none_value' => 0 // string
                );
                wp_dropdown_pages( $args );
                ?>

                <?php

                $counter = 0;

                if ( count( $resources ) > 0 )
                {
                    foreach( $resources as $resource )
                    {

                        if ( isset( $resource['page_ids'] ) )

                        { ?>
                            <div class="at-ample-sec">

                            <?php

                            $repeater_id     = $this->get_field_id( 'resources' ) .'-'. $counter.'-page_ids';
                            $repeater_name   = $this->get_field_name( 'resources' ) . '['.$counter.'][page_ids]';

                            $args = array(
                                'selected'          => $resource['page_ids'],
                                'name'              => $repeater_name,
                                'id'                => $repeater_id,
                                'class'             => 'widefat pt-select',
                                'show_option_none'  => __( 'Select Page', 'ample-business'),
                                'option_none_value' => 0 // string
                            );
                            wp_dropdown_pages( $args );
                            ?>

                        </div>
                            <?php
                            $counter++;
                        }
                    }
                }

                ?>

            </span>
            <a class="at-ample-add button" data-id="ample-business_resource_widget" id="<?php echo  esc_attr( $repeater_id); ?>"><?php _e('Add New Section', 'ample-business'); ?></a>

            <hr/>


            <hr>
            <p>
                <label for="<?php echo $this->get_field_id('features_background'); ?>">
                    <?php _e( 'Select Background Image', 'ample-business' ); ?>:
                </label>
                <span class="img-preview-wrap" <?php  if ( empty( $features_background ) ){ ?> style="display:none;" <?php  } ?>>
                    <img class="widefat" src="<?php echo esc_url( $features_background ); ?>" alt="<?php esc_attr_e( 'Image preview', 'ample-business' ); ?>"  />
                </span><!-- .img-preview-wrap -->
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('features_background'); ?>" id="<?php echo $this->get_field_id('features_background'); ?>" value="<?php echo esc_url( $features_background ); ?>" />
                <input type="button" id="custom_media_button"  value="<?php esc_attr_e( 'Upload Image', 'ample-business' ); ?>" class="button media-image-upload" data-title="<?php esc_attr_e( 'Select Background Image','ample-business'); ?>" data-button="<?php esc_attr_e( 'Select Background Image','ample-business'); ?>"/>
                <input type="button" id="remove_media_button" value="<?php esc_attr_e( 'Remove Image', 'ample-business' ); ?>" class="button media-image-remove" />
            </p>
            <?php
        }
        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['sub-title'] = sanitize_text_field($new_instance['sub-title']);
            $instance['features_background'] = esc_url_raw($new_instance['features_background']);

            if (isset($new_instance['resources']))
            {
                foreach($new_instance['resources'] as $resource){

                    $resource['page_ids'] = absint($resource['page_ids']);
                }
                $instance['resources'] = $new_instance['resources'];
            }
            return $instance;

        }
        public function widget($args, $instance)
        {

            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                
                $resources = (!empty($instance['resources'])) ? $instance['resources'] : array();
                $features_background  = esc_url($instance['features_background']);

                echo $args['before_widget'];
                ?>
                <section id="ample-business-theme-testimonial" class="widget widget-ample-business-theme-testimonial"
                         style="background-image: url(<?php echo esc_url($features_background);?>);">
                    <div class="container">
                        <div class="main-title wow fadeInDown" data-wow-duration="2s">

                            <h2 class="widget-title whitetext"><?php echo esc_html($title); ?></h2>
                            <span class="double-border"></span>
                            
                        </div>
                        <div class="col-xs-12 col-sm-10 col-xs-offset-0 col-sm-offset-1">
                            <div id="owl-demo2" class="owl-carousel owl-theme">
                            <?php if (isset($resources) && !empty($resources['main'])) { ?>
                                <?php
                                $post_in = array();

                                if (count($resources) > 0 && is_array($resources)) {

                                    $post_in[0] = $resources['main'];

                                    foreach ($resources as $our_resource) {

                                        if (isset($our_resource['page_ids']) && !empty($our_resource['page_ids'])) {

                                            $post_in[] = $our_resource['page_ids'];

                                        }
                                    }


                                }

                                if (!empty($post_in)) :
                                    $resources_page_args = array(
                                        'post__in' => $post_in,
                                        'orderby' => 'post__in',
                                        'posts_per_page' => count($post_in),
                                        'post_type' => 'page',
                                        'no_found_rows' => true,
                                        'post_status' => 'publish'
                                    );

                                    $resources_query = new WP_Query($resources_page_args);

                                    /*The Loop*/
                                    if ($resources_query->have_posts()):
                                        $i = 1;
                                        while ($resources_query->have_posts()):$resources_query->the_post();

                                            ?>
                                            <div class="item">
                                                <div class="testimonial-details">
                                                    <p class="whitetext"><?php echo esc_html(wp_trim_words(get_the_content(), 30)); ?></p>
                                                    <h2 class="clientname"><?php the_title(); ?></h2>

                                                    <div class="testimonial-img">
                                                        <?php
                                                        if (has_post_thumbnail()) {
                                                            $image_id = get_post_thumbnail_id();
                                                            $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
                                                            ?>
                                                            <img src="<?php echo esc_url($image_url[0]); ?>"
                                                                 class="img-responsive">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php
                                        endwhile;
                                    endif;
                                    wp_reset_postdata();
                                endif;
                            }
                            ?>

                            </div>
                        </div>
                    </div>
                </section>


                <?php
                echo $args['after_widget'];
            }
        }

    }
}

add_action('widgets_init', 'ample_business_testimonials_widget');
function ample_business_testimonials_widget()
{
    register_widget('Ample_Business_Testimonials_Widget');

}

