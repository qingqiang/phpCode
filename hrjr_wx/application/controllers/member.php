<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller
{
    public $fill_score = 1000;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('score_model');
    }

    public function index()
    {
        $user_info = $this->_get_user_info();
        $data['user_info'] = $user_info;
        $data['token'] = $this->_generate_token($user_info['openid']);

        if($user_info['is_filled'] != 1) {
            redirect(site_url("member/info?openid=" . $user_info['openid'] . "&token=" . $data['token']));
        }

        unset($user_info);
        $this->load->view('member', $data);
    }

    public function info()
    {
        $openid = $this->input->get_post('openid');
        $token = $this->input->get_post('token');
		$step = $this->input->get('step');
        $user_info = $this->_check_data($openid, $token);

        $data['user_info'] = $user_info;
        $data['token'] = $token;
		$data['step'] = $step;
		
        unset($user_info);
        $this->load->view('edit_info', $data);
    }

    public function edit()
    {
        if ($this->input->is_ajax_request()) {
            $openid = $this->input->get_post('openid');
            $token = $this->input->get_post('token');
            $user_info = $this->_check_data($openid, $token);

            if($user_info['is_filled'] != 1) {
                $this->score_model->add_score_log($user_info['userid'], $this->fill_score, 'fill');
                $this->user_model->update_user_score($user_info['userid'], $this->fill_score);

                $this->weixin->send_custom_message($user_info['openid'], '您填写资料成功，获得' . $this->fill_score . '积分奖励！注册华人金融，领取更多礼品！');
            }

            $update_data = array(
                'username' => $this->input->post('username'),
                'telephone' => $this->input->post('telephone'),
                'gender' => $this->input->post('gender'),
                'birth_year' => $this->input->post('birth_year'),
                'birth_month' => $this->input->post('birth_month'),
                'birth_date' => $this->input->post('birth_date'),
                'addr_prov' => $this->input->post('addr_prov'),
                'addr_city' => $this->input->post('addr_city'),
                'addr_area' => $this->input->post('addr_area'),
                'address' => $this->input->post('address'),
                'updated_at' => date('Y-m-d H:i:s'),
                'is_filled' => 1
            );

            $this->user_model->update_user($user_info['userid'], $update_data);

            exit(json_encode(array(
                'errno' => 0
            )));
        }
    }
}

/* End of file member.php */
/* Location: ./application/controllers/member.php */