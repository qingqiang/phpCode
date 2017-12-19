<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//注册测试
class Reg extends CI_Controller
{
    public $reg_score = 5000;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('weixin');
        $this->load->model('score_model');
        $this->load->model('user_model');
    }

    public function index()
    {
		@error_log("\n".date('Y/m/d H:i:s').var_export($_REQUEST, true), 3, dirname(__FILE__) . '/reglog.log');
        $uid = (int)$this->input->post('uid');
        $status = $this->input->post('status');
        $token = $this->input->post('token');
		
        $user_info = $this->user_model->get_user_info_by_uid($uid);
        $md5_token = md5($this->config->item('api_md5_secret') . $uid);
		@error_log("\n".$uid.'#'.$status.'#'.$token.'#'.$md5_token, 3, dirname(__FILE__) . '/reglog.log');

        if ($user_info && $user_info['is_registered'] == 0 && $status == 1 && $token == $md5_token) {
            $this->user_model->update_user($uid, array(
                'is_registered' => 1
            ));

            $this->score_model->add_score_log($uid, $this->reg_score, 'reg');
            $this->user_model->update_user_score($uid, $this->reg_score);

            $this->weixin->send_custom_message($user_info['openid'], '您注册成功，获得积分' . $this->reg_score . '！');

            exit('success');
        }

        exit('error');
    }
}


/* End of file reg.php */
/* Location: ./application/controllers/reg.php */