<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Checkin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function add_checkin_log($userid, $score)
    {
        $userid = mysql_real_escape_string($userid);
        $score = mysql_real_escape_string($score);
        $sql = sprintf("INSERT INTO %s SET userid = %d, score = %d, datetime = NOW()", $this->db->dbprefix('checkin_log'), $userid, $score);
        log_message('DEBUG', $sql);
        $this->db->query($sql);

        return $this->db->insert_id();
    }

    function check_checkin_log($userid)
    {
        $userid = mysql_real_escape_string($userid);
        $sql = sprintf("SELECT id FROM %s WHERE userid = %d AND DATE_FORMAT(datetime, '%%Y-%%m-%%d') = CURRENT_DATE()", $this->db->dbprefix('checkin_log'), $userid);
        log_message('DEBUG', $sql);
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    function get_checkin_count($userid)
    {
        $userid = mysql_real_escape_string($userid);
        $sql = sprintf("SELECT COUNT(id) AS rec_count FROM %s WHERE userid = %d", $this->db->dbprefix('checkin_log'), $userid);
        log_message('DEBUG', $sql);
        $query = $this->db->query($sql);

        $result = $query->row_array();
        return $result['rec_count'];
    }

    function get_checkin_log($userid)
    {
        $userid = mysql_real_escape_string($userid);
        $sql = sprintf("SELECT * FROM %s WHERE userid = %d ORDER BY datetime DESC LIMIT 30", $this->db->dbprefix('checkin_log'), $userid);
        log_message('DEBUG', $sql);
        $query = $this->db->query($sql);

        return $query->result_array();
    }
}