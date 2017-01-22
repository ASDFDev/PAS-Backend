<?php


    $i = 3;
    $cstrong = 6;
    $bytes = openssl_random_pseudo_bytes($i,$cstrong);
    $hex   = bin2hex($bytes);