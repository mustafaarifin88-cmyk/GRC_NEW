<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="page-title mb-4">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Dashboard Administrator</h3>
            <p class="text-subtitle text-muted">Ringkasan statistik sistem dan aktivitas audit GRC.</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Pengguna</h6>
                            <h6 class="font-extrabold mb-0"><?= esc($total_users ?? 0) ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon blue mb-2">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Laporan</h6>
                            <h6 class="font-extrabold mb-0"><?= esc($total_reports ?? 0) ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon green mb-2">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Laporan Disetujui</h6>
                            <h6 class="font-extrabold mb-0"><?= esc($reports_approved ?? 0) ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon red mb-2">
                                <i class="bi bi-x-circle-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Laporan Ditolak</h6>
                            <h6 class="font-extrabold mb-0"><?= esc($reports_rejected ?? 0) ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Aktivitas Laporan Terbaru</h5>
                </div>
                <div class="card-body mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pembuat</th>
                                    <th>Jenis Laporan</th>
                                    <th>Status Saat Ini</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($recent_reports)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada aktivitas laporan.</td>
                                </tr>
                                <?php else: ?>
                                    <?php foreach($recent_reports as $report): ?>
                                    <tr>
                                        <td><?= date('d M Y H:i', strtotime($report['created_at'])) ?></td>
                                        <td class="font-bold"><?= esc($report['nama_pembuat']) ?></td>
                                        <td><span class="badge bg-light-primary"><?= str_replace('_', ' ', strtoupper($report['jenis_form'])) ?></span></td>
                                        <td>
                                            <?php if($report['status_approval'] == 'PROSES'): ?>
                                                <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> <?= esc($report['posisi_approval']) ?></span>
                                            <?php elseif($report['status_approval'] == 'APPROVED'): ?>
                                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Selesai</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Ditolak</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>