<?php

/**
 * Created by PhpStorm.
 * User: tucan
 * Date: 15/11/18
 * Time: 下午12:02
 */
class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
        $this->load->helper('url_helper');
    }

    public function list_users()
    {
        $this->output->enable_profiler(TRUE);
        $data['users'] = $this->User_model->get_all_users();
        $data['title'] = 'All users';

        $this->load->view('templates/header', $data);
        $this->load->view('users/list_users', $data);
        $this->load->view('templates/footer');
    }


    public function query($uid = null)
    {   //启动调试查看sql
        $this->output->enable_profiler(TRUE);
        $data['user'] = $this->User_model->get_user_by_id($uid);
        $data['title'] = 'Query user';

        $this->load->view('templates/header', $data);
        $this->load->view('users/user_info', $data);
        $this->load->view('templates/footer');

    }

    public function create()
    {
        $this->output->enable_profiler(TRUE);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';
        $data['name'] = 'name';

        $this->form_validation->set_rules('name', 'Text', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('users/create');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->User_model->create_user();
            $this->load->view('user/create_success');
        }
    }

}