<?php
$countryidis1 = $_GET['countryidisthisome'];
$file = fopen("countryindex.txt", "w");
$data = $countryidis1. "\r\n";
fputs($file,$data);
include ('miestai.php');
 ?>
