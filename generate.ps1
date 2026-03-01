$patchDir = "Patch_Views_Role_CI4"
$appDir = "$patchDir\app"

New-Item -ItemType Directory -Force -Path "$appDir\Views\admin" | Out-Null
New-Item -ItemType Directory -Force -Path "$appDir\Views\leader" | Out-Null

$utf8NoBom = New-Object System.Text.UTF8Encoding($False)

$adminDashboardView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="space-y-6">
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden">
<div class="relative z-10">
<h1 class="text-3xl sm:text-4xl font-extrabold mb-3 tracking-tight">Selamat Datang, <?= session()->get('fullname') ?>!</h1>
<p class="text-blue-100 text-lg max-w-2xl">Kelola dan pantau seluruh aktivitas GRC (Governance, Risk, and Compliance) System dari panel admin ini.</p>
</div>
<i class="bi bi-shield-check absolute -right-10 -bottom-10 text-[12rem] text-white/10 transform -rotate-12"></i>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-5 hover:shadow-md transition">
<div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl"><i class="bi bi-people-fill"></i></div>
<div>
<p class="text-sm text-slate-500 font-medium mb-1">Total Pengguna</p>
<h3 class="text-2xl font-bold text-slate-800">120</h3>
</div>
</div>
<div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-5 hover:shadow-md transition">
<div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-2xl"><i class="bi bi-file-earmark-check-fill"></i></div>
<div>
<p class="text-sm text-slate-500 font-medium mb-1">Laporan Selesai</p>
<h3 class="text-2xl font-bold text-slate-800">45</h3>
</div>
</div>
<div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-5 hover:shadow-md transition">
<div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-2xl"><i class="bi bi-hourglass-split"></i></div>
<div>
<p class="text-sm text-slate-500 font-medium mb-1">Menunggu Review</p>
<h3 class="text-2xl font-bold text-slate-800">12</h3>
</div>
</div>
<div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center space-x-5 hover:shadow-md transition">
<div class="w-14 h-14 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-2xl"><i class="bi bi-shield-exclamation"></i></div>
<div>
<p class="text-sm text-slate-500 font-medium mb-1">Insiden Terbuka</p>
<h3 class="text-2xl font-bold text-slate-800">3</h3>
</div>
</div>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\admin\dashboard.php", $adminDashboardView, $utf8NoBom)

$adminCompanyProfileView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
<div>
<h2 class="text-2xl font-bold text-slate-800">Profil Perusahaan</h2>
<p class="text-slate-500 text-sm mt-1">Kelola informasi identitas perusahaan</p>
</div>
<i class="bi bi-building text-3xl text-blue-500"></i>
</div>
<div class="p-6 sm:p-8">
<?php if(session()->getFlashdata('success')): ?>
<div class="bg-emerald-50 text-emerald-600 px-4 py-3 rounded-xl border border-emerald-200 mb-6 flex items-center">
<i class="bi bi-check-circle-fill mr-3"></i><?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>
<form action="<?= base_url('admin/company-profile/update') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<input type="hidden" name="id" value="<?= isset($profile) ? $profile['id'] : '' ?>">
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Nama Perusahaan</label>
<input type="text" name="company_name" value="<?= isset($profile) ? $profile['company_name'] : '' ?>" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Nama Pimpinan Utama</label>
<input type="text" name="leader_name" value="<?= isset($profile) ? $profile['leader_name'] : '' ?>" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
<textarea name="address" rows="3" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50 focus:bg-white"><?= isset($profile) ? $profile['address'] : '' ?></textarea>
</div>
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-slate-700 mb-2">Logo Perusahaan</label>
<?php if(isset($profile) && $profile['logo']): ?>
<div class="mb-4">
<img src="<?= base_url('uploads/company/' . $profile['logo']) ?>" class="h-20 object-contain rounded-lg border border-slate-200 p-2">
</div>
<?php endif; ?>
<input type="file" name="logo" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
<p class="text-xs text-slate-500 mt-2">Format: JPG, PNG. Maksimal 2MB.</p>
</div>
</div>
<div class="flex justify-end pt-4">
<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/30 flex items-center">
<i class="bi bi-save mr-2"></i> Simpan Perubahan
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\admin\company_profile.php", $adminCompanyProfileView, $utf8NoBom)

$adminHierarchyView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50">
<h2 class="text-2xl font-bold text-slate-800">Hierarki Approval</h2>
<p class="text-slate-500 text-sm mt-1">Struktur persetujuan laporan dari Unit hingga Pimpinan Tinggi</p>
</div>
<div class="p-6 sm:p-8">
<div class="flex flex-col items-center space-y-4">
<div class="w-full max-w-2xl bg-gradient-to-r from-slate-800 to-slate-900 rounded-2xl p-6 text-white text-center relative shadow-lg">
<div class="absolute -left-4 top-1/2 -translate-y-1/2 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center font-bold">1</div>
<h3 class="text-xl font-bold">PIMPINAN TINGGI</h3>
<p class="text-slate-300 text-sm mt-2">Approval Tahap Akhir</p>
</div>
<i class="bi bi-arrow-down text-3xl text-slate-300"></i>
<div class="w-full max-w-2xl bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white text-center relative shadow-lg">
<div class="absolute -left-4 top-1/2 -translate-y-1/2 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center font-bold">2</div>
<h3 class="text-xl font-bold">MANAGERIAL</h3>
<p class="text-blue-100 text-sm mt-2">Review & Approval Tahap 3</p>
</div>
<i class="bi bi-arrow-down text-3xl text-slate-300"></i>
<div class="w-full max-w-2xl bg-gradient-to-r from-cyan-600 to-blue-500 rounded-2xl p-6 text-white text-center relative shadow-lg">
<div class="absolute -left-4 top-1/2 -translate-y-1/2 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center font-bold border-2 border-white">3</div>
<h3 class="text-xl font-bold">SUPERVISOR</h3>
<p class="text-cyan-100 text-sm mt-2">Review & Approval Tahap 2</p>
</div>
<i class="bi bi-arrow-down text-3xl text-slate-300"></i>
<div class="w-full max-w-2xl bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl p-6 text-white text-center relative shadow-lg">
<div class="absolute -left-4 top-1/2 -translate-y-1/2 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center font-bold border-2 border-white">4</div>
<h3 class="text-xl font-bold">KEPALA UNIT</h3>
<p class="text-emerald-100 text-sm mt-2">Review & Approval Tahap 1</p>
</div>
<i class="bi bi-arrow-up text-3xl text-slate-300 mt-4"></i>
<div class="w-full max-w-2xl bg-slate-100 border-2 border-dashed border-slate-300 rounded-2xl p-6 text-slate-600 text-center relative">
<h3 class="text-xl font-bold">STAFF</h3>
<p class="text-slate-500 text-sm mt-2">Pembuat Laporan</p>
</div>
</div>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\admin\hierarchy_setting.php", $adminHierarchyView, $utf8NoBom)

$adminReportMonitoringView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
<div>
<h2 class="text-2xl font-bold text-slate-800">Monitoring Laporan</h2>
<p class="text-slate-500 text-sm mt-1">Pantau seluruh laporan GRC dari semua divisi</p>
</div>
<i class="bi bi-display text-3xl text-blue-500"></i>
</div>
<div class="p-6">
<div class="bg-slate-50 rounded-2xl p-8 text-center border border-slate-200 border-dashed">
<div class="w-16 h-16 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
<i class="bi bi-cone-striped"></i>
</div>
<h3 class="text-lg font-bold text-slate-700 mb-2">Fitur Dalam Pengembangan</h3>
<p class="text-slate-500 text-sm">Modul Monitoring Laporan Global sedang diintegrasikan. Silakan cek kembali nanti.</p>
</div>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\admin\report_monitoring.php", $adminReportMonitoringView, $utf8NoBom)

$adminUserCrudView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div x-data="{ addModal: false, importModal: false }" class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
<div>
<h2 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h2>
<p class="text-slate-500 text-sm mt-1">Kelola data user dan hak akses sistem</p>
</div>
<div class="flex space-x-3">
<button @click="importModal = true" class="px-4 py-2 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-xl hover:bg-emerald-100 font-semibold text-sm transition flex items-center">
<i class="bi bi-file-earmark-excel mr-2"></i> Import Excel
</button>
<button @click="addModal = true" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-semibold text-sm transition flex items-center shadow-lg shadow-blue-500/30">
<i class="bi bi-plus-lg mr-2"></i> Tambah User
</button>
</div>
</div>
<div class="p-0 overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-sm uppercase tracking-wider">
<th class="p-4 pl-8 font-semibold">User</th>
<th class="p-4 font-semibold">Username</th>
<th class="p-4 font-semibold">Level / Role</th>
<th class="p-4 pr-8 font-semibold text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100">
<?php if(isset($users) && count($users) > 0): ?>
<?php foreach($users as $u): ?>
<tr class="hover:bg-slate-50/80 transition">
<td class="p-4 pl-8">
<div class="flex items-center space-x-3">
<div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
<?= strtoupper(substr($u['fullname'], 0, 1)) ?>
</div>
<div>
<p class="font-bold text-slate-800 text-sm"><?= $u['fullname'] ?></p>
</div>
</div>
</td>
<td class="p-4 text-slate-600 text-sm font-medium"><?= $u['username'] ?></td>
<td class="p-4">
<span class="px-3 py-1 rounded-full text-xs font-bold tracking-wide bg-slate-100 text-slate-600 border border-slate-200">
<?= $u['level'] ?>
</span>
</td>
<td class="p-4 pr-8 text-right">
<button class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition"><i class="bi bi-pencil-square"></i></button>
<button class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition ml-1"><i class="bi bi-trash"></i></button>
</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr><td colspan="4" class="p-8 text-center text-slate-500">Belum ada data user.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
<div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-transition.opacity>
<div @click.away="addModal = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden" x-transition.scale.origin.bottom>
<div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
<h3 class="text-lg font-bold text-slate-800">Tambah User Baru</h3>
<button @click="addModal = false" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg text-xl"></i></button>
</div>
<form action="<?= base_url('admin/users/save') ?>" method="post" enctype="multipart/form-data" class="p-6 space-y-4">
<div><label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label><input type="text" name="fullname" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"></div>
<div><label class="block text-sm font-semibold text-slate-700 mb-1">Username</label><input type="text" name="username" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"></div>
<div><label class="block text-sm font-semibold text-slate-700 mb-1">Password</label><input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"></div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-1">Level Akses</label>
<select name="level" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none bg-white">
<option value="STAFF">STAFF</option>
<option value="KEPALA UNIT">KEPALA UNIT</option>
<option value="SUPERVISOR">SUPERVISOR</option>
<option value="MANAGERIAL">MANAGERIAL</option>
<option value="PIMPINAN TINGGI">PIMPINAN TINGGI</option>
<option value="ADMIN">ADMIN</option>
</select>
</div>
<div class="pt-4 flex justify-end space-x-3 border-t border-slate-100 mt-6">
<button type="button" @click="addModal = false" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition">Batal</button>
<button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition">Simpan User</button>
</div>
</form>
</div>
</div>
<div x-show="importModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-transition.opacity>
<div @click.away="importModal = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden" x-transition.scale.origin.bottom>
<div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
<h3 class="text-lg font-bold text-slate-800">Import User dari Excel</h3>
<button @click="importModal = false" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg text-xl"></i></button>
</div>
<form action="<?= base_url('admin/users/import') ?>" method="post" enctype="multipart/form-data" class="p-6 space-y-4">
<div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50">
<i class="bi bi-file-earmark-spreadsheet text-4xl text-emerald-500 mb-3 block"></i>
<input type="file" name="excel_file" accept=".xlsx, .xls" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
</div>
<p class="text-xs text-slate-500 text-center">Format kolom: Nama Lengkap | Username | Password | Level</p>
<div class="pt-4">
<button type="submit" class="w-full px-5 py-3 text-sm font-bold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/30">Mulai Import</button>
</div>
</form>
</div>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\admin\user_crud.php", $adminUserCrudView, $utf8NoBom)


$leaderDashboardView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="space-y-6">
<div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden">
<div class="relative z-10">
<span class="inline-block px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs font-bold tracking-wider mb-4 border border-blue-500/30 uppercase"><?= session()->get('level') ?></span>
<h1 class="text-3xl sm:text-4xl font-extrabold mb-3 tracking-tight">Dashboard Approval</h1>
<p class="text-slate-300 text-lg max-w-2xl">Lakukan review dan persetujuan terhadap laporan yang diajukan oleh tim Anda.</p>
</div>
<i class="bi bi-ui-checks absolute -right-4 -bottom-10 text-[12rem] text-white/5 transform -rotate-12"></i>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center hover:shadow-md transition">
<div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center text-3xl mb-4"><i class="bi bi-clock-history"></i></div>
<h3 class="text-3xl font-black text-slate-800 mb-1">8</h3>
<p class="text-sm text-slate-500 font-medium">Menunggu Approval</p>
<a href="<?= base_url('leader/reports') ?>" class="mt-4 text-sm font-bold text-blue-600 hover:text-blue-800">Lihat Daftar &rarr;</a>
</div>
<div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center hover:shadow-md transition">
<div class="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center text-3xl mb-4"><i class="bi bi-check2-all"></i></div>
<h3 class="text-3xl font-black text-slate-800 mb-1">124</h3>
<p class="text-sm text-slate-500 font-medium">Total Disetujui</p>
</div>
<div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center hover:shadow-md transition">
<div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center text-3xl mb-4"><i class="bi bi-x-octagon"></i></div>
<h3 class="text-3xl font-black text-slate-800 mb-1">3</h3>
<p class="text-sm text-slate-500 font-medium">Laporan Ditolak</p>
</div>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\leader\dashboard.php", $leaderDashboardView, $utf8NoBom)

$leaderReportListView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
<div>
<h2 class="text-2xl font-bold text-slate-800">Daftar Laporan</h2>
<p class="text-slate-500 text-sm mt-1">Laporan yang membutuhkan review dan persetujuan Anda</p>
</div>
<i class="bi bi-inboxes text-3xl text-blue-500"></i>
</div>
<div class="p-0 overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider">
<th class="p-4 pl-8 font-semibold">Jenis Laporan</th>
<th class="p-4 font-semibold">Judul / Pengaju</th>
<th class="p-4 font-semibold">Tanggal Diajukan</th>
<th class="p-4 font-semibold text-center">Status</th>
<th class="p-4 pr-8 font-semibold text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100">
<tr class="hover:bg-slate-50/80 transition">
<td class="p-4 pl-8">
<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">Audit Bond</span>
</td>
<td class="p-4">
<p class="font-bold text-slate-800 text-sm">Laporan Audit Q3 2024</p>
<p class="text-xs text-slate-500 mt-0.5"><i class="bi bi-person mr-1"></i> Budi Staff IT</p>
</td>
<td class="p-4 text-sm text-slate-600">12 Okt 2024 14:30</td>
<td class="p-4 text-center">
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">Menunggu Review</span>
</td>
<td class="p-4 pr-8 text-right space-x-2">
<button class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-lg transition shadow-md shadow-blue-500/20">Detail & Action</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<?= $this->include('leader/modal_reject') ?>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\leader\report_list.php", $leaderReportListView, $utf8NoBom)

$leaderReportDetailView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
<div>
<div class="flex items-center space-x-3 mb-2">
<a href="<?= base_url('leader/reports') ?>" class="text-slate-400 hover:text-blue-600 transition"><i class="bi bi-arrow-left-circle-fill text-xl"></i></a>
<span class="px-2.5 py-1 rounded-md text-xs font-bold tracking-wide bg-blue-100 text-blue-700 border border-blue-200">Audit Bond</span>
</div>
<h2 class="text-2xl font-bold text-slate-800">Laporan Audit Q3 2024</h2>
</div>
<a href="<?= base_url('leader/print-pdf/1') ?>" target="_blank" class="px-4 py-2 bg-slate-800 text-white text-sm font-semibold rounded-xl hover:bg-slate-900 transition flex items-center shadow-lg">
<i class="bi bi-printer mr-2"></i> Cetak PDF
</a>
</div>
<div class="p-6 sm:p-8">
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="md:col-span-2 space-y-6">
<div>
<h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Deskripsi Laporan</h4>
<div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 text-sm text-slate-700 leading-relaxed">
Ini adalah deskripsi laporan yang diajukan oleh staff. Menjelaskan detail audit pada kuartal ketiga tahun 2024 sesuai dengan standar GRC yang berlaku.
</div>
</div>
<div>
<h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Dokumen Eviden</h4>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<a href="#" class="flex items-center p-3 border border-slate-200 rounded-xl hover:border-blue-400 hover:bg-blue-50 transition group">
<i class="bi bi-file-earmark-pdf text-2xl text-red-500 mr-3"></i>
<div class="overflow-hidden">
<p class="text-sm font-semibold text-slate-700 group-hover:text-blue-700 truncate">Dokumen_Pendukung.pdf</p>
<p class="text-xs text-slate-500">Lihat Dokumen</p>
</div>
</a>
</div>
</div>
</div>
<div>
<div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 mb-6">
<h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Informasi Pengaju</h4>
<div class="flex items-center space-x-3 mb-4">
<div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 text-lg"><i class="bi bi-person-fill"></i></div>
<div>
<p class="text-sm font-bold text-slate-800">Budi Santoso</p>
<p class="text-xs text-slate-500">STAFF</p>
</div>
</div>
<div class="text-sm space-y-2">
<div class="flex justify-between"><span class="text-slate-500">Tanggal:</span><span class="font-semibold text-slate-700">12 Okt 2024</span></div>
<div class="flex justify-between"><span class="text-slate-500">Status Saat Ini:</span><span class="font-bold text-amber-600">PROSES KEPALA UNIT</span></div>
</div>
</div>
<div class="space-y-3">
<h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Aksi Approval</h4>
<a href="<?= base_url('leader/approve/1/audit_bonds') ?>" class="block w-full text-center px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl transition shadow-lg shadow-emerald-500/30">
<i class="bi bi-check-circle mr-2"></i> Setujui Laporan
</a>
<button onclick="openRejectModal('1', 'audit_bonds', '10')" class="w-full px-4 py-3 bg-red-50 hover:bg-red-100 text-red-600 font-bold border border-red-200 rounded-xl transition">
<i class="bi bi-x-circle mr-2"></i> Tolak Laporan
</button>
</div>
</div>
</div>
</div>
</div>
<?= $this->include('leader/modal_reject') ?>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\leader\report_detail.php", $leaderReportDetailView, $utf8NoBom)

$leaderModalRejectView = @'
<div id="rejectModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
<div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-95 opacity-0" id="rejectModalContent">
<form action="<?= base_url('leader/reject') ?>" method="post">
<div class="p-6 border-b border-slate-100 bg-red-50/50 flex justify-between items-center">
<h3 class="text-lg font-bold text-red-700 flex items-center"><i class="bi bi-exclamation-triangle-fill mr-2 text-red-500"></i> Tolak Laporan</h3>
<button type="button" onclick="closeRejectModal()" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
</div>
<div class="p-6 space-y-4">
<input type="hidden" name="report_id" id="reject_report_id">
<input type="hidden" name="report_type" id="reject_report_type">
<input type="hidden" name="staff_id" id="reject_staff_id">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Alasan Penolakan</label>
<textarea name="reason" rows="4" required placeholder="Tuliskan catatan perbaikan untuk staff..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition bg-slate-50 focus:bg-white text-sm"></textarea>
</div>
</div>
<div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end space-x-3">
<button type="button" onclick="closeRejectModal()" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-100 transition">Batal</button>
<button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-500/30">Konfirmasi Penolakan</button>
</div>
</form>
</div>
</div>
<script>
function openRejectModal(reportId, reportType, staffId) {
document.getElementById('reject_report_id').value = reportId;
document.getElementById('reject_report_type').value = reportType;
document.getElementById('reject_staff_id').value = staffId;
const modal = document.getElementById('rejectModal');
const content = document.getElementById('rejectModalContent');
modal.classList.remove('hidden');
modal.classList.add('flex');
setTimeout(() => {
content.classList.remove('scale-95', 'opacity-0');
content.classList.add('scale-100', 'opacity-100');
}, 10);
}
function closeRejectModal() {
const modal = document.getElementById('rejectModal');
const content = document.getElementById('rejectModalContent');
content.classList.remove('scale-100', 'opacity-100');
content.classList.add('scale-95', 'opacity-0');
setTimeout(() => {
modal.classList.add('hidden');
modal.classList.remove('flex');
}, 200);
}
</script>
'@
[System.IO.File]::WriteAllText("$appDir\Views\leader\modal_reject.php", $leaderModalRejectView, $utf8NoBom)

Compress-Archive -Path "$appDir" -DestinationPath "$patchDir.zip" -Force

Write-Host "================================================================" -ForegroundColor Green
Write-Host "BERHASIL!" -ForegroundColor Green
Write-Host "Folder 'app/Views/admin' & 'app/Views/leader' telah dibuat di dalam '$patchDir'"
Write-Host "File '$patchDir.zip' juga telah dibuat (DIJAMIN TANPA BOM/ERROR)."
Write-Host "Silakan ekstrak ZIP tersebut ke root project CI4 Anda."
Write-Host "================================================================" -ForegroundColor Green