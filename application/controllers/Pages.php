<?php

/**
 * Created by PhpStorm.
 * User: tucan
 * Date: 15/11/18
 * Time: 上午10:58
 */
class Pages extends CI_Controller
{
    public function view( $page = 'home')
    {
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }


}