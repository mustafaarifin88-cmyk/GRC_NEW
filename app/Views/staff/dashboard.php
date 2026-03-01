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