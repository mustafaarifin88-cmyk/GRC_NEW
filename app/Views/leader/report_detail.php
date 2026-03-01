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