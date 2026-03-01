<?php
helper('grc');
$level = session()->get('level');
$menuItems = generate_sidebar_menu($level);
$gradient = get_sidebar_gradient($level);
?>
<aside id="sidebar" class="<?= $gradient ?> text-white w-72 min-h-screen fixed left-0 top-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50 flex flex-col shadow-2xl">
<div class="p-6 flex items-center justify-between border-b border-white/10 relative overflow-hidden">
<div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
<div class="flex items-center space-x-3 relative z-10">
<div class="w-8 h-8 bg-white text-blue-600 rounded-lg flex items-center justify-center font-bold text-xl">G</div>
<h2 class="text-xl font-bold tracking-widest uppercase">GRC Hub</h2>
</div>
<button id="closeSidebar" class="md:hidden p-2 text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition">
<i class="bi bi-x-lg"></i>
</button>
</div>
<div class="p-6 border-b border-white/10 flex items-center space-x-4 bg-black/5">
<div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center overflow-hidden border border-white/30 shadow-inner flex-shrink-0">
<?php if(session()->get('photo')): ?>
<img src="<?= base_url('uploads/profiles/' . session()->get('photo')) ?>" alt="Profile" class="w-full h-full object-cover">
<?php else: ?>
<i class="bi bi-person-fill text-2xl"></i>
<?php endif; ?>
</div>
<div class="overflow-hidden">
<p class="text-sm font-bold truncate text-white"><?= session()->get('fullname') ?></p>
<span class="inline-block mt-1 px-2.5 py-0.5 text-[10px] font-semibold tracking-wider text-blue-900 bg-blue-100 rounded-full uppercase">
<?= $level ?>
</span>
</div>
</div>
<nav class="flex-1 overflow-y-auto py-6 custom-scrollbar">
<ul class="space-y-1.5 px-4">
<?php foreach ($menuItems as $item) : ?>
<?php if (isset($item['submenu'])) : ?>
<li class="relative" x-data="{ open: false }">
<button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl hover:bg-white/15 transition duration-200 group">
<div class="flex items-center space-x-3.5">
<i class="<?= $item['icon'] ?> text-lg text-white/70 group-hover:text-white transition"></i>
<span><?= $item['title'] ?></span>
</div>
<i class="bi bi-chevron-down text-[10px] transition-transform duration-300" :class="{'rotate-180': open}"></i>
</button>
<ul x-show="open" x-collapse.duration.300ms class="mt-1 space-y-1 pl-12 pr-2 pb-2">
<?php foreach ($item['submenu'] as $sub) : ?>
<li>
<a href="<?= base_url($sub['url']) ?>" class="block px-3 py-2 text-sm text-white/70 hover:text-white hover:bg-white/10 rounded-lg transition duration-200 relative before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-1.5 before:h-1.5 before:bg-white/30 hover:before:bg-white before:rounded-full">
<?= $sub['title'] ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</li>
<?php else : ?>
<li>
<a href="<?= base_url($item['url']) ?>" class="flex items-center space-x-3.5 px-4 py-3 text-sm font-medium rounded-xl hover:bg-white/15 transition duration-200 group">
<i class="<?= $item['icon'] ?> text-lg text-white/70 group-hover:text-white transition"></i>
<span><?= $item['title'] ?></span>
</a>
</li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
</nav>
<div class="p-5 border-t border-white/10 bg-black/10">
<a href="<?= base_url('/logout') ?>" class="flex items-center justify-center space-x-2 w-full px-4 py-3 text-sm font-bold rounded-xl bg-red-500/80 hover:bg-red-500 text-white shadow-lg shadow-red-500/20 transition duration-200 transform hover:-translate-y-0.5">
<i class="bi bi-power text-lg"></i>
<span>Logout System</span>
</a>
</div>
</aside>