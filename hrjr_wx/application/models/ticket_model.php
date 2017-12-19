<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function add_excharge_log($userid, $giftid)
    {
        $userid = mysql_real_escape_string($userid);
        $giftid = mysql_real_escape_string($giftid);
        $sql = sprintf("INSERT INTO %s SET userid = %d, giftid = %d, created_at = NOW()", $this->db->dbprefix('excharge_log'), $userid, $giftid);
        log_message('DEBUG', $sql);
        $this->db->query($sql);

        return $this->db->insert_id();
    }

    function get_excharge_log($userid = 0, $page = 0, $pagesize = 10)
    {
        $userid = mysql_real_escape_string($userid);
        $page = mysql_real_escape_string($page);
        $pagesize = mysql_real_escape_string($pagesize);

        $sql = sprintf("SELECT u.nickname, u.avator, e.giftid, p.title, DATE_FORMAT(e.created_at, '%%m/%%d/%%Y %%H:%%i') AS created_at FROM %s AS e LEFT JOIN %s AS u ON e.userid = u.userid LEFT JOIN %s AS p ON e.giftid = p.id WHERE e.userid = %d ORDER BY e.id DESC LIMIT %d, %d", $this->db->dbprefix('excharge_log'), $this->db->dbprefix('user'), $this->db->dbprefix('prize'), $userid, $page*$pagesize, $pagesize);
        $query = $this->db->query($sql);

        return $query->result_array();
    }
}