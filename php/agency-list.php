<?php
require ('conn.php');

$stm = $pdo->query("SELECT * FROM agencies");
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

$list = NULL;
foreach ($rows as $value) {
	$list .= '<option value="'.$value['code'].'" data-id="'.$value['id'].'" data-email="'.$value['email'].'">'.$value['name'].'</option>';
}

echo $list;
