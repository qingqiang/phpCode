<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Draw extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('draw_model');
    }

    public function index()
    {
        $user_info = $this->_get_user_info();

        $data['user_info'] = $user_info;
        $data['token'] = $this->_generate_token($user_info['openid']);
        $data['draw_log'] = $this->draw_model->get_draw_log();

        unset($user_info);
        $this->load->view('draw', $data);
    }

    public function get_more()
    {
        if($this->input->is_ajax_request()) {
            $openid = $this->input->get_post('openid');
            $token = $this->input->get_post('token');
            $page = $this->input->get_post('page');

            $this->_check_data($openid, $token);

            $data['draw_log'] = $this->draw_model->get_draw_log(0, $page);
            exit(json_encode(array(
                'content' => $this->load->view('get_more_draw_log', $data, true),
                'count' => count($data['draw_log'])
            )));
        }
    }
}

/* End of file draw.php */
/* Location: ./application/controllers/draw.php */