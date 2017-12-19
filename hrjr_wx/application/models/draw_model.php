<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Draw_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function add_draw_log($userid, $prize)
    {
        $userid = mysql_real_escape_string($userid);
        $prize = mysql_real_escape_string($prize);
        $sql = sprintf("INSERT INTO %s SET userid = %d, prize = %d, created_at = NOW()", $this->db->dbprefix('draw_log'), $userid, $prize);
        log_message('DEBUG', $sql);
        $this->db->query($sql);

        return $this->db->insert_id();
    }

    function get_draw_log($userid = 0, $page = 0, $pagesize = 10)
    {
        $page = mysql_real_escape_string($page);
        $pagesize = mysql_real_escape_string($pagesize);

        $sql = sprintf("SELECT u.nickname, u.avator, d.prize, p.title, DATE_FORMAT(d.created_at, '%%m/%%d/%%Y %%H:%%i') AS created_at FROM %s AS d LEFT JOIN %s AS u ON d.userid = u.userid LEFT JOIN %s AS p ON d.prize = p.id AND p.type = 0 WHERE 1 = 1 %s ORDER BY d.id DESC LIMIT %d, %d", $this->db->dbprefix('draw_log'), $this->db->dbprefix('user'), $this->db->dbprefix('prize'), $userid ? sprintf(" AND d.userid = %d", $userid): '', $page*$pagesize, $pagesize);
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    function get_draw_count($userid)
    {
        $userid = mysql_real_escape_string($userid);

        $sql = sprintf("SELECT COUNT(id) AS rec_count FROM %s WHERE userid = %d AND prize < 8", $this->db->dbprefix('draw_log'), $userid);
        $query = $this->db->query($sql);
        $result = $query->row_array();

        return $result['rec_count'];
    }
}