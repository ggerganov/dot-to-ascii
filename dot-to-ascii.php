<?php

include('config.php');

// you need to insall "graph-easy" to use this script
// for more info: https://stackoverflow.com/questions/3211801/graphviz-and-ascii-output

$cmd = "graph-easy --from=dot --timeout=10";

if (isset($_GET['boxart']) && $_GET['boxart'] == '1') {
    $cmd .= " --as_boxart";
} else {
    $cmd .= " --as_ascii";
}

$descriptorspec = array(
    0 => array("pipe", "r"),
    1 => array("pipe", "w")
);

$process = proc_open($cmd, $descriptorspec, $pipes);

if (is_resource($process)) {

    $src = urldecode($_GET['src']);

    // store request
    $hash = hash('sha256', $src);
    $file = DTA_DATA_REQUESTS."/dot-to-ascii-".$hash.".dot";

    file_put_contents($file, $src);

    // remove comments : #, //, /*, */
    $pattern = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))|(?:(?<!\:|\\\|\'|\")\#.*)/';
    $src = preg_replace($pattern, '', $src);

    // remove new lines
    $src = preg_replace("/\r|\n/", " ", $src);

    fwrite($pipes[0], $src);
    fclose($pipes[0]);

    $result = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    $return_value = proc_close($process);

    header('Content-type: text/plain');
    echo htmlspecialchars($result);
}

?>
