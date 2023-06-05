<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-gamepad"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?= $this->config->item('app_name') ?> <sup>1.0</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= uri_is('admin', 'admin/dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengelolaan
    </div>

    <li class="nav-item <?= uri_is('admin/user', 'admin/user/*') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('admin/user') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelola User</span>
        </a>
    </li>

    <li class="nav-item <?= uri_is('admin/kategori', 'admin/kategori/*') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('admin/kategori') ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Kelola Kategori</span>
        </a>
    </li>

    <li class="nav-item <?= uri_is('admin/game', 'admin/game/*') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('admin/game') ?>">
            <i class="fas fa-fw fa-gamepad"></i>
            <span>Kelola Game</span>
        </a>
    </li>

    <li class="nav-item <?= uri_is('admin/pengisian', 'admin/pengisian/*') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('admin/pengisian') ?>">
            <i class="fas fa-fw fa-hdd"></i>
            <span>Kelola Pengisian</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->