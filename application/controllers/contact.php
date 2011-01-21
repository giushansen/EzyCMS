<?php

class Contact extends Public_Controller {

    function __construct()
    {
        parent::__construct();

        // Set the validation rules
        $validationRules = array(
            array(
                    'field' => 'name',
                    'label'	=> 'Nom',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'email',
                    'label'	=> 'Courrier electronique',
                    'rules' => 'required|valid_email'
            ),
            array(
                    'field' => 'phone',
                    'label'	=> 'Numero de telephone'
            ),
            array(
                    'field' => 'comment',
                    'label'	=> 'Votre message',
                    'rules' => 'required|xss_clean'
            )
        );

        // Load the Form validation class with the validation rules
        $this->load->library('form_validation');
        $this->form_validation->set_rules($validationRules);

        // Load the helper for the view
        $this->load->helper(array('form', 'url'));

        // Load the EMail class with the belowed configuration
        $config = array(
            'protocol' => 'smtp',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'contact.itatom@gmail.com',
            'smtp_pass' => 'N!cGuy1983'
        );
        $this->load->library('email', $config);
    }

    public function index()
    {
        $aNav = $this->pages_m->getMenu($this->sDefault_slug);
        
        $this->template->set_title('Contactez-nous - IT Atom')
                ->set_metadata('title', 'Contactez-nous - IT Atom')
                ->set_metadata('description', 'Formulaire de contact')
                ->set_metadata('keywords', 'courrier, e-mail')
                ->set_menu($aNav)
                ->build('pages/contact_view');
    }

    public function contact_processing()
    {
        if ($this->form_validation->run())
        {
            $this->email->set_newline("\r\n");
            $this->email->to('info@it-atom.com');
            $this->email->from('khrysteneguillaume@gmail.com');
            $this->email->subject('It\'s " '.$this->input->post('name').' " with phone number : " '.$this->input->post('phone').' " and IP : '.$this->input->ip_address());
            $this->email->message('The project is : '.$this->input->post('project'));

            if (!$this->email->send())
            {
                //show_error($this->email->print_debugger());
                $data['info']="Votre email n'a pas pu etre envoyé, merci de nous contacter a : info[ARROBASE]it-atom[POINT]com";
            }else{
                $data['info']="Votre email a bien été envoyé";
            }

            $this->template->set_title('Contactez-nous - IT Atom')
                ->set_metadata('title', 'Contactez-nous - IT Atom')
                ->set_metadata('description', 'Formulaire de contact')
                ->set_metadata('keywords', 'courrier, e-mail')
                ->set_menu($aNav)
                ->build('pages/contact_view', $data);
        }else
        {
            $data['info']="Les champs : Nom, Courrier électronique et Projet sont obligatoires et doivent etre correctement remplis.";
            $this->template->set_title('Contactez-nous - IT Atom')
                ->set_metadata('title', 'Contactez-nous - IT Atom')
                ->set_metadata('description', 'Formulaire de contact')
                ->set_metadata('keywords', 'courrier, e-mail')
                ->set_menu($aNav)
                ->build('pages/contact_view', $data);
        }
    }
    
}
