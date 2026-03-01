$patchDir = "Patch_Views_Staff_Profile_CI4"
$appDir = "$patchDir\app"

New-Item -ItemType Directory -Force -Path "$appDir\Views\profile" | Out-Null
New-Item -ItemType Directory -Force -Path "$appDir\Views\staff" | Out-Null
New-Item -ItemType Directory -Force -Path "$appDir\Views\staff\data_audit" | Out-Null

$utf8NoBom = New-Object System.Text.UTF8Encoding($False)

$editProfileView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
<div>
<h2 class="text-2xl font-bold text-slate-800">Edit Profil</h2>
<p class="text-slate-500 text-sm mt-1">Perbarui informasi akun dan kata sandi Anda</p>
</div>
<i class="bi bi-person-badge text-3xl text-blue-500"></i>
</div>
<div class="p-6 sm:p-8">
<?php if(session()->getFlashdata('success')): ?>
<div class="bg-emerald-50 text-emerald-600 px-4 py-3 rounded-xl border border-emerald-200 mb-6 flex items-center">
<i class="bi bi-check-circle-fill mr-3"></i><?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>
<form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<div class="flex flex-col sm:flex-row gap-8">
<div class="w-full sm:w-1/3 flex flex-col items-center space-y-4">
<div class="relative group">
<div class="w-40 h-40 rounded-full border-4 border-slate-100 shadow-lg overflow-hidden bg-slate-50 flex items-center justify-center">
<?php if(session()->get('photo')): ?>
<img src="<?= base_url('uploads/users/' . session()->get('photo')) ?>" class="w-full h-full object-cover">
<?php else: ?>
<i class="bi bi-person-fill text-6xl text-slate-300"></i>
<?php endif; ?>
</div>
<div class="absolute inset-0 bg-slate-900/50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
<span class="text-white text-sm font-semibold"><i class="bi bi-camera fill mr-1"></i> Ubah Foto</span>
</div>
<input type="file" name="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
</div>
<p class="text-xs text-slate-500 text-center">Format: JPG, PNG. Max 2MB.</p>
</div>
<div class="w-full sm:w-2/3 space-y-5">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
<input type="text" name="fullname" value="<?= session()->get('fullname') ?>" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
<input type="text" name="username" value="<?= session()->get('username') ?>" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div class="pt-4 border-t border-slate-100">
<h4 class="text-sm font-bold text-slate-800 mb-4">Ubah Kata Sandi <span class="text-xs text-slate-400 font-normal">(Kosongkan jika tidak ingin mengubah)</span></h4>
<div class="space-y-4">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi Baru</label>
<input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
</div>
</div>
</div>
</div>
<div class="flex justify-end pt-6 border-t border-slate-100">
<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/30 flex items-center">
<i class="bi bi-save mr-2"></i> Simpan Profil
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\profile\edit_profile.php", $editProfileView, $utf8NoBom)


$staffDashboardView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="space-y-6">
<div class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden">
<div class="relative z-10">
<span class="inline-block px-3 py-1 bg-white/20 text-white rounded-full text-xs font-bold tracking-wider mb-4 border border-white/30 uppercase">Dashboard Staff</span>
<h1 class="text-3xl sm:text-4xl font-extrabold mb-3 tracking-tight">Halo, <?= session()->get('fullname') ?>!</h1>
<p class="text-blue-100 text-lg max-w-2xl">Mulai buat laporan audit, insiden, atau pantau status laporan yang telah Anda ajukan.</p>
</div>
<i class="bi bi-journal-text absolute -right-4 -bottom-10 text-[12rem] text-white/10 transform -rotate-12"></i>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<a href="<?= base_url('staff/audit-bond') ?>" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col items-center text-center hover:shadow-md hover:border-blue-200 transition group cursor-pointer">
<div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform"><i class="bi bi-shield-check"></i></div>
<h3 class="font-bold text-slate-800">Buat Audit Bond</h3>
<p class="text-xs text-slate-500 mt-1">Input data laporan audit baru</p>
</a>
<a href="<?= base_url('staff/incident-report') ?>" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col items-center text-center hover:shadow-md hover:border-red-200 transition group cursor-pointer">
<div class="w-14 h-14 bg-red-50 text-red-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform"><i class="bi bi-exclamation-triangle"></i></div>
<h3 class="font-bold text-slate-800">Lapor Insiden</h3>
<p class="text-xs text-slate-500 mt-1">Buat laporan insiden terbaru</p>
</a>
<a href="<?= base_url('staff/compliance-bond') ?>" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col items-center text-center hover:shadow-md hover:border-emerald-200 transition group cursor-pointer">
<div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform"><i class="bi bi-clipboard-check"></i></div>
<h3 class="font-bold text-slate-800">Compliance Bond</h3>
<p class="text-xs text-slate-500 mt-1">Input laporan kepatuhan</p>
</a>
<a href="<?= base_url('staff/risk-bond') ?>" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col items-center text-center hover:shadow-md hover:border-amber-200 transition group cursor-pointer">
<div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform"><i class="bi bi-lightning-charge"></i></div>
<h3 class="font-bold text-slate-800">Risk Bond</h3>
<p class="text-xs text-slate-500 mt-1">Input laporan manajemen risiko</p>
</a>
</div>
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden mt-6">
<div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
<h3 class="text-lg font-bold text-slate-800">Status Laporan Terakhir Anda</h3>
<a href="<?= base_url('staff/monitoring') ?>" class="text-sm font-bold text-blue-600 hover:text-blue-800">Lihat Semua</a>
</div>
<div class="p-0 overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-slate-50 border-b border-slate-100 text-xs text-slate-500 uppercase">
<tr>
<th class="p-4 pl-6 font-semibold">Jenis</th>
<th class="p-4 font-semibold">Judul Laporan</th>
<th class="p-4 font-semibold">Tanggal</th>
<th class="p-4 font-semibold">Status</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100 text-sm">
<tr class="hover:bg-slate-50 transition">
<td class="p-4 pl-6"><span class="px-2 py-1 bg-slate-100 text-slate-600 rounded-md font-bold text-xs">Audit Bond</span></td>
<td class="p-4 font-semibold text-slate-800">Laporan Kuartal 3</td>
<td class="p-4 text-slate-500">12 Okt 2024</td>
<td class="p-4"><span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold">PROSES KEPALA UNIT</span></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\staff\dashboard.php", $staffDashboardView, $utf8NoBom)


$staffProgressMonitoringView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
<div>
<h2 class="text-2xl font-bold text-slate-800">Monitoring Progress</h2>
<p class="text-slate-500 text-sm mt-1">Pantau status persetujuan laporan yang telah Anda ajukan</p>
</div>
<div class="flex space-x-2">
<select class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
<option value="all">Semua Laporan</option>
<option value="audit_bonds">Audit Bonds</option>
<option value="incident_reports">Incident Reports</option>
</select>
</div>
</div>
<div class="p-0 overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider">
<th class="p-4 pl-8 font-semibold">Jenis Laporan</th>
<th class="p-4 font-semibold">Judul Laporan</th>
<th class="p-4 font-semibold">Tanggal Diajukan</th>
<th class="p-4 font-semibold">Posisi Approval</th>
<th class="p-4 font-semibold text-center">Status Final</th>
<th class="p-4 pr-8 font-semibold text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100">
<tr class="hover:bg-slate-50/80 transition group">
<td class="p-4 pl-8"><span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">Audit Bond</span></td>
<td class="p-4"><p class="font-bold text-slate-800 text-sm">Laporan Audit Internal 2024</p><p class="text-xs text-slate-500 mt-0.5 truncate max-w-xs">Audit operasional kuartal pertama</p></td>
<td class="p-4 text-sm text-slate-600">01 Okt 2024</td>
<td class="p-4">
<div class="flex items-center space-x-2">
<div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
<span class="text-sm font-bold text-slate-700">SUPERVISOR</span>
</div>
</td>
<td class="p-4 text-center"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">PROSES</span></td>
<td class="p-4 pr-8 text-right">
<button class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition" title="Lihat Detail"><i class="bi bi-eye-fill"></i></button>
</td>
</tr>
<tr class="hover:bg-slate-50/80 transition group">
<td class="p-4 pl-8"><span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-red-50 text-red-700 border border-red-200">Incident</span></td>
<td class="p-4"><p class="font-bold text-slate-800 text-sm">Server Down Terpusat</p><p class="text-xs text-slate-500 mt-0.5 truncate max-w-xs">Gangguan jaringan utama</p></td>
<td class="p-4 text-sm text-slate-600">28 Sep 2024</td>
<td class="p-4">
<div class="flex items-center space-x-2">
<div class="w-2 h-2 rounded-full bg-slate-300"></div>
<span class="text-sm font-bold text-slate-500">KEPALA UNIT</span>
</div>
</td>
<td class="p-4 text-center"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700"><i class="bi bi-x-circle mr-1"></i> REJECTED</span></td>
<td class="p-4 pr-8 text-right">
<button class="text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 p-2 rounded-lg transition" title="Revisi"><i class="bi bi-pencil-square"></i></button>
</td>
</tr>
<tr class="hover:bg-slate-50/80 transition group">
<td class="p-4 pl-8"><span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Compliance</span></td>
<td class="p-4"><p class="font-bold text-slate-800 text-sm">Laporan ISO 27001</p><p class="text-xs text-slate-500 mt-0.5 truncate max-w-xs">Kepatuhan standar keamanan data</p></td>
<td class="p-4 text-sm text-slate-600">15 Sep 2024</td>
<td class="p-4">
<div class="flex items-center space-x-2">
<div class="w-2 h-2 rounded-full bg-emerald-500"></div>
<span class="text-sm font-bold text-slate-700">SELESAI</span>
</div>
</td>
<td class="p-4 text-center"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700"><i class="bi bi-check-circle mr-1"></i> APPROVED</span></td>
<td class="p-4 pr-8 text-right">
<button class="text-slate-600 hover:text-slate-800 bg-slate-100 hover:bg-slate-200 p-2 rounded-lg transition" title="Detail"><i class="bi bi-eye-fill"></i></button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\staff\progress_monitoring.php", $staffProgressMonitoringView, $utf8NoBom)


$formAuditBondView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-gradient-to-r from-blue-600 to-indigo-600 text-white flex items-center gap-4">
<div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl backdrop-blur-sm"><i class="bi bi-shield-check"></i></div>
<div>
<h2 class="text-2xl font-bold">Form Audit Bond</h2>
<p class="text-blue-100 text-sm mt-1">Lengkapi data laporan audit di bawah ini dengan benar.</p>
</div>
</div>
<div class="p-6 sm:p-8">
<form action="<?= base_url('staff/audit-bond/save') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Judul Laporan Audit <span class="text-red-500">*</span></label>
<input type="text" name="title" required placeholder="Contoh: Laporan Audit Keuangan Q3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Lengkap <span class="text-red-500">*</span></label>
<textarea name="description" rows="5" required placeholder="Jelaskan detail audit secara komprehensif..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50 focus:bg-white"></textarea>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Upload Dokumen Eviden / Pendukung <span class="text-red-500">*</span></label>
<div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition relative">
<i class="bi bi-cloud-arrow-up text-4xl text-blue-500 mb-3 block"></i>
<p class="text-sm font-semibold text-slate-700 mb-1">Pilih File atau Tarik ke sini</p>
<p class="text-xs text-slate-500 mb-4">Format yang didukung: PDF, DOCX, XLSX, JPG, PNG (Maks. 5MB)</p>
<input type="file" name="file_evidence" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
<span class="px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-lg shadow-sm">Browse Files</span>
</div>
</div>
<div class="flex justify-end pt-6 border-t border-slate-100 gap-3">
<a href="<?= base_url('staff/dashboard') ?>" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</a>
<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/30 flex items-center">
<i class="bi bi-send-fill mr-2"></i> Ajukan Laporan
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\staff\data_audit\form_audit_bond.php", $formAuditBondView, $utf8NoBom)


$formIncidentReportView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-gradient-to-r from-red-600 to-rose-600 text-white flex items-center gap-4">
<div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl backdrop-blur-sm"><i class="bi bi-exclamation-triangle"></i></div>
<div>
<h2 class="text-2xl font-bold">Form Laporan Insiden</h2>
<p class="text-red-100 text-sm mt-1">Laporkan insiden atau masalah operasional yang terjadi.</p>
</div>
</div>
<div class="p-6 sm:p-8">
<form action="<?= base_url('staff/incident-report/save') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Judul Insiden <span class="text-red-500">*</span></label>
<input type="text" name="title" required placeholder="Contoh: Kegagalan Sistem Jaringan" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Kronologi / Deskripsi Insiden <span class="text-red-500">*</span></label>
<textarea name="description" rows="5" required placeholder="Jelaskan kronologi kejadian secara rinci..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition bg-slate-50 focus:bg-white"></textarea>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Upload Bukti Insiden <span class="text-red-500">*</span></label>
<div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition relative">
<i class="bi bi-camera text-4xl text-red-500 mb-3 block"></i>
<p class="text-sm font-semibold text-slate-700 mb-1">Pilih File atau Tarik ke sini</p>
<p class="text-xs text-slate-500 mb-4">Format: Foto (JPG/PNG), PDF, DOCX (Maks. 5MB)</p>
<input type="file" name="file_evidence" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
<span class="px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-lg shadow-sm">Browse Files</span>
</div>
</div>
<div class="flex justify-end pt-6 border-t border-slate-100 gap-3">
<a href="<?= base_url('staff/dashboard') ?>" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</a>
<button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-red-500/30 flex items-center">
<i class="bi bi-send-fill mr-2"></i> Laporkan Insiden
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\staff\data_audit\form_incident_report.php", $formIncidentReportView, $utf8NoBom)


$formComplianceBondView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-gradient-to-r from-emerald-600 to-teal-600 text-white flex items-center gap-4">
<div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl backdrop-blur-sm"><i class="bi bi-clipboard-check"></i></div>
<div>
<h2 class="text-2xl font-bold">Form Compliance Bond</h2>
<p class="text-emerald-100 text-sm mt-1">Input data laporan kepatuhan terhadap regulasi atau standar.</p>
</div>
</div>
<div class="p-6 sm:p-8">
<form action="<?= base_url('staff/compliance-bond/save') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Judul Laporan Kepatuhan <span class="text-red-500">*</span></label>
<input type="text" name="title" required placeholder="Contoh: Kepatuhan ISO 27001 Tahun 2024" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Detail Pemenuhan / Catatan <span class="text-red-500">*</span></label>
<textarea name="description" rows="5" required placeholder="Jelaskan detail pemenuhan standar..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition bg-slate-50 focus:bg-white"></textarea>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Upload Dokumen Sertifikat / Eviden <span class="text-red-500">*</span></label>
<div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition relative">
<i class="bi bi-cloud-check text-4xl text-emerald-500 mb-3 block"></i>
<p class="text-sm font-semibold text-slate-700 mb-1">Pilih File atau Tarik ke sini</p>
<p class="text-xs text-slate-500 mb-4">Format: PDF, ZIP, RAR (Maks. 5MB)</p>
<input type="file" name="file_evidence" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
<span class="px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-lg shadow-sm">Browse Files</span>
</div>
</div>
<div class="flex justify-end pt-6 border-t border-slate-100 gap-3">
<a href="<?= base_url('staff/dashboard') ?>" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</a>
<button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-emerald-500/30 flex items-center">
<i class="bi bi-send-fill mr-2"></i> Ajukan Kepatuhan
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\staff\data_audit\form_compliance_bond.php", $formComplianceBondView, $utf8NoBom)


$formRiskBondView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-gradient-to-r from-amber-500 to-orange-500 text-white flex items-center gap-4">
<div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl backdrop-blur-sm"><i class="bi bi-lightning-charge"></i></div>
<div>
<h2 class="text-2xl font-bold">Form Risk Bond</h2>
<p class="text-amber-100 text-sm mt-1">Identifikasi dan laporkan potensi risiko pada perusahaan.</p>
</div>
</div>
<div class="p-6 sm:p-8">
<form action="<?= base_url('staff/risk-bond/save') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Judul Risiko <span class="text-red-500">*</span></label>
<input type="text" name="title" required placeholder="Contoh: Risiko Fluktuasi Nilai Tukar" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Analisis Risiko & Mitigasi <span class="text-red-500">*</span></label>
<textarea name="description" rows="5" required placeholder="Jelaskan analisa dampak risiko dan rencana mitigasinya..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition bg-slate-50 focus:bg-white"></textarea>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Upload Dokumen Pendukung <span class="text-red-500">*</span></label>
<div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition relative">
<i class="bi bi-file-earmark-bar-graph text-4xl text-amber-500 mb-3 block"></i>
<p class="text-sm font-semibold text-slate-700 mb-1">Pilih File atau Tarik ke sini</p>
<p class="text-xs text-slate-500 mb-4">Format: PDF, Excel, Word (Maks. 5MB)</p>
<input type="file" name="file_evidence" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
<span class="px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-lg shadow-sm">Browse Files</span>
</div>
</div>
<div class="flex justify-end pt-6 border-t border-slate-100 gap-3">
<a href="<?= base_url('staff/dashboard') ?>" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</a>
<button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-amber-500/30 flex items-center">
<i class="bi bi-send-fill mr-2"></i> Ajukan Manajemen Risiko
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>
'@
[System.IO.File]::WriteAllText("$appDir\Views\staff\data_audit\form_risk_bond.php", $formRiskBondView, $utf8NoBom)


Compress-Archive -Path "$appDir" -DestinationPath "$patchDir.zip" -Force

Write-Host "================================================================" -ForegroundColor Green
Write-Host "BERHASIL!" -ForegroundColor Green
Write-Host "Folder views untuk Profile dan Staff telah dibuat di dalam '$patchDir'"
Write-Host "File '$patchDir.zip' juga telah dibuat (DIJAMIN TANPA BOM/ERROR)."
Write-Host "Silakan ekstrak ZIP tersebut ke root project CI4 Anda."
Write-Host "================================================================" -ForegroundColor Green