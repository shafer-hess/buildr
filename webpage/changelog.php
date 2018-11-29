<?php

    $changelog = $_GET['changelog'];
    $md = $_GET['md'];

    if(file_exists('changelog.txt')) {unlink('changelog.txt');}
    if(file_exists('md.txt')) {unlink('md.txt');}

    $file = fopen('changelog.txt', 'x+');
    fwrite($file, $changelog);
    fclose($file);

    $file = fopen('md.txt', 'x+');
    fwrite($file, $md);
    fclose($file);

?>