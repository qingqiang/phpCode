<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class WeiXin
{
    var $CI;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * 基础
     * @return string
     */
    function get_access_token()
    {
        $access_token = $this->CI->session->userdata('wx_access_token');
        $access_token_time = $this->CI->session->userdata('wx_access_token_time');

        if (!$access_token || time() - $access_token_time >= 3600) {
            $url = sprintf("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s", $this->CI->config->item('appid'), $this->CI->config->item('appsecret'));
            $data = $this->return_data($url);

            log_message('DEBUG', $url . '###' . json_encode($data));
            $access_token = isset($data['access_token']) ? $data['access_token'] : '';
            $this->CI->session->set_userdata('wx_access_token', $access_token);
            $this->CI->session->set_userdata('wx_access_token_time', time());
        }

        return $access_token;
    }

    /**
     * 获取用户基本信息(UnionID机制)
     * @param $openid
     * @return mixed
     */
    function get_user_info($openid)
    {
        $access_token = $this->get_access_token();
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=%s&lang=zh_CN", $access_token, $openid);

        return $this->return_data($url);
    }

    /**
     * 获取access_token和openid
     * @param $code
     * @return array
     */
    function get_web_access_token($code)
    {
        $web_access_token = $this->CI->session->userdata('wx_web_access_token');
        $web_openid = $this->CI->session->userdata('wx_web_openid');
        $access_token_time = $this->CI->session->userdata('wx_web_access_token_time');

        if (!$web_access_token || !$web_openid || time() - $access_token_time >= 7200) {
            $url = sprintf("https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code", $this->CI->config->item('appid'), $this->CI->config->item('appsecret'), $code);
            $data = $this->return_data($url);

            $web_access_token = isset($data['access_token']) ? $data['access_token'] : '';
            $web_openid = isset($data['openid']) ? $data['openid'] : '';

            $this->CI->session->set_userdata('wx_web_access_token', $web_access_token);
            $this->CI->session->set_userdata('wx_web_openid', $web_openid);
            $this->CI->session->set_userdata('wx_web_access_token_time', time());
        }

        return array(
            'access_token' => $web_access_token,
            'openid' => $web_openid
        );
    }

    /**
     * 网页授权获取用户基本信息
     * @param $access_token
     * @param $openid
     * @return mixed
     */
    function get_web_user_info($access_token, $openid)
    {
        $url = sprintf("https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN", $access_token, $openid);

        return $this->return_data($url);
    }

    /**
     * JSON转换成Array
     * @param $url
     * @return mixed
     */
    function return_data($url, $data='')
    {
        $json_data = $this->https_request($url, $data);
        return json_decode($json_data, true);
    }

    /**
     * CURL请求
     * @param $url
     * @param null $data
     * @return mixed
     */
    function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    /**
     * 获取二维码ticket
     * @param $userid
     * @return mixed
     */
    function get_ticket($userid)
    {
        $access_token = $this->get_access_token();
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s", $access_token);

        $data = array(
            "expire_seconds" => 1800,
            "action_name" => "QR_SCENE",
            "action_info" => array(
                "scene" => array(
                    "scene_id" => $userid
                )
            )
        );

        $return_data = $this->return_data($url, json_encode($data));
        log_message('DEBUG', var_export($return_data, true)."###".json_encode($data)."###".$access_token);
        if(!isset($return_data['ticket'])) {
            /*$this->CI->session->unset_userdata(array('wx_access_token', 'wx_access_token_time'));
            $this->get_ticket($userid);*/
        }

        return @$return_data['ticket'];
    }

    /**
     * 获取二维码地址
     * @param $userid
     * @return string
     */
    function get_qrcode_url($userid)
    {
        $ticket = $this->get_ticket($userid);
        return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($ticket);
    }

    /**
     * @param $object
     * @param $contentStr
     * @param string $msgType
     * @param int $flag
     * @return string
     */
    function responseMsg($object, $contentStr, $msgType = 'text', $flag = 0)
    {
        switch ($msgType) {
            case "news":
                $textTpl = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <ArticleCount>%d</ArticleCount>
                                <Articles>
                                    %s
                                </Articles>
                                <FuncFlag>%d</FuncFlag>
                            </xml>";
                $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $msgType, count($contentStr), $this->_render_news_item($contentStr), $flag);
                break;
            default:
                $textTpl = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Content><![CDATA[%s]]></Content>
                                <FuncFlag>%d</FuncFlag>
                            </xml>";
                $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $msgType, $contentStr, $flag);
                break;
        }

        return $resultStr;
    }

    protected function _render_news_item($newsData)
    {
        $news_item = '';
        foreach ($newsData as $news) {
            $news_item .= <<<EOT
                <item>
                    <Title><![CDATA[{$news['title']}]]></Title>
                    <Description><![CDATA[{$news['desc']}]]></Description>
                    <PicUrl><![CDATA[{$news['picurl']}]]></PicUrl>
                    <Url><![CDATA[{$news['url']}]]></Url>
                </item>
EOT;
        }

        return $news_item;
    }

    /**
     * 发送消息
     * @param $userid
     * @return mixed
     */
    function send_custom_message($openid, $content)
    {
        $access_token = $this->get_access_token();
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=%s", $access_token);

        $data = <<<EOT
            {
                "touser":"{$openid}",
                "msgtype":"text",
                "text":
                {
                     "content":"{$content}"
                }
            }
EOT;

        return $this->return_data($url, $data);
    }
}