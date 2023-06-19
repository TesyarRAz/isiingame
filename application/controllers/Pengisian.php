<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengisian extends User_Controller {
    public function active()
    {
        $id_pengisian = $this->input->post('id_pengisian');

        $pengisian = $this->pengisian_model->first_where(['id_pengisian' => $id_pengisian]);
        $this->abort_if(404, empty($pengisian));

        $this->session->set_userdata($pengisian);

        redirect('game');
    }

    public function store()
    {
        [$id_game, $game, $id_pengisian, $pengisian] = $this->validate_pengisian();

        $this->pengisian_model->add_game_to_pengisian(['id_game' => $id_game, 'id_pengisian' => $id_pengisian]);

        $this->session->set_flashdata('message', 'Berhasil menambahkan game');

        redirect('game');
    }

    public function destroy()
    {
        [$id_game, $game, $id_pengisian, $pengisian] = $this->validate_pengisian();

        $this->pengisian_model->delete_game_to_pengisian(['id_game' => $id_game, 'id_pengisian' => $id_pengisian]);

        $this->session->set_flashdata('message', 'Berhasil menghapus game');

        redirect('game');
    }

    private function validate_pengisian() {
        $id_game = $this->input->post('id_game');
        $this->abort_if(404, empty($id_game));

        $game = $this->game_model->first_where_game(['id_game' => $id_game]);
        $this->abort_if(404, empty($game));

        $id_pengisian = $this->session->userdata('id_pengisian');
        $this->abort_if(404, empty($id_pengisian));

        $pengisian = $this->pengisian_model->first_where(['id_pengisian' => $id_pengisian]);
        if (empty($pengisian)) {
            $this->session->unset_userdata('id_pengisian');
            $this->abort(404);
        }

        return [$id_game, $game, $id_pengisian, $pengisian];
    }

    public function finalize()
    {
        $id_pengisian = $this->session->userdata('id_pengisian');
        $this->abort_if(404, empty($id_pengisian));

        $pengisian = $this->pengisian_model->first_where(['id_pengisian' => $id_pengisian]);
        $this->abort_if(404, empty($pengisian));

        $this->session->unset_userdata('id_pengisian');

        $this->pengisian_model->update(['id_pengisian' => $id_pengisian], ['status' => 'diatur']);

        $this->session->set_flashdata('message', 'Berhasil mengatur pengisian');
        
        redirect('welcome');
    }
}