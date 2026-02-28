<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="page-title mb-4">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Profil Perusahaan</h3>
            <p class="text-subtitle text-muted">Kelola identitas dan informasi dasar perusahaan untuk keperluan laporan.</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <?php if(!empty($company['logo'])): ?>
                            <img src="<?= base_url('uploads/company/' . $company['logo']) ?>" alt="Logo Perusahaan" class="img-fluid rounded" style="max-height: 200px;">
                        <?php else: ?>
                            <div class="avatar avatar-xl bg-light-primary" style="width: 150px; height: 150px;">
                                <span class="avatar-content fs-1"><i class="bi bi-building"></i></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h4 class="font-bold mb-1"><?= esc($company['nama_perusahaan'] ?? 'Nama Perusahaan') ?></h4>
                    <p class="text-muted text-sm mb-0"><?= esc($company['bidang_usaha'] ?? 'Bidang Usaha') ?></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Edit Informasi Perusahaan</h5>
                </div>
                <div class="card-body mt-4">
                    <form action="<?= base_url('/admin/setting-company/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-bold">Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan" class="form-control" value="<?= esc($company['nama_perusahaan'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-bold">Bidang Usaha</label>
                                <input type="text" name="bidang_usaha" class="form-control" value="<?= esc($company['bidang_usaha'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-bold">Email Perusahaan</label>
                                <input type="email" name="email" class="form-control" value="<?= esc($company['email'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-bold">Nomor Telepon</label>
                                <input type="text" name="telepon" class="form-control" value="<?= esc($company['telepon'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-bold">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3"><?= esc($company['alamat'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label font-bold">Logo Perusahaan</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo. (Format: JPG/PNG, Maks 2MB)</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan Pengaturan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>