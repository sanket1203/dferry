<?php
session_start();
/** no direct access **/
defined('_MECEXEC_') or die();

$styling = $this->main->get_styling();
$event_colorskin = (isset($styling['mec_colorskin'] ) || isset($styling['color'])) ? 'colorskin-custom' : '';

// colorful
$colorful_flag = $colorful_class = '';
if($this->style == 'colorful')
{
	$colorful_flag = true;
	$this->style = 'modern';
	$colorful_class = ' mec-event-grid-colorful';
}
?>
<script>
	$(document).ready(function(){ 
		$(".mec-booking-button").click(function(){
			var day = $(this).parent().parent().find('.event-grid-modern-head .mec-event-date.mec-color').html();
			var month = $(this).parent().parent().find('.event-grid-modern-head .mec-event-month').html(); 
			var d = new Date();
			var n_year = d.getFullYear();
			var aren_island_ferry = month +' '+ day+' '+n_year; 
			//~ alert(aren_island_ferry);
			localStorage.setItem('aren_island_ferry_current_date', aren_island_ferry); 
			<?php  
			$_SESSION['aren_island_ferry_current_date_session']=1;
			?>
			});
		});
</script>
<div class="mec-wrap <?php echo $event_colorskin . $colorful_class; ?>">
    <div class="mec-event-grid-<?php echo $this->style; ?>">
        <?php
        $count = $this->count;

        if($count == 0 or $count == 5) $col = 4;
        else $col = 12 / $count;

        $rcount = 1 ;
        foreach($this->events as $date):
        foreach($date as $event):

        echo ($rcount == 1) ? '<div class="row">' : '';
        echo '<div class="col-md-'.$col.' col-sm-'.$col.'">';
        
        $location = isset($event->data->locations[$event->data->meta['mec_location_id']])? $event->data->locations[$event->data->meta['mec_location_id']] : array();
        $organizer = isset($event->data->organizers[$event->data->meta['mec_organizer_id']])? $event->data->organizers[$event->data->meta['mec_organizer_id']] : array();
        $event_color = isset($event->data->meta['mec_color']) ? '<span class="event-color" style="background: #'.$event->data->meta['mec_color'].'"></span>' : '';
        
        // colorful
		$colorful_bg_color = ($colorful_flag && isset($event->data->meta['mec_color'])) ? ' style="background: #' . $event->data->meta['mec_color'] . '"' : '';

        echo '<article class="mec-event-article mec-clear"' . $colorful_bg_color . '>';
        ?>
        <?php if($this->style == 'modern'): ?>
            <div class="event-grid-modern-head clearfix">
                <div class="mec-event-date mec-color"><?php echo date_i18n($this->date_format_modern_1, strtotime($event->date['start']['date'])); ?></div>
                <div class="mec-event-month"><?php echo date_i18n($this->date_format_modern_2, strtotime($event->date['start']['date'])); ?></div>
                <div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
                <div class="mec-event-day"><?php echo date_i18n($this->date_format_modern_3, strtotime($event->date['start']['date'])); ?></div>
            </div>
            <div class="mec-event-content">
                <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
                <p><?php echo (isset($location['address']) ? $location['address'] : ''); ?></p>
            </div>
            <div class="mec-event-footer">
                <a class="mec-booking-button" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>" target="_self"><?php echo (is_array($event->data->tickets) and count($event->data->tickets)) ? $this->main->m('register_button', __('REGISTER', 'mec')) : $this->main->m('view_detail', __('View Detail', 'mec')) ; ?></a>
                <ul class="mec-event-sharing-wrap">
                    <li class="mec-event-share">
                        <a href="#" class="mec-event-share-icon">
                            <i class="mec-sl-share"></i>
                        </a>
                    </li>
                    <ul class="mec-event-sharing"><?php echo $this->main->module('links.list', array('event'=>$event)); ?></ul>
                </ul>
            </div>
        <?php elseif($this->style == 'classic'): ?>
            <div class="mec-event-image"><?php echo $event->data->thumbnails['medium']; ?></div>
            <div class="mec-event-content">
                <div class="mec-event-date mec-bg-color"><?php echo date_i18n($this->date_format_classic_1, strtotime($event->date['start']['date'])); ?></div>
                <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
                <p><?php echo trim((isset($location['name']) ? $location['name'] : '').', '.(isset($location['address']) ? $location['address'] : ''), ', '); ?></p>
            </div>
            <div class="mec-event-footer">
                <ul class="mec-event-sharing-wrap">
                    <li class="mec-event-share">
                        <a href="#" class="mec-event-share-icon">
                            <i class="mec-sl-share"></i>
                        </a>
                    </li>
                    <ul class="mec-event-sharing"><?php echo $this->main->module('links.list', array('event'=>$event)); ?></ul>
                </ul>
                <a class="mec-booking-button" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>" target="_self"><?php echo (is_array($event->data->tickets) and count($event->data->tickets)) ? $this->main->m('register_button', __('REGISTER', 'mec')) : $this->main->m('view_detail', __('View Detail', 'mec')) ; ?></a>
            </div>
        <?php elseif($this->style == 'minimal'): ?>
            <div class="mec-event-date mec-bg-color-hover mec-border-color-hover mec-color"><span><?php echo date_i18n($this->date_format_minimal_1, strtotime($event->date['start']['date'])); ?></span><?php echo date_i18n($this->date_format_minimal_2, strtotime($event->date['start']['date'])); ?></div>
            <div class="event-detail-wrap">
                <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
                <div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
            </div>
        <?php elseif($this->style == 'clean'): ?>
            <div class="event-grid-t2-head mec-bg-color clearfix">
                <div class="mec-event-date"><?php echo date_i18n($this->date_format_clean_1, strtotime($event->date['start']['date'])); ?></div>
                <div class="mec-event-month"><?php echo date_i18n($this->date_format_clean_2, strtotime($event->date['start']['date'])); ?></div>
                <div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
            </div>
            <div class="mec-event-image"><?php echo $event->data->thumbnails['medium']; ?></div>
            <div class="mec-event-content">
                <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
                <p><?php echo (isset($location['address']) ? $location['address'] : ''); ?></p>
            </div>
            <div class="mec-event-footer mec-color">
                <ul class="mec-event-sharing-wrap">
                    <li class="mec-event-share">
                        <a href="#" class="mec-event-share-icon">
                            <i class="mec-sl-share"></i>
                        </a>
                    </li>
                    <ul class="mec-event-sharing"><?php echo $this->main->module('links.list', array('event'=>$event)); ?></ul>
                </ul>
                <a class="mec-booking-button" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>" target="_self"><?php echo (is_array($event->data->tickets) and count($event->data->tickets)) ? $this->main->m('register_button', __('REGISTER', 'mec')) : $this->main->m('view_detail', __('View Detail', 'mec')) ; ?></a>
            </div>
        <?php elseif($this->style == 'simple'): ?>
            <div class="mec-event-date mec-color"><?php echo $this->main->date_label($event->date['start'], $event->date['end'], $this->date_format_simple_1); ?></div>
            <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
            <div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
        <?php endif;
        echo '</article></div>';

        if($rcount == $count)
        {
            echo '</div>';
            $rcount = 0;
        }

        $rcount++;
        ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
	</div>
</div>
