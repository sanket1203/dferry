<?php
/** no direct access **/
defined('_MECEXEC_') or die();
?>
<div class="mec-wrap <?php echo $event_colorskin; ?> clearfix <?php echo $this->html_class; ?> mec-modal-wrap" id="mec_skin_<?php echo $this->id; ?>">
    <article class="mec-single-event mec-single-modern mec-single-modal">
        <div class="mec-events-event-image"><?php echo $event->data->thumbnails['full']; ?></div>

        <div class="col-md-4">
            
            <div class="mec-event-meta mec-color-before mec-frontbox <?php echo ((!$this->main->can_show_booking_module($event) and in_array($event->data->meta['mec_organizer_id'], array('0', '1'))) ? 'mec-util-hidden' : '') ; ?>">
                <?php
                // Event Organizer
                if(isset($event->data->organizers[$event->data->meta['mec_organizer_id']]) && !empty($event->data->organizers[$event->data->meta['mec_organizer_id']]))
                {
                    $organizer = $event->data->organizers[$event->data->meta['mec_organizer_id']];
                    ?>
                    <div class="mec-single-event-organizer">
                        <?php if(isset($organizer['thumbnail']) and trim($organizer['thumbnail'])): ?>
                            <img class="mec-img-organizer" src="<?php echo esc_url($organizer['thumbnail']); ?>" alt="<?php echo (isset($organizer['name']) ? $organizer['name'] : ''); ?>">
                        <?php endif; ?>
                        <h3 class="mec-events-single-section-title"><?php echo $this->main->m('taxonomy_organizer', __('Organizer', 'mec')); ?></h3>
                        <?php if(isset($organizer['thumbnail'])): ?>
                        <dd class="mec-organizer">
                            <i class="mec-sl-home"></i>
                            <h6><?php echo (isset($organizer['name']) ? $organizer['name'] : ''); ?></h6>
                        </dd>
                        <?php endif;
                        if(isset($organizer['tel']) && !empty($organizer['tel'])): ?>
                        <dd class="mec-organizer-tel">
                            <i class="mec-sl-phone"></i>
                            <h6><?php _e('Phone', 'mec'); ?></h6>
                            <a href="tel:<?php echo $organizer['tel']; ?>"><?php echo $organizer['tel']; ?></a>
                        </dd>
                        <?php endif;
                        if(isset($organizer['email']) && !empty($organizer['email'])): ?>
                        <dd class="mec-organizer-email">
                            <i class="mec-sl-envelope"></i>
                            <h6><?php _e('Email', 'mec'); ?></h6>
                            <a href="mailto:<?php echo $organizer['email']; ?>"><?php echo $organizer['email']; ?></a>
                        </dd>
                        <?php endif;
                        if(isset($organizer['url']) && !empty($organizer['url']) and $organizer['url'] != 'http://'): ?>
                        <dd class="mec-organizer-url">
                            <i class="mec-sl-sitemap"></i>
                            <h6><?php _e('Website', 'mec'); ?></h6>
                            <span><a href="<?php echo (strpos($organizer['url'], 'http') === false ? 'http://'.$organizer['url'] : $organizer['url']); ?>" class="mec-color-hover" target="_blank"><?php echo $organizer['url']; ?></a></span>
                        </dd>
                        <?php endif; ?>
                    </div>
                <?php
                }
                ?>

                <!-- Register Booking Button -->
                <?php if($this->main->can_show_booking_module($event)): ?>
                    <a class="mec-booking-button mec-bg-color" href="#mec-events-meta-group-booking"><?php echo esc_html($this->main->m('register_button', __('REGISTER', 'mec'))); ?></a>
                <?php endif ?>
            </div>

            <!-- Local Time Module -->
            <?php echo $this->main->module('local-time.details', array('event'=>$event)); ?>
            
            <div class="mec-event-meta mec-color-before mec-frontbox">
                
                <?php
                // Event Location
                if(isset($event->data->locations[$event->data->meta['mec_location_id']]) and !empty($event->data->locations[$event->data->meta['mec_location_id']]))
                {
                    $location = $event->data->locations[$event->data->meta['mec_location_id']];
                    ?>
                    <div class="mec-single-event-location">
                        <?php if($location['thumbnail']): ?>
                        <img class="mec-img-location" src="<?php echo esc_url($location['thumbnail'] ); ?>" alt="<?php echo (isset($location['name']) ? $location['name'] : ''); ?>">
                        <?php endif; ?>
                        <i class="mec-sl-location-pin"></i>
                        <h3 class="mec-events-single-section-title mec-location"><?php echo $this->main->m('taxonomy_location', __('Location', 'mec')); ?></h3>
                        <dd class="author fn org"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></dd>
                        <dd class="location"><address class="mec-events-address"><span class="mec-address"><?php echo (isset($location['address']) ? $location['address'] : ''); ?></span></address></dd>
                    </div>
                    <?php
                }
                ?>

                <?php
                // Event Categories
                if(isset($event->data->categories) and !empty($event->data->categories))
                {
                    ?>
                    <div class="mec-single-event-category">
                        <i class="mec-sl-folder"></i>
                        <dt><?php echo $this->main->m('taxonomy_categories', __('Category', 'mec')); ?></dt>
                        <?php
                        $cats = array();
                        foreach($event->data->categories as $category)
                        {
                            echo '<dd class="mec-events-event-categories"><a href="'.get_category_link($category['id']).'" class="mec-color-hover" rel="tag">'.$category['name'].'</a></dd>';
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>  
                <?php
                    // More Info
                    if(isset($event->data->meta['mec_more_info']) and trim($event->data->meta['mec_more_info']) and $event->data->meta['mec_more_info'] != 'http://')
                    {
                        ?>
                        <div class="mec-event-more-info">
                            <i class="mec-sl-info"></i>
                            <h3 class="mec-cost"><?php echo $this->main->m('more_info_link', __('More Info', 'mec')); ?></h3>
                            <dd class="mec-events-event-more-info"><a class="mec-more-info-button mec-color-hover" target="<?php echo (isset($event->data->meta['mec_more_info_target']) ? $event->data->meta['mec_more_info_target'] : '_self'); ?>" href="<?php echo $event->data->meta['mec_more_info']; ?>"><?php echo ((isset($event->data->meta['mec_more_info_title']) and trim($event->data->meta['mec_more_info_title'])) ? $event->data->meta['mec_more_info_title'] : __('Read More', 'mec')); ?></a></dd>
                        </div>
                        <?php
                    }
                ?>
                
            </div>

            <!-- Attendees List Module -->
            <?php echo $this->main->module('attendees-list.details', array('event'=>$event)); ?>
            
            <!-- Next Previous Module -->
            <?php echo $this->main->module('next-event.details', array('event'=>$event)); ?>                
        </div>

        <div class="col-md-8">

            <div class="mec-event-content">
                <div class="mec-single-event-description mec-events-content"><?php echo $this->main->get_post_content($event->data->ID) ?></div>
            </div>

            <!-- Links Module -->
            <?php echo $this->main->module('links.details', array('event'=>$event)); ?>

            <!-- Google Maps Module -->
            <div class="mec-events-meta-group mec-events-meta-group-gmap">
                <?php echo $this->main->module('googlemap.details', array('event'=>$this->events)); ?>
            </div>
            
            <!-- Export Module -->
            <?php echo $this->main->module('export.details', array('event'=>$event)); ?>

            <!-- Countdown module -->
            <?php //if($this->main->can_show_countdown_module($event)): ?>
            <!-- <div class="mec-events-meta-group mec-events-meta-group-countdown"> -->
                <?php //echo $this->main->module('countdown.details', array('event'=>$this->events)); ?>
            <!-- </div>  -->
            <?php //endif; ?>

            <!-- Hourly Schedule -->
            <?php if(isset($event->data->meta['mec_hourly_schedules']) and is_array($event->data->meta['mec_hourly_schedules']) and count($event->data->meta['mec_hourly_schedules'])): ?>
            <div class="mec-event-schedule mec-frontbox">
                <h3 class="mec-schedule-head mec-frontbox-title"><?php _e('Hourly Schedule','mec'); ?></h3>
                <div class="mec-event-schedule-content">
                    <?php foreach($event->data->meta['mec_hourly_schedules'] as $schedule): ?>
                    <dl>
                        <dt class="mec-schedule-time"><span class="mec-schedule-start-time mec-color"><?php echo $schedule['from']; ?></span> - <span class="mec-schedule-end-time mec-color"><?php echo $schedule['to']; ?></span> </dt>
                        <dt class="mec-schedule-title"><?php echo $schedule['title']; ?></dt>
                        <dt class="mec-schedule-description"><?php echo $schedule['description']; ?></dt>
                    </dl>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Booking Module -->
            <?php if($this->main->is_sold($event, (trim($occurrence) ? $occurrence : $event->date['start']['date']))): ?>
            <div class="mec-sold-tickets"><?php _e('Sold out!', 'wpl'); ?></div>
            <?php elseif($this->main->can_show_booking_module($event)): ?>
            <div id="mec-events-meta-group-booking" class="mec-events-meta-group mec-events-meta-group-booking">
                <?php echo $this->main->module('booking.default', array('event'=>$this->events)); ?>
            </div>
            <?php endif ?>

            <!-- Tags -->
            <div class="mec-events-meta-group mec-events-meta-group-tags">
                <?php the_tags(__('Tags: ', 'mec'), ', ', '<br />'); ?>
            </div>
        </div>
    </article>
</div>