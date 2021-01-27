<?php
require_once("libcalcul.php");
$somme=$_POST['a'];
$taux=$_POST['b'];
$duree=$_POST['c'];


echo "\n Le cumul est ";
print_r(cumul($somme, $taux, $duree));
