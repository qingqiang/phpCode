<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//抽奖大转盘
class Turn extends MY_Controller
{
    public $turn_score = 10000;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('draw_model');
        $this->load->model('score_model');
        $this->load->model('prize_model');
    }

    public function index()
    {
        $openid = $this->input->get('openid');
        $token = $this->input->get('token');
        $this->_check_data($openid, $token);

        $data['openid'] = $openid;
        $data['token'] = $token;
        $data['prize_list'] = $this->prize_model->get_prize_list();
        $this->load->view('turn', $data);
    }

    public function doturn()
    {
        if($this->input->is_ajax_request()) {
            $openid = $this->input->get_post('openid');
            $token = $this->input->get_post('token');
            $user_info = $this->_check_data($openid, $token);

            if ($user_info['score'] < $this->turn_score) {
                exit(json_encode(array(
                    'error' => 'scoreerr'
                )));
            }

            $prize = $this->_get_prize();

            $this->score_model->add_score_log($user_info['userid'], $this->turn_score, 'draw');
            $this->draw_model->add_draw_log($user_info['userid'], $prize);
            $this->user_model->update_user_score($user_info['userid'], $this->turn_score, '-');

            if($prize <= 7) {
                $prize_info = $this->prize_model->get_prize_info($prize);
                exit(json_encode(array(
                    'success' => 1,
                    'prizetype' => $prize,
                    'prize_title' => $prize_info['title'],
                    'fill_info' => $this->_check_fill_user_info($user_info)
                )));
            }
        }
    }

    function _get_prize()
    {
        $prize_arr = array(
            array('id' => 1, 'v' => 70),
            array('id' => 2, 'v' => 70),
            array('id' => 3, 'v' => 70),
            array('id' => 4, 'v' => 70),
            array('id' => 5, 'v' => 70),
            array('id' => 6, 'v' => 70),
            array('id' => 7, 'v' => 80),
            array('id' => 8, 'v' => 500)
        );

        foreach ($prize_arr as $key => $val) {
            $arr[$val['id']] = $val['v'];
        }

        $rid = $this->_get_rand($arr);

        return $prize_arr[$rid - 1]['id'];
    }


    function _get_rand($proArr)
    {
        $result = '';
        $proSum = array_sum($proArr);

        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }

        unset ($proArr);
        return $result;
    }
}

/* End of file turn.php */
/* Location: ./application/controllers/turn.php */