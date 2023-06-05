<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $this->config->item('app_name') ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('/assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('/assets/vendor/bootstrap-5.2.3/css/bootstrap.min.css') ?>" rel="stylesheet">

    <?php foreach ($css as $e) : ?>
        <?= $e ?>
    <?php endforeach ?>
</head>

<body class="vh-100 d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?= $this->config->item('app_name') ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= uri_is('welcome', '') ? 'active' : '' ?>" href="<?= site_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= uri_is('game', 'game/*') ? 'active' : '' ?>" href="<?= site_url('game') ?>">Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= uri_is('harga', 'welcome/harga') ? 'active' : '' ?>" href="<?= site_url('harga') ?>">Harga</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (!$this->session->has_userdata('id_user')) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= uri_is('login', 'register', 'welcome/login', 'welcome/register') ? 'active' : '' ?>" href="<?= site_url('login') ?>">
                                <i class="fas fa-fw fa-user"></i>
                                Masuk
                            </a>
                        </li>
                    <?php elseif ($this->session->userdata('role') == 'admin') : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('admin') ?>">
                                <i class="fas fa-fw fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-fw fa-user me-1"></i>
                                Akun
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <?= $content ?>

    <footer class="mt-auto text-center bg-dark text-white py-2 fw-bold">
        Copyright &copy; IsiinGame 2023
    </footer>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('/assets/vendor/bootstrap-5.2.3/js/bootstrap.bundle.min.js') ?>"></script>

    <?php foreach ($js as $e) : ?>
        <?= $e ?>
    <?php endforeach ?>
</body>

</html>