<?php
session_start();
include "data_produk.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama_pelanggan = $_POST['nama_pelanggan'] ?? "Pelanggan";
    $tempahan_input = $_POST['process_tempahan'] ?? [];

    $items = [];
    $total = 0;

    foreach ($tempahan_input as $id => $saiz_list) {
        foreach ($data as $p) {
            if ($p['id'] == $id) {
                foreach ($saiz_list as $saiz => $qty) {
                    $qty = (int)$qty;

                    if ($qty > 0) {
                        $harga = $p['harga'][$saiz];
                        $jumlah = $qty * $harga;
                        $total += $jumlah;

                        $items[] = [
                            'nama_produk' => $p['nama'],
                            'saiz' => ucwords(str_replace('_',' ',$saiz)),
                            'harga_seunit' => $harga,
                            'kuantiti' => $qty,
                            'jumlah_harga' => $jumlah
                        ];
                    }
                }
            }
        }
    }

    if ($total > 0) {
        $_SESSION['invois_data'] = [
            'no_invois' => 'INV-' . rand(10000, 99999),
            'nama_pelanggan' => htmlspecialchars($nama_pelanggan),
            'tarikh' => date("d/m/Y"),
            'items' => $items,
            'jumlah_besar' => $total
        ];

        header("Location: index.php?menu=invois");
        exit;
    } else {
        header("Location: index.php?menu=tempah&error=1");
    }
}