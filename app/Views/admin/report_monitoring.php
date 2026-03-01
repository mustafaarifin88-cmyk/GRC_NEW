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