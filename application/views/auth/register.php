<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container my-auto">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <form action="<?= site_url('auth/register') ?>" method="POST" class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title">Daftar ke <?= $this->config->item('app_name') ?></h4>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold mb-1" for="nama">Nama</label>
                        <input id="nama" type="nama" class="form-control" name="nama" placeholder="Masukan Nama" required>
                        <?= $this->session->flashdata('message') ? '<span class="text-danger ms-1">' . $this->session->flashdata('message') . '</span>' : '' ?>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold mb-1" for="nomor_telepon">No. Hp</label>
                        <input id="nomor_telepon" type="phone" class="form-control" name="nomor_telepon" placeholder="Masukan No Hp" required>
                        <?= $this->session->flashdata('message') ? '<span class="text-danger ms-1">' . $this->session->flashdata('message') . '</span>' : '' ?>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold mb-1" for="username">Username</label>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Masukan Username" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold mb-1" for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Masukan Password" required>
                        <?= $this->session->flashdata('message') ? '<span class="text-danger ms-1">' . $this->session->flashdata('message') . '</span>' : '' ?>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Sudah punya akun? <a href="<?= site_url('login') ?>" class="text-decoration-none">Klik disini</a></span>

                        <div class="ms-auto">
                            <button type="submit" class="btn btn-dark">Daftar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>