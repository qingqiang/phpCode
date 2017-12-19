<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//订单测试
class Order extends CI_Controller
{
    public $invest_score = 15000;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('weixin');
        $this->load->model('score_model');
        $this->load->model('user_model');
    }

    public function index()
    {

		@error_log("\n".date('Y/m/d H:i:s').var_export($_REQUEST, true), 3, dirname(__FILE__) . '/orderlog.log');
        $uid = (int)$this->input->post('uid');
        $money = (int)$this->input->post('money');
        $status = $this->input->post('status');
        $token = $this->input->post('token');

        $user_info = $this->user_model->get_user_info_by_uid($uid);
        $md5_token = md5($this->config->item('api_md5_secret') . $uid);
		@error_log("\n".$uid.'#'.$status.'#'.$token.'#'.$md5_token, 3, dirname(__FILE__) . '/orderlog.log');

        if ($user_info && $user_info['is_invested'] == 0 && $money > 0 && $status == 1 && $token == $md5_token) {
            $this->user_model->update_user($uid, array(
                'is_invested' => 1
            ));

            $add_score = $this->invest_score;
            $this->score_model->add_score_log($uid, $add_score, 'invest');
            $this->user_model->update_user_score($uid, $add_score);

            $this->weixin->send_custom_message($user_info['openid'], "您投资成功，投资金额为：{$money}元，获得积分{$add_score}！");

            exit('success');
        }

        exit('error');
    }


}


/* End of file order.php */
/* Location: ./application/controllers/order.php */