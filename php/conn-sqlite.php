<?php

const PATH_TO_SQLITE_FILE = 'database/data.sqlite';
$pdo = new PDO("sqlite:" . PATH_TO_SQLITE_FILE);