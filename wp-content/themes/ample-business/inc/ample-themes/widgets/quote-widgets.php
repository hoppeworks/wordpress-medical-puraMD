<?php
if (!class_exists('Ample_Business_Quote_Widget')) {
    class Ample_Business_Quote_Widget extends WP_Widget
    {
        private function defaults()
        {
            $defaults = array(
                'title' => '',
                'button-text1' => esc_html__('button1', 'ample-business'),
                'button-text-link1' => '#',
                'button-text2' => esc_html__('button2', 'ample-business'),
                'button-text-link2' => '#',
                'features_background' => '',
            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'ample-business-quote-widget',
                esc_html__('AB : Quote Widget', 'ample-business'),
                array('description' => esc_html__('Business Quote Section', 'ample-business'))
            );
        }

        public function form($instance)
        {
            $instance = wp_parse_args((array )$instance, $this->defaults());
            $title = esc_attr($instance['title']);
            $button_text1 = esc_attr($instance['button-text1']);
            $button_text_link1 = esc_url($instance['button-text-link1']);
            $button_text2 = esc_attr($instance['button-text2']);
            $button_text_link2 = esc_url($instance['button-text-link2']);
            $features_background = esc_url($instance['features_background']);
            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'ample-business'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($title); ?>">
            </p>

            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('button-text1')); ?>"><?php esc_html_e('Button Text1', 'ample-business'); ?></label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-text1')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('button-text1')); ?>"
                       value="<?php echo esc_attr ($button_text1); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('button-text-link1')); ?>">
                    <?php esc_html_e('Button Link1', 'ample-business'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-text-link1')); ?>"
                       class="widefat" id="<?php echo esc_attr($this->get_field_id('button-text-link1')); ?>"
                       value="<?php echo esc_attr($button_text_link1); ?>">
            </p>
            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('button-text2')); ?>"><?php esc_html_e('Button Text2', 'ample-business'); ?></label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-text2')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('button-text2')); ?>"
                       value="<?php echo esc_attr($button_text2); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('button-text-link2')); ?>">
                    <?php esc_html_e('Button Link2', 'ample-business'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-text-link2')); ?>"
                       class="widefat" id="<?php echo esc_attr($this->get_field_id('button-text-link2')); ?>"
                       value="<?php echo esc_attr($button_text_link2); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('features_background'); ?>">
                    <?php _e('Select Background Image', 'ample-business'); ?>:
                </label>
                <span class="img-preview-wrap" <?php if (empty($features_background)) { ?> style="display:none;" <?php } ?>>
                    <img class="widefat" src="<?php echo esc_url($features_background); ?>"
                         alt="<?php esc_attr_e('Image preview', 'ample-business'); ?>"/>
                </span><!-- .img-preview-wrap -->
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('features_background'); ?>"
                       id="<?php echo $this->get_field_id('features_background'); ?>"
                       value="<?php echo esc_url($features_background); ?>"/>
                <input type="button" id="custom_media_button"
                       value="<?php esc_attr_e('Upload Image', 'ample-business'); ?>" class="button media-image-upload"
                       data-title="<?php esc_attr_e('Select Background Image', 'ample-business'); ?>"
                       data-button="<?php esc_attr_e('Select Background Image', 'ample-business'); ?>"/>
                <input type="button" id="remove_media_button"
                       value="<?php esc_attr_e('Remove Image', 'ample-business'); ?>"
                       class="button media-image-remove"/>
            </p>
            <hr>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['button-text1'] = sanitize_text_field($new_instance['button-text1']);
            $instance['button-text-link1'] = esc_url_raw($new_instance['button-text-link1']);
            $instance['button-text2'] = sanitize_text_field($new_instance['button-text2']);
            $instance['button-text-link2'] = esc_url_raw($new_instance['button-text-link2']);
            $instance['features_background'] = esc_url_raw($new_instance['features_background']);

            return $instance;
        }

        public function widget($args, $instance)
        {

            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $button_text1 = esc_html($instance['button-text1']);
                $button_text_link1 = esc_url($instance['button-text-link1']);
                $button_text2 = esc_html($instance['button-text2']);
                $button_text_link2 = esc_url($instance['button-text-link2']);
                $features_background = esc_url($instance['features_background']);
                echo $args['before_widget'];
                ?>
                <section id="ample-business-theme-meetbutton" class="widget widget-ample-business-theme-meetbutton"
                         style="background-image: url(<?php echo $features_background; ?>);">
                    <div class="container">
                        <div class="meet-button-content wow fadeInDown" data-wow-duration="2s">
                            <div class="main-title">
                                <h2 class="widget-title whitetext"><?php echo esc_html($title); ?></h2>
                            </div>
                            <div class="meet-counter-button">
                                <?php if (!empty($button_text1)) { ?>
                                    <a id="parallex-team" href="<?php echo esc_url($button_text_link1) ; ?> "
                                       class="paralex-btn"><?php echo esc_html($button_text1); ?></a>
                                <?php } ?>
                                <?php if (!empty($button_text2)) { ?>
                                    <a id="parallex-counter" href="<?php echo esc_url($button_text_link2) ; ?>"
                                       class="paralex-btn"><?php echo esc_html($button_text2); ?></a>
                                <?php } ?>
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
add_action('widgets_init', 'business_quote_widget');
function business_quote_widget()
{
    register_widget('Ample_Business_Quote_Widget');

}

