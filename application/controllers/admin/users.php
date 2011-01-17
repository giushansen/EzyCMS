<?php

class Users extends Admin_Controller {

    function __construct()
    {
            parent::__construct();
    }

    function index()
    {
        $this->aData['sBaseURL']  = $this->sBaseUrl;
        $this->aData['sActionTitle']  = "Gerer les utilisateurs";
        // To change :
        $this->aData['sError']  = "Cette fonctionnalite sera bientot presente dans votre CMS favori";

        $this->template->set_title('EzyCMS - Utilisateurs')
             ->build('admin/navigation_view', $this->aData);
    }
}