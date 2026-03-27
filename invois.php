<?php
    if (!isset($_SESSION['invois_data'])) {
        echo "<script>alert('Sila buat tempahan dahulu.'); window.location.href='index.php?menu=tempah';</script>";
        exit;
    }
    $invois = $_SESSION['invois_data'];
    ?>
    <h1 class="page-title">Invois Tempahan Biskut Klasik</h1>
    <div class="invoice-box">
        <div class="invoice-header">
            <div><strong>Kepada:</strong><br><?= $invois['nama_pelanggan'] ?></div>
            <div class="text-right;">
                <strong>No. Invois:</strong> <?= $invois['no_invois'] ?><br>
                <strong>Tarikh:</strong> <?= $invois['tarikh'] ?>
            </div>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Produk</th><th>Saiz</th><th>Harga</th><th>Kuantiti</th><th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($invois['items'] as $item): ?>
                    <tr>
                        <td><?= $item['nama_produk'] ?></td>
                        <td><?= $item['saiz'] ?></td>
                        <td>RM <?= number_format($item['harga_seunit'], 2) ?></td>
                        <td><?= $item['kuantiti'] ?></td>
                        <td>RM <?= number_format($item['jumlah_harga'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><strong>Jumlah Besar</strong></td>
                    <td><strong>RM <?= number_format($invois['jumlah_besar'], 2) ?></strong></td>
                </tr>
            </tfoot>
        </table>
        
        <div class="invoice-note">
            <p>* Sila cetak invois ini dan serahkan semasa mengambil tempahan.</p>
            <p>* Bayaran boleh dibuat secara tunai atau imbas Kod QR semasa pengambilan.</p>
        </div>

        <div class="action-buttons">
            <button onclick="window.print()" class="print-btn">Cetak Invois</button>
        </div>
    </div>