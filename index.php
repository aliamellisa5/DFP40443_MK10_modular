<?php
session_start();
include "data_produk.php";

$menu = $_GET['menu'] ?? 'utama';

include "header.php";

switch ($menu) {
    case 'tempah':
        include "pages_tempah.php";
        break;
    case 'invois':
        include "pages_invois.php";
        break;
    default:
        include "pages_utama.php";
}

include "footer.php";
?>