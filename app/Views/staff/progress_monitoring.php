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