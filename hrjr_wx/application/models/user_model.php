<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function check_bind($openid)
    {
        $openid = mysql_real_escape_string($openid);
        $sql = sprintf("SELECT userid FROM %s WHERE openid = '%s' LIMIT 1", $this->db->dbprefix('oauth'), $openid);
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    function get_user_info($openid)
    {
        $openid = mysql_real_escape_string($openid);
        $sql = sprintf("SELECT u.*, intro.nickname AS intro_name, o.openid FROM %s AS u LEFT JOIN %s AS o ON u.userid = o.userid LEFT JOIN %s AS intro ON u.intro_id = intro.userid WHERE o.openid = '%s' LIMIT 1", $this->db->dbprefix('user'), $this->db->dbprefix('oauth'), $this->db->dbprefix('user'), $openid);
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    function get_user_info_by_uid($userid)
    {
        $userid = mysql_real_escape_string($userid);
        $sql = sprintf("SELECT u.*, o.openid FROM %s AS u LEFT JOIN %s AS o ON u.userid = o.userid WHERE u.userid = %d LIMIT 1", $this->db->dbprefix('user'), $this->db->dbprefix('oauth'), $userid);
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    function add_user($user_info)
    {
        $sql = sprintf("INSERT INTO %s SET nickname = '%s', avator = '%s', intro_id = %d, score = %d, created_at = NOW()", $this->db->dbprefix('user'), $user_info['nickname'], $user_info['avator'], $user_info['intro_id'], $user_info['score']);
        $this->db->query($sql);

        return $this->db->insert_id();
    }

    function update_user($userid, $data)
    {
        $this->db->where('userid', $userid);
        $this->db->update('user', $data);
    }

    function add_oauth($oauth_info)
    {
        $sql = sprintf("INSERT INTO %s SET openid = '%s', userid = %d, created_at = NOW()", $this->db->dbprefix('oauth'), $oauth_info['openid'], $oauth_info['userid']);
        $this->db->query($sql);

        return $this->db->insert_id();
    }

    function get_intro_list($userid, $level = 3)
    {
        static $intro_list = array();
        static $count;

        $userid = mysql_real_escape_string($userid);
        $sql = sprintf("SELECT intro_id FROM %s WHERE userid = %d LIMIT 1", $this->db->dbprefix('user'), $userid);
        $query = $this->db->query($sql);

        $result = $query->row_array();
        if ($result['intro_id'] && $count < $level) {
            $intro_list[] = $result['intro_id'];
            $count++;
            $this->get_intro_list($result['intro_id']);
        }

        return $intro_list;
    }

    function get_my_team($userid, $page = 0, $pagesize = 10)
    {
        $userid = mysql_real_escape_string($userid);
        $sql = sprintf("SELECT userid, nickname, avator, DATE_FORMAT(created_at, '%%m/%%d/%%Y %%H:%%i') AS created_at FROM %s WHERE intro_id = %d ORDER BY userid DESC LIMIT %d, %d", $this->db->dbprefix('user'), $userid, $page*$pagesize, $pagesize);
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    function update_user_score($userid, $score, $type = '+')
    {
        $userid = mysql_real_escape_string($userid);
        $score = mysql_real_escape_string($score);
        if (!in_array($type, array('+', '-'))) {
            return false;
        }

        $sql = sprintf("UPDATE %s SET score = score %s %d WHERE userid = %d", $this->db->dbprefix('user'), $type, $score, $userid);
        return $this->db->query($sql);
    }

    function get_intro_count($userid, $all = false)
    {
        static $user_list = array();
        if(!is_array($userid)) {
            $userid = array($userid);
        }

        $sql = sprintf("SELECT userid FROM %s WHERE intro_id IN(%s)", $this->db->dbprefix('user'), implode(",", $userid));
        $query = $this->db->query($sql);
        $result = $query->result_array();

        $list = array();
        foreach ($result as $user) {
            $user_list[] = $list[] = $user['userid'];
        }

        if($list && $all) {
            $this->get_intro_count($list, $all);
        }

        return count($user_list);
    }
}