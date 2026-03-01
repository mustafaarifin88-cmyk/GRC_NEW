<?php
echo "Memulai pembersihan file PHP dari BOM dan spasi tersembunyi...\n<br><br>";

$dir = __DIR__ . '/app';

if (!is_dir($dir)) {
    die("Error: Folder 'app' tidak ditemukan di " . $dir);
}

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$countFix = 0;

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        // Ambil isi file
        $content = file_get_contents($file->getRealPath());
        $bom = pack('H*', 'EFBBBF');
        $modified = false;

        // 1. Hapus karakter BOM (U+FEFF)
        if (strpos($content, $bom) === 0) {
            $content = substr($content, 3);
            $modified = true;
        }

        // 2. Hapus spasi / baris kosong sebelum tag <?php
        if (preg_match('/^\s+<\?php/', $content)) {
            $content = preg_replace('/^\s+<\?php/', '<?php', $content);
            $modified = true;
        }

        // Jika ada perbaikan, timpa file tersebut
        if ($modified) {
            file_put_contents($file->getRealPath(), $content);
            echo "-> File diperbaiki: " . $file->getRealPath() . "\n<br>";
            $countFix++;
        }
    }
}

echo "<br><b>SELESAI!</b> Berhasil membersihkan <b>$countFix</b> file bermasalah.\n<br>";
echo "Silakan hapus file fix.php ini, lalu refresh web CodeIgniter Anda.";