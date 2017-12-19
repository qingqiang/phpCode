<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prize_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_prize_list($type = 0)
    {
        $type = mysql_real_escape_string($type);
        $sql = sprintf("SELECT * FROM %s WHERE type = %d ORDER BY id ASC", $this->db->dbprefix('prize'), $type);
        log_message('DEBUG', $sql);
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    function get_prize_info($id)
    {
        $id = mysql_real_escape_string($id);
        $sql = sprintf("SELECT * FROM %s WHERE id = %d LIMIT 1", $this->db->dbprefix('prize'), $id);
        log_message('DEBUG', $sql);
        $query = $this->db->query($sql);

        return $query->row_array();
    }
}