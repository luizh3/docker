<?php

    $message = $_POST["message"];

    $files = scandir("./messages");
    $numFiles = count($files) - 2;

    $fileName = "msg-{$numFiles}.txt";

    $file = fopen("./messages/{$fileName}", "x" );

    fwrite($file, $message );
    
    fclose($file);

    header("Location: index.php");