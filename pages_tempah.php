<h1 class="page-title">Borang Tempahan</h1>

<?php if (isset($_GET['error'])): ?>
<p style="color:red;">Sila pilih sekurang-kurangnya satu biskut.</p>
<?php endif; ?>

<form method="POST" action="process_tempahan.php">

<div class="product-grid">
<?php foreach ($data as $produk): ?>
<div class="product-card">
    <img src="gambar/<?= $produk['gambar'] ?>" class="product-image">

    <h3><?= $produk['nama'] ?></h3>

    <?php foreach ($produk['harga'] as $saiz => $harga): ?>
        <div class="product-option">
            <span><?= $saiz ?> (RM <?= $harga ?>)</span>
            <input type="number" name="tempahan[<?= $produk['id'] ?>][<?= $saiz ?>]"
                   value="0" min="0" class="qty-input" data-price="<?= $harga ?>">
        </div>
    <?php endforeach; ?>

</div>
<?php endforeach; ?>
</div>

<div class="checkout-card">
    <h3>Jumlah: <span id="totalPrice">RM 0.00</span></h3>

    <input type="text" name="nama_pelanggan" placeholder="Nama penuh" required>

    <button type="submit" class="btn-teruskan">Teruskan</button>
</div>

</form>