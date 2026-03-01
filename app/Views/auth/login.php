<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - GRC System</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 p-8 sm:p-10 rounded-3xl shadow-2xl relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-400 to-purple-500"></div>
<div class="text-center mb-8">
<div class="w-16 h-16 bg-blue-500 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-500/30 transform rotate-3">
<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 -rotate-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
</div>
<h1 class="text-3xl font-bold text-white tracking-tight">GRC System</h1>
<p class="text-slate-300 mt-2 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
</div>
<?php if (session()->getFlashdata('error')) : ?>
<div class="bg-red-500/20 border border-red-500/50 text-red-100 px-4 py-3 rounded-xl mb-6 text-sm flex items-center">
<svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
<?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>
<form action="<?= base_url('/process-login') ?>" method="post" class="space-y-5">
<div>
<label class="block text-sm font-medium text-slate-300 mb-1.5 ml-1">Username</label>
<input type="text" name="username" required class="w-full px-4 py-3.5 rounded-xl bg-slate-900/50 border border-slate-600 text-white placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400 transition shadow-inner">
</div>
<div>
<label class="block text-sm font-medium text-slate-300 mb-1.5 ml-1">Password</label>
<input type="password" name="password" required class="w-full px-4 py-3.5 rounded-xl bg-slate-900/50 border border-slate-600 text-white placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400 transition shadow-inner">
</div>
<button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-3.5 px-4 rounded-xl transition duration-300 transform hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/25 active:translate-y-0">
Masuk Sekarang
</button>
</form>
</div>
</body>
</html>