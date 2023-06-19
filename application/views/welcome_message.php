<main class="container my-auto">
	<form class="mt-5" action="<?= site_url('/') ?>" method="GET">
		<div class="mb-2 text-center">
			<label for="kode-pengisian" class="h4 mb-4">Kode Pengisian</label>
			<input name="kode" id="kode-pengisian" type="text" class="form-control form-control-lg mb-2" placeholder="Masukan Kode Pengisian">
			<button class="btn btn-outline-dark">
				<i class="fa fa-fw fa-gamepad"></i>
				Atur Game
			</button>
		</div>
	</form>

	<?php if (!empty($pengisian)) : ?>
		<div class="mt-5">
			<h4>Riwayat Pengisian</h4>
			<div class="row">
				<?php foreach ($pengisian as $item) : ?>
					<div class="col-lg-3 col-md-4 col-6">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between mb-2">
									<div>Nama Pemesan</div>
									<div>
										<span class="fw-bold"><?= $item['nama_pemesan'] ?></span>
									</div>
								</div>
								<div class="d-flex justify-content-between mb-2">
									<div>Status</div>
									<div>
										<span class="badge bg-secondary"><?= ucfirst($item['status']) ?></span>
									</div>
								</div>
								<div class="d-flex flex-column mb-2">
									<div class="mb-1">Sisa Penyimpanan</div>
									<div class="progress" role="progressbar">
										<?php $digunakan_percent = 100 - (($item['ukuran_penyimpanan'] - $item['ukuran_digunakan']) / $item['ukuran_penyimpanan']) * 100 ?>
										<div class="progress-bar bg-secondary" style="width: <?= $digunakan_percent ?>%"></div>
									</div>
									<div class="d-flex justify-content-between">
										<span class="text-muted small"><?= ukuran_format($item['ukuran_digunakan']) ?></span>
										<span class="text-muted small"><?= ukuran_format($item['ukuran_penyimpanan']) ?></span>
									</div>
								</div>

								<?php if ($item['status'] == 'dibuat') : ?>
									<form action="<?= site_url('pengisian/active') ?>" method="POST">
										<input type="hidden" name="id_pengisian" value="<?= $item['id_pengisian'] ?>">
										<button type="submit" class="btn btn-sm w-100 btn-block btn-dark">
											<i class="fas fa-fw fa-gamepad"></i>
											Atur Game
										</button>
									</form>
								<?php else : ?>
									<div class="d-flex flex-column mb-2">
										<div>Games</div>
										<div>
											<?php foreach ($item['games'] as $game): ?>
												<span class="badge bg-dark"><?= $game['nama_game'] ?></span>
											<?php endforeach ?>
										</div>
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	<?php endif ?>
</main>