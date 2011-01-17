<?php

class Pages extends Admin_Controller {

    private $aMenu  = array();
    private $validation_rules_page = array();

    function __construct()
    {
        parent::__construct();
        $this->_setMenu();
        $this->_setValidationRules();
    }

    /**
    * Display all the pages available in the CMS
    * @access public
    * @return void
    */
    public function index() {
        // If this is a default page
        $this->aData['aPages'] = $this->_buildAnchorsArray($this->pages_m->getAllPages());

        $this->aData['sActionTitle']  = "Lister les pages du site";
        // Get the menu and put the active class on the correct tab of the menu
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

        $this->aData['sActionTitle']  = "Creer une nouvelle page";
        $this->aData['aMenu']  = $this->_getMenu('create');
        $this->aData['bEditMode']  = false;
        $this->aData['sError']  = "Cette fonctionnalite sera bientot presente dans votre CMS favori";

        $this->template->set_title('Ezy CMS - Creer une page')
                ->build('admin/pages_view', $this->aData);
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
            $this->aData['sActionTitle']  = "Edition de la page";
            $this->aData['aMenu']  = $this->_getMenu('edit');
            $this->aData['aMenuPage']  = $this->_getMenuPage();
            $this->aData['bEditMode']  = true;
            $this->aData['id']  = $id;

            $this->template->set_title('Ezy CMS - Modifier une page')
                    ->set_js($this->sBaseUrl.'js/tiny_mce/tiny_mce_gzip.js')
                    ->set_tinyMCE()
                    ->build('admin/pages_view', $this->aData);
        }else{
            // If this is a default page
            $this->aData['aPages'] = $this->_buildAnchorsArray($this->pages_m->getAllPages());
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
            $this->form_validation->set_rules($this->validation_rules_page);
            if ($this->form_validation->run() == true){
                
               $this->pages_m->update($id, $_POST);
            }
            
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

    // Set the menu in hardcording the aMenu property
    private function _setMenu ()
    {
        $this->aMenu = array(
                           'index'  => 'Lister les pages',
                           'create' => 'Cr&eacute;er une page',
                           'edit'   => 'Modifier une page'
                       );
    }

    // Set the menu in hardcording the menu-page getting the property
    private function _getMenuPage ()
    {
        $aMenuPage = array('<a href="#info" class="active">Informations</a>',
                           '<a href="#content">Contenu</a>'
                     );
        return $aMenuPage;
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

    private function _setValidationRules()
    {
        $this->validation_rules_page = array(
                array(
                        'field' => 'title',
                        'label'	=> 'Titre',
                        'rules' => 'trim|required|max_length[120]'
                ),
                array(
                        'field' => 'slug',
                        'label'	=> 'URL',
                        'rules' => 'trim|alpha_dot_dash|required|max_length[60]'
                ),
                array(
                        'field' => 'meta-title',
                        'label'	=> 'Meta-titre',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'meta-keywords',
                        'label'	=> 'Mots-Clefs',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'meta-description',
                        'label'	=> 'Description',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'content',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'status',
                        'label'	=> 'Statut',
                        'rules' => 'alpha|required'
                )
        );
    }
}