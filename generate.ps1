$patchDir = "Patch_Views_Risk_ThirdParty_Toast"
$appDir = "$patchDir\app"

New-Item -ItemType Directory -Force -Path "$appDir\Views\staff\internal_audit_grc" | Out-Null
New-Item -ItemType Directory -Force -Path "$appDir\Views\components" | Out-Null

$utf8NoBom = New-Object System.Text.UTF8Encoding($False)

$formRiskBondView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-gradient-to-r from-amber-500 to-orange-600 text-white flex items-center gap-4">
<div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl backdrop-blur-sm"><i class="bi bi-shield-exclamation"></i></div>
<div>
<h2 class="text-2xl font-bold">Form Risk Bond (GRC)</h2>
<p class="text-amber-100 text-sm mt-1">Identifikasi, analisis, dan mitigasi risiko operasional perusahaan.</p>
</div>
</div>
<div class="p-6 sm:p-8">
<form action="<?= base_url('staff/internal-audit-grc/risk-bond/save') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Judul Risiko <span class="text-red-500">*</span></label>
<input type="text" name="title" required placeholder="Contoh: Risiko Fluktuasi Nilai Tukar" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Analisis & Mitigasi Risiko <span class="text-red-500">*</span></label>
<textarea name="description" rows="5" required placeholder="Jelaskan detail risiko, dampaknya, dan rencana mitigasi yang akan dilakukan..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition bg-slate-50 focus:bg-white"></textarea>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Upload Dokumen Penilaian Risiko <span class="text-red-500">*</span></label>
<div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition relative">
<i class="bi bi-file-earmark-bar-graph text-4xl text-amber-500 mb-3 block"></i>
<p class="text-sm font-semibold text-slate-700 mb-1">Pilih File atau Tarik ke sini</p>
<p class="text-xs text-slate-500 mb-4">Format: PDF, DOCX, XLSX (Maks. 5MB)</p>
<input type="file" name="file_evidence" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
<span class="px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-lg shadow-sm">Browse Files</span>
</div>
</div>
<div class="flex justify-end pt-6 border-t border-slate-100 gap-3">
<a href="<?= base_url('staff/dashboard') ?>" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</a>
<button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-amber-500/30 flex items-center">
<i class="bi bi-send-fill mr-2"></i> Submit Risk
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>
'@

$formThirdPartyBondView = @'
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-gradient-to-r from-violet-600 to-purple-700 text-white flex items-center gap-4">
<div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl backdrop-blur-sm"><i class="bi bi-buildings"></i></div>
<div>
<h2 class="text-2xl font-bold">Form Third Party Bond</h2>
<p class="text-violet-100 text-sm mt-1">Evaluasi vendor, manajemen kontrak, dan pengelolaan risiko pihak ketiga.</p>
</div>
</div>
<div class="p-6 sm:p-8">
<form action="<?= base_url('staff/internal-audit-grc/third-party-bond/save') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Nama Vendor / Pihak Ketiga <span class="text-red-500">*</span></label>
<input type="text" name="title" required placeholder="Contoh: PT Teknologi Nusantara (Penyedia Cloud)" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-violet-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Evaluasi Kinerja & Risiko <span class="text-red-500">*</span></label>
<textarea name="description" rows="5" required placeholder="Jelaskan detail evaluasi SLA, kepatuhan keamanan, atau masalah yang ditemukan..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-violet-500 outline-none transition bg-slate-50 focus:bg-white"></textarea>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Upload Kontrak / Laporan SLA <span class="text-red-500">*</span></label>
<div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition relative">
<i class="bi bi-file-earmark-text text-4xl text-violet-500 mb-3 block"></i>
<p class="text-sm font-semibold text-slate-700 mb-1">Pilih File atau Tarik ke sini</p>
<p class="text-xs text-slate-500 mb-4">Format: PDF, DOCX, ZIP (Maks. 5MB)</p>
<input type="file" name="file_evidence" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
<span class="px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-lg shadow-sm">Browse Files</span>
</div>
</div>
<div class="flex justify-end pt-6 border-t border-slate-100 gap-3">
<a href="<?= base_url('staff/dashboard') ?>" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</a>
<button type="submit" class="bg-violet-600 hover:bg-violet-700 text-white font-bold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-violet-500/30 flex items-center">
<i class="bi bi-send-fill mr-2"></i> Submit Third Party
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>
'@

$notificationToastView = @'
<?php if (session()->getFlashdata('success') || session()->getFlashdata('error')) : ?>
<div id="toast-notification" class="fixed top-6 right-6 z-50 flex flex-col gap-3 transition-all duration-300 transform translate-x-0 opacity-100">
<?php if (session()->getFlashdata('success')) : ?>
<div class="bg-white border-l-4 border-emerald-500 shadow-xl rounded-xl p-4 flex items-start gap-4 max-w-sm w-full">
<div class="text-emerald-500 bg-emerald-50 p-2 rounded-lg"><i class="bi bi-check-circle-fill text-xl"></i></div>
<div class="flex-1">
<h3 class="text-sm font-bold text-slate-800">Berhasil!</h3>
<p class="text-sm text-slate-500 mt-0.5"><?= session()->getFlashdata('success') ?></p>
</div>
<button onclick="document.getElementById('toast-notification').remove()" class="text-slate-400 hover:text-slate-600 transition"><i class="bi bi-x-lg"></i></button>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
<div class="bg-white border-l-4 border-red-500 shadow-xl rounded-xl p-4 flex items-start gap-4 max-w-sm w-full">
<div class="text-red-500 bg-red-50 p-2 rounded-lg"><i class="bi bi-exclamation-triangle-fill text-xl"></i></div>
<div class="flex-1">
<h3 class="text-sm font-bold text-slate-800">Terjadi Kesalahan!</h3>
<p class="text-sm text-slate-500 mt-0.5"><?= session()->getFlashdata('error') ?></p>
</div>
<button onclick="document.getElementById('toast-notification').remove()" class="text-slate-400 hover:text-slate-600 transition"><i class="bi bi-x-lg"></i></button>
</div>
<?php endif; ?>
</div>
<script>
setTimeout(() => {
const toast = document.getElementById('toast-notification');
if(toast) {
toast.classList.remove('translate-x-0', 'opacity-100');
toast.classList.add('translate-x-full', 'opacity-0');
setTimeout(() => toast.remove(), 300);
}
}, 5000);
</script>
<?php endif; ?>
'@

[System.IO.File]::WriteAllText("$appDir\Views\staff\internal_audit_grc\form_risk_bond.php", $formRiskBondView, $utf8NoBom)
[System.IO.File]::WriteAllText("$appDir\Views\staff\internal_audit_grc\form_third_party_bond.php", $formThirdPartyBondView, $utf8NoBom)
[System.IO.File]::WriteAllText("$appDir\Views\components\notification_toast.php", $notificationToastView, $utf8NoBom)

Compress-Archive -Path "$appDir" -DestinationPath "$patchDir.zip" -Force

Write-Host "================================================================" -ForegroundColor Green
Write-Host "BERHASIL!" -ForegroundColor Green
Write-Host "File form_risk_bond.php, form_third_party_bond.php, dan komponen notification_toast.php telah dibuat."
Write-Host "Folder siap diekstrak dari '$patchDir.zip'."
Write-Host "================================================================" -ForegroundColor Green