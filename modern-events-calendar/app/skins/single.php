<?php
/** no direct access **/
defined('_MECEXEC_') or die();

/**
 * Webnus MEC single class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_skin_single extends MEC_skins
{
    /**
     * @var string
     */
    public $skin = 'single';
    
    /**
     * Constructor method
     * @author Webnus <info@webnus.biz>
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Registers skin actions into WordPress
     * @author Webnus <info@webnus.biz>
     */
    public function actions()
    {
        $this->factory->action('wp_ajax_mec_load_single_page', array($this, 'load_single_page'));
        $this->factory->action('wp_ajax_nopriv_mec_load_single_page', array($this, 'load_single_page'));
    }
    
    /**
     * Initialize the skin
     * @author Webnus <info@webnus.biz>
     * @param array $atts
     */
    public function initialize($atts)
    {
        $this->atts = $atts;

        // MEC Settings
        $this->settings = $this->main->get_settings();
        
        // Date Formats
        $this->date_format1 = (isset($this->settings['single_date_format1']) and trim($this->settings['single_date_format1'])) ? $this->settings['single_date_format1'] : 'M d Y';

        // Single Event Layout
        $this->layout = isset($this->atts['layout']) ? $this->atts['layout'] : NULL;
        
        // Search Form Status
        $this->sf_status = false;
        
        // HTML class
        $this->html_class = '';
        if(isset($this->atts['html-class']) and trim($this->atts['html-class']) != '') $this->html_class = $this->atts['html-class'];
        
        // From Widget
        $this->widget = (isset($this->atts['widget']) and trim($this->atts['widget'])) ? true : false;
        
        // Init MEC
        $this->args['mec-skin'] = $this->skin;
        
        $this->id = isset($this->atts['id']) ? $this->atts['id'] : 0;
        $this->maximum_dates = isset($this->atts['maximum_dates']) ? $this->atts['maximum_dates'] : 6;
    }
    
    /**
     * Search and returns the filtered events
     * @author Webnus <info@webnus.biz>
     * @return list of objects
     */
    public function search()
    {
        $events = array();
        $rendered = $this->render->data($this->id, (isset($this->atts['content']) ? $this->atts['content'] : ''));
        
        $occurrence = isset($_GET['occurrence']) ? sanitize_text_field($_GET['occurrence']) : NULL;
        
        if(strtotime($occurrence)) $occurrence = date('Y-m-d', strtotime('-1 day', strtotime($occurrence)));
        else $occurrence = NULL;
        
        $data = new stdClass();
        $data->ID = $this->id;
        $data->data = $rendered;
        $data->dates = $this->render->dates($this->id, $rendered, $this->maximum_dates, $occurrence);
        $data->date = isset($data->dates[0]) ? $data->dates[0] : array();
        
        $events[] = $data;
        
        return $events;
    }
    
    /**
     * Load Single Event Page for AJAX requert
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function load_single_page()
    {
        $id = isset($_GET['id']) ? sanitize_text_field($_GET['id']) : 0;
        $layout = isset($_GET['layout']) ? sanitize_text_field($_GET['layout']) : 'm1';
        
        // Initialize the skin
        $this->initialize(array('id'=>$id, 'layout'=>$layout));
        
        // Fetch the events
        $this->fetch();
        
        // Return the output
        echo $this->output();
        exit;
    }
}