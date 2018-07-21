


<style>

	.innr-box { border: 1px solid #e6e6e6; float: left; padding: 20px; width: 100%;}
	.innr-box .left-box {  border: medium none; padding-left: 0;}
	.innr-box .left-box .mec-frontbox { float:left; width:100%; border: medium none; padding: 0;}
	.innr-box .right-box{ padding-right:0;}
	.innr-box .right-box .mec-frontbox { float:left; width:100%; border: medium none; padding: 0;}
	
	.innr-box h3{ font-size:18px !important; margin-bottom:15px; float:none !important; display:inline-block !important; width:100%; margin-top:0 !important;}
	
	
	.innr-box h4.heading{ border-bottom: 4px solid #ebebeb; color: #313131; display: block; font-size: 15px; font-weight: 500; padding-bottom: 10px; position: relative; text-align: center; text-transform: uppercase; width: 100%; margin-bottom:20px;}
	
	.innr-box h4.heading:before { border-bottom: 4px solid  #e64883; bottom: -4px; content: ""; font-size: 6px; left: 50%; margin-left: -35px; padding: 1px 35px; position: absolute; text-align: center;}


	.innr-box .mec-events-meta-group-booking { border: medium none; float: left; padding: 0; width: 100%;}
	
	.innr-box + .mec-single-event-description.mec-events-content { display: inline-block; float: none; margin-bottom: 0; padding-top: 30px;}
	.innr-box + .mec-single-event-description.mec-events-content p { margin-bottom: 0;}
	
	.innr-box .mec-single-event-date{ padding:0; background:none; line-height:40px; margin-bottom:10px;}
	.innr-box .mec-single-event-time{ padding:0; background:none; line-height:40px;}
	
	
	.innr-box .right-box input{ float:left; border:2px solid #D7D7D7; width:100%; line-height:40px; margin-bottom:10px; height:40px; padding:0 15px;}    

   .returndata h2 {
  display: inline !important;
  font-family: Montserrat,Helvetica,Arial,sans-serif !important;
  font-size: 18px !important;
  font-weight: 500 !important;
  padding-bottom: 5px !important;
  padding-left: 10px !important;
  text-transform: uppercase !important;
}
	.oneway_image img {margin-top: 15px;}
</style>
    


<?php 

echo '<script type="text/javascript">
jQuery(document).ready(function()
{
    if (localStorage.getItem("current_date") !== null) {
       var getdate_from_claender = localStorage.getItem("current_date");
       $("#set_frm_claender").text(getdate_from_claender);
       $("#input_01").val(getdate_from_claender);
       $("#set_frm_claender_right").text(getdate_from_claender); 
        localStorage.removeItem("current_date");
    }
    if (localStorage.getItem("aren_island_ferry_current_date") !== null) {
    
        //~ var getdate_from_claender = localStorage.getItem("aren_island_ferry_current_date");
        //alert(getdate_from_claender);
       //~ $("#set_frm_claender").text(getdate_from_claender);
       //~ $("#input_01").val(getdate_from_claender);
       // localStorage.clear(getdate_from_claender);
    }
 });
</script>';

/** no direct access **/
defined('_MECEXEC_') or die();
/* Testing GitHub Commit again */

?>

<div class="mec-wrap <?php echo $event_colorskin; ?> clearfix <?php echo $this->html_class; ?>" id="mec_skin_<?php echo $this->id; ?>">

    <article class="mec-single-event">
        <div class="col-md-8">
            
            <div class="mec-events-event-image"><?php echo $event->data->thumbnails['full']; ?></div>
            <div class="mec-event-content">
                <h1 class="mec-single-title"><?php the_title(); ?> </h1>
                
            <!-- ******** content part ***********-->
			<div class="innr-box">
            
            	<h4 class="heading setme_hide"><?php _e('Book Your Tickets', 'mec'); ?></h4>
                <div class="col-md-6 left-box setme_hide">     
                <div class="mec-event-meta mec-color-before mec-frontbox"> 


                        <h3 class="mec-date">Departaure</h3>
                <?php
                    // Event Date and Time 
                    echo '<pre>'; 
                         //~ print_r($event->data);                         //~ print_r($this); 
                    echo '</pre>';
                   
                    
                    if(isset($event->data->meta['mec_date']['start']) and !empty($event->data->meta['mec_date']['start']))
                    {
                    ?>
                        <div class="mec-single-event-date">
                            <i class="mec-sl-calendar" style="float:left; margin-top:10px;"></i>
                           <!-- <h3 class="mec-date"><?php _e('Date', 'mec'); ?></h3>  -->
                            <?php ///echo "<pre>"; print_r($event->date['start']);  echo "</pre>";?>
                            
                            <dd>
                                <abbr class="mec-events-abbr" id="set_frm_claender">
									<?php  
									/******************by ravi today date ******************************/
									global $v_depart_date;
									global $dayte; 
									 $dayte = date("Y/m/d");  
									 if(!empty($occurrence)){ 
									$occurrence = trim($occurrence);
									echo $occurrence = date('M d Y', strtotime($occurrence));  
									  //~ echo $this->main->date_label(( ? array('date'=>$occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date'=>$occurrence_end_date) : (isset($event->date['end1']) ? $event->date['end'] : NULL)), $this->date_format1);
									  
									  $v_depart_date=$occurrence;
									}
									else{
										$event->date['start']=$dayte;
									  echo  $v_depart_date=$this->main->date_label((trim($occurrence) ? array('date'=>$occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date'=>$occurrence_end_date) : (isset($event->date['end1']) ? $event->date['end'] : NULL)), $this->date_format1);
									 }
									 ?>
                                
                                </abbr>
                            </dd>
                            <?php  
                            //~ echo "<pre>"; print_r(trim($occurrence_end_date)); echo"</pre>"; 
                            ?>
                        </div>

                        <?php  
                        if(isset($event->data->meta['mec_hide_time']) and $event->data->meta['mec_hide_time'] == '0')
                        {
                            $time_comment = isset($event->data->meta['mec_comment']) ? $event->data->meta['mec_comment'] : '';
                            $allday = isset($event->data->meta['mec_allday']) ? $event->data->meta['mec_allday'] : 0;
                            ?>
                            <div class="mec-single-event-time">
                                <i class="mec-sl-clock" style="float:left; margin-top:10px;"></i>
                                <!-- <h3 class="mec-time"><?php _e('Time', 'mec'); ?></h3> -->
                                
                                
                                <?php if($allday == '0' and isset($event->data->time) and trim($event->data->time['start'])): ?>
                                <dd><abbr class="mec-events-abbr"><?php echo $event->data->time['start']; ?><?php /*echo (trim($event->data->time['end']) ? ' - '.$event->data->time['end'] : '');*/ ?></abbr></dd>
                                <?php else: ?>
                                <dd><abbr class="mec-events-abbr"><?php _e('All of the day', 'mec'); ?></abbr></dd>
                                <?php endif; ?>
                            </div>
                        <?php
                             
                            if(isset($event->data->meta['mec_start_check']) && $event->data->meta['mec_start_check'] == 1 ) {
                               /*echo "<span style='font-size:15px;'> no same day return sailing available for this strip </span>";*/ 
                            }
                        }
                    }
                ?>
                
                <i class="mec-time-comment"><?php echo (isset($time_comment) ? $time_comment : ''); ?></i>
                </div> 


                </div>
            <?php
            $catArr = array();  
            $taxonomy='mec_category';
            $tax_terms = get_terms($taxonomy, array('hide_empty' => false));     
            $modifiedArr=array();
            $modifiedArrStore=array();
            foreach($event->data->categories as $key => $valueArr)
            {
                
               $catArr[] = $key;
            }  
            
            $onewaycat_parent = array(25,28,29,30,79);
            /**********************check event category parent for one way category by ravi*********************************/
            function checkforparent($valueParent='',$tax_terms=array(),$onewaycat_parent=array()){  
					foreach($tax_terms as $Key => $IndividualCatArr)
					{
						if($IndividualCatArr->term_id == $valueParent)
						{  
						 foreach($onewaycat_parent as $onewaycat_parent_item)
						{ 
							if(($IndividualCatArr->parent == $onewaycat_parent_item))
								{  
									return true;
								}	 
							}
						} 
					} 
			} 
            $widget_show = array(24); /**specal offers by ravi*******************/
            $flag=0;
            $w_flag=0;
          
            foreach ($catArr as $key => $valueParent) 
            {
                foreach ($onewaycat_parent as $key => $valueChild) 
                { 
                    if($valueParent == $valueChild)
                    {
                        $flag=1;
                        break;
                    } 
                } 
            $checkinside_parent = checkforparent($valueParent,$tax_terms,$onewaycat_parent);
				if($checkinside_parent)
				{
					$flag=1;
					break;						
				}
            }
            
             
            /*********************specal offers by ravi**************************/
            foreach ($catArr as $key => $valueParent)
             { 
                if($widget_show == $valueParent)
                {
					$w_flag=1;
					 break;
				} 
				$checkinside_parent_for_return = checkforparent($valueParent,$tax_terms,$widget_show);
				if($checkinside_parent_for_return)
				{
						$w_flag=1; 
						 break;
				} 
            }
            
            
            if($flag != 1)
        {
             ?>

            	<div class="col-md-6 right-box setme_hide">     
                <div class="mec-event-meta mec-color-before mec-frontbox"> 


                        <h3 class="mec-date">CHOOSE A RETURN TRIP</h3>
                        <script> 
							
                        </script>
              <?php 
              
   $aren_island_ferry_current_date = "<script>document.write(localStorage.getItem('aren_island_ferry_current_date'));</script>";
?> 
<input type="hidden" id="get_date_from_ferry" value="">

                <div class=" ticket-box"> 
                    <div>
                        <label for="ChooseReturnDate"></label>
<!--
                        <?php // $this->main->date_label((trim($occurrence) ? array('date'=>$occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date'=>$occurrence_end_date) : (isset($event->date['end1']) ? $event->date['end'] : NULL)), $this->date_format1); ?>
-->
                        <?php 

                           $fetch_departure_date = $this->main->date_label((trim($occurrence) ? array('date'=>$occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date'=>$occurrence_end_date) : (isset($event->date['end1']) ? $event->date['end'] : NULL)), $this->date_format1); ?>
                        
                         <?php    
                         //~ if(!empty($aren_island_ferry_current_date)){  
							    //~ $getdate_departure_format = date('m-d-Y', strtotime($aren_island_ferry_current_date));  
							//~ }
                        //~ else
                        //~ { 
							  //~ $getdate_departure_format = date('Y-m-d', strtotime($fetch_departure_date)); 
						//~ } 
						
						$today = date("Y/m/d"); 
						$getdate_departure_format = date('Y-m-d', strtotime($fetch_departure_date)); 
                        if(!empty($getdate_departure_format)) {
                             $event->data->meta['mec_end_date'] = $getdate_departure_format;
                        } else {
                              //~ $event->data->meta['mec_end_date'] = '01-06-2017'; /*********$today*******/
                              $event->data->meta['mec_end_date'] =  $today; /*********$today*******/
                        }
                            
                        //~ echo  $sssss = $event->data->meta['mec_end_date'] ;  
 

                         ?>
                          <input id="input_01" class="datepickerd" name="date" type="text"  value="<?php echo $v_depart_date;?> ">
                         <div id="containerd"></div>
                    </div> 
                 </div>

                  <div class="">
                        <label for="ChooseSailingTime"></label>
<!--
                        <input id="input_from" class="datepicker" type="time" name="time" autofocuss value="" placeholder="Choose Sailing Time...." data-valuee="">
-->
  <?php
 
  
                     global $post;
                     $date_return_time = $event->data->meta['date_return_time'];
                        //~ if(!empty($date_return_time) || )
                        //~ {
							$date_return_time = json_decode($date_return_time,true);
							$hoursm=$mm=$secondm=array();
							$hoursm = $date_return_time['h'];
							$mm = $date_return_time['m'];
							$secondm = $date_return_time['ap']; 
							$total=0;
							$total= count($hoursm); 
			
					 $end_time_hour = get_post_meta($post->ID, 'mec_end_time_hour', true);					 $end_time_hour = get_post_meta($post->ID, 'mec_end_time_hour', true);
       
                     $end_time_minutes = get_post_meta($post->ID, 'mec_end_time_minutes', true);
        
                     $end_time_ampm = get_post_meta($post->ID, 'mec_end_time_ampm', true);		
		
							?>

						<select name="time" id="current_time"  placeholder="sdf" class=" right-box input" style="width: 100%;">
							<option selected> Choose Sailing Time....</option>
							<option><?php echo $end_time_hour.':'.$end_time_minutes.'&nbsp;'.$end_time_ampm;?>  </option>
									<?php for($j=0; $j<$total; $j++){ 
										if($mm[$j]=='0')
										{
											//~ $mm[$j]='00';
										}

                                        $hours          =  sprintf("%02d", $hoursm[$j]);
                                        //$departure_min  = get_post_meta($event_id, 'mec_start_time_minutes', true);
                                        $mins           = sprintf("%02d", $mm[$j]);   
										?>
						<option value="<?php echo $hours.':'.$mins.'&nbsp;'.$secondm[$j];?>"><?php echo $hours.':'.$mins.'&nbsp;'.$secondm[$j];?> </option>
						<?php } ?>
						</select>
							 							
						<?php 
						
						//~ }
						?> 
                 </div>
               

                </div>
                </div>
                <?php 
                }
                 ?>
                
                <!-- Booking Module -->
				<?php if($this->main->is_sold($event, (trim($occurrence) ? $occurrence : $event->date['start']['date']))):  ?>
                <div class="mec-sold-tickets"><?php _e('Sold out!', 'wpl'); ?></div>
                <?php elseif($this->main->can_show_booking_module($event)): ?>
                <div id="mec-events-meta-group-booking" class="mec-events-meta-group mec-events-meta-group-booking">
                    <?php 
                    echo $this->main->module('booking.default', array('event'=>$this->events)); ?>
                </div>
                <?php endif ?>
    
                <!-- Tags -->
                <div class="mec-events-meta-group mec-events-meta-group-tags">
                    <?php the_tags(__('Tags: ', 'mec'), ', ', '<br />'); ?>
                </div>
                
                
            </div>
                
                <div class="mec-single-event-description mec-events-content"><?php the_content(); ?></div>
                
                
                
                
                

            <!-- ******** End part *********** --> 
            </div>

            <!-- Export Module -->
            <?php echo $this->main->module('export.details', array('event'=>$event)); ?>

            <!-- Countdown module -->
            <?php if($this->main->can_show_countdown_module($event)): ?>
            <div class="mec-events-meta-group mec-events-meta-group-countdown">
                <?php echo $this->main->module('countdown.details', array('event'=>$this->events)); ?>
            </div> 
            <?php endif; ?>

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

            

        </div>

 <div class="col-md-4">
            <div class="mec-event-meta mec-color-before mec-frontbox">
                <?php
                    // Event Date and Time
                    if(isset($event->data->meta['mec_date']['start']) and !empty($event->data->meta['mec_date']['start']))
                    {
                    ?>
                        <div class="mec-single-event-date">
                            <i class="mec-sl-calendar"></i>
                            <h3 class="mec-date"><?php _e('Date', 'mec'); ?></h3>
                            <dd><abbr class="mec-events-abbr" id="set_frm_claender_right">
								<?php
								
								global $dayte; 
									 $dayte = date("Y/m/d");  
									 if(!empty($occurrence)){ 
									$occurrence = trim($occurrence);
									echo $occurrence = date('M d Y', strtotime($occurrence));  
								 	}
									else{
										$event->date['start']=$dayte;
									  echo $this->main->date_label((trim($occurrence) ? array('date'=>$occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date'=>$occurrence_end_date) : (isset($event->date['end1']) ? $event->date['end'] : NULL)), $this->date_format1);
									 }
								 //~ echo $this->main->date_label((trim($occurrence) ? array('date'=>$occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date'=>$occurrence_end_date) : (isset($event->date['end1']) ? $event->date['end'] : NULL)), $this->date_format1); ?>
								<?php
								 //~ echo $today = date("Y/m/d"); ?>
								 </abbr></dd>
                        </div>

                        <?php 
                        if(isset($event->data->meta['mec_hide_time']) and $event->data->meta['mec_hide_time'] == '0')
                        {
                            $time_comment = isset($event->data->meta['mec_comment']) ? $event->data->meta['mec_comment'] : '';
                            $allday = isset($event->data->meta['mec_allday']) ? $event->data->meta['mec_allday'] : 0;
                            ?>
                            <div class="mec-single-event-time">
                                <i class="mec-sl-clock " style=""></i>
                                <h3 class="mec-time"><?php _e('Departaure Time', 'mec'); ?></h3>
                                <i class="mec-time-comment"><?php echo (isset($time_comment) ? $time_comment : ''); ?></i>
                               
                                <?php if($allday == '0' and isset($event->data->time) and trim($event->data->time['start'])): ?>
                                <dd><abbr class="mec-events-abbr"><?php echo $event->data->time['start']; ?><?php /*echo (trim($event->data->time['end']) ? ' - '.$event->data->time['end'] : '');*/ ?></abbr></dd>
                                <?php else: ?>
                                <dd><abbr class="mec-events-abbr"><?php _e('All of the day', 'mec'); ?></abbr></dd>
                                <?php endif; ?>
                            </div>
                        <?php

                        }

                        if(isset($event->data->meta['mec_start_check']) && $event->data->meta['mec_start_check'] == 1 ) {
                               /*echo "<span> no same day return sailing available for this strip </span>";*/
                        }
                    }
                ?>
               
                <!-- Local Time Module -->
                <?php echo $this->main->module('local-time.details', array('event'=>$event)); ?>

                <?php
                    // Event Cost
                    if(isset($event->data->meta['mec_cost']) and $event->data->meta['mec_cost'] != '')
                    {
                        ?>
                        <div class="mec-event-cost">
                            <i class="mec-sl-wallet"></i>
                            <h3 class="mec-cost"><?php echo $this->main->m('cost', __('Cost', 'mec')); ?></h3>
                            <dd class="mec-events-event-cost"><?php echo (is_numeric($event->data->meta['mec_cost']) ? $this->main->render_price($event->data->meta['mec_cost']) : $event->data->meta['mec_cost']); ?></dd>
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
               
                <?php
                // Event labels
                if(isset($event->data->labels) && !empty($event->data->labels))
                {
                    $mec_items = count($event->data->labels);
                    $mec_i = 0; ?>
                    <div class="mec-single-event-label">
                        <i class="mec-fa-bookmark-o"></i>
                        <h3 class="mec-cost"><?php echo $this->main->m('taxonomy_labels', __('Labels', 'mec')); ?></h3>
                        <?php foreach($event->data->labels as $labels=>$label) :
                            $seperator = (++$mec_i === $mec_items ) ? '' : ',';
                            echo '<dd style=color:"' . $label['color'] . '">' . $label["name"] . $seperator . '</dd>';
                        endforeach; ?>
                    </div>
                    <?php
                }
                ?>

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
               /* if(isset($event->data->categories) and !empty($event->data->categories))
                {
                    ?>
                    <div class="mec-single-event-category" >
                        <i class="mec-sl-folder"></i>
                        <dt><?php echo $this->main->m('taxonomy_categories', __('Category', 'mec')); ?></dt>
                        <?php
                        $cats = array();
                        foreach($event->data->categories as $category)
                        {
                            echo '<dd class="mec-events-event-categories"><a href="'.get_category_link($category['id']).'" class="mec-color-hover" rel="tag">'.$category['name'].'</a></dd>';
                        }
                        ?>
                    <!-- </div> -->
                    <?php
                } */
                ?>

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
                <!-- <?php if($this->main->can_show_booking_module($event)): ?>
                <a class="mec-booking-button mec-bg-color" href="#mec-events-meta-group-booking"><?php echo esc_html($this->main->m('register_button', __('REGISTER', 'mec'))); ?></a>
                <?php endif ?> -->
               
            </div>   
             <!--div class="mec-event-meta mec-color-before mec-frontbox">  
               <?php   if(isset($event->data->categories) and !empty($event->data->categories))
                {
                    if($flag!=1){
                    ?>
                    <div class="mec-single-event-category" >
                        <i class="mec-sl-folder"></i>
                        <dt><?php echo $this->main->m('taxonomy_categories', __('Category', 'mec')).'[Return Trips]'; ?></dt>
                        <?php
                        $cats = array();
                        foreach($event->data->categories as $category)
                        {
                            echo '<dd class="mec-events-event-categories"><a href="'.get_category_link($category['id']).'" class="mec-color-hover" rel="tag">'.$category['name'].'</a></dd>';
                        }
                        ?>
                     </div> 
                    <?php
                } ?>
           <?php
                } ?>

             </div--> 
             <?php
             if($flag==1){
             ?>
        <div class="mec-event-meta mec-color-before mec-frontbox">   
                    <div class="mec-single-event-category oneway_image" > 
                        <div class="returndata">
							 
                        <?php dynamic_sidebar( 'One_way_trips' ); ?></div>
                        <?php
                        $cats = array();
                        foreach($event->data->categories as $category)
                        {
                            // echo '<dd class="mec-events-event-categories"><a href="'.get_category_link($category['id']).'" class="mec-color-hover" rel="tag">'.$category['name'].'</a></dd>';
                        }
                        ?>
        </div> 
        
         </div> <?php }else if($w_flag==1){ ?>
                <div class="mec-event-meta mec-color-before mec-frontbox">   
                    <div class="mec-single-event-category oneway_image" >
                         
                        <div class="returndata">
                         <?php dynamic_sidebar( 'return_trips' ); ?></div>
                        <?php
                        $cats = array();
                        foreach($event->data->categories as $category)
                        {
                            // echo '<dd class="mec-events-event-categories"><a href="'.get_category_link($category['id']).'" class="mec-color-hover" rel="tag">'.$category['name'].'</a></dd>';
                        }
                        ?>
                     </div> 
                   
           

             </div> 
             <?php } ?>
            <!-- Attendees List Module -->
            <?php echo $this->main->module('attendees-list.details', array('event'=>$event)); ?>
           
            <!-- Next Previous Module -->
            <?php echo $this->main->module('next-event.details', array('event'=>$event)); ?>
           
            <!-- Links Module -->
            <?php echo $this->main->module('links.details', array('event'=>$event)); ?>
           
            <!-- Google Maps Module -->
            <div class="mec-events-meta-group mec-events-meta-group-gmap">
                <?php echo $this->main->module('googlemap.details', array('event'=>$this->events)); ?>
            </div>
        </div>

        
    </article>
</div>            
                    
                
