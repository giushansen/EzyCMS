<?php

class Page extends Public_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
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

        //---------------------------------------------------------------------
        // LOAD THE BLOCKS
        //---------------------------------------------------------------------
        
        // This page has block(s) ?
        $this->aAllBlocks = $this->blocks_m->getBlocksByPageID($this->oPage->id);
        // Check if there are Blocks in this page
        if ($this->aAllBlocks == true){
            // Browse each column of this page
            foreach($this->aAllBlocks as $col=>$aBlock){
                // Browse each block of this column and store the block in a ordered view array
                foreach ($aBlock as $key=>$oBlock){

                    $this->aBlocks[$col][$oBlock->position[1]] = $this->_loadBlockView($oBlock->block_name, $oBlock->block_id);

                }
                ksort($this->aBlocks[$col]);
            }

            $this->aData['aBlocks'] = $this->aBlocks;
        }

        //---------------------------------------------------------------------
        // LOAD THE PAGE
        //---------------------------------------------------------------------

        //$this->aData['Body'] = $this->oPage->body;

        $this->aData['sBaseURL']  = $this->sBaseUrl;

        $this->template->set_title($this->oPage->title)
                ->set_metadata('title', $this->oPage->meta_title)
                ->set_metadata('description', $this->oPage->meta_description)
                ->set_metadata('keywords', $this->oPage->meta_keywords)
                ->set_menu($aNav)
                ->build('pages/'.$this->oPage->view.'_view', $this->aData);
    }

    // Load the controller class of the block that matches the block name
    public function _loadBlockView($block_name = '', $block_id = 0)
    {      
        switch($block_name){

            case 'content':
                require_once './'.APPPATH.'libraries/blocks/content_blocks'.EXT;
                $oContentBlock = new content_blocks();
                return $oContentBlock->getBlockView($block_id);

            case 'tbox':
                require_once './'.APPPATH.'libraries/blocks/tbox_blocks'.EXT;
                $oTboxBlock = new tbox_blocks();
                return $oTboxBlock->getBlockView($block_id);

            case 'contact':
                require_once './'.APPPATH.'libraries/blocks/contact_blocks'.EXT;
                $oContactBlock = new contact_blocks();
                return $oContactBlock->getBlockView($block_id);

            default :
                return false;
                break;
        }
    }

}