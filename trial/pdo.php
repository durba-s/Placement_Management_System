<?php
    ini_set('display_errors',0);
    $pdo = new PDO('mysql:host=localhost;dbname=trial', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>