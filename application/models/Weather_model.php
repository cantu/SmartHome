<?php
/**
 * Created by PhpStorm.
 * User: tucan
 * Date: 15/11/18
 * Time: 下午9:03
 */

class Weather_model extends CI_Model
{
    public $table_name='';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table_name = "weather_day_tb";
    }

    public function create_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `{$this->table_name}`(
                id				INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
                day				DATE NOT NULL,
                city			VARCHAR(20)  NOT NULL,
                pm25	    	INT(4) NOT NULL,
                day_temp_max 	Decimal(5,2) NOT NULL COMMENT'the day  highest temperature',
                day_temp_min	Decimal(5,2) NOT NULL COMMENT'the day  highest temperature',
                weather			VARCHAR(10) NOT NULL,
                wind			VARCHAR(10) NOT NULL,
                query_api	 	VARCHAR(10) NOT NULL,
                query_time	 	TIMESTAMP NOT NULL,
                PRIMARY KEY(id),
                INDEX day(day)
                )ENGINE=InnoDB, DEFAULT CHARSET=utf8; ";

        $this->db->query($sql);
    }

    //insert new record to table
    public function insert(
        $day,
        $city,
        $pm25,
        $day_temp_max,
        $day_temp_min,
        $weather,
        $wind,
        $query_api="baidu"
    )
    {
        $insert_array= array(
            'day' => $day,
            'city'=> $city,
            'pm25'=> $pm25,
            'day_temp_max'=>$day_temp_max,
            'day_temp_min' =>$day_temp_min,
            'weather' => $weather,
            'wind'  => $wind,
            'query_api' => $query_api,
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

    //测试插入三行数据，返回成功插入的行数
    public function test_insert()
    {
        $test_sql = "Insert into `{$this->table_name}` values
                    (null, '2015-11-18', '北京', '111', 17, 3, '阴', '微风', 'baidu', NOW()),
                    (null, '2015-11-19', '北京',  '31', 16, 3, '阴', '微风', 'baidu', NOW()),
                    (null, '2015-11-20', '北京', '290', 17, 2, '阴', '微风', 'baidu', NOW());
                    ";
        $query = $this->db->query($test_sql);
        return $this->db->affected_rows();
    }
}

