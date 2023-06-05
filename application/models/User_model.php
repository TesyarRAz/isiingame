<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function userWhere($where)
    {
        return $this->db->where($where)->get('tbl_user')->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('tbl_user', $data);
    }

    public function count_all()
    {
        return $this->db->count_all('tbl_user');
    }

    public function update($where, $data)
    {
        return $this->db->where($where)->update('tbl_user', $data);
    }

    public function delete($where)
    {
        return $this->db->delete('tbl_user', $where);
    }


    public function page($limit, $page)
    {
        $this->db->limit($limit, $page);

        return $this;
    }
    
    public function latest()
    {
        $this->db->order_by('id_user', 'desc');

        return $this;
    }

    public function where($where)
    {
        $this->db->where($where);

        return $this;
    }

    public function all()
    {
        return $this->db->get('tbl_user')->result_array();
    }

    public function first_where($where)
    {
        return $this->db->where($where)->get('tbl_user')->row_array();
    }
}