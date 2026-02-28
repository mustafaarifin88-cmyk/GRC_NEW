<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Konfigurasi Hierarki Approval</h3>
            <p class="text-subtitle text-muted">Tentukan rantai komando dari bawahan ke atasan untuk alur persetujuan dokumen.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first text-md-end mb-3 mb-md-0">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahHierarki">
                <i class="bi bi-diagram-3 me-2"></i>Tambah Relasi Hierarki
            </button>
        </div>
    </div>
</div>

<section class="section">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">No</th>
                            <th class="py-3">Data Atasan (Penerima Laporan)</th>
                            <th class="py-3 text-center"><i class="bi bi-arrow-left-right text-muted"></i></th>
                            <th class="py-3">Data Bawahan (Pembuat Laporan)</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($hierarchies)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">Belum ada struktur hierarki yang dikonfigurasi.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach($hierarchies as $h): ?>
                            <tr>
                                <td class="font-bold"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-light-primary me-3">
                                            <span class="avatar-content"><i class="bi bi-person-badge"></i></span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0"><?= esc($h['nama_atasan']) ?></h6>
                                            <small class="text-muted"><?= esc($h['level_atasan']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><i class="bi bi-arrow-left text-primary fw-bold"></i></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-light-secondary me-3">
                                            <span class="avatar-content"><i class="bi bi-person"></i></span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0"><?= esc($h['nama_bawahan']) ?></h6>
                                            <small class="text-muted"><?= esc($h['level_bawahan']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('/admin/hierarchy/delete/' . $h['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus relasi hierarki ini?');">
                                        <i class="bi bi-trash"></i> Hapus
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

<div class="modal fade" id="modalTambahHierarki" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Buat Relasi Hierarki Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('/admin/hierarchy/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label font-bold text-primary">Pilih Atasan</label>
                        <select name="id_atasan" class="form-select form-select-lg" required>
                            <option value="">-- Pilih Atasan --</option>
                            <?php foreach($all_users as $u): ?>
                                <?php if($u['level'] != 'STAFF' && $u['level'] != 'ADMIN'): ?>
                                    <option value="<?= $u['id'] ?>"><?= esc($u['nama_lengkap']) ?> (<?= esc($u['level']) ?>)</option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="text-center mb-4">
                        <i class="bi bi-arrow-down-circle-fill fs-3 text-muted"></i>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-bold text-secondary">Pilih Bawahan</label>
                        <select name="id_bawahan" class="form-select form-select-lg" required>
                            <option value="">-- Pilih Bawahan --</option>
                            <?php foreach($all_users as $u): ?>
                                <?php if($u['level'] != 'PIMPINAN TINGGI' && $u['level'] != 'ADMIN'): ?>
                                    <option value="<?= $u['id'] ?>"><?= esc($u['nama_lengkap']) ?> (<?= esc($u['level']) ?>)</option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-link-45deg me-2"></i>Hubungkan Relasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>