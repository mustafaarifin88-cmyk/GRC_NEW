<?php if (session()->getFlashdata('success') || session()->getFlashdata('error')) : ?>
<div id="toast-notification" class="fixed top-6 right-6 z-50 flex flex-col gap-3 transition-all duration-300 transform translate-x-0 opacity-100">
<?php if (session()->getFlashdata('success')) : ?>
<div class="bg-white border-l-4 border-emerald-500 shadow-xl rounded-xl p-4 flex items-start gap-4 max-w-sm w-full">
<div class="text-emerald-500 bg-emerald-50 p-2 rounded-lg"><i class="bi bi-check-circle-fill text-xl"></i></div>
<div class="flex-1">
<h3 class="text-sm font-bold text-slate-800">Berhasil!</h3>
<p class="text-sm text-slate-500 mt-0.5"><?= session()->getFlashdata('success') ?></p>
</div>
<button onclick="document.getElementById('toast-notification').remove()" class="text-slate-400 hover:text-slate-600 transition"><i class="bi bi-x-lg"></i></button>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
<div class="bg-white border-l-4 border-red-500 shadow-xl rounded-xl p-4 flex items-start gap-4 max-w-sm w-full">
<div class="text-red-500 bg-red-50 p-2 rounded-lg"><i class="bi bi-exclamation-triangle-fill text-xl"></i></div>
<div class="flex-1">
<h3 class="text-sm font-bold text-slate-800">Terjadi Kesalahan!</h3>
<p class="text-sm text-slate-500 mt-0.5"><?= session()->getFlashdata('error') ?></p>
</div>
<button onclick="document.getElementById('toast-notification').remove()" class="text-slate-400 hover:text-slate-600 transition"><i class="bi bi-x-lg"></i></button>
</div>
<?php endif; ?>
</div>
<script>
setTimeout(() => {
const toast = document.getElementById('toast-notification');
if(toast) {
toast.classList.remove('translate-x-0', 'opacity-100');
toast.classList.add('translate-x-full', 'opacity-0');
setTimeout(() => toast.remove(), 300);
}
}, 5000);
</script>
<?php endif; ?>