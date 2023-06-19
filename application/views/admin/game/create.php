<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Game</h1>
</div>

<form action="<?= site_url('admin/game/store') ?>" class="card card-body" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold" for="nama_game">Nama Game <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_game" id="nama_game" required>
                <?= form_error('nama_game') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold" for="ukuran_game">Ukuran <span class="text-danger">*</span></label>
                <div class="d-flex align-items-center">
                    <input type="number" class="form-control" name="ukuran_game" id="ukuran_game" required> <span class="ml-3">MB</span>
                </div>
                <?= form_error('ukuran_game') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" data-toggle="image-preview">
                <label class="font-weight-bold" for="gambar_game">Gambar <span class="text-danger">*</span></label>
                <input type="file" class="d-none" name="gambar_game" id="gambar_game" data-source="true" accept="image/*">
                <img src="<?= base_url('assets/img/empty-image.png') ?>" role="button" class="d-block img-thumbnail" width="300" height="300" data-target="true" required>
                <?= form_error('gambar_game') ?>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold" for="id_kategori">Kategori <span class="text-danger">*</span></label>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategori as $item) : ?>
                            <tr>
                                <td><?= $item['nama_kategori'] ?></td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input name="kategori_game[]" value="<?= $item['id_kategori'] ?>" class="form-check-input" type="checkbox" role="switch" id="kategori-<?= $item['id_kategori'] ?>">
                                        <label class="form-check-label" for="kategori-<?= $item['id_kategori'] ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?= form_error('kategori_game') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold" for="deskripsi_game">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control" name="deskripsi_game" id="deskripsi_game" required></textarea>
                <?= form_error('deskripsi_game') ?>
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