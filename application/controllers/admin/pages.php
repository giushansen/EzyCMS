<?php

class Pages extends Admin_Controller {

    private $aMenu  = array();

    function __construct()
    {
        parent::__construct();
        $this->_setMenu();
    }

    /**
    * Display all the pages available in the CMS
    * @access public
    * @return void
    */
    public function index() {
        // If this is a default page
        $this->aData['aPages'] = $this->_buildAnchorsArray($this->pages_m->getAllPages());
        $this->aData['sBaseURL']  = $this->sBaseUrl;
        $this->aData['sActionTitle']  = "Lister les pages du site";
        $this->aData['aMenu']  = $this->_getMenu('index');
        $this->aData['bEditMode']  = false;

        $this->template->set_title('Ezy CMS - Gestion des pages')
                ->build('admin/pages_view', $this->aData);
    }

    /**
    * Create the page in the CMS after checking
    * @access public
    * @return void
    */
    public function create() {

    }

    /**
    * Create the page in the CMS after checking
    * @access public
    * @return void
    */
    public function edit($id = NULL) {

        if (isset ($id))
        {
            $this->aData['oPage'] = $this->pages_m->getPageByID($id);
            $this->aData['sBaseURL']  = $this->sBaseUrl;
            $this->aData['sActionTitle']  = "Edition de la page";
            $this->aData['aMenu']  = $this->_getMenu('edit');
            $this->aData['bEditMode']  = true;
            $this->aData['id']  = $id;

            //var_dump(htmlentities($this->aData['oPage']->body));die;
            $this->template->set_title('Ezy CMS - Modifier une page')
                    ->set_js($this->sBaseUrl.'js/tiny_mce/tiny_mce_gzip.js')
                    ->set_tinyMCE()
                    ->build('admin/pages_view', $this->aData);
        }else{
            // If this is a default page
            $this->aData['aPages'] = $this->_buildAnchorsArray($this->pages_m->getAllPages());

            $this->aData['sBaseURL']  = $this->sBaseUrl;
            $this->aData['sActionTitle']  = "Modifier une page du site";
            $this->aData['aMenu']  = $this->_getMenu('edit');
            $this->aData['bEditMode']  = false;

            $this->template->set_title('Ezy CMS - Modifier une page')
                    ->build('admin/pages_view', $this->aData);
        }
    }

    public function save($id = NULL)
    {
        if (isset ($id))
        {
            $this->pages_m->update($id, $_POST);

            redirect('admin/pages/edit/'.$id);
        }else{
            // If this is a default page
            redirect('admin/pages/edit');
        }
    }

    /**
     * Get the details of a page using Ajax
     * @access public
     * @param int $page_id The ID of the page
     * @return void
     */
    public function ajax_page_details($page_id)
    {
        if(true == $this->isAdmin())
        {

            $page = $this->pages_m->getPageByID($page_id);

            $this->load->view('admin/ajax/page_details', array('page' => $page));
        }else{
            
            redirect('admin');
        }
    }

    // Retrieve the Menu and set the class="active" according which menu tab is selected
    private function _getMenu ($action = "")
    {
        $MenuTab = array();

        foreach ($this->aMenu as $menu)
        {
            if (array_search($menu, $this->aMenu) == $action ){

                $MenuTab [] = anchor('admin/pages/'.array_search($menu, $this->aMenu), $menu, array('class'=>'active'));
            }else{

                $MenuTab [] = anchor('admin/pages/'.array_search($menu, $this->aMenu), $menu);
            }
        }

        return $MenuTab;
    }

    // Hardcode the menu in the aMenu property
    private function _setMenu ()
    {
        $this->aMenu = array(
                           'index'  => 'Lister les pages',
                           'create' => 'Cr&eacute;er une page',
                           'edit' => 'Modifier une page'
                       );
    }

    private function _buildAnchorsArray ($allPages)
    {
        foreach($allPages as $page){

            $anchorTab[] = anchor( $this->sBaseUrl.'admin/pages/edit/'.$page->id,
                                   $page->slug,
                                   array('rel'=>$page->id) );
        }
        
        return $anchorTab;
    }
}