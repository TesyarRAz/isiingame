<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Game_model extends CI_Model
{
    public function latest()
    {
        $this->db->order_by('id_game', 'desc');

        return $this;
    }

    public function latest_kategori()
    {
        $this->db->order_by('id_kategori', 'desc');

        return $this;
    }

    public function page($limit, $page)
    {
        $this->db->limit($limit, $page);

        return $this;
    }

    public function count_all()
    {
        return $this->db->count_all('tbl_game');
    }

    public function count_all_kategori()
    {
        return $this->db->count_all('tbl_kategori');
    }

    public function all()
    {
        $games = $this->db->get('tbl_game')->result_array();

        if (!empty($games)) {
            $kategori = $this->db->select('tbl_kategori.id_kategori, tbl_kategori_game.id_game, tbl_kategori.nama_kategori')
                ->join('tbl_kategori_game', 'tbl_kategori_game.id_kategori = tbl_kategori.id_kategori')
                ->where_in('tbl_kategori_game.id_game', array_map(fn ($e) => $e['id_game'], $games))
                ->get('tbl_kategori')
                ->result_array();

            for ($i = 0; $i < count($games); $i++) {
                $games[$i]['kategori'] = array_filter($kategori, fn ($e) => $e['id_game'] == $games[$i]['id_game']);
            }
        }

        return $games;
    }

    public function all_kategori()
    {
        return $this->db->get('tbl_kategori')->result_array();
    }

    public function insert_kategori($data)
    {
        $this->db->insert('tbl_kategori', $data);

        return $this->db->insert_id();
    }

    public function update_kategori($where, $data)
    {
        return $this->db->where($where)->update('tbl_kategori', $data);
    }

    public function first_where_kategori($where)
    {
        return $this->db->where($where)->get('tbl_kategori')->row_array();
    }

    public function first_where_game($where)
    {
        return $this->db->where($where)->get('tbl_game')->row_array();
    }

    public function delete_kategori($where)
    {
        return $this->db->delete('tbl_kategori', $where);
    }

    public function sync_game_kategori($id_game, $kategori_game)
    {
        $this->db->delete('tbl_kategori_game', ['id_game' => $id_game]);
        $this->db->insert_batch('tbl_kategori_game', array_map(fn ($e) => [
            'id_kategori' => $e,
            'id_game' => $id_game,
        ], array_values($kategori_game)));
    }

    public function insert_game($data)
    {
        $this->db->insert('tbl_game', $data);

        return $this->db->insert_id();
    }

    public function game_ids_kategori($id_game)
    {
        return array_map(fn ($e) => $e['id_kategori'], $this->db->where('id_game', $id_game)->get('tbl_kategori_game')->result_array());
    }

    public function update_game($where, $data)
    {
        return $this->db->where($where)->update('tbl_game', $data);
    }

    public function delete_game($where)
    {
        return $this->db->delete('tbl_game', $where);
    }

    public function where_in($games)
    {
        $this->db->where_in('id_game', $games);

        return $this;
    }

    public function count_pengisian_dibuat()
    {
        return $this->db->select('COUNT(*) as pengisian_dibuat')->where('status', 'dibuat')->get('tbl_pengisian')->row_array()['pengisian_dibuat'];
    }
}
