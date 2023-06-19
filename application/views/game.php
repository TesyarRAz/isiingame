<main class="container my-5">
    <?php if (isset($active_pengisian)) : ?>
        <div class="d-flex flex-column">
            <div class="mb-1">Sisa Penyimpanan</div>
            <div class="progress" role="progressbar">
                <?php $digunakan_percent = 100 - (($active_pengisian['ukuran_penyimpanan'] - $active_pengisian['ukuran_digunakan']) / $active_pengisian['ukuran_penyimpanan']) * 100 ?>
                <div class="progress-bar bg-secondary" style="width: <?= $digunakan_percent ?>%"></div>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted small"><?= number_format($active_pengisian['ukuran_digunakan'], 0, ',', '.') ?> MB</span>
                <span class="text-muted small"><?= number_format($active_pengisian['ukuran_penyimpanan'], 0, ',', '.') ?> MB</span>
            </div>
        </div>
    <?php endif ?>

    <div class="mt-5 d-flex justify-content-between align-items-center">
        <h4>Daftar Game</h4>
        <?php if (isset($active_pengisian)) : ?>
            <form action="<?= site_url('pengisian/finalize') ?>" method="POST" onsubmit="return confirm('Ketika sudah selesai game tidak bisa diminta untuk ditambah kembali, yakin ?') ?>">
                <button class="btn btn-sm btn-danger">
                    <i class="fas fa-fw fa-save"></i>
                    Selesai
                </button>
            </form>
        <?php endif ?>
    </div>
    <hr>

    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1 g-4">
        <?php foreach ($games as $game) : ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?= base_url($game['gambar_game']) ?>" class="card-img-top img-fluid" style="height: 200px;" alt="Gambar <?= $game['nama_game'] ?>">
                    <div class="card-body">
                        <h6><?= $game['nama_game'] ?></h6>
                        <p class="card-text"><?= $game['deskripsi_game'] ?></p>
                        <span class="text-muted small">Ukuran : <?= ukuran_format($game['ukuran_game']) ?></span>

                        <?php if (isset($active_pengisian) && $active_pengisian) : ?>
                            <div class="d-flex justify-content-end">
                                <?php if (count(array_filter($active_pengisian['games'], fn ($e) => $e['id_game'] == $game['id_game'])) == 0) : ?>
                                    <form action="<?= site_url('pengisian/store') ?>" method="POST">
                                        <input type="hidden" name="id_game" value="<?= $game['id_game'] ?>">
                                        <button class="btn btn-sm btn-outline-dark">
                                            <i class="fas fa-fw fa-plus"></i>
                                            Tambah
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <form action="<?= site_url('pengisian/destroy') ?>" method="POST">
                                        <input type="hidden" name="id_game" value="<?= $game['id_game'] ?>">
                                        <button class="btn btn-sm btn-outline-dark">
                                            <i class="fas fa-fw fa-trash-alt"></i>
                                            Hapus
                                        </button>
                                    </form>
                                <?php endif ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

        <?php if (empty($games)) : ?>
            <div class="col text-center">
                Tidak ada game
            </div>
        <?php endif ?>
    </div>
</main>