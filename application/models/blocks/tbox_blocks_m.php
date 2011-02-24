<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Regular pages model
 *
 * @author Guillaume Fourret
 * @package Pages Model for Ezy CMS
 *
 */
class Tbox_blocks_m extends Model
{

    public function __construct()
    {
            parent::Model();
    }

    public function getBlockByID ($id = 0)
    {
        $qBlock = $this->db
                       ->get_where('tbox_blocks', array('id' => $id));

        return $qBlock->row(); 
    }

}

?>
