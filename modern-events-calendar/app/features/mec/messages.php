<?php
/** no direct access **/
defined('_MECEXEC_') or die();

$messages = $this->main->get_messages();
$values = $this->main->get_messages_options();
?>
<div class="wrap" id="mec-wrap">
    <h1><?php _e('Modern Events Calendar', 'mec'); ?></h1>
    <h2 class="nav-tab-wrapper">
        <a href="<?php echo $this->main->remove_qs_var('tab'); ?>" class="nav-tab"><?php echo __('Settings', 'mec'); ?></a>
        <?php if(isset($this->settings['booking_status']) and $this->settings['booking_status']): ?>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-reg-form'); ?>" class="nav-tab"><?php echo __('Booking Form', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-gateways'); ?>" class="nav-tab"><?php echo __('Payment Gateways', 'mec'); ?></a>
        <?php endif; ?>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-notifications'); ?>" class="nav-tab"><?php echo __('Notifications', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-styling'); ?>" class="nav-tab"><?php echo __('Styling Options', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-customcss'); ?>" class="nav-tab"><?php echo __('Custom CSS', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-messages'); ?>" class="nav-tab nav-tab-active"><?php echo __('Messages', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-support'); ?>" class="nav-tab"><?php echo __('Support', 'mec'); ?></a>
    </h2>
    <div class="mec-container">
        <form id="mec_messages_form">
            <div class="mec-form-row">
                <h4 class="mec-form-subtitle"><?php _e('Messages', 'mec'); ?></h4>
			</div>
            <p><?php _e("You can change some MEC messages here simply. For example if you like to change \"REGISTER\" button label, you can do it here. By the Way, if your website is a multilingual website, we recommend you to change the messages/phrases from language files.", 'mec'); ?></p>
            <div class="mec-form-row" id="mec_messages_form_container">
                <ul class="mec-accordion mec-message-categories" id="mec_message_categories_wp">
                    <?php foreach($messages as $cat_key=>$category): ?>
                    <li class="mec-acc-label" data-key="<?php echo $cat_key; ?>" data-status="close"><?php echo $category['category']['name']; ?></li>
                    <ul id="mec-acc-<?php echo $cat_key; ?>">
                        <?php foreach($category['messages'] as $key=>$message): ?>
                        <li>
                            <label for="<?php echo 'mec_m_'.$key; ?>"><?php echo $message['label']; ?></label>
                            <input id="<?php echo 'mec_m_'.$key; ?>" name="mec[messages][<?php echo $key; ?>]" type="text" placeholder="<?php echo esc_attr($message['default']); ?>" value="<?php echo (isset($values[$key]) and trim($values[$key])) ? esc_attr($values[$key]) : ''; ?>" />
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endforeach; ?>
                </ul>
			</div>
            <div class="mec-form-row">
                <?php wp_nonce_field('mec_options_form'); ?>
                <button id="mec_messages_form_button" class="button button-primary mec-button-primary" type="submit"><?php _e('Save Changes', 'mec'); ?></button>
			</div>
        </form>
    </div>
</div>
<script type="text/javascript">
jQuery("#mec_messages_form").on('submit', function(event)
{
    event.preventDefault();
    
    // Add loading Class to the button
    jQuery("#mec_messages_form_button").addClass('loading').text("<?php echo esc_js(esc_attr__('Saved', 'mec')); ?>");
    
    var messages = jQuery("#mec_messages_form").serialize();
    jQuery.ajax(
    {
        type: "POST",
        url: ajaxurl,
        data: "action=mec_save_messages&"+messages,
        success: function(data)
        {
            // Remove the loading Class to the button
            setTimeout(function(){
                jQuery("#mec_messages_form_button").removeClass('loading').text("<?php echo esc_js(esc_attr__('Save Changes', 'mec')); ?>");
            }, 1000);
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Remove the loading Class to the button
            setTimeout(function(){
                jQuery("#mec_messages_form_button").removeClass('loading').text("<?php echo esc_js(esc_attr__('Save Changes', 'mec')); ?>");
            }, 1000);
        }
    });
});
</script>