<?php
require ('conn.php');

$agency_id = $_POST['agency_id'];

$stmt = $pdo->prepare("SELECT code, name FROM services WHERE agency_id = :agency_id AND enabled = 1");
$stmt->execute(['agency_id' => $agency_id]); 
$rows = $stmt->fetchAll();

$list = NULL;
foreach ($rows as $value) {
	$list .= '<option value="'.$value['code'].'">'.$value['name'].'</option>';
}

echo $list;
