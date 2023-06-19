<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Pengisian</h1>
    <a href="<?= site_url('admin/pengisian/create') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        Tambah
    </a>
</div>

<div class="card card-body">
    <div class="table-responsive-sm">
        <table class="table table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>No.</th>
                    <th>Kode Pengisian</th>
                    <th>Ukuran Penyimpanan</th>
                    <th>Penyimpanan Digunakan</th>
                    <th>Games</th>
                    <th>User</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                <?php foreach ($pengisian as $item) : ?>
                    <tr>
                        <td><?= ++$count ?></td>
                        <td><?= $item['kode_pengisian'] ?></td>
                        <td><?= ukuran_format($item['ukuran_penyimpanan']) ?></td>
                        <td><?= ukuran_format($item['ukuran_digunakan']) ?></td>
                        <td>
                            <?php if (isset($item['games'])) : ?>
                                <?php foreach ($item['games'] as $game) : ?>
                                    <span class="badge badge-success"><?= $game['nama_game'] ?></span>
                                <?php endforeach ?>
                            <?php endif ?>
                        </td>
                        <td>
                            <?= $item['nama_pemesan'] ?>
                        </td>
                        <td>
                            <div>
                                <a href="<?= site_url('/?kode=' . $item['kode_pengisian']) ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-fw fa-globe"></i>
                                    URL
                                </a>
                                <a href="<?= site_url('admin/pengisian/edit/' . $item['id_pengisian']) ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <a onclick="return confirm('Yakin ingin dihapus?')" href="<?= site_url('admin/pengisian/destroy/' . $item['id_pengisian']) ?>" class="btn btn-sm btn-danger">
                                    <i class="fas fa-fw fa-trash"></i>
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>

                <?php if ($count == 0) : ?>
                    <tr>
                        <td colspan="9" class="text-center">
                            Belum ada data
                        </td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>

        <div class="mt-2">
            <?= $this->pagination->create_links() ?>
        </div>
    </div>
</div>