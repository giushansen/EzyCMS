<?php

class Contact extends Public_Controller {

    function __construct()
    {
            parent::__construct();
    }

    function index()
    {
        $data['sBaseUrl'] = $this->sBaseUrl;
        $sTitle = "IT Atom - Contactez-nous ";
        $aNav[] = anchor('agence_web',
                                    'Accueil');
        $aNav[] = anchor('offres', 'Nos Offres');
        $aNav[] = anchor('contact', 'Contactez-nous',
                                    array('class' => 'active',
                                          'title' => 'Page d\'accueil'
                                         ));

        $this->template->set_title($sTitle)
            ->set_metadata('title', 'Contactez-nous')
            ->set_metadata('description', 'Formulaire de contact')
            ->set_metadata('keywords', 'contact, adresse, telephone')
            ->set_menu($aNav)
            ->build('pages/contact_view', $data);
    }
}