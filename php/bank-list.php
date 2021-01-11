<?php
require_once ('fpx.php');
$bank = new FPX();

$post = [
	'mode' => $_POST['mode'],
	'env' => $_POST['env']
];

$bank_list = $bank->get_bank_list($post);
echo json_encode($bank_list,true);