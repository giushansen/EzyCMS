<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Regular pages model
 *
 * @author Guillaume Fourret
 * @package Blocks Model for Ezy CMS
 *
 */
class Blocks_m extends Model
{

    public function __construct()
    {
            parent::Model();
    }

    public function getBlocksByID ($page_id = 0)
    {
        $qBlocks = $this->db
                      ->get_where('has_block', array('page_id' => $page_id));
 
        return $qBlocks->result();
    }

    public function getPagesByID ($block_id = 0)
    {
        $qPages = $this->db
                      ->get_where('has_block', array('block_id' => $block_id));

        return $qPages->result();
    }

    /**
     * Retrieve all the blocks related to a page ID and sort them out per column
     *  in an array
     *
     * @access public
     * @param int $page_id The ID of the page
     * @return array
     */
    public function getBlocksByPageID ($page_id = 0, $view = '1col')
    {
        $aBlocks = NULL;
        $aBlocksStacks = array();
        $aBlocks = $this->getBlocksByID($page_id);

        if (isset($aBlocks)) {

            foreach($aBlocks as $block) {
            // Check the first digit and put the block into the matching column
                switch ($block->position[0]){

                    case '1' : $aBlocksStacks[1][] = $block; break;
                    case '2' : $aBlocksStacks[2][] = $block; break;
                    case '3' : $aBlocksStacks[3][] = $block; break;
                    default : break;
                }
            }
            $aBlocksStacks = $this->_sortColumnPerPosition($aBlocksStacks);

            return $aBlocksStacks;
        }else{

            return false;
        }
    }

    public function getAllBlocksRelationships ()
    {
        $qBlocks = $this->db->get('has_block');

        return $qBlocks->result();
    }

    public function createBlockRelationship ($input = array())
    {
        $this->load->helper('date');

        $this->db->insert('has_block',array(
                                    'page_id'  => $input['page_id'],
                                    'block_id' => $input['block_id'],
                                    'position' => $input['position']
                                  )
                         );
    }

    public function updateBlockRelationship ($id = 0, $input = array())
    {
        $this->load->helper('date');

        $this->db->where('id',$id);
        $this->db->update('has_block',array(
                                    'page_id'  => $input['page_id'],
                                    'block_id' => $input['block_id'],
                                    'position' => $input['position']
                                  )
                         );
    }

     /**
     * Take all the blocks unsorted in their columns and
     * sort them out per position in their own column
     *
     * @access public
     * @param array The array with all the blocks in their column
     * @return array The sorted array
     */
    private function _sortColumnPerPosition ($aAllBlocks = array())
    {
        foreach($aAllBlocks as $aColumn){

            usort($aColumn, array('Blocks_m', 'cmp_function'));
        }

        return $aAllBlocks;
    }

    static function cmp_function($oLeft, $oRight) {
        // Check the second digit which represents the position within the column
        if ($oLeft->position[1] == $oRight->position[1]){
            
            return 0;
        }
        return ($oLeft->position[1] < $oRight->position[1]) ? -1 : 1;
    }
}

?>