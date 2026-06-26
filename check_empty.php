<?php
require 'wp-load.php';
$pages = get_pages();
$empty_pages = [];
foreach ($pages as $p) {
    if (trim(strip_tags($p->post_content)) == '') {
        $empty_pages[] = $p->post_title;
    }
}
if (empty($empty_pages)) {
    echo "Tidak ada halaman WP yang kosong.\n";
} else {
    echo "Halaman WP yang kosong konten:\n- " . implode("\n- ", $empty_pages) . "\n";
}
