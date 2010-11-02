<?php

class Navigation extends Admin_Controller {

    function __construct()
    {
            parent::__construct();
    }

    function index()
    {
        $this->aData['sBaseURL']  = $this->sBaseUrl;
        $this->aData['sActionTitle']  = "Gerer la navigation";
        // To change :
        $this->aData['sError']  = "Cette fonctionnalite sera bientot presente dans votre CMS favori";

        $this->template->set_title('EzyCMS - Navigation')
             ->build('admin/navigation_view', $this->aData);
    }
}