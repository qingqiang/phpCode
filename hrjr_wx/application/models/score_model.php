<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Score_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function add_score_log($userid, $score, $type)
    {
        $userid = mysql_real_escape_string($userid);
        $score = mysql_real_escape_string($score);
        $type = mysql_real_escape_string($type);

        $sql = sprintf("INSERT INTO %s SET userid = %d, score = %d, type = '%s', created_at = NOW()", $this->db->dbprefix('score_log'), $userid, $score, $type);
        $this->db->query($sql);

        return $this->db->insert_id();
    }

    function get_user_score_log($userid, $page = 0, $pagesize = 10, $sortby = 0)
    {
        $userid = mysql_real_escape_string($userid);
        $page = mysql_real_escape_string($page);
        $pagesize = mysql_real_escape_string($pagesize);

        $sortby = $sortby == 0 ? 's.created_at' : 's.score';

        $sql = sprintf("SELECT u.nickname, u.avator, s.score, s.type, DATE_FORMAT(s.created_at, '%%m/%%d/%%Y %%H:%%i') AS created_at FROM %s AS s LEFT JOIN %s AS u ON s.userid = u.userid WHERE u.userid = %d ORDER BY %s DESC, s.id DESC LIMIT %d, %d", $this->db->dbprefix('score_log'), $this->db->dbprefix('user'), $userid, $sortby, $page*$pagesize, $pagesize);
        $query = $this->db->query($sql);

        return $query->result_array();
    }
}