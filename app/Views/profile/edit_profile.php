<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
<div>
<h2 class="text-2xl font-bold text-slate-800">Edit Profil</h2>
<p class="text-slate-500 text-sm mt-1">Perbarui informasi akun dan kata sandi Anda</p>
</div>
<i class="bi bi-person-badge text-3xl text-blue-500"></i>
</div>
<div class="p-6 sm:p-8">
<?php if(session()->getFlashdata('success')): ?>
<div class="bg-emerald-50 text-emerald-600 px-4 py-3 rounded-xl border border-emerald-200 mb-6 flex items-center">
<i class="bi bi-check-circle-fill mr-3"></i><?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>
<form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
<div class="flex flex-col sm:flex-row gap-8">
<div class="w-full sm:w-1/3 flex flex-col items-center space-y-4">
<div class="relative group">
<div class="w-40 h-40 rounded-full border-4 border-slate-100 shadow-lg overflow-hidden bg-slate-50 flex items-center justify-center">
<?php if(session()->get('photo')): ?>
<img src="<?= base_url('uploads/users/' . session()->get('photo')) ?>" class="w-full h-full object-cover">
<?php else: ?>
<i class="bi bi-person-fill text-6xl text-slate-300"></i>
<?php endif; ?>
</div>
<div class="absolute inset-0 bg-slate-900/50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
<span class="text-white text-sm font-semibold"><i class="bi bi-camera fill mr-1"></i> Ubah Foto</span>
</div>
<input type="file" name="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
</div>
<p class="text-xs text-slate-500 text-center">Format: JPG, PNG. Max 2MB.</p>
</div>
<div class="w-full sm:w-2/3 space-y-5">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
<input type="text" name="fullname" value="<?= session()->get('fullname') ?>" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
<input type="text" name="username" value="<?= session()->get('username') ?>" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
<div class="pt-4 border-t border-slate-100">
<h4 class="text-sm font-bold text-slate-800 mb-4">Ubah Kata Sandi <span class="text-xs text-slate-400 font-normal">(Kosongkan jika tidak ingin mengubah)</span></h4>
<div class="space-y-4">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi Baru</label>
<input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50 focus:bg-white">
</div>
</div>
</div>
</div>
</div>
<div class="flex justify-end pt-6 border-t border-slate-100">
<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg shadow-blue-500/30 flex items-center">
<i class="bi bi-save mr-2"></i> Simpan Profil
</button>
</div>
</form>
</div>
</div>
<?= $this->endSection() ?>