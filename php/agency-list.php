<?php
require ('conn.php');

$pdo = new PDO($dsn, $user, $passwd);
$stm = $pdo->query("SELECT id, code, name FROM agencies");
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

$list = NULL;
foreach ($rows as $value) {
	$list .= '<option value="'.$value['code'].'" data-id="'.$value['id'].'">'.$value['name'].'</option>';
}

echo $list;