<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Pengisian</h1>
</div>

<form action="<?= site_url('admin/pengisian/store') ?>" class="card card-body" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold" for="kode_pengisian">Kode Pengisian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="kode_pengisian" id="kode_pengisian" value="<?= $generated_kode_pengisian ?>" readonly required>
                <?= form_error('kode_pengisian') ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold" for="nama_pemesan">Nama Pemesan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_pemesan" id="nama_pemesan" required>
                <?= form_error('nama_pemesan') ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold" for="ukuran_penyimpanan">Ukuran Penyimpanan <span class="text-danger">*</span></label>
                <div class="d-flex align-items-center">
                    <input type="number" class="form-control" name="ukuran_penyimpanan" id="ukuran_penyimpanan" required> <span class="ml-3">GB</span>
                </div>
                <?= form_error('ukuran_penyimpanan') ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bold" for="status">Status <span class="text-danger">*</span></label>
                <div class="d-flex align-items-center">
                    <select name="status" id="status" class="form-control" required>
                        <option value="dibuat">Dibuat</option>
                        <option value="diatur">Diatur</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <?= form_error('status') ?>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold" for="id_game">Game <span class="text-danger">*</span></label>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($games as $item) : ?>
                            <tr>
                                <td><?= $item['nama_game'] ?></td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input name="games[]" value="<?= $item['id_game'] ?>" class="form-check-input" type="checkbox" role="switch" id="game-<?= $item['id_game'] ?>">
                                        <label class="form-check-label" for="game-<?= $item['id_game'] ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?= form_error('games') ?>
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