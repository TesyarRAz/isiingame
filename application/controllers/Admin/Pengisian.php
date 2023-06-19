<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengisian extends Admin_Controller
{
    public function index()
    {
        $config["base_url"] = site_url('pengisian');
        $config["total_rows"] = $this->pengisian_model->count_all();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        
        $this->template->setup_pagination($config);
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['pengisian'] = $this->pengisian_model->latest()->page($config['per_page'], $page)->all();

        $this->template->render_admin('admin/pengisian/index', $data);
    }

    
    public function create()
    {
        $data['games'] = $this->game_model->latest()->all();
        $data['generated_kode_pengisian'] = 'ISI' . time();

        $this->template->render_admin('admin/pengisian/create', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('kode_pengisian', 'Kode Pengisian', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('ukuran_penyimpanan', 'Ukuran Penyimpanan', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        
        $this->form_validation->set_rules('status', 'Status', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() === false) {
            return $this->create();
        }

        $data = $this->input->post(['kode_pengisian', 'ukuran_penyimpanan', 'nama_pemesan', 'status']);
        $games = $this->input->post('games');

        $data['ukuran_penyimpanan'] = $data['ukuran_penyimpanan'] * 1000;

        $id_pengisian = $this->pengisian_model->insert($data);
        $this->pengisian_model->sync_pengisian_game($id_pengisian, $games);

        $this->session->set_flashdata('message', 'Berhasil menambahkan pengisian');

        redirect('admin/pengisian/index');
    }

    public function edit($id_pengisian)
    {
        $data = $this->pengisian_model->first_where(['id_pengisian' => $id_pengisian]);
        $this->abort_if(404, empty($data));

        $data['games'] = $this->game_model->latest()->all();
        $data['ids_game'] = $this->pengisian_model->pengisian_ids_games($id_pengisian);

        $data['ukuran_penyimpanan'] = $data['ukuran_penyimpanan'] / 1000;

        $this->template->render_admin('admin/pengisian/edit', $data);
    }

    public function update($id_pengisian)
    {
        $pengisian = $this->pengisian_model->first_where(['id_pengisian' => $id_pengisian]);
        $this->abort_if(404, empty($pengisian));

        $this->form_validation->set_rules('kode_pengisian', 'Kode Pengisian', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('ukuran_penyimpanan', 'Ukuran Penyimpanan', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() === false) {
            return $this->edit($id_pengisian);
        }

        $data = $this->input->post(['kode_pengisian', 'ukuran_penyimpanan', 'nama_pemesan', 'status']);
        $games = $this->input->post('games');

        $data['ukuran_penyimpanan'] = $data['ukuran_penyimpanan'] * 1000;

        $this->pengisian_model->update(['id_pengisian' => $id_pengisian], $data);
        $this->pengisian_model->sync_pengisian_game($id_pengisian, $games);

        $this->session->set_flashdata('message', 'Berhasil mengedit pengisian');

        redirect('admin/pengisian/index');
    }

    public function destroy($id_pengisian)
    {
        $this->pengisian_model->delete(['id_pengisian' => $id_pengisian]);

        $this->session->set_flashdata('message', 'Berhasil menghapus pengisian');

        redirect('admin/pengisian/index');
    }
}