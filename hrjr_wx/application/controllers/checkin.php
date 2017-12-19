<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkin extends MY_Controller
{
    public $checkin_score = 50;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('checkin_model');
        $this->load->model('score_model');
    }

    public function index()
    {
        $user_info = $this->_get_user_info();

        $data['checkin_score'] = $this->checkin_score;
        $data['checkin_count'] = $this->checkin_model->get_checkin_count($user_info['userid']);
        $data['checkin_log'] = $this->checkin_model->get_checkin_log($user_info['userid']);
        $data['user_info'] = $user_info;

        unset($user_info);
        $this->load->view('checkin', $data);
    }

    public function docheckin()
    {
        if($this->input->is_ajax_request()) {
            $openid = $this->input->post('openid');
            $user_info = $this->user_model->get_user_info($openid);

            if (!$user_info) {
                $arr = array(
                    'status' => -1,
                    'msg' => '用户信息获取失败！'
                );
            } else {
                if (!$this->checkin_model->check_checkin_log($user_info['userid'])) {
                    $this->checkin_model->add_checkin_log($user_info['userid'], $this->checkin_score);
                    $this->score_model->add_score_log($user_info['userid'], $this->checkin_score, 'checkin');
                    $this->user_model->update_user_score($user_info['userid'], $this->checkin_score);
                    $arr = array(
                        'status' => 0,
                        'msg' => '签到成功，获得' . $this->checkin_score . '积分。'
                    );
                } else {
                    $arr = array(
                        'status' => -1,
                        'msg' => '您今天已经签到了。'
                    );
                }
            }

            exit(json_encode($arr));
        }
    }
}

/* End of file checkin.php */
/* Location: ./application/controllers/checkin.php */