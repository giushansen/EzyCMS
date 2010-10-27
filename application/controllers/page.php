<?php

class Page extends Public_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('navigations_m');
        $this->load->model('pages_m');
    }

    	/**
	 * Catch all requests to this page in one mega-function
	 * @access public
	 * @param string $method The method to call
	 * @return void
	 */
    public function _remap()
    {
    	$url_segments = $this->uri->total_segments() > 0 ? $this->uri->segment_array() : $this->sDefault_controller;

        $this->_page($url_segments);
    }

	/**
	 * Page method
	 * @access public
	 * @param array $url_segments The URL segments
	 * @return void
	 */
    public function _page($url_segments)
    {
        if (!is_array($url_segments))
        {
            // If this is a default page
            $this->oPage = $this->pages_m->getPage($this->sDefault_slug);
            $aNav = $this->pages_m->getMenu($this->sDefault_slug);
        }else
        {
            $this->oPage = $this->pages_m->getPage($url_segments[1]);
            $aNav = $this->pages_m->getMenu($url_segments[1]);
            if( !$this->oPage || $this->oPage->status == 'draft' ){
                // If page is missing or not live (and not an admin) show 404
                show_404($url_segments[1]);
            }
        }
        
        $this->aData['Body'] = $this->oPage->body;
        $this->aData['sBaseURL']  = $this->sBaseUrl;

        $this->template->set_title($this->oPage->title)
                ->set_metadata('title', $this->oPage->meta_title)
                ->set_metadata('description', $this->oPage->meta_description)
                ->set_metadata('keywords', $this->oPage->meta_keywords)
                ->set_menu($aNav)
                ->build('pages/content_two_view', $this->aData);
    }

}