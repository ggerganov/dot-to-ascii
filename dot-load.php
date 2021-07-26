<?php

include('config.php');

function is_valid_crc32($hash) {
    return (preg_match("/^([a-f0-9]{8})$/", $hash) == 1);
}

$hash = $_GET['src_hash'];

if (is_valid_crc32($hash) == false) return 0;

$file = DTA_DATA_SHARE."/dot-to-ascii-".$hash.".dot";

echo file_get_contents($file);

?>
