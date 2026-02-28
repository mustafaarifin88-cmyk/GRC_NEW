<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Pengaturan Profil</h3>
            <p class="text-subtitle text-muted">Perbarui informasi profil dan kata sandi Anda di sini.</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-2xl mb-3">
                            <img src="<?= base_url('uploads/profil/' . (session()->get('foto') ?: 'default.png')) ?>" alt="Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h3 class="mt-3"><?= session()->get('nama_lengkap') ?></h3>
                        <p class="text-small"><?= session()->get('level') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Detail Akun</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/profile/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" value="<?= session()->get('username') ?>" readonly disabled>
                            <small class="text-muted">Username digunakan untuk login dan tidak dapat diubah.</small>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>

                        <div class="form-group mb-4">
                            <label for="foto" class="form-label">Ubah Foto Profil</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Format yang didukung: JPG, PNG. Maksimal ukuran 2MB.</small>
                        </div>

                        <div class="form-group d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i> Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>