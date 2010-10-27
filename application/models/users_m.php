<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Regular pages model
 *
 * @author Guillaume Fourret
 * @package Pages Model for Ezy CMS
 *
 */
class Users_m extends Model
{

    public function __construct()
    {
            parent::Model();
    }

    public function getUser ($username = "")
    {
        if (isset ($username)) {

          $this->db->select('id')->select('email')->select('group')->select('password')
               ->from('users')
               ->where('username', $username)
               ->limit(1);

            return $this->db->get();
        }

        return false;
    }

    public function insertUser ()
    {

    }

    public function updateUser ()
    {

    }

    public function checkUserStatus($id = 0)
    {
        //if no id was passed use the current users id
        if (empty($id))
        {
                    $id = $this->session->userdata('user_id');
        }

        $this->db->where('users', $id);
        $this->db->limit(1);

        return $this->get_users();
    }

}

?>
