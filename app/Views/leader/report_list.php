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