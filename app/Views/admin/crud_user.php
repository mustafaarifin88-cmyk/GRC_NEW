<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="page-title mb-4">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Manajemen Pengguna</h3>
            <p class="text-subtitle text-muted">Kelola data akun pengguna, hak akses, dan status keaktifan.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first text-md-end mb-3 mb-md-0">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                <i class="bi bi-plus-circle me-2"></i>Tambah Pengguna Baru
            </button>
        </div>
    </div>
</div>

<section class="section">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="tableUser">
                    <thead>
                        <tr>
                            <th>Profil</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Level Akses</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($users)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">Data pengguna tidak ditemukan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($users as $user): ?>
                            <tr>
                                <td>
                                    <div class="avatar avatar-md">
                                        <img src="<?= base_url('uploads/profil/' . ($user['foto'] ?: 'default.png')) ?>" alt="Foto">
                                    </div>
                                </td>
                                <td class="font-bold"><?= esc($user['nama_lengkap']) ?></td>
                                <td><?= esc($user['username']) ?></td>
                                <td>
                                    <span class="badge bg-light-primary"><?= esc($user['level']) ?></span>
                                </td>
                                <td class="text-center">
                                    <?php if(!isset($user['is_active']) || $user['is_active']): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#modalEditUser<?= $user['id'] ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="<?= base_url('/admin/users/delete/' . $user['id']) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus pengguna ini?');">
                                        <i class="bi bi-trash"></i>
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

<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('/admin/users/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-bold">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-bold">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-bold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-bold">Level Akses</label>
                            <select name="level" class="form-select" required>
                                <option value="">Pilih Level</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="STAFF">STAFF</option>
                                <option value="KEPALA UNIT">KEPALA UNIT</option>
                                <option value="SUPERVISOR">SUPERVISOR</option>
                                <option value="MANAGERIAL">MANAGERIAL</option>
                                <option value="PIMPINAN TINGGI">PIMPINAN TINGGI</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(!empty($users)): foreach($users as $user): ?>
<div class="modal fade" id="modalEditUser<?= $user['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-dark">Edit Data Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('/admin/users/update/' . $user['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-bold">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= esc($user['nama_lengkap']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-bold">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= esc($user['username']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-bold">Password Baru (Opsional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-bold">Level Akses</label>
                            <select name="level" class="form-select" required>
                                <option value="ADMIN" <?= $user['level'] == 'ADMIN' ? 'selected' : '' ?>>ADMIN</option>
                                <option value="STAFF" <?= $user['level'] == 'STAFF' ? 'selected' : '' ?>>STAFF</option>
                                <option value="KEPALA UNIT" <?= $user['level'] == 'KEPALA UNIT' ? 'selected' : '' ?>>KEPALA UNIT</option>
                                <option value="SUPERVISOR" <?= $user['level'] == 'SUPERVISOR' ? 'selected' : '' ?>>SUPERVISOR</option>
                                <option value="MANAGERIAL" <?= $user['level'] == 'MANAGERIAL' ? 'selected' : '' ?>>MANAGERIAL</option>
                                <option value="PIMPINAN TINGGI" <?= $user['level'] == 'PIMPINAN TINGGI' ? 'selected' : '' ?>>PIMPINAN TINGGI</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label font-bold">Status Akun</label>
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" <?= (!isset($user['is_active']) || $user['is_active']) ? 'checked' : '' ?>>
                                <label class="form-check-label text-sm mt-1">Akun Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning"><i class="bi bi-save me-2"></i>Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; endif; ?>
<?= $this->endSection() ?>