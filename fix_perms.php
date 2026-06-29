<?php
require_once('wp-load.php');
require_once('wp-admin/includes/misc.php');

echo "Active theme: " . get_option('stylesheet') . "\n";
echo "got_mod_rewrite: " . (got_mod_rewrite() ? 'true' : 'false') . "\n";
echo "got_url_rewrite: " . (got_url_rewrite() ? 'true' : 'false') . "\n";

// Force the option
update_option('permalink_structure', '/%postname%/');
echo "Updated permalink_structure to /%postname%/\n";

// Flush rules
flush_rewrite_rules();
echo "Flushed rewrite rules.\n";
