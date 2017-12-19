<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_check_browser();
        $this->load->library('weixin');
        $this->load->model('user_model');
    }

    function _check_browser()
    {
        $user_agent = $this->input->user_agent();
        if (strpos($user_agent, 'MicroMessenger') === false) {
            // 非微信浏览器禁止浏览
            exit('请用微信浏览器打开！');
        }
    }

    function _get_user_info()
    {
        $code = $this->input->get('code');
        if (!$code) {
            exit('code错误！');
        }

        $web_token_openid = $this->weixin->get_web_access_token($code);
        $user_info = $this->user_model->get_user_info($web_token_openid['openid']);
        if (!$user_info) {
            exit('用户信息获取失败，请重新关注！');
        }

        return $user_info;
    }

    function _check_data($openid, $token)
    {
        if ($token != $this->_generate_token($openid)) {
            exit('非法操作');
        }

        $user_info = $this->user_model->get_user_info($openid);
        if (!$user_info) {
            exit('用户信息获取失败，请重新关注!');
        }

        return $user_info;
    }

    function _generate_token($openid)
    {
        return md5($openid . $this->config->item('token'));
    }

    function _check_fill_user_info($user_info)
    {
        return $user_info['username'] && $user_info['telephone']  && $user_info['gender']  && $user_info['birth_year']  && $user_info['birth_month']  && $user_info['birth_date']  && $user_info['addr_prov']  && $user_info['addr_city']  && $user_info['addr_area']  && $user_info['address'];
    }
}