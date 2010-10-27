<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Code here is run before admin controllers
class Admin_Controller extends Controller
{
    private   $isAdmin  = false;
    protected $sBaseUrl = "";
    protected $default_admin_controller = "admin/agence_web";
    protected $aData    = array();
    protected $aNav    = array();

    // Page object from the model
    protected $oPage;

    private $_CI;

    function __construct()
    {
        parent::Controller();

        // Load the helper needed for the extended controllers
        $this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
        
        // Load the models for the Back End
        $this->load->model('navigations_m');
        $this->load->model('pages_m');
        $this->load->model('users_m');

        $this->setNavigation();
        $this->_CI =& get_instance();
        $this->sBaseUrl = base_url();

        if(true == $this->session->userdata('user_id'))
        { 
            // User is already an admin
            $this->isAdmin = true;
        }
        elseif( true == $this->uri->segment(2)
                 && 'login' != $this->uri->segment(2)
                 && 'logout' != $this->uri->segment(2) )
        {
            // Redirect to the login page if not an admin on any page except Login and Logout
            redirect('admin');
        }
        // Analyze the url to give the Navigation menu with the right active tab
        $aNav = $this->getNavigation($this->uri->segment(2));

        $this->template->set_metadata('canonical', site_url($this->uri->uri_string()), 'link')
            ->set_admin()
            ->set_user($this->session->userdata('username'))
            ->set_metadata('stylesheet', $this->sBaseUrl.'styles/custom-theme/jquery-ui-1.8.2.custom.css', 'style')
            ->set_metadata('stylesheet', $this->sBaseUrl.'styles/admin/admin_style.css', 'style')
            ->set_js($this->sBaseUrl.'js/jquery-1.4.2.min.js')
            ->set_js($this->sBaseUrl.'js/jquery-ui-1.8.2.custom.min.js')
            ->set_js($this->sBaseUrl.'js/admin/admin.js')
            ->set_menu($aNav);
    }

    // Retrieve the Navigation and set the class="active" according which nav tab is selected
    private function getNavigation ($action = "")
    {
        $NavTab = array();

        foreach ($this->aNav as $menu)
        {
            if (array_search($menu, $this->aNav) == $action ){

                $NavTab [] = anchor('admin/'.array_search($menu, $this->aNav), $menu, array('class'=>'active'));
            }else{

                $NavTab [] = anchor('admin/'.array_search($menu, $this->aNav), $menu);
            }

        }

        return $NavTab;
    }

    // Hardcode the navigation in the aNav property
    private function setNavigation ()
    {
        $this->aNav = array(
                           'navigation' => 'La navigation',
                           'pages'      => 'Les pages',
                           'users'      => 'Les utilisateurs',
                           'logout'     => 'Deconnexion'
                       );
    }

    // Check if the user got admin's rights
    public function isAdmin (){

        if ($this->isAdmin == true){

            return true;
        }else{
            
            return false;
        }
    }
}