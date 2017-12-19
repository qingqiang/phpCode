<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ticket extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ticket_model');
        $this->load->model('score_model');
        $this->load->model('prize_model');
    }

    public function index()
    {
        $user_info = $this->_get_user_info();

        $data['user_info'] = $user_info;
        $data['token'] = $this->_generate_token($user_info['openid']);
        $data['prize_list'] = $this->prize_model->get_prize_list($type = 1);
        $this->load->view('ticket', $data);
    }

    public function doexcharge()
    {
        if($this->input->is_ajax_request()) {
            $openid = $this->input->get_post('openid');
            $token = $this->input->get_post('token');
            $giftid = (int)$this->input->get_post('giftid');
            $user_info = $this->_check_data($openid, $token);
            $prize_info = $this->prize_model->get_prize_info($giftid);

            if (!$prize_info || $user_info['score'] < $prize_info['score']) {
                exit(json_encode(array(
                    'error' => 'scoreerr'
                )));
            }

            $this->score_model->add_score_log($user_info['userid'], $prize_info['score'], 'excharge');
            $this->ticket_model->add_excharge_log($user_info['userid'], $giftid);
            $this->user_model->update_user_score($user_info['userid'], $prize_info['score'], '-');

            exit(json_encode(array(
                'success' => 1,
                'fill_info' => $this->_check_fill_user_info($user_info)
            )));
        }
    }
}

/* End of file ticket.php */
/* Location: ./application/controllers/ticket.php */