<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('weixin');
        $this->load->model('page_model');
    }

    public function index()
    {
        $data="";
        $this->load->view('about', $data);
    }
	 public function baozhang()
    {
        $data="";
		$this->load->view('baozhang', $data);
    }
	 public function fengxian()
    {
        $data="";
		$this->load->view('fengxian', $data);
    }
	
	 public function gudong()
    {
        $data="";
		$this->load->view('gudong', $data);
    }
	 public function product()
    {
        $data="";
		$this->load->view('product', $data);
    }
	 public function score()
    {
        $data="";
		$this->load->view('score', $data);
    }
	 public function jifen()
    {
        $data="";
		$this->load->view('jifen', $data);
    }
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */