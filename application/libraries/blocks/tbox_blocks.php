<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Regular TBox blocks controller
 *
 * @author Guillaume Fourret
 * @package Pages Model for Ezy CMS
 *
 */
class tbox_blocks
{
    // Take the CodeIgniter object
    private $_ci;
    private $oBoxView;
    
    public function __construct()
    {
        $this->_ci =& get_instance();
        $this->_ci->load->model('blocks/tbox_blocks_m','tbox_m');
    }

    // Retrieve the appropriate model of the block
    public function getBlockView ($idBlock = 0)
    {
        $this->oBoxView = $this->_ci->tbox_m->getBlockByID($idBlock);

        $data['header'] = $this->oBoxView->header;
        $data['content'] = $this->oBoxView->content;
        $data['url_link'] = $this->oBoxView->url_link;
        
        return $this->_ci->load->view('blocks/tbox_view', $data, true);
    }

}

?>
