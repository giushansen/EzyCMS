<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Code here is run before frontend controllers
class Public_Controller extends Controller
{
    protected $sBaseUrl = "";
    protected $sDefault_controller = "";
    protected $sDefault_slug = "agence_web";
    protected $aData = array();

    // Page object from the model
    protected $oPage;

    private $_CI;

    function __construct()
    {
        parent::Controller();

        $this->_CI =& get_instance();
        $this->sBaseUrl = base_url();
        $this->sDefault_controller =$this->_CI->router->default_controller;
        
        // Enable profiler on local box
        if( ENV == 'DEV' && $this->input->get('_debug') )
        {
            $this->output->enable_profiler(TRUE);
        }

        $this->template->set_metadata('robot', 'follow, all')
            ->set_metadata('icon', $this->sBaseUrl.'images/favicon.ico', 'link')
            ->set_metadata('canonical', site_url($this->uri->uri_string()), 'link')
            ->set_metadata('stylesheet', $this->sBaseUrl.'styles/site.css', 'style')
            ->set_metadata('stylesheet', $this->sBaseUrl.'styles/custom-theme/jquery-ui-1.8.2.custom.css', 'style')
            ->set_js($this->sBaseUrl.'js/jquery-1.4.2.min.js')
            ->set_js($this->sBaseUrl.'js/jquery-ui-1.8.2.custom.min.js')
            ->set_js($this->sBaseUrl.'js/jquery.cycle/jquery.cycle.all.min.js')
            ->set_js($this->sBaseUrl.'js/design.js');
               
    }
}
