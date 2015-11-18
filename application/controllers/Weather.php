<?php

/**
 * Created by PhpStorm.
 * User: tucan
 * Date: 15/11/18
 * Time: 下午8:52
 */
class Weather extends CI_Controller
{
    public $api_key = "gvgMjw4iPCqw20GoMtjjvf05";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Weather_model");
        $this->load->model("Real_Weather_model");

        $this->load->helper('url_helper');
    }

    public function prepare_database(){
        $this->Weather_model->create_table();
        $insert_num = $this->Weather_model->test_insert();
        echo"test insert: ".$insert_num."\n";
    }

    public function get_last_weather()
    {
        //$this->output->enable_profiler(TRUE);
        $data['info'] = $this->Weather_model->get_last_record();
        $data['title'] = 'Get last weather';

        $this->load->view('templates/header', $data);
        $this->load->view('debug', $data);
        $this->load->view('templates/footer');
    }

    public function get_realtime_temperature()
    {
        //$this->output->enable_profiler(TRUE);
        $data['info'] = $this->Real_Weather_model->get_last_record();
        $data['title'] = 'Get last weather';

        $this->load->view('templates/header', $data);
        $this->load->view('debug', $data);
        $this->load->view('templates/footer');
    }

    public function get_temperature_cli()
    {
        //$url = "http://api.map.baidu.com/telematics/v3/weather?location=北京output=json&ak=".$this->api_key;
        $url = "http://api.map.baidu.com/telematics/v3/weather?location=%E5%8C%97%E4%BA%AC&output=json&ak=".$this->api_key;
        //var_dump($url);
        $json_data = file_get_contents($url);
        $array_data = json_decode($json_data,true);
        $today_weather =$array_data['results'][0]['weather_data'][0];
        preg_match_all('/\d+/', $today_weather['temperature'], $temp_arr);
        preg_match_all('/\d+/', $today_weather['date'], $temp);
        $current_temp = $temp[0][2];
        //var_dump($current_temp);
        //var_dump($temp_arr);

        $result1 = $this->Weather_model->insert(
            $day =$array_data['date'],
            $city=$array_data['results'][0]['currentCity'],
            $pm25=$array_data['results'][0]['pm25'],
            $day_temp_max=$temp_arr[0][0],
            $day_temp_min=$temp_arr[0][1],
            $weather=$today_weather['weather'],
            $wind=$today_weather['wind'],
            $query_api="baidu");
        $result2 = $this->Real_Weather_model->insert(
            $city="北京",
            $temperature=$current_temp
        );

        //$this->get_last_weather();
        //$this->get_realtime_temperature();

        /*
        $data['info'] = $array_data;
        $data['title'] = "get weather from baidu api";
        $this->load->view('templates/header', $data);
        $this->load->view('debug', $data);
        $this->load->view('templates/footer');
        */

    }

}