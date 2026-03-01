<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div x-data="{ addModal: false, importModal: false }" class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
<div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
<div>
<h2 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h2>
<p class="text-slate-500 text-sm mt-1">Kelola data user dan hak akses sistem</p>
</div>
<div class="flex space-x-3">
<button @click="importModal = true" class="px-4 py-2 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-xl hover:bg-emerald-100 font-semibold text-sm transition flex items-center">
<i class="bi bi-file-earmark-excel mr-2"></i> Import Excel
</button>
<button @click="addModal = true" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-semibold text-sm transition flex items-center shadow-lg shadow-blue-500/30">
<i class="bi bi-plus-lg mr-2"></i> Tambah User
</button>
</div>
</div>
<div class="p-0 overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-sm uppercase tracking-wider">
<th class="p-4 pl-8 font-semibold">User</th>
<th class="p-4 font-semibold">Username</th>
<th class="p-4 font-semibold">Level / Role</th>
<th class="p-4 pr-8 font-semibold text-right">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100">
<?php if(isset($users) && count($users) > 0): ?>
<?php foreach($users as $u): ?>
<tr class="hover:bg-slate-50/80 transition">
<td class="p-4 pl-8">
<div class="flex items-center space-x-3">
<div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
<?= strtoupper(substr($u['fullname'], 0, 1)) ?>
</div>
<div>
<p class="font-bold text-slate-800 text-sm"><?= $u['fullname'] ?></p>
</div>
</div>
</td>
<td class="p-4 text-slate-600 text-sm font-medium"><?= $u['username'] ?></td>
<td class="p-4">
<span class="px-3 py-1 rounded-full text-xs font-bold tracking-wide bg-slate-100 text-slate-600 border border-slate-200">
<?= $u['level'] ?>
</span>
</td>
<td class="p-4 pr-8 text-right">
<button class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition"><i class="bi bi-pencil-square"></i></button>
<button class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition ml-1"><i class="bi bi-trash"></i></button>
</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr><td colspan="4" class="p-8 text-center text-slate-500">Belum ada data user.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
<div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-transition.opacity>
<div @click.away="addModal = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden" x-transition.scale.origin.bottom>
<div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
<h3 class="text-lg font-bold text-slate-800">Tambah User Baru</h3>
<button @click="addModal = false" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg text-xl"></i></button>
</div>
<form action="<?= base_url('admin/users/save') ?>" method="post" enctype="multipart/form-data" class="p-6 space-y-4">
<div><label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label><input type="text" name="fullname" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"></div>
<div><label class="block text-sm font-semibold text-slate-700 mb-1">Username</label><input type="text" name="username" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"></div>
<div><label class="block text-sm font-semibold text-slate-700 mb-1">Password</label><input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none"></div>
<div>
<label class="block text-sm font-semibold text-slate-700 mb-1">Level Akses</label>
<select name="level" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none bg-white">
<option value="STAFF">STAFF</option>
<option value="KEPALA UNIT">KEPALA UNIT</option>
<option value="SUPERVISOR">SUPERVISOR</option>
<option value="MANAGERIAL">MANAGERIAL</option>
<option value="PIMPINAN TINGGI">PIMPINAN TINGGI</option>
<option value="ADMIN">ADMIN</option>
</select>
</div>
<div class="pt-4 flex justify-end space-x-3 border-t border-slate-100 mt-6">
<button type="button" @click="addModal = false" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition">Batal</button>
<button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition">Simpan User</button>
</div>
</form>
</div>
</div>
<div x-show="importModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-transition.opacity>
<div @click.away="importModal = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden" x-transition.scale.origin.bottom>
<div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
<h3 class="text-lg font-bold text-slate-800">Import User dari Excel</h3>
<button @click="importModal = false" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg text-xl"></i></button>
</div>
<form action="<?= base_url('admin/users/import') ?>" method="post" enctype="multipart/form-data" class="p-6 space-y-4">
<div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50">
<i class="bi bi-file-earmark-spreadsheet text-4xl text-emerald-500 mb-3 block"></i>
<input type="file" name="excel_file" accept=".xlsx, .xls" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
</div>
<p class="text-xs text-slate-500 text-center">Format kolom: Nama Lengkap | Username | Password | Level</p>
<div class="pt-4">
<button type="submit" class="w-full px-5 py-3 text-sm font-bold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/30">Mulai Import</button>
</div>
</form>
</div>
</div>
</div>
<?= $this->endSection() ?>