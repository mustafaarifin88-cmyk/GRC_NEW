<header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-200 sticky top-0 z-30">
<div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
<div class="flex items-center">
<button id="openSidebar" class="mr-4 md:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-900 transition focus:outline-none">
<i class="bi bi-list text-2xl leading-none"></i>
</button>
<h1 class="text-xl font-bold text-slate-800 hidden sm:block bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Dashboard Area</h1>
</div>
<div class="flex items-center space-x-3 sm:space-x-5">
<div class="relative">
<button class="p-2 text-slate-500 hover:bg-slate-100 hover:text-blue-600 rounded-full transition relative focus:outline-none">
<i class="bi bi-bell text-xl leading-none"></i>
<span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
</button>
</div>
<div class="flex items-center space-x-3 pl-3 sm:pl-5 border-l border-slate-200">
<div class="text-right hidden sm:block">
<p class="text-sm font-bold text-slate-700 leading-tight"><?= session()->get('fullname') ?></p>
<p class="text-xs font-medium text-blue-600"><?= session()->get('level') ?></p>
</div>
<a href="<?= base_url('/profile') ?>" class="block relative w-10 h-10 rounded-full bg-slate-200 border-2 border-white shadow-sm hover:ring-2 hover:ring-blue-400 hover:border-transparent transition overflow-hidden flex-shrink-0">
<?php if(session()->get('photo')): ?>
<img src="<?= base_url('uploads/profiles/' . session()->get('photo')) ?>" alt="Profile" class="w-full h-full object-cover">
<?php else: ?>
<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-600">
<i class="bi bi-person-fill text-lg"></i>
</div>
<?php endif; ?>
</a>
</div>
</div>
</div>
</header>