<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h2 class="text-2xl font-bold text-slate-800">Pantau Progres Laporan</h2>
        <p class="text-sm text-slate-500 mt-1">Daftar seluruh laporan audit dan insiden yang telah Anda ajukan.</p>
    </div>

    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-100 text-xs text-slate-500 uppercase">
                <tr>
                    <th class="p-4 pl-6 font-semibold">No</th>
                    <th class="p-4 font-semibold">Jenis Laporan</th>
                    <th class="p-4 font-semibold">Judul / Keterangan</th>
                    <th class="p-4 font-semibold">Tanggal Diajukan</th>
                    <th class="p-4 font-semibold">Posisi Saat Ini</th>
                    <th class="p-4 font-semibold text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <?php if (empty($reports)): ?>
                    <tr>
                        <td colspan="6" class="p-6 text-center text-slate-400">Belum ada data laporan yang diajukan.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($reports as $item): ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 pl-6 text-slate-600"><?= $no++ ?></td>
                        <td class="p-4 font-medium text-slate-800"><?= $item['jenis'] ?></td>
                        <td class="p-4 text-slate-600"><?= htmlspecialchars($item['judul']) ?></td>
                        <td class="p-4 text-slate-600"><?= date('d M Y H:i', strtotime($item['tanggal'])) ?></td>
                        <td class="p-4 text-slate-600 font-medium"><?= $item['level'] ?></td>
                        <td class="p-4 text-center">
                            <?php if ($item['status'] == 'APPROVED'): ?>
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">APPROVED</span>
                            <?php elseif ($item['status'] == 'REJECTED'): ?>
                                <button onclick="cekReject('<?= $item['report_type'] ?>', '<?= $item['id'] ?>')" class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold hover:bg-red-200 cursor-pointer">
                                    REJECTED (Cek Alasan)
                                </button>
                            <?php else: ?>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">PROSES</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script untuk melihat alasan reject -->
<script>
function cekReject(type, id) {
    fetch(`<?= base_url('staff/progress/reject-detail') ?>/${type}/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Alasan Penolakan: \n\n" + data.note);
            } else {
                alert("Detail penolakan tidak ditemukan.");
            }
        });
}
</script>

<?= $this->endSection() ?>