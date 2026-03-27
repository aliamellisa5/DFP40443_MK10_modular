<h1 class="page-title">Selamat Datang</h1>

<div class="gallery-row">
<?php foreach ($data as $produk): ?>
    <div class="gallery-item">
        <img src="gambar/<?= htmlspecialchars($produk['gambar']) ?>" class="gallery-thumb">
        <p><?= htmlspecialchars($produk['nama']) ?></p>
    </div>
<?php endforeach; ?>
</div>

<div class="instructions-section">
    <h3>Cara Membuat Tempahan</h3>
    <p>Selamat datang ke Biskut Klasik! Untuk membuat tempahan, sila ikuti langkah-langkah mudah ini. 
            Mula-mula, klik pada menu <strong>Tempah</strong> di bahagian atas. Isikan kuantiti biskut yang 
            anda inginkan dan masukkan nama anda, kemudian klik butang <strong>Teruskan</strong>. 
            Invois akan dipaparkan secara automatik. Sila klik butang <strong>Cetak</strong> untuk 
            mencetak invois tersebut. Invois ini perlu diserahkan kepada kami semasa membuat tempahan. 
            Bayaran boleh dibuat secara tunai atau imbasan Kod QR semasa hari pengambilan tempahan. Terima kasih!
        </p>
</div>