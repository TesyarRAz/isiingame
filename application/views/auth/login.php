<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container my-auto">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <form action="<?= site_url('auth/login') ?>" method="POST" class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title">Masuk ke <?= $this->config->item('app_name') ?></h4>
                </div>

                <div class="card-body">
                    <?= $this->session->flashdata('message') ? '<div class="alert alert-danger">' . $this->session->flashdata('message') . '</div>' : '' ?>
                    <div class="mb-3">
                        <label class="fw-bold mb-1" for="username">Username</label>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Masukan Username" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold mb-1" for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Masukan Password" required>

                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Belum punya akun? <a href="<?= site_url('register') ?>" class="text-decoration-none" tabindex="-1">Klik disini</a></span>

                        <div class="ms-auto">
                            <button type="submit" class="btn btn-dark">Masuk</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>