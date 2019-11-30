<?php

$cmd = "graph-easy --from=dot --as_ascii";

$descriptorspec = array(
    0 => array("pipe", "r"),
    1 => array("pipe", "w")
);

$process = proc_open($cmd, $descriptorspec, $pipes);

if (is_resource($process)) {

    fwrite($pipes[0], urldecode($_GET['src']));
    fclose($pipes[0]);

    $result = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    $return_value = proc_close($process);

    header('Content-type: text/plain');
    echo $result;
}

?>
