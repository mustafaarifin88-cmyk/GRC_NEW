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