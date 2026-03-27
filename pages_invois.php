<?php
if (!isset($_SESSION['invois_data'])) {
    header("Location: index.php?menu=tempah");
    exit;
}
$invois = $_SESSION['invois_data'];
?>

<h1 class="page-title">Invois</h1>

<div class="invoice-box">

<p>Nama: <?= $invois['nama_pelanggan'] ?></p>
<p>No: <?= $invois['no_invois'] ?></p>
<p>Tarikh: <?= $invois['tarikh'] ?></p>

<table class="invoice-table">
<tr>
<th>Produk</th><th>Saiz</th><th>Harga</th><th>Qty</th><th>Jumlah</th>
</tr>

<?php foreach($invois['items'] as $item): ?>
<tr>
<td><?= $item['nama_produk'] ?></td>
<td><?= $item['saiz'] ?></td>
<td><?= $item['harga_seunit'] ?></td>
<td><?= $item['kuantiti'] ?></td>
<td><?= $item['jumlah_harga'] ?></td>
</tr>
<?php endforeach; ?>

</table>

<h3>Total: RM <?= $invois['jumlah_besar'] ?></h3>

<button onclick="window.print()">Cetak</button>

</div>