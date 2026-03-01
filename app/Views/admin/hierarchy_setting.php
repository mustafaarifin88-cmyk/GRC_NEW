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