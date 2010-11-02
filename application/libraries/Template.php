<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Template Class
 *
 * Build your CodeIgniter pages much easier with menu, breadcrumbs
 *
 * @package        	CodeIgniter
 * @category    	Libraries
 * @author        	Guillaume Fourret
 * @link
 */
class Template
{
    // Check if the template is Admin Template
    private $isAdmin = false;

    // Parameters of the header
    private $_sTitle = '';
    private $_aMetadata = array();
    private $_aJs = array();
    private $_sUser = '';

    // Navigation menu
    private $_aNav = array();

    // Breadcrumbs navigation display
    private $_aBreadcrumbs = array();

    // Contains all the data to be passed to the view
    private $aHeader = array();
    //private $footer = array();

    // Seconds that cache will be alive for
    private $cache_lifetime = 0;//7200;
 
    // Take the CodeIgniter object
    private $_ci;

    /**
    * Constructor - Sets Preferences
    *
    * The constructor can be passed an array of config values
    */
    function __construct()
    {
        // Take the CodeIgniter super object
        $this->_ci =& get_instance();
    }

    /**
     * Set the mode of the creation
     *
     * @access    public
     * @param    string

     * @return    void
     */
    public function build($view = '', $data = array())
    {
        // Disable sodding IE7's constant cacheing!!
        $this->_ci->output->set_header('Expires: Sat, 01 Jan 2000 00:00:01 GMT');
        $this->_ci->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->_ci->output->set_header('Cache-Control: post-check=0, pre-check=0, max-age=0');
        $this->_ci->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
        $this->_ci->output->set_header('Pragma: no-cache');

       // Let CI do the caching instead of the browser
       $this->_ci->output->cache( $this->cache_lifetime );

       $this->aHeader['aTitle']    = $this->_sTitle;
       $this->aHeader['aJs']       = $this->_aJs;
       $this->aHeader['aMetadata'] = $this->_aMetadata;
       $this->aHeader['aNav']     = $this->_aNav;

        if (true == $this->isAdmin){

            $this->aHeader['user'] = $this->_sUser;
            // Load all the views
            $this->_ci->load->view('admin/template/header_view', $this->aHeader);
            $this->_ci->load->view($view, $data);
            $this->_ci->load->view('admin/template/footer_view');

        }else{

            // Load all the views
            $this->_ci->load->view('template/header_view', $this->aHeader);
            $this->_ci->load->view($view, $data);
            $this->_ci->load->view('template/footer_view');
        }
    }


    /**
     * Set the title of the page
     *
     * @access    public
     * @param    string
     * @return    void
     */
    public function set_title($title)
    {
    	$this->_sTitle = $title;

        return $this;
    }

    /**
     * Set the current user of the CMS
     *
     * @access    public
     * @param    string
     * @return    void
     */
    public function set_user($user)
    {
        $this->_sUser = $user;

        return $this;
    }
     /**
     * Set metadata for output later
     *
     * @access    public
     * @param	  string	$name		keywords, description, etc
     * @param	  string	$content	The content of meta data
     * @param	  string	$type		Meta-data comes in a few types, links for example
     * @return    void
     */
    public function set_metadata($name, $content, $type = 'meta')
    {
        $name = htmlspecialchars(strip_tags($name));
        $content = htmlspecialchars(strip_tags($content));

        // Keywords with no comments? ARG! comment them
        if($name == 'keywords' && !strpos($content, ','))
        {
        	$content = preg_replace('/[\s]+/', ', ', trim($content));
        }

        switch($type)
        {
        	case 'meta':
        		$this->_aMetadata[$name] = '<meta name="'.$name.'" content="'.$content.'" />';
        	break;

        	case 'link':
        		$this->_aMetadata[$content] = '<link rel="'.$name.'" href="'.$content.'" />';
        	break;

                case 'style':
        		$this->_aMetadata[$content] = '<link rel="'.$name.'" type="text/css" media="screen" href="'.$content.'" />';
        	break;
        }

        return $this;
    }


     /**
     * Set javascript for output later
     *
     * @access    public
     * @param	  string	$url		Url address
     * @return    void
     */
    public function set_js($url)
    {
        $this->_aJs[] = '<script type="text/javascript" src="'.$url.'"></script>';

        return $this;
    }

     /**
     * Set javascript for output later
     *
     * @access    public
     * @param	  string	$url		Url address
     * @return    void
     */
    public function set_tinyMCE()
    {
        $this->_aJs[] =
            '<script type="text/javascript">
            tinyMCE_GZ.init({
                            mode : "exact",
                            elements: "body",
                            theme : "advanced",
                            language : "fr",
                            convert_urls : false,
                            plugins : "style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,"+
                                      "searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",

                            // Theme options - button# indicated the row# only
                            theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,formatselect",
                            theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
                            theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",
                            theme_advanced_toolbar_location : "top",
                            theme_advanced_toolbar_align : "left",
                            theme_advanced_statusbar_location : "bottom" //(n.b. no trailing comma in last line of code)
                            //theme_advanced_resizing : true //leave this out as there is an intermittent bug.
            });
            </script>
            <script type="text/javascript">
            tinyMCE.init({
                            mode : "exact",
                            elements: "body",
                            theme : "advanced",
                            language : "fr",
                            convert_urls : false,
                            plugins : "style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,"+
                                      "searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",

                            // Theme options - button# indicated the row# only
                            theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,formatselect",
                            theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
                            theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",
                            theme_advanced_toolbar_location : "top",
                            theme_advanced_toolbar_align : "left",
                            theme_advanced_statusbar_location : "bottom" //(n.b. no trailing comma in last line of code)
                            //theme_advanced_resizing : true //leave this out as there is an intermittent bug.
            });
            </script>';

        return $this;
    }

     /**
     * Set metadata for output later
     *
     * @access    public
     * @param	  string	$name		keywords, description, etc
     * @param	  string	$content	The content of meta data
     * @param	  string	$type		Meta-data comes in a few types, links for example
     * @return    void
     */
    public function set_menu($menu = array())
    {
        $this->_aNav = $menu;

        return $this;
    }

    /**
    * Helps build custom breadcrumb trails
    *
    * @access	public
    * @param	string	$name		What will appear as the link text
    * @param	string	$url_ref	The URL segment
    * @return	void
    */
    public function set_breadcrumb($name, $uri = '')
    {
    	$this->_aBreadcrumbs[] = array('name' => $name, 'uri' => $uri );
        
        return $this;
    }

    public function set_admin()
    {
        $this->isAdmin = true;

        return $this;
    }
}
