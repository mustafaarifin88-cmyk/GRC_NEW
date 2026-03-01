<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
<div>
<h2 class="text-2xl font-bold text-slate-800">Profil Perusahaan</h2>
<p class="text-slate-500 text-sm mt-1">Kelola informasi identitas perusahaan</p>
</div>
<i class="bi bi-building text-3xl text-blue-500"></i>
</div>
<div class="p-6 sm:p-8">
<?php if(session()->getFlashdata('success')): ?>
<div class="bg-emerald-50 text-emerald-600 px-4 py-3 rounded-xl border border-emerald-200 mb-6 flex items-center">
<i class="bi bi-check-circle-fill mr-3"></i><?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>
<form action="<?= base_url('admin/company-profile/update') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<input type="hidden" name="id" value="<?= isset($profile) ? $profile['id'] : '' ?>">
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Nama Perusahaan</label>
<input type="text" name="company_name" value="<?= isset($profile) ? $profile['company_name'] : '' ?>" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Nama Pimpinan Utama</label>
<input type="text" name="leader_name" value="<?= isset($profile) ? $profile['leader_name'] : '' ?>" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
<textarea name="address" rows="3" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50 focus:bg-white"><?= isset($profile) ? $profile['address'] : '' ?></textarea>
</div>
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-slate-700 mb-2">Logo Perusahaan</label>
<?php if(isset($profile) && $profile['logo']): ?>
<div class="mb-4">
<img src="<?= base_url('uploads/company/' . $profile['logo']) ?>" class="h-20 object-contain rounded-lg border border-slate-200 p-2">
</div>
<?php endif; ?>
<input type="file" name="logo" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
<p class="text-xs text-slate-500 mt-2">Format: JPG, PNG. Maksimal 2MB.</p>
</div>
</div>
<div class="flex justify-end pt-4">
<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/30 flex items-center">
<i class="bi bi-save mr-2"></i> Simpan Perubahan
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>