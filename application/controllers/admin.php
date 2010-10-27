<?php

class Admin extends Admin_Controller {

    private $validation_rules = array();
    
    function __construct()
    {
        parent::__construct();
        // Set the validation rules
        $this->validation_rules = array(
                array(
                        'field' => 'username',
                        'label'	=> 'Username',
                        'rules' => 'required|callback__checkLogin'
                ),
                array(
                        'field' => 'password',
                        'label'	=> 'Password',
                        'rules' => 'required'
                )
        );
    }

    /**
     * Page method
     * @access public
     * @param array $url_segments The URL segments
     * @return void
     */
    public function index()
    {
        $this->aData['sTitle'] = "Administration du site web";
        $this->aData['sBaseURL'] = $this->sBaseUrl;

        $aNav[] = anchor('agence_web', 'Retournez sur le site');
        
        $this->template->set_title("Administration du site web")
                ->set_menu($aNav)
                ->build('admin/login_view', $this->aData);
    }

    public function login()
    {
        // Set the validation rules for the Form
        $this->form_validation->set_rules($this->validation_rules);
        
        // If the validation worked, or the user is already logged in
        if ($this->form_validation->run() || $this->isAdmin() == true)
        {

            // Valid Form so the user is recorded into the CI session via _checkLogin()
            redirect('admin/pages');
        }else{

            // Invalid form so it is redisplayed containing your data
            $this->aData['sTitle'] = "Administration du site web";
            $this->aData['sBaseURL'] = $this->sBaseUrl;
            $aNav[] = anchor('agence_web', 'Retournez sur le site');

            $this->template->set_title("Administration du site web")
                    ->set_menu($aNav)
                    ->build('admin/login_view', $this->aData);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('group');

        $this->session->sess_destroy();

        redirect ('admin');
    }

    public function _checkLogin ($username = "")
    {
        $query = $this->users_m->getUser($username)->row();

        if (true == $query) {
            
            if($query->password == $this->input->post('password')){

                $this->session->set_userdata('user_id', $query->id);
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('email', $query->email);
                $this->session->set_userdata('group', $query->group);

                return true;
            }
        }
        $this->form_validation->set_message('_checkLogin', 'Your login is not good');

        return false;
    }
}