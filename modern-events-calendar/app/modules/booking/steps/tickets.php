<?php

/** no direct access **/

defined('_MECEXEC_') or die();



$event_id = $event->ID;

$tickets = isset($event->data->tickets) ? $event->data->tickets : array();
 
$dates = isset($event->dates) ? $event->dates : $event->date;



$book = $this->getBook();

$availability = $book->get_tickets_availability($event_id, $dates[0]['start']['date']);



$date_format = (isset($settings['booking_date_format1']) and trim($settings['booking_date_format1'])) ? $settings['booking_date_format1'] : 'Y-m-d';

?>

<form id="mec_book_form">

    <!-- h4><?php// _e('Book Event', 'mec'); ?></h4>-->

    <div style="display:none;">

        <label><?php _e('Date', 'mec'); ?>: </label>

        <select name="book[date]" id="mec_book_form_date" onchange="mec_get_tickets_availability(<?php echo $event_id; ?>, this.value);">

            <?php foreach($dates as $date): ?>

            <option value="<?php echo $date['start']['date'].':'.$date['end']['date']; ?>"><?php echo date_i18n($date_format, strtotime($date['start']['date'])).((strtotime($date['end']['date']) > strtotime($date['start']['date'])) ? ' - '.date_i18n($date_format, strtotime($date['end']['date'])) : ''); ?></option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="mec-event-tickets-list">

        <?php foreach($tickets as $ticket_id=>$ticket): $ticket_limit = isset($availability[$ticket_id]) ? $availability[$ticket_id] : -1; ?>

        <div class="mec-event-ticket mec-event-ticket<?php echo $ticket_limit; ?>" id="mec_event_ticket<?php echo $ticket_id; ?>">

            <span class="mec-event-ticket-name"><?php echo (isset($ticket['name']) ? $ticket['name'] : ''); ?></span>

            <span class="mec-event-ticket-price"><?php echo (isset($ticket['price_label']) ? $ticket['price_label'] : ''); ?></span>

            <?php if(isset($ticket['description']) and trim($ticket['description'])): ?><p class="mec-event-ticket-description"><?php echo $ticket['description']; ?></p><?php endif; ?>

            <div>

                <input type="number"  id='book_ticket<?php echo $ticket_id; ?>' class="mec-book-ticket-limit" name="book[tickets][<?php echo $ticket_id; ?>]" placeholder="<?php esc_attr_e('Count', 'mec'); ?>" value="0" min="0" max="<?php echo ($ticket_limit != '-1' ? $ticket_limit : '') ?>" 
                 />

            </div>

            <span class="mec-event-ticket-available"><?php echo sprintf(__('Available Tickets: <span>%s</span>', 'mec'), ($ticket['unlimited'] ? __('Unlimited', 'mec') : $ticket_limit)); ?></span>

        </div>
        
        
        
        <?php endforeach; ?>

      
        
       
    
    </div>

    <?php if($this->get_recaptcha_status('booking')): ?><div class="mec-google-recaptcha"><div class="g-recaptcha" data-sitekey="<?php echo $settings['google_recaptcha_sitekey']; ?>"></div></div><?php endif; ?>

    <input type="hidden" name="action" value="mec_book_form" />

    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" />

    <input type="hidden" name="step" value="1" />

    <?php wp_nonce_field('mec_book_form_'.$event_id); ?>

    <button type="submit"><?php _e('Next', 'mec'); ?></button>

</form>


<!-- <script type="text/javascript">
jQuery(document).ready(function()
{
    console.log("Ticket check");
    $('#book_ticket1').change(function(){
        var ticket1_nummber = $('#book_ticket1').val();
        $('#ticket_adult').val(ticket1_nummber); 
        console.log("book_ticket1"+ticket1_nummber);
    });

    $('#book_ticket2').change(function(){
        var ticket2_nummber = $('#book_ticket2').val(); 
        console.log("ticket2_nummber"+ticket2_nummber);
    });

    $('#book_ticket3').change(function(){
        var ticket3_nummber = $('#book_ticket3').val(); 
        console.log("ticket3_nummber"+ticket3_nummber);
    });

    $('#book_ticket4').change(function(){
        var ticket4_nummber = $('#book_ticket4').val(); 
        console.log("ticket4_nummber"+ticket4_nummber);
    }); 
        
});

    //find('mec-book-ticket-limit').val();
    //console.log('--------Ticket Value------------'+ticket_val); 
    //console.log("out of context");

 

</script> -->
