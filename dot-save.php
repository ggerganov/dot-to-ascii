<?php

    $data = urldecode($_GET['src']);
    $hash = hash('crc32', $data);
    $file = "/tmp/dot-to-ascii-".$hash.".dot";

    file_put_contents($file, $data);

    echo $hash;

?>
