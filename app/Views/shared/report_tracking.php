<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tracking Status Laporan</h3>
            <p class="text-subtitle text-muted">Pantau proses persetujuan dokumen dan laporan Anda di sini.</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Form</th>
                            <th>Tanggal Dibuat</th>
                            <th>Posisi Dokumen</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($reports)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada laporan yang Anda buat.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach($reports as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <span class="badge bg-light-secondary"><?= strtoupper(str_replace('_', ' ', $row['jenis_form'])) ?></span>
                                </td>
                                <td><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                                <td class="font-bold text-primary"><?= $row['posisi_approval'] ?></td>
                                <td class="text-center">
                                    <?php if($row['status_approval'] == 'PROSES'): ?>
                                        <span class="badge bg-warning"><i class="bi bi-hourglass-split me-1"></i> Sedang Diproses</span>
                                    <?php elseif($row['status_approval'] == 'APPROVED'): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Disetujui</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($row['status_approval'] == 'REJECTED'): ?>
                                        <button class="btn btn-sm btn-outline-danger" onclick="Swal.fire('Alasan Penolakan', '<?= htmlspecialchars($row['alasan_tolak'] ?? 'Tidak ada alasan khusus') ?>', 'error')">
                                            <i class="bi bi-info-circle"></i> Info
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
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
</section>
<?= $this->endSection() ?>