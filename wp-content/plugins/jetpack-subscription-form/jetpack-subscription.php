<?php
/*
  Plugin Name: Jetpack Subscription Form
  Description: Customizable subscription UI for Jetpack
  Version: 1.0
  Author: Kiran Antony
  Author URI: http://www.kiranantony.com

Copyright 2014 Kiran Antony | mail@kiranantony.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

class Jetpack_Subscriptions_Widget_Custom extends WP_Widget {

    function Jetpack_Subscriptions_Widget_Custom() {
        $widget_ops = array('classname' => 'jetpack_subscription_custom_widget', 'description' => __('Add an email signup form to allow people to subscribe to your blog.', 'jetpack'));
        $control_ops = array('width' => 300);

        $this->WP_Widget('blog_subscription_custom_jetpack', __('Blog Subscriptions Customized(Jetpack)', 'jetpack'), $widget_ops, $control_ops);

//        add_action('init', array($this, 'maybe_add_style'));
    }

//    function maybe_add_style() {
//        //if ( is_active_widget( false, false, $this->id_base, true ) ) {
//        wp_register_style('jetpack-subscriptions', plugins_url('style.css', __FILE__));
//        wp_enqueue_style('jetpack-subscriptions');
//        //}
//    }

    function widget($args, $instance) {
        global $current_user;



        $source = 'widget';
        $instance = wp_parse_args((array) $instance, $this->defaults());
        $subscribe_text = isset($instance['subscribe_text']) ? stripslashes($instance['subscribe_text']) : '';
        $subscribe_placeholder = isset($instance['subscribe_placeholder']) ? stripslashes($instance['subscribe_placeholder']) : '';
        $subscribe_text_class = isset($instance['subscribe_text_class']) ? stripslashes($instance['subscribe_text_class']) : '';
        $subscribe_button = isset($instance['subscribe_button']) ? stripslashes($instance['subscribe_button']) : '';
        $show_subscribers_total = (bool) $instance['show_subscribers_total'];
        $remove_p_tags_caza_jet = (bool) $instance['remove_p_tags_caza_jet'];
        $subscribe_submit_class = isset($instance['subscribe_submit_class']) ? stripslashes($instance['subscribe_submit_class']) : '';
        $subscribers_total = $this->fetch_subscriber_count();
        $widget_id = esc_attr(!empty($args['widget_id']) ? esc_attr($args['widget_id']) : mt_rand(450, 550) );

        if (!is_array($subscribers_total))
            $show_subscribers_total = FALSE;

        // Give the input element a unique ID  
        $subscribe_field_id = apply_filters('subscribe_field_id', 'subscribe-field', $widget_id);

        echo $args['before_widget'];
        echo $args['before_title'] . esc_attr($instance['title']) . $args['after_title'] . "\n";

        $referer = set_url_scheme('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

        // Check for subscription confirmation.
        if (isset($_GET['subscribe']) && 'success' == $_GET['subscribe']) :
            ?>

            <div class="success">
                <p><?php esc_html_e('An email was just sent to confirm your subscription. Please find the email now and click activate to start subscribing.', 'jetpack'); ?></p>
            </div>

            <?php
        endif;

        // Display any errors
        if (isset($_GET['subscribe'])) :
            switch ($_GET['subscribe']) :
                case 'invalid_email' :
                    ?>
                    <p class="error"><?php esc_html_e('The email you entered was invalid, please check and try again.', 'jetpack'); ?></p>
                    <?php
                    break;
                case 'already' :
                    ?>
                    <p class="error"><?php esc_html_e('You have already subscribed to this site, please check your inbox.', 'jetpack'); ?></p>
                    <?php
                    break;
                case 'success' :
                    echo wpautop($subscribe_text);
                    break;
                default :
                    ?>
                    <p class="error"><?php esc_html_e('There was an error when subscribing, please try again.', 'jetpack') ?></p>
                    <?php
                    break;
            endswitch;
        endif;

        // Display a subscribe form 
        ?>
        <form action="#" method="post" accept-charset="utf-8" id="subscribe-blog-<?php echo $widget_id; ?>">
            <?php
            if (!isset($_GET['subscribe'])) {
                ?><p id="subscribe-text"><?php echo $subscribe_text ?></p><?php
            }

            if ($show_subscribers_total && 0 < $subscribers_total['value']) {
                echo wpautop(sprintf(_n('Join %s other subscriber', 'Join %s other subscribers', $subscribers_total['value'], 'jetpack'), number_format_i18n($subscribers_total['value'])));
            }
            ?>
            <?php
            if (!$remove_p_tags_caza_jet)
                echo '<p id="subscribe-email">';
            ?>
            <input type="text" name="email" value="<?php echo!empty($current_user->user_email) ? esc_attr($current_user->user_email) : esc_html__('Email Address', 'jetpack'); ?>" id="<?php echo esc_attr($subscribe_field_id) ?>" class="<?php echo esc_attr($subscribe_text_class); ?>" placeholder="<?php echo esc_attr($subscribe_placeholder); ?>" />
                <?php
            if (!$remove_p_tags_caza_jet)
                echo '</p>';
            ?>

            <?php
            if (!$remove_p_tags_caza_jet)
                echo '<p id="subscribe-submit">';
            ?>
            <input type="hidden" name="action" value="subscribe" />
            <input type="hidden" name="source" value="<?php echo esc_url($referer); ?>" />
            <input type="hidden" name="sub-type" value="<?php echo esc_attr($source); ?>" />
            <input type="hidden" name="redirect_fragment" value="<?php echo $widget_id; ?>" />
            <?php
            if (is_user_logged_in()) {
                wp_nonce_field('blogsub_subscribe_' . get_current_blog_id(), '_wpnonce', false);
            }
            ?>
            <input type="submit" value="<?php echo esc_attr($subscribe_button); ?>" class="<?php echo esc_attr($subscribe_submit_class); ?>" name="jetpack_subscriptions_widget" />
            <?php
            if (!$remove_p_tags_caza_jet)
                echo '</p>';
            ?>
        </form>

        <?php
        echo "\n" . $args['after_widget'];
    }

    function increment_subscriber_count($current_subs_array = array()) {
        $current_subs_array['value'] ++;

        set_transient('wpcom_subscribers_total', $current_subs_array, 3600); // try to cache the result for at least 1 hour

        return $current_subs_array;
    }

    function fetch_subscriber_count() {
        $subs_count = get_transient('wpcom_subscribers_total');

        if (FALSE === $subs_count || 'failed' == $subs_count['status']) {
            Jetpack:: load_xml_rpc_client();

            $xml = new Jetpack_IXR_Client(array('user_id' => JETPACK_MASTER_USER,));

            $xml->query('jetpack.fetchSubscriberCount');

            if ($xml->isError()) { // if we get an error from .com, set the status to failed so that we will try again next time the data is requested
                $subs_count = array(
                    'status' => 'failed',
                    'code' => $xml->getErrorCode(),
                    'message' => $xml->getErrorMessage(),
                    'value' => ( isset($subs_count['value']) ) ? $subs_count['value'] : 0,
                );
            } else {
                $subs_count = array(
                    'status' => 'success',
                    'value' => $xml->getResponse(),
                );
            }

            set_transient('wpcom_subscribers_total', $subs_count, 3600); // try to cache the result for at least 1 hour
        }

        return $subs_count;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = wp_kses(stripslashes($new_instance['title']), array());
        $instance['subscribe_text'] = wp_filter_post_kses(stripslashes($new_instance['subscribe_text']));
        $instance['subscribe_placeholder'] = wp_filter_post_kses(stripslashes($new_instance['subscribe_placeholder']));
        $instance['subscribe_text_class'] = wp_filter_post_kses(stripslashes($new_instance['subscribe_text_class']));
        $instance['subscribe_submit_class'] = wp_filter_post_kses(stripslashes($new_instance['subscribe_submit_class']));
        $instance['subscribe_logged_in'] = wp_filter_post_kses(stripslashes($new_instance['subscribe_logged_in']));
        $instance['subscribe_button'] = wp_kses(stripslashes($new_instance['subscribe_button']), array());
        $instance['show_subscribers_total'] = isset($new_instance['show_subscribers_total']) && $new_instance['show_subscribers_total'];
        $instance['remove_p_tags_caza_jet'] = isset($new_instance['remove_p_tags_caza_jet']) && $new_instance['remove_p_tags_caza_jet'];

        return $instance;
    }

    public static function defaults() {
        return array(
            'title' => esc_html__('Subscribe to Blog via Email', 'jetpack'),
            'subscribe_text' => esc_html__('Enter your email address to subscribe to this blog and receive notifications of new posts by email.', 'jetpack'),
            'subscribe_button' => esc_html__('Subscribe', 'jetpack'),
            'subscribe_logged_in' => esc_html__('Click to subscribe to this blog and receive notifications of new posts by email.', 'jetpack'),
            'show_subscribers_total' => true,
        );
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->defaults());

        $title = stripslashes($instance['title']);
        $subscribe_text = stripslashes($instance['subscribe_text']);
        $subscribe_placeholder = stripslashes($instance['subscribe_placeholder']);
        $subscribe_text_class = stripslashes($instance['subscribe_text_class']);
        $subscribe_submit_class = stripslashes($instance['subscribe_submit_class']);
        $subscribe_button = stripslashes($instance['subscribe_button']);
        $show_subscribers_total = checked($instance['show_subscribers_total'], true, false);
        $remove_p_tags_caza_jet = checked($instance['remove_p_tags_caza_jet'], true, false);

        $subs_fetch = $this->fetch_subscriber_count();

        if ('failed' == $subs_fetch['status']) {
            printf('<div class="error inline"><p>' . __('%s: %s', 'jetpack') . '</p></div>', esc_html($subs_fetch['code']), esc_html($subs_fetch['message']));
        }
        $subscribers_total = number_format_i18n($subs_fetch['value']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Widget title:', 'jetpack'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subscribe_text'); ?>">
                <?php _e('Optional text to display to your readers:', 'jetpack'); ?>
                <textarea style="width: 95%" id="<?php echo $this->get_field_id('subscribe_text'); ?>" name="<?php echo $this->get_field_name('subscribe_text'); ?>" type="text"><?php echo esc_html($subscribe_text); ?></textarea>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subscribe_placeholder'); ?>">
                <?php _e('Optional Placeholder to display to your readers:', 'jetpack'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('subscribe_placeholder'); ?>" name="<?php echo $this->get_field_name('subscribe_placeholder'); ?>" type="text" value="<?php echo esc_attr($subscribe_placeholder); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subscribe_text_class'); ?>">
                <?php _e('Css Class For the Email Field:', 'jetpack'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('subscribe_text_class'); ?>" name="<?php echo $this->get_field_name('subscribe_text_class'); ?>" type="text" value="<?php echo esc_attr($subscribe_text_class); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subscribe_button'); ?>">
                <?php _e('Subscribe Button:', 'jetpack'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('subscribe_button'); ?>" name="<?php echo $this->get_field_name('subscribe_button'); ?>" type="text" value="<?php echo esc_attr($subscribe_button); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subscribe_submit_class'); ?>">
                <?php _e('Css Class For the Submit Button:', 'jetpack'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('subscribe_submit_class'); ?>" name="<?php echo $this->get_field_name('subscribe_submit_class'); ?>" type="text" value="<?php echo esc_attr($subscribe_submit_class); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_subscribers_total'); ?>">
                <input type="checkbox" id="<?php echo $this->get_field_id('show_subscribers_total'); ?>" name="<?php echo $this->get_field_name('show_subscribers_total'); ?>" value="1"<?php echo $show_subscribers_total; ?> />
                <?php echo esc_html(sprintf(_n('Show total number of subscribers? (%s subscriber)', 'Show total number of subscribers? (%s subscribers)', $subscribers_total, 'jetpack'), $subscribers_total)); ?>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('remove_p_tags_caza_jet'); ?>">
                <input type="checkbox" id="<?php echo $this->get_field_id('remove_p_tags_caza_jet'); ?>" name="<?php echo $this->get_field_name('remove_p_tags_caza_jet'); ?>" value="1"<?php echo $remove_p_tags_caza_jet; ?> />
     
                <?php _e('Remove P tags Surronding The Input field And Submit Button:', 'jetpack'); ?>
            </label>
        </p>
        <?php
    }

}

//add_action( 'widgets_init', function(){
//     register_widget( 'Jetpack_Subscriptions_Widget_Custom' );
//});
// register Foo_Widget widget
function register_jtetpack_custom_widget() {
    register_widget('Jetpack_Subscriptions_Widget_Custom');
}

add_action('widgets_init', 'register_jtetpack_custom_widget');
