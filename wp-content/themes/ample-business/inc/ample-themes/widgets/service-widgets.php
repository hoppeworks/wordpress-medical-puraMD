<?php
if (!class_exists('Ample_Business_Resource_Widget')) {
    class Ample_Business_Resource_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'title' => esc_html__('Our Services', 'ample-business'),
                'sub-title' => '',
                'resources' => ''

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'business_services_widget',
                esc_html__('AB : Services Widget', 'ample-business'),
                array('description' => esc_html__('Business Services Section', 'ample-business'))
            );
        }
        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $title = esc_attr( $instance['title'] );
            $subtitle =  esc_attr( $instance['sub-title'] );
            $resources   = ( ! empty( $instance['resources'] ) ) ? $instance['resources'] : array();

            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'ample-business'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sub-title') ); ?>">
                    <?php esc_html_e( 'Sub Title', 'ample-business'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('sub-title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('sub-title')); ?>" value="<?php echo $subtitle; ?>">
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
            <a class="at-ample-add button" data-id="ample-business_resource_widget" id="<?php echo esc_attr($repeater_id); ?>"><?php _e('Add New Section', 'ample-business'); ?></a>

            <hr/>



            <?php
        }
        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['sub-title'] = sanitize_text_field($new_instance['sub-title']);


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
                $subtitle = esc_html($instance['sub-title']);
                $resources = (!empty($instance['resources'])) ? $instance['resources'] : array();

                echo $args['before_widget'];
                ?>
                <section id="ample-business-theme-service" class="widget widget-ample-business-theme-service">
                    <div class="container">
                        <div class="main-title wow fadeInDown" data-wow-duration="2s">
                            <h2 class="widget-title"><?php echo esc_html($title); ?></h2>
                            <span class="double-border"></span>
                            <p><?php echo esc_html($subtitle); ?></p>
                        </div>
                        <div class="row">
                <?php
                if (isset($resources) && !empty($resources['main'])) {

                    $idvalue = array();
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
                                $icon = get_post_meta(get_the_ID(), 'ample_business_icon', true);
                                $idvalue[] = get_the_ID();
                                ?>
                                <!-- Start single resource item -->
                                <div class="col-xs-12 col-sm-6 col-md-4 ">
                                    <div class="service-item wow fadeInUp">
                                        <div class="service-icon">
                                            <i class="fa <?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
                                            <div></div>
                                        </div>
                                        <h3 class="widget-inner-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p>
                                    </div>
                                </div>
                                <!-- End single resource item -->
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    endif;
                }
                            ?>


                        </div>
                    </div>
                </section>


                <?php
                echo $args['after_widget'];
            }
        }

        }
    }

add_action('widgets_init', 'ample_business_resource_widget');
function ample_business_resource_widget()
{
    register_widget('Ample_Business_resource_Widget');

}

