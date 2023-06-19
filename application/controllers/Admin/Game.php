<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Game extends Admin_Controller
{
    public function index()
    {
        $config["base_url"] = site_url('game');
        $config["total_rows"] = $this->game_model->count_all();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        
        $this->template->setup_pagination($config);
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['games'] = $this->game_model->latest()->page($config['per_page'], $page)->all();

        $this->template->render_admin('admin/game/index', $data);
    }

    public function create()
    {
        $data['kategori'] = $this->game_model->latest_kategori()->all_kategori();

        $this->template->render_admin('admin/game/create', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama_game', 'Nama Game', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('ukuran_game', 'Ukuran Game', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('deskripsi_game', 'Deskripsi Game', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('kategori_game[]', 'Kategori Game', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() === false) {
            return $this->create();
        }

        $data = $this->input->post(['nama_game', 'ukuran_game', 'deskripsi_game', 'kategori_game']);

        if($_FILES["gambar_game"]["error"] == 0) {
            if ([$status, $gambar_game] = $this->file_manager->upload_file('gambar_game', 'uploads')) {
                if ($status) {
                    $data['gambar_game'] = '/uploads/' . $gambar_game['file_name'];
                } else {
                    $this->session->set_flashdata('message', $gambar_game);
                    redirect('admin/game/index');
                }
            }
        }

        $kategori_game = $data['kategori_game'];
        unset($data['kategori_game']);

        $id_game = $this->game_model->insert_game($data);
        $this->game_model->sync_game_kategori($id_game, $kategori_game);

        $this->session->set_flashdata('message', 'Berhasil menambahkan game');

        redirect('admin/game/index');
    }

    public function edit($id_game)
    {
        $data = $this->game_model->first_where_game(['id_game' => $id_game]);
        $this->abort_if(404, empty($data));

        $data['kategori'] = $this->game_model->latest_kategori()->all_kategori();
        $data['ids_kategori'] = $this->game_model->game_ids_kategori($id_game);

        $this->template->render_admin('admin/game/edit', $data);
    }

    public function update($id_game)
    {
        $game = $this->game_model->first_where_game(['id_game' => $id_game]);
        $this->abort_if(404, empty($game));

        $this->form_validation->set_rules('nama_game', 'Nama Game', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('ukuran_game', 'Ukuran Game', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('deskripsi_game', 'Deskripsi Game', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('kategori_game[]', 'Kategori Game', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() === false) {
            return $this->edit($id_game);
        }

        $data = $this->input->post(['nama_game', 'ukuran_game', 'deskripsi_game', 'kategori_game']);

        if ($_FILES["gambar_game"]["error"] == 0) {
            if ([$status, $gambar_game] = $this->file_manager->upload_file('gambar_game', 'uploads')) {
                if ($status) {
                    $data['gambar_game'] = '/uploads/' . $gambar_game['file_name'];
                } else {
                    $this->session->set_flashdata('message', $gambar_game);
                    redirect('admin/game/index');
                }
            }
        }

        $kategori_game = $data['kategori_game'];
        unset($data['kategori_game']);

        $this->game_model->update_game(['id_game' => $id_game], $data);
        $this->game_model->sync_game_kategori($id_game, $kategori_game);

        $this->session->set_flashdata('message', 'Berhasil mengedit game');

        redirect('admin/game/index');
    }

    public function destroy($id_game)
    {
        $this->game_model->delete_game(['id_game' => $id_game]);

        $this->session->set_flashdata('message', 'Berhasil menghapus game');

        redirect('admin/game/index');
    }
}