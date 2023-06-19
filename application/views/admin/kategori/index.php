<?php $this->load->view('admin/kategori/create') ?>
<?php $this->load->view('admin/kategori/edit') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Kategori</h1>
    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                <?php foreach ($kategori as $item) : ?>
                    <tr>
                        <td><?= ++$count ?></td>
                        <td><?= $item['nama_kategori'] ?></td>
                        <td>
                            <div>
                                <a href="javascript:void(0)" onclick="action_edit('<?= $item['id_kategori'] ?>')" class="btn btn-sm btn-primary">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <a onclick="return confirm('Yakin ingin dihapus?')" href="<?= site_url('admin/kategori/destroy/' . $item['id_kategori']) ?>" class="btn btn-sm btn-danger">
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