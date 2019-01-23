<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function __construct() 
     {
           parent::__construct(); 
           $this->load->database();
     }

    
    /**
     * This function is used to add new class to system
     * @return number $insert_id : This is last inserted id
     */
    function add($data)
    {
        
        $this->db->insert('user', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }



}

  
