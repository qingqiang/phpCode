<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('score_model');
        $this->load->model('draw_model');
        $this->load->model('ticket_model');
    }

    public function index()
    {
        $user_info = $this->_get_user_info();

        $data['user_info'] = $user_info;
        $data['qrcode_url'] = $this->weixin->get_qrcode_url($user_info['userid']);
        $data['team_list'] = $this->user_model->get_my_team($user_info['userid']);
        $data['intro_count'] = $this->user_model->get_intro_count($user_info['userid']);
        $data['all_intro_count'] = $this->user_model->get_intro_count($user_info['userid'], true);
        $data['score_list'] = $this->score_model->get_user_score_log($user_info['userid']);
        $data['prize_list'] = $this->draw_model->get_draw_log($user_info['userid']);
        $data['prize_count'] = $this->draw_model->get_draw_count($user_info['userid']);
        $data['token'] = $this->_generate_token($user_info['openid']);

        unset($user_info);
        $this->load->view('user', $data);
    }

    public function reg()
    {
        $user_info = $this->_get_user_info();

        $redirect_url = $this->config->item('reg_url') . '?from=wx&uid=' . $user_info['userid'];
        redirect($redirect_url);
    }

    public function get_more_score()
    {
        if ($this->input->is_ajax_request()) {
            $openid = $this->input->get_post('openid');
            $token = $this->input->get_post('token');
            $page = $this->input->get_post('page');
            $sortby = $this->input->get_post('sortby');

            $user_info = $this->_check_data($openid, $token);

            $data['score_list'] = $this->score_model->get_user_score_log($user_info['userid'], $page, 10, $sortby);
            exit(json_encode(array(
                'content' => $this->load->view('get_more_score_log', $data, true),
                'count' => count($data['score_list'])
            )));
        }
    }

    public function get_more_prize()
    {
        if ($this->input->is_ajax_request()) {
            $openid = $this->input->get_post('openid');
            $token = $this->input->get_post('token');
            $page = $this->input->get_post('page');
            $type = (int)$this->input->get_post('type');

            $user_info = $this->_check_data($openid, $token);

            if($type == 1) {
                $data['prize_list'] = $this->ticket_model->get_excharge_log($user_info['userid'], $page);
            } else {
                $data['prize_list'] = $this->draw_model->get_draw_log($user_info['userid'], $page);
            }
            $data['type'] = $type;

            exit(json_encode(array(
                'content' => $this->load->view('get_more_prize_log', $data, true),
                'count' => count($data['prize_list'])
            )));
        }
    }

    public function get_more_user()
    {
        if ($this->input->is_ajax_request()) {
            $openid = $this->input->get_post('openid');
            $token = $this->input->get_post('token');
            $page = $this->input->get_post('page');
            $userid = $this->input->get_post('userid');

            $user_info = $this->_check_data($openid, $token);
            if ($userid) {
                $intro_list = $this->user_model->get_intro_list($userid);
                $data['level'] = @$intro_list[1] == $user_info['userid'] ? 2 : 1;
                $data['team_list'] = $this->user_model->get_my_team($userid, 0, 50);
            } else {
                $data['team_list'] = $this->user_model->get_my_team($user_info['userid'], $page);
            }

            exit(json_encode(array(
                'content' => $this->load->view('get_more_user_log', $data, true),
                'count' => count($data['team_list'])
            )));
        }
    }
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */