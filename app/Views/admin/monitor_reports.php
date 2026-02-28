<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="page-title mb-4">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Monitoring Seluruh Laporan</h3>
            <p class="text-subtitle text-muted">Pantau pergerakan dan status semua dokumen laporan dari seluruh unit/staff.</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom pb-3">
            <h5 class="card-title mb-0">Database Laporan GRC</h5>
            <div class="input-group w-50">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0 bg-light" placeholder="Cari laporan atau pembuat...">
            </div>
        </div>
        <div class="card-body mt-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead>
                        <tr>
                            <th class="py-3">No</th>
                            <th class="py-3">Waktu Dibuat</th>
                            <th class="py-3">Pembuat Dokumen</th>
                            <th class="py-3">Jenis Form</th>
                            <th class="py-3">Posisi Dokumen (Approval)</th>
                            <th class="py-3 text-center">Status Final</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($reports)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2"></i>
                                    Belum ada data laporan yang diajukan ke sistem.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach($reports as $row): ?>
                            <tr>
                                <td class="font-bold"><?= $no++ ?></td>
                                <td>
                                    <span class="d-block font-bold text-dark"><?= date('d M Y', strtotime($row['created_at'])) ?></span>
                                    <span class="text-muted text-sm"><?= date('H:i', strtotime($row['created_at'])) ?> WIB</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <img src="<?= base_url('uploads/profil/' . ($row['foto_pembuat'] ?? 'default.png')) ?>" alt="Foto">
                                        </div>
                                        <span class="font-bold"><?= esc($row['nama_pembuat']) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light-info text-info fw-semibold rounded-pill px-3 py-2">
                                        <?= strtoupper(str_replace('_', ' ', $row['jenis_form'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($row['status_approval'] == 'APPROVED'): ?>
                                        <span class="text-success font-bold"><i class="bi bi-check-all me-1"></i> Tuntas</span>
                                    <?php else: ?>
                                        <span class="text-primary font-bold"><i class="bi bi-geo-alt-fill me-1"></i> <?= esc($row['posisi_approval']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($row['status_approval'] == 'PROSES'): ?>
                                        <span class="badge bg-warning text-dark px-3"><i class="bi bi-arrow-repeat me-1"></i> Proses</span>
                                    <?php elseif($row['status_approval'] == 'APPROVED'): ?>
                                        <span class="badge bg-success px-3"><i class="bi bi-check-circle me-1"></i> Disetujui</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger px-3"><i class="bi bi-x-circle me-1"></i> Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('/admin/monitor-reports/detail/' . $row['id']) ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>