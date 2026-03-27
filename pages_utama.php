<h1 class="page-title">Selamat Datang</h1>

<div class="gallery-row">
<?php foreach ($data as $produk): ?>
    <div class="gallery-item">
        <img src="gambar/<?= $produk['gambar'] ?>" class="gallery-thumb">
        <p><?= $produk['nama'] ?></p>
    </div>
<?php endforeach; ?>
</div>

<div class="instructions-section">
<h3>Cara Membuat Tempahan</h3>
<p>
Klik menu Tempah → isi kuantiti → masukkan nama → tekan Teruskan → cetak invois.
</p>
</div>