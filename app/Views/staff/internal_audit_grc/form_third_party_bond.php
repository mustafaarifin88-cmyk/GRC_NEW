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