<?php
$dsn = "mysql:host=localhost;dbname=perlis";
$user = "root";
$passwd = "root";

$pdo = new PDO($dsn, $user, $passwd);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);