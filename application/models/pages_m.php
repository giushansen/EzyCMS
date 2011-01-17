<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Regular pages model
 *
 * @author Guillaume Fourret
 * @package Pages Model for Ezy CMS
 *
 */
class Pages_m extends Model
{

    public function __construct()
    {
            parent::Model();
    }

    public function getPageByID ($id = 0)
    {
        $qPage = $this->db
                      ->get_where('pages', array('id' => $id));

        return $qPage->row();
    }

    public function getPage ($slug = "", $status = "live")
    {
        $qPage = $this->db
                      ->get_where('pages', array('slug' => $slug, 'status' => $status));

        return $qPage->row();
    }

    public function getAllPages ()
    {
        $qPage = $this->db->get('pages');

        return $qPage->result();
    }

    /*
     * Determine the menu to display in Front-End
     * and set the current menu with a class = active
     *
     * @return : Array of tab for the menu
     */
    public function getMenu ($url_segments)
    {
        $aPage = $this->db
                      ->select('meta_title, slug')
                      ->get_where('pages', array('status' => "live"));
        
        foreach($aPage->result() as $oPage){
            
            if($oPage->slug == $url_segments)
            {
                $aNav[] = anchor($oPage->slug,
                                 $oPage->meta_title,
                                 array('class' => 'active') );
            }else{
                $aNav[] = anchor($oPage->slug, $oPage->meta_title);
            }
        } 

        return $aNav;
    }

    public function create ($input = array())
    {
        $this->load->helper('date');

        $this->db->insert('pages',array(
                                    'slug'             => $input['slug'],
                                    'title'            => $input['title'],
                                    'body'             => $input['content'],
                                    'meta_title'       => $input['meta_title'],
                                    'meta_keywords'    => $input['meta_keywords'],
                                    'meta_description' => $input['meta_description'],
                                    'status'           => $input['status'],
                                    'created_on'=> now(),
                                    'updated_on'=> now()
                                  )
                         );
    }

    public function update ($id = 0, $input = array())
    {  
        $this->load->helper('date');

        $this->db->where('id',$id);
        $this->db->update('pages',
                          array(
                            'slug'             => $input['slug'],
                            'title'            => $input['title'],
                            'body'             => $input['content'],
                            'meta_title'       => $input['meta-title'],
                            'meta_keywords'    => $input['meta-keywords'],
                            'meta_description' => $input['meta-description'],
                            'status'           => $input['status'],
                            'updated_on'=> now()
                          )
                         );
        
    }

}

?>
