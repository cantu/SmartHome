<?php

/**
 * Created by PhpStorm.
 * User: tucan
 * Date: 15/11/18
 * Time: 下午11:44
 */
class Real_Weather_model extends CI_Model
{
    public $table_name='';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table_name = "weather_realtime_tb";
    }

    //insert new record to table
    public function insert( $city="北京", $temperature)
    {
        $insert_array= array(
            'city'=>$city,
            'temperature'=>$temperature,
            'query_time'=>date("Y-m-d H:i:s")
        );
        $this->db->insert( $this->table_name, $insert_array);
        return $this->db->insert_id();

    }


    public function get_last_record()
    {
        $sql="Select * From `{$this->table_name}` order by id DESC limit 1";
        $query = $this->db->query($sql);
        return $query->row();

    }


}
