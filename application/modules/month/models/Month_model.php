<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Month_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases 
    function get($params = array())
    {
        $res = $this->db->get('month');

        if(isset($params['id']))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }

}
