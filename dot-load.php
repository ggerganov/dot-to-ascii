<?php

    function is_valid($hash) {
        return (preg_match("/^([a-f0-9]{8})$/", $hash) == 1);
    }

    $hash = $_GET['src_hash'];

    if (is_valid($hash) == false) return 0;

    $file = "/tmp/dot-to-ascii-".$hash.".dot";

    echo file_get_contents($file);

?>
