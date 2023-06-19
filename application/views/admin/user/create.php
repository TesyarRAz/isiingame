<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
</div>

<form action="<?= site_url('admin/user/store') ?>" class="card card-body" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold" for="nama">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama" id="nama" required>
                <?= form_error('nama') ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold" for="username">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="username" id="username" required>
                <?= form_error('username') ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold" for="password">Password <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="password" id="password" required>
                <?= form_error('password') ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold" for="nomor_telepon">No Telp <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nomor_telepon" id="nomor_telepon" required>
                <?= form_error('nomor_telepon') ?>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <button class="btn btn-primary ml-auto">
            <i class="fas fa-fw fa-save"></i>
            Simpan
        </button>
    </div>
</form>