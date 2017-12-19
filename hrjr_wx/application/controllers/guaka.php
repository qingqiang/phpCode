<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//抽奖大转盘
class Guaka extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('url');
        $this->load->library('weixin');
        $this->load->model('guaka_model');
    }

    public function index()
    {
        $data="";
        $this->load->view('guaka', $data);
    }
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */