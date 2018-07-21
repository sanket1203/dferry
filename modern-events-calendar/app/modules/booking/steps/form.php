<?php
/** no direct access **/
defined('_MECEXEC_') or die();

$event_id = $event->ID;
$reg_fields = $this->main->get_reg_fields();

$event_tickets = isset($event->data->tickets) ? $event->data->tickets : array();
$price_details = $this->book->get_price_details($tickets, $event_id, $event_tickets);

$current_user = wp_get_current_user();

/*********************  for setting booking date to today i have directly added booking daTE TO DAYA ******************************/
$today = date("Y/m/d"); 
  //~ $date= '2017-07-06';
  //~ echo $date;
  
?>
<!--style>

	.setme_hide{
		display:none;
		}
		.innr-box h4.heading{
			display:none;
			}

</style-->
<form id="mec_book_form" class="mec-booking-form-container">
    <h4><?php _e('Attendees Form', 'mec'); ?></h4>
    <ul class="mec-book-tickets-container">

        <?php 
        $ctr=1;
        $p=1;
        $ticket_type_array = array();
        //~ print_r($event_tickets);?>
        <div style="display:none">
  <h3><span class="mec-ticket-name"> SELECTED TICKETS</span></h3> <?php
        foreach ($event_tickets as $key => $value) { 
			if(!empty($tickets[$p])){
    			?>
                 <!-- show the number of tickets with type of tickets  -->
                <?php $ticket_name = $value['name']; ?>
                <?php $ticket_array = explode("-", $ticket_name , 2); ?>  
                
              
                <h4><span class="mec-ticket-name"><?php //echo $value['name']; ?>  
                                                  
                    <?php echo  $ticket_array[1] ;  ?> </span>
                    <?php array_push($ticket_type_array, $ticket_array[1]); ?> 
                    
                    <span class="mec-ticket-price" >
                    <?php //echo $value['price_label']; ?> * </span>
                    <span id="ticket_type<?php echo $key; ?>"><?php echo $tickets[$p];?></span></h4>
                <?php
            }
        
            $p++;
        }
        ?>
        </div>
        <?php 
        $j = 0; foreach($tickets as $ticket_id=>$count): if(!$count) continue; $ticket = $event_tickets[$ticket_id]; for($i = 1; $i <= $count; $i++): $j++; ?>
       

        <?php  
        if($ctr<=1){
        $ctr++;
        ?> 
        
        
        <li class="mec-book-ticket-container">
           
            <div class="mec-reg-mandatory">
                <label for="mec_book_reg_field_name<?php echo $j; ?>"><?php _e('Name', 'mec'); ?> <span class="wbmec-mandatory">*</span></label>
                <input class="getbookername" id="mec_book_reg_field_name<?php echo $j; ?>" type="text" name="book[tickets][<?php echo $j; ?>][name]" value="<?php echo trim((isset($current_user->user_firstname) ? $current_user->user_firstname : '').' '.(isset($current_user->user_lastname) ? $current_user->user_lastname : '')); ?>" placeholder="<?php _e('Name', 'mec'); ?>" required />
            </div>

            <div class="mec-reg-mandatory">
                <label for="mec_book_reg_field_email<?php echo $j; ?>"><?php _e('Email', 'mec'); ?></label>
                <input id="mec_book_reg_field_email<?php echo $j; ?>" class="getsamevalue_old" type="email" name="book[tickets][<?php echo $j; ?>][email]" value="<?php echo isset($current_user->user_email) ? $current_user->user_email : ''; ?>" placeholder="<?php _e('Email', 'mec'); ?>" required />
            </div>



            <div class="mec-reg-mandatory">
                <input id="currnet_departure_date" type="hidden" 
                name="book[tickets][<?php echo $j; ?>][date1]" >
            </div>

            <div class="mec-reg-mandatory">
                <input id="currnet_return_date" type="hidden" 
                name="book[tickets][<?php echo $j; ?>][date2]" >
            </div>

            <div class="mec-reg-mandatory">
                <input id="currnet_return_time" type="hidden" 
                name="book[tickets][<?php echo $j; ?>][ret_time]" >
            </div>

            <div class="mec-reg-mandatory">
                <input id="ticket_adult" type="hidden" 
                name="book[tickets][<?php echo $j; ?>][type_adult]"  >
            </div>

            <div class="mec-reg-mandatory">
                <input id="ticket_child_free" type="hidden" 
                name="book[tickets][<?php echo $j; ?>][type_child_free]"  >
            </div>
            
            <div class="mec-reg-mandatory">
                <input id="ticket_child" type="hidden" 
                name="book[tickets][<?php echo $j; ?>][type_child]"  >
            </div>

            <div class="mec-reg-mandatory">
                <input id="ticket_student" type="hidden" 
                name="book[tickets][<?php echo $j; ?>][type_student]"  >
            </div>

            <!-- Custom fields -->
            <?php if(count($reg_fields)): foreach($reg_fields as $reg_field_id=>$reg_field): ?>
            <div class="mec-book-reg-field-<?php echo $reg_field['type']; ?> <?php echo ((isset($reg_field['mandatory']) and $reg_field['mandatory']) ? 'mec-reg-mandatory' : ''); ?>" data-ticket-id="<?php echo $j; ?>" data-field-id="<?php echo $reg_field_id; ?>">
                <?php if(isset($reg_field['label'])): ?><label for="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id; ?>"><?php _e($reg_field['label'], 'mec'); ?><?php echo ((isset($reg_field['mandatory']) and $reg_field['mandatory']) ? '<span class="wbmec-mandatory">*</span>' : ''); ?></label><?php endif; ?>

                <?php /** Text **/ if($reg_field['type'] == 'text'): ?>
                <input id="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id; ?>" type="text" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="" placeholder="<?php _e($reg_field['label'], 'mec'); ?>" <?php if(isset($reg_field['mandatory']) and $reg_field['mandatory']) echo 'required'; ?> />
                
                <?php /** Email **/ elseif($reg_field['type'] == 'email'): ?>
                <input id="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id; ?>" type="email" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="" placeholder="<?php _e($reg_field['label'], 'mec'); ?>" <?php if(isset($reg_field['mandatory']) and $reg_field['mandatory']) echo 'required'; ?> />
                
                <?php /** Tel **/ elseif($reg_field['type'] == 'tel'): ?>
                <input id="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id; ?>" type="tel" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="" placeholder="<?php _e($reg_field['label'], 'mec'); ?>" <?php if(isset($reg_field['mandatory']) and $reg_field['mandatory']) echo 'required'; ?> />

                <?php /** Textarea **/ elseif($reg_field['type'] == 'textarea'): ?>
                <textarea id="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id; ?>" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" placeholder="<?php _e($reg_field['label'], 'mec'); ?>" <?php if(isset($reg_field['mandatory']) and $reg_field['mandatory']) echo 'required'; ?>></textarea>

                <?php /** Dropdown **/ elseif($reg_field['type'] == 'select'): ?>
                <select id="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id; ?>" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" placeholder="<?php _e($reg_field['label'], 'mec'); ?>" <?php if(isset($reg_field['mandatory']) and $reg_field['mandatory']) echo 'required'; ?>>
                    <?php foreach($reg_field['options'] as $reg_field_option): ?>
                    <option value="<?php esc_attr_e($reg_field_option['label'], 'mec'); ?>"><?php _e($reg_field_option['label'], 'mec'); ?></option>
                    <?php endforeach; ?>
                </select>

                <?php /** Radio **/ elseif($reg_field['type'] == 'radio'): ?>
                <?php foreach($reg_field['options'] as $reg_field_option): ?>
                <label for="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id.'_'.strtolower(str_replace(' ', '_', $reg_field_option['label'])); ?>">
                    <input type="radio" id="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id.'_'.strtolower(str_replace(' ', '_', $reg_field_option['label'])); ?>" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="<?php _e($reg_field_option['label'], 'mec'); ?>" />
                    <?php _e($reg_field_option['label'], 'mec'); ?>
                </label>
                <?php endforeach; ?>

                <?php /** Checkbox **/ elseif($reg_field['type'] == 'checkbox'): ?>
                <?php foreach($reg_field['options'] as $reg_field_option): ?>
                <label for="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id.'_'.strtolower(str_replace(' ', '_', $reg_field_option['label'])); ?>">
                    <input type="checkbox" id="mec_book_reg_field_reg<?php echo $j.'_'.$reg_field_id.'_'.strtolower(str_replace(' ', '_', $reg_field_option['label'])); ?>" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>][]" value="<?php _e($reg_field_option['label'], 'mec'); ?>" />
                    <?php _e($reg_field_option['label'], 'mec'); ?>
                </label>
                <?php endforeach; ?>

                <?php /** Paragraph **/ elseif($reg_field['type'] == 'p'): ?>
                <p><?php _e($reg_field['content'], 'mec'); ?></p>

                <?php endif; ?>
            </div>
            <?php endforeach; endif; ?>

            
            <?php 
		 }else{
		 
            ?>
          
           <input id="mec_book_reg_field_name<?php echo $j; ?>" class="getbookernameto" type="hidden" name="book[tickets][<?php echo $j; ?>][name]" value="<?php echo trim((isset($current_user->user_firstname) ? $current_user->user_firstname : '').' '.(isset($current_user->user_lastname) ? $current_user->user_lastname : '')); ?>"  placeholder="<?php _e('Name', 'mec'); ?>" />

                  <!--input id="mec_book_reg_field_email<?php echo $j; ?>" class="getsamevalue" type="hidden" name="book[tickets][<?php echo $j; ?>][email]" value="<?php echo isset($current_user->user_email) ? $current_user->user_email : ''; ?>" placeholder="<?php _e('Email', 'mec'); ?>" required /--> 
   
			
            
            <?php
             }
            ?>
              
            <input type="hidden" name="book[tickets][<?php echo $j; ?>][id]" value="<?php echo $ticket_id; ?>" />
            <input type="hidden" name="book[tickets][<?php echo $j; ?>][count]" value="1" />
        </li>
        
        <?php endfor; endforeach; ?>

    </ul>
    <div class="mec-book-form-price">
        <?php if(isset($price_details['details']) and is_array($price_details['details']) and count($price_details['details'])): ?>
        <ul class="mec-book-price-details">
            <?php foreach($price_details['details'] as $detail): ?>
            <li class="mec-book-price-detail mec-book-price-detail-type<?php echo $detail['type']; ?>">
                <span class="mec-book-price-detail-description"><?php echo $detail['description']; ?></span>
                <span class="mec-book-price-detail-amount"><?php echo $this->main->render_price($detail['amount']); ?></span>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <!--span class="mec-book-price-total"><?php echo $this->main->render_price($price_details['total']); ?></span-->
    </div>
    <input type="hidden" name="book[date]" value="<?php echo $date; ?>" />
    <input type="hidden" name="book[event_id]" value="<?php echo $event_id; ?>" />
    <input type="hidden" name="action" value="mec_book_form" />
    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" />
    <input type="hidden" name="step" value="2" />
    
    <!--input type="text" name="book[dept_date]" id="currnet_departure_date"  class="currnet_departure_date" /-->
    <!--input type="text" name="book[ret_date]" id="currnet_return_date"  class="currnet_return_date" /-->
        
        <?php wp_nonce_field('mec_book_form_'.$event_id); ?>
    <button type="submit"><?php _e('NEXT', 'mec'); ?></button>
</form>

<script type="text/javascript">
jQuery(document).ready(function()
{
    
    if (localStorage.getItem("current_date") !== null) {
       var getdate_from_claender = localStorage.getItem("current_date");
        
       var date_value = $("#set_frm_claender").text();
       var ret_date = $("#input_01").val();
       
       
       
       $("#currnet_departure_date").val(date_value);
       localStorage.clear(getdate_from_claender);
       
       $("#currnet_return_date").val(ret_date);


        var form_time = $("#currnet_time").val(); 
        $('#currnet_departure_time').val(form_time);
     


    } else{
        var date_value = $("#set_frm_claender").text();
        
        var ret_date = $("#input_01").val();
        
        $("#currnet_departure_date").val(date_value);
        $("#currnet_return_date").val(ret_date);
        var form_time = $("#currnet_time").val(); 
        $('#currnet_departure_time').val(form_time);
    }

    var return_timer = $("#current_time").val();
    $('#currnet_return_time').val(return_timer);
    
    /*$('#book_ticket1').change(function(){
    var ticket1_nummber = $('#book_ticket1').val();
    $('#ticket_adult').val(ticket1_nummber);
    console.log('Adult ticket --->'+ticket1_nummber); 
    });*/ 


    // console.log("Ticket check");

    // $('#book_ticket1').change(function(){
    //     var ticket1_nummber = $('#book_ticket1').val();
    //     $('#ticket_adult').val(ticket1_nummber); 
    //     console.log("book_ticket1"+ticket1_nummber);
    // });

    // $('#book_ticket2').change(function(){
    //     var ticket2_nummber = $('#book_ticket2').val(); 
    //     console.log("ticket2_nummber"+ticket2_nummber);
    // });

    // $('#book_ticket3').change(function(){
    //     var ticket3_nummber = $('#book_ticket3').val(); 
    //     console.log("ticket3_nummber"+ticket3_nummber);
    // });

    // $('#book_ticket4').change(function(){
    //     var ticket4_nummber = $('#book_ticket4').val(); 
    //     console.log("ticket4_nummber"+ticket4_nummber);
    // }); 
        var type_adult = $('#ticket_type1').text();
        var type_child_free = $('#ticket_type2').text();
        var type_child  = $('#ticket_type3').text();
        var type_student = $('#ticket_type4').text();
        
        $('#ticket_adult').val(type_adult);
        $('#ticket_child_free').val(type_child_free);
        $('#ticket_child').val(type_child);
        $('#ticket_student').val(type_student);
        
        console.log("========== ticket type ==========="+type_adult);
        console.log("========== ticket type ==========="+type_child_free);
        console.log("========== ticket type ==========="+type_child);

});


</script>
