<?php

/**
 * Created by PhpStorm.
 * User: tucan
 * Date: 15/11/18
 * Time: 上午11:54
 */
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_users()
    {
        $query = $this->db->get('user_tb');
        return $query->result_array();
    }


    public function get_user_by_id( $id=0)
    {
        if( is_numeric( $id)){
            #$query = $this->db->get_where('user_tb', array('id'=>$id));
            $sql = 'Select *  from user_tb where id='.$id.';';
            //print_r($sql);
            $query = $this->db->query($sql);
            //print_r($query->row());
            return $query->row();
        }
    }

    public function create_user()
    {

    }
}