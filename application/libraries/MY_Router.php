<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Router Class Modified
 *
 * Surcharge the "_validate_request" function by loading the default controller instead of the 404 error
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @author		ExpressionEngine Dev Team
 * @category	Libraries
 * @link		http://codeigniter.com/user_guide/general/routing.html
 */
class MY_Router extends CI_Router {

    /**
     * Constructor
     *
     * Runs the route mapping function.
     */
    public function __construct()
    {
        parent::CI_Router();
    }

    /**
     * Validates the supplied segments.  Attempts to determine the path to
     * the controller.
     *
     * @access	private
     * @param	array
     * @return	array
     */
    public function _validate_request($segments)
    {
            // Does the requested controller exist in the root folder?
            if (file_exists(APPPATH.'controllers/'.$segments[0].EXT) && (empty ($segments[1]) || $segments[1]=='login' || $segments[1]=='logout' ) )
            {
                    return $segments;
            }

            // Is the controller in a sub-folder?
            if (is_dir(APPPATH.'controllers/'.$segments[0]))
            {
                    // Set the directory and remove it from the segment array
                    $this->set_directory($segments[0]);
                    $segments = array_slice($segments, 1);

                    if (count($segments) > 0)
                    {
                            // Does the requested controller exist in the sub-folder?
                            if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$segments[0].EXT))
                            {
                                    show_404($this->fetch_directory().$segments[0]);
                            }
                    }
                    else
                    {
                            $this->set_class($this->default_controller);
                            $this->set_method('index');

                            // Does the default controller exist in the sub-folder?
                            if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.EXT))
                            {
                                    $this->directory = '';
                                    return array();
                            }

                    }

                    return $segments;
            }

            // Can't find the requested controller... 
            //show_404($segments[0]);
            //
            // So I redirect to the default controller which will manage the page control
            return array($this->default_controller);
    }
}