<?php
require_once 'wp-load.php';
$ashe_mods = get_option('theme_mods_ashe');
print_r($ashe_mods['nav_menu_locations']);
