<div id="rejectModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
<div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-95 opacity-0" id="rejectModalContent">
<form action="<?= base_url('leader/reject') ?>" method="post">
<div class="p-6 border-b border-slate-100 bg-red-50/50 flex justify-between items-center">
<h3 class="text-lg font-bold text-red-700 flex items-center"><i class="bi bi-exclamation-triangle-fill mr-2 text-red-500"></i> Tolak Laporan</h3>
<button type="button" onclick="closeRejectModal()" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
</div>
<div class="p-6 space-y-4">
<input type="hidden" name="report_id" id="reject_report_id">
<input type="hidden" name="report_type" id="reject_report_type">
<input type="hidden" name="staff_id" id="reject_staff_id">
<div>
<label class="block text-sm font-semibold text-slate-700 mb-2">Alasan Penolakan</label>
<textarea name="reason" rows="4" required placeholder="Tuliskan catatan perbaikan untuk staff..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition bg-slate-50 focus:bg-white text-sm"></textarea>
</div>
</div>
<div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end space-x-3">
<button type="button" onclick="closeRejectModal()" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-100 transition">Batal</button>
<button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-500/30">Konfirmasi Penolakan</button>
</div>
</form>
</div>
</div>
<script>
function openRejectModal(reportId, reportType, staffId) {
document.getElementById('reject_report_id').value = reportId;
document.getElementById('reject_report_type').value = reportType;
document.getElementById('reject_staff_id').value = staffId;
const modal = document.getElementById('rejectModal');
const content = document.getElementById('rejectModalContent');
modal.classList.remove('hidden');
modal.classList.add('flex');
setTimeout(() => {
content.classList.remove('scale-95', 'opacity-0');
content.classList.add('scale-100', 'opacity-100');
}, 10);
}
function closeRejectModal() {
const modal = document.getElementById('rejectModal');
const content = document.getElementById('rejectModalContent');
content.classList.remove('scale-100', 'opacity-100');
content.classList.add('scale-95', 'opacity-0');
setTimeout(() => {
modal.classList.add('hidden');
modal.classList.remove('flex');
}, 200);
}
</script>