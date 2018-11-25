<?php

    $changelog = $_GET['changelog'];

    if(file_exists('changelog.txt')) {unlink('changelog.txt');}

    $file = fopen('changelog.txt', 'x+');
    fwrite($file, $changelog);
    fclose($file);

?>