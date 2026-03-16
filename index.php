<?php
session_start();

include "data.php";

$menu = $_GET['menu'] ?? 'utama';

include "header.php";
?>

<?php if ($menu === 'utama'): ?>

<h1 class="page-title">Selamat Datang</h1>

<div class="gallery-row">
<?php foreach ($data as $produk): ?>
    
<div class="gallery-item">
<img src="gambar/<?= htmlspecialchars($produk['gambar']) ?>"
alt="<?= htmlspecialchars($produk['nama']) ?>"
class="gallery-thumb">

<p><?= htmlspecialchars($produk['nama']) ?></p>
</div>

<?php endforeach; ?>
</div>

<div class="instructions-section">

<h3 class="instruction-title">Cara Membuat Tempahan</h3>

<p>
Selamat datang ke Biskut Klasik! Untuk membuat tempahan, sila klik menu
<strong>Tempah</strong>. Masukkan kuantiti biskut yang anda mahu dan isi
nama anda. Kemudian tekan butang <strong>Teruskan</strong>.
Sistem akan memaparkan invois secara automatik. Sila cetak invois tersebut
dan bawa semasa mengambil tempahan.
</p>

</div>

<?php elseif ($menu === 'tempah'): ?>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

$nama_pelanggan = $_POST['nama_pelanggan'] ?? "Pelanggan";
$tempahan_input = $_POST['tempahan'] ?? [];

$items = [];
$total = 0;

foreach ($tempahan_input as $id => $saiz_list) {

$produk_detail = null;

foreach ($data as $p) {
if ($p['id'] == $id) {
$produk_detail = $p;
}
}

if ($produk_detail) {

foreach ($saiz_list as $saiz => $qty) {

$qty = (int)$qty;

if ($qty > 0) {

$harga = $produk_detail['harga'][$saiz];
$jumlah = $qty * $harga;

$total += $jumlah;

$items[] = [
'nama_produk' => $produk_detail['nama'],
'saiz' => ucwords(str_replace('_',' ',$saiz)),
'harga_seunit' => $harga,
'kuantiti' => $qty,
'jumlah_harga' => $jumlah
];

}

}

}

}

if ($total > 0) {

$_SESSION['invois_data'] = [

'no_invois' => 'INV-' . rand(10000,99999),
'nama_pelanggan' => htmlspecialchars($nama_pelanggan),
'tarikh' => date("d/m/Y"),
'items' => $items,
'jumlah_besar' => $total

];

header("Location: index.php?menu=invois");
exit;

} else {

echo "<script>alert('Sila pilih sekurang-kurangnya satu biskut');</script>";

}

}

?>

<h1 class="page-title">Borang Tempahan</h1>

<form method="POST">

<div class="product-grid">

<?php foreach ($data as $produk): ?>

<div class="product-card">

<img src="gambar/<?= htmlspecialchars($produk['gambar']) ?>"
class="product-image">

<h3><?= htmlspecialchars($produk['nama']) ?></h3>

<?php foreach ($produk['harga'] as $saiz => $harga): ?>

<div class="product-option">

<span><?= ucwords(str_replace('_',' ',$saiz)) ?></span>

<span>RM <?= number_format($harga,2) ?></span>

<input type="number"

name="tempahan[<?= $produk['id'] ?>][<?= $saiz ?>]"

value="0"

min="0"

class="qty-input">

</div>

<?php endforeach; ?>

</div>

<?php endforeach; ?>

</div>

<div class="checkout-card">

<label>Nama Penuh Anda</label>

<input type="text"
name="nama_pelanggan"
required>

<br><br>

<button type="submit" class="btn-teruskan">
Teruskan
</button>

</div>

</form>

<?php elseif ($menu === 'invois'): ?>

<?php

if (!isset($_SESSION['invois_data'])) {

echo "<script>
alert('Sila buat tempahan dahulu');
window.location='index.php?menu=tempah';
</script>";

exit;

}

$invois = $_SESSION['invois_data'];

?>

<h1 class="page-title">Invois Tempahan</h1>

<div class="invoice-box">

<div class="invoice-header">

<div>

<strong>Kepada:</strong><br>
<?= $invois['nama_pelanggan'] ?>

</div>

<div style="text-align:right">

<strong>No Invois:</strong>
<?= $invois['no_invois'] ?>

<br>

<strong>Tarikh:</strong>
<?= $invois['tarikh'] ?>

</div>

</div>

<table class="invoice-table">

<thead>

<tr>

<th>Produk</th>
<th>Saiz</th>
<th>Harga</th>
<th>Kuantiti</th>
<th>Jumlah</th>

</tr>

</thead>

<tbody>

<?php foreach ($invois['items'] as $item): ?>

<tr>

<td><?= $item['nama_produk'] ?></td>

<td><?= $item['saiz'] ?></td>

<td>RM <?= number_format($item['harga_seunit'],2) ?></td>

<td><?= $item['kuantiti'] ?></td>

<td>RM <?= number_format($item['jumlah_harga'],2) ?></td>

</tr>

<?php endforeach; ?>

</tbody>

<tfoot>

<tr>

<td colspan="4"><strong>Jumlah Besar</strong></td>

<td>
<strong>
RM <?= number_format($invois['jumlah_besar'],2) ?>
</strong>
</td>

</tr>

</tfoot>

</table>

<button onclick="window.print()" class="print-btn">
Cetak Invois
</button>

</div>

<?php endif; ?>

<?php include "footer.php"; ?>