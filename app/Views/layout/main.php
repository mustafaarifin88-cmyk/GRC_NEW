<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GRC System Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.13.3/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
body { font-family: 'Inter', sans-serif; }
[x-cloak] { display: none !important; }
.custom-scrollbar::-webkit-scrollbar { width: 6px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); border-radius: 10px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.4); }
</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden selection:bg-blue-200 selection:text-blue-900">
<?= $this->include('layout/sidebar') ?>
<div id="mainContent" class="md:ml-72 min-h-screen flex flex-col transition-all duration-300">
<?= $this->include('layout/header') ?>
<main class="flex-1 p-4 sm:p-6 lg:p-8 w-full max-w-7xl mx-auto">
<div class="animate-[fadeIn_0.5s_ease-out]">
<?= $this->renderSection('content') ?>
</div>
</main>
<footer class="py-6 px-4 md:px-8 border-t border-slate-200 bg-white/50 backdrop-blur-sm mt-auto">
<div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500 font-medium">
<p>&copy; <?= date('Y') ?> <span class="text-blue-600 font-bold">GRC Hub</span>. All rights reserved.</p>
<p>Developed with <i class="bi bi-heart-fill text-red-500 mx-1"></i> for Enterprise</p>
</div>
</footer>
</div>
<div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden md:hidden transition-opacity opacity-0 duration-300"></div>
<script>
const sidebar = document.getElementById('sidebar');
const openBtn = document.getElementById('openSidebar');
const closeBtn = document.getElementById('closeSidebar');
const overlay = document.getElementById('sidebarOverlay');
function toggleSidebar() {
const isClosed = sidebar.classList.contains('-translate-x-full');
if (isClosed) {
sidebar.classList.remove('-translate-x-full');
overlay.classList.remove('hidden');
setTimeout(() => overlay.classList.remove('opacity-0'), 10);
} else {
sidebar.classList.add('-translate-x-full');
overlay.classList.add('opacity-0');
setTimeout(() => overlay.classList.add('hidden'), 300);
}
}
if(openBtn) openBtn.addEventListener('click', toggleSidebar);
if(closeBtn) closeBtn.addEventListener('click', toggleSidebar);
if(overlay) overlay.addEventListener('click', toggleSidebar);
</script>
</body>
</html>