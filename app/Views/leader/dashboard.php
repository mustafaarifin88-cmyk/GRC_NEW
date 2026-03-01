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