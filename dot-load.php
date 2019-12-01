<?php

    function is_valid($hash) {
        return (preg_match("/^([a-f0-9]{8})$/", $hash) == 1);
    }

    $hash = $_GET['src_hash'];

    if (is_valid($hash) == false) return 0;

    $file = "/tmp/".$hash;

    echo file_get_contents($file);

?>
