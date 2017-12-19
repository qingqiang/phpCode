<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    protected $openid;
    protected $subscribe_score = 500;//关注获得的积分
    protected $intro_score = array(500, 250, 125);//推荐所获得的积分

    public function __construct()
    {
        parent::__construct();
        $this->load->library('weixin');
        $this->load->model('user_model');
        $this->load->model('score_model');
    }

    public function index()
    {
        if (isset($_GET['echostr'])) {
            $this->_valid();
        } else {
            $this->_responseMsg();
        }
    }

    function _valid()
    {
        $echoStr = $_GET["echostr"];
        if ($this->_checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    function _checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = $this->config->item('token');
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    function _responseMsg()
    {
        $postStr = @$GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $msgType = trim($postObj->MsgType);
            $this->openid = $postObj->FromUserName;

            switch ($msgType) {
                case "event":
                    $resultStr = $this->_receiveEvent($postObj);
                    break;
                default:
                    $resultStr = "亲，正在开发中。。";
                    $resultStr = $this->weixin->responseMsg($postObj, $resultStr);
                    break;
            }

            echo $resultStr;
        } else {
            echo "";
            exit;
        }
    }

    function _receiveEvent($object)
    {
        $msgType = 'text';
        $flag = 0;

        switch ($object->Event) {
            case "subscribe"://关注
                $check_bind = $this->_check_bind($this->openid);

                if (isset($object->EventKey) && !empty($object->EventKey)) {
                    $result = $this->_handleScanEvent($object);//扫描二维码关注
                    if (!$check_bind) {
                        $this->_add_user_score($result[0]);
                    }
                    //$contentStr = $result[1];
                } else {
                    if (!$check_bind) {
                        $user_info = $this->user_model->get_user_info($this->openid);
                        $this->_add_user_score($user_info['userid']);
                    }
                }

                $msgType = 'news';
                $flag = 1;
                $contentStr = array(
                    array(
                        'title' => '华人金融欢迎您!',
                        'desc' => '',
                        'picurl' => 'http://zhaojianzhan.net/images/hr_logo.png',
                        'url' => 'http://zhaojianzhan.net/page'
                    ),
                    array(
                        'title' => '积分抽奖活动介绍！',
                        'desc' => '',
                        'picurl' => 'http://zhaojianzhan.net/images/hr_logo.png',
                        'url' => 'http://zhaojianzhan.net/page/score'
                    ),
                    array(
                        'title' => '积分介绍！',
                        'desc' => '',
                        'picurl' => 'http://zhaojianzhan.net/images/hr_logo.png',
                        'url' => 'http://zhaojianzhan.net/page/jifen'
                    )
                );
                break;
            case "unsubscribe":
                $contentStr = $this->_handleUnSubscribeEvent($object);
                break;
            case "SCAN":
                $result = $this->_handleScanEvent($object);//关注之后扫描二维码
                $contentStr = $result[1];
                break;
            default :
                $contentStr = "Event: " . $object->Event;
                break;
        }

        $resultStr = $this->weixin->responseMsg($object, $contentStr, $msgType, $flag);
        return $resultStr;
    }

    /**
     * 检查是否已经绑定
     * @param $openid
     */
    function _check_bind($openid)
    {
        $check_bind = $this->user_model->check_bind($openid);
        if (!$check_bind) {
            $user_info = $this->weixin->get_user_info($openid);
            $user_id = $this->user_model->add_user(
                array(
                    'nickname' => $user_info['nickname'],
                    'avator' => $user_info['headimgurl'],
                    'intro_id' => 0,
                    'score' => $this->subscribe_score
                )
            );
            $this->user_model->add_oauth(
                array(
                    'openid' => $openid,
                    'userid' => $user_id
                )
            );

            return false;
        }

        return true;
    }

    function _handleUnSubscribeEvent($object)
    {
        //TODO
    }

    /**
     * 处理扫描二维码事件
     * @param $object
     * @return string
     */
    function _handleScanEvent($object)
    {
        $intro_id = $object->EventKey;
        if ($object->Event == 'subscribe') {
            $intro = explode("_", $intro_id);
            $intro_id = $intro[1];
        }

        $result = $this->_update_intro($this->openid, $intro_id);
        return $result;
    }

    /**
     * 更新推荐人信息
     * @param $openid
     * @param $intro_id
     * @return string
     */
    function _update_intro($openid, $intro_id)
    {
        $user_info = $this->user_model->get_user_info($openid);//用户信息
        $intro_user_info = $this->user_model->get_user_info_by_uid($intro_id);//推荐人信息

        if (!$user_info['intro_id'] && $user_info['userid'] != $intro_id && $intro_user_info['intro_id'] != $user_info['userid']) {
            $this->user_model->update_user($user_info['userid'], array(
                'intro_id' => $intro_id
            ));
            $contentStr = "您已加入" . $intro_user_info['nickname'] . "的团队！";
            $this->weixin->send_custom_message($intro_user_info['openid'], $user_info['nickname'] . '加入了您的团队，您获得500积分！注册华人金融，领取更多礼品！');
        } else {
            $contentStr = "您不能加入" . $intro_user_info['nickname'] . "的团队！";
        }

        $this->weixin->send_custom_message($openid, $contentStr);
        return array(
            $user_info['userid'],
            $contentStr
        );
    }

    /**
     * 添加积分记录
     * @param $userid
     */
    function _add_user_score($userid)
    {
        $this->score_model->add_score_log($userid, $this->subscribe_score, 'subscribe');
        $this->weixin->send_custom_message($this->openid, '您关注成功，因此获得' . $this->subscribe_score . '积分！');

        $intro_list = $this->user_model->get_intro_list($userid);
        if ($intro_list) {
            //处理推荐者积分
            log_message('DEBUG', var_export($intro_list, true));
            foreach ($intro_list as $key => $intro_id) {
                $this->score_model->add_score_log($intro_id, $this->intro_score[$key], 'intro');
                $this->user_model->update_user_score($intro_id, $this->intro_score[$key]);
            }
        }
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */