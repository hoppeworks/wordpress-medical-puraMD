<?php
/**
 * Created by PhpStorm.
 * User: arjun
 * Date: 7/12/2017
 * Time: 8:43 AM
 */
if (!class_exists('Ample_Business_notice_Widget')) {
    class Ample_Business_notice_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'cat_id' => 0,
                'title' => esc_html__('Noticed', 'ample-business'),
                'sub-title' =>'',
                'image'=>'',
                'post_number' =>3,
            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'ample-business-notice-widget',
                esc_html__('AB : Notice Widgets', 'ample-business'),
                array('description' => esc_html__('Business Noticed Section', 'ample-business'))
            );
        }

        public function form($instance)
        {
            $instance = wp_parse_args((array )$instance, $this->defaults());
            $catid = absint($instance['cat_id']);
            $title = esc_attr($instance['title']);
            $subtitle = esc_attr($instance['sub-title']);
            $image = esc_url($instance['image']);
	        $post_number = absint($instance['post_number']);

            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'ample-business'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo $title; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('sub-title')); ?>">
                    <?php esc_html_e('Sub Title', 'ample-business'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('sub-title')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('sub-title')); ?>" value="<?php echo $subtitle; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id')); ?>">
                    <?php esc_html_e('Select Category', 'ample-business'); ?>
                </label><br/>
                <?php
                $business_dropown_cat = array(
                    'show_option_none' => esc_html__('Select Category', 'ample-business'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => $catid,
                    'hierarchical' => 1,
                    'name' => esc_attr($this->get_field_name('cat_id')),
                    'id' => esc_attr($this->get_field_name('cat_id')),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($business_dropown_cat);
                ?>
            </p>
            <hr>
            <p>
                <label for="<?php echo $this->get_field_id('image'); ?>">
                    <?php _e('Select Background Image', 'ample-business'); ?>:
                </label>
                <span class="img-preview-wrap" <?php if (empty($image)) { ?> style="display:none;" <?php } ?>>
                    <img class="widefat" src="<?php echo esc_url($image); ?>"
                         alt="<?php esc_attr_e('Image preview', 'ample-business'); ?>"/>
                </span><!-- .img-preview-wrap -->
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('image'); ?>"
                       id="<?php echo $this->get_field_id('image'); ?>"
                       value="<?php echo esc_url($image); ?>"/>
                <input type="button" id="custom_media_button"
                       value="<?php esc_attr_e('Upload Image', 'ample-business'); ?>" class="button media-image-upload"
                       data-title="<?php esc_attr_e('Select Background Image', 'ample-business'); ?>"
                       data-button="<?php esc_attr_e('Select Background Image', 'ample-business'); ?>"/>
                <input type="button" id="remove_media_button"
                       value="<?php esc_attr_e('Remove Image', 'ample-business'); ?>"
                       class="button media-image-remove"/>
            </p>
            <hr>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('post_number')); ?>"><strong><?php esc_html_e('Number of Posts:', 'ample-business'); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post_number')); ?>" name="<?php echo esc_attr($this->get_field_name('post_number')); ?>" type="number" value="<?php echo $post_number; ?>" min="1"/>
            </p>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['cat_id'] = (isset($new_instance['cat_id'])) ? absint($new_instance['cat_id']) : '';
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['sub-title'] = sanitize_text_field($new_instance['sub-title']);
            $instance['image'] = esc_url_raw($new_instance['image']);
	        $instance['post_number'] = absint( $new_instance['post_number'] );

            return $instance;

        }

        public function widget($args, $instance)
        {
            if (!empty($instance)) {
                $instance = wp_parse_args((array)$instance, $this->defaults());
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $subtitle = esc_html($instance['sub-title']);
                $catid = absint($instance['cat_id']);
                $image = esc_url($instance['image']);
	            $post_number = absint($instance['post_number']);
                echo $args['before_widget'];
                ?>
                <section id="ample-business-theme-feature" class="widget widget-ample-business-theme-feature">
                <div class="container">
                  <div class="row">
                    <div class="col-xs-12 col-sm-6 wow fadeInLeftBig"  data-wow-duration="2s">
                      <div class="feature-content ">
                        <div class="main-title">
                          <h2 class="widget-title"><?php echo $title;?> </h2>
                            <span class="double-border"></span>
                          <p> <?php echo $subtitle; ?></p>
                        </div>

                          <?php
                          $idvalue = array();
                          if (!empty($catid)) {
                              $i = 0;
                              $sticky = get_option('sticky_posts');
                              $home_our_features_section = array(
                                  'cat' => $catid,
                                  'posts_per_page' => $post_number,
                                  'ignore_sticky_posts' => true,
                                  'post__not_in' => $sticky,
                                  'orderby' => 'post_date',
                                  'order' => 'DESC',
                              );
                              $home_our_features_section_query = new WP_Query($home_our_features_section);
                              if ($home_our_features_section_query->have_posts()) {
                                  while ($home_our_features_section_query->have_posts()) {
                                      $home_our_features_section_query->the_post();
                                      $icon = get_post_meta(get_the_ID(), 'ample_business_icon', true);
                                      $idvalue[] = get_the_ID();
                                      ?>

                                      <!-- Start single feature item -->
                            <div class="feature-item">
                                <div class="feature-item-icon notice">
                                    <?php echo esc_html(get_the_date()); ?>
                                </div>
                                <div class="feature-item-content">
                                    <h3 class="widget-inner-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                    <p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p>
                                </div>
                            </div>
                            <!-- End single feature item -->
                        <?php
                            $i++;
                        }
                        wp_reset_postdata();
                    }
                }?>
                          

                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 wow fadeInRightBig"  data-wow-duration="2s">
                      <div class="feature-image">
                        <img src="<?php echo $image;?>" title="" class="img-responsive">
                      </div>
                    </div>
                  </div>
                </div>
            </section>
          <!-- End feature Area -->
<?php
                echo $args['after_widget'];
            }
        }

    }
}
add_action('widgets_init', 'Ample_Business_notice_widget');
function Ample_Business_notice_widget()
{
    register_widget('Ample_Business_notice_Widget');

}

?>
