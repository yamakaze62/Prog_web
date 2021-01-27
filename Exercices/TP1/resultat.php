<?php
$somme=$_POST['a'];
$taux=$_POST['b'];
$duree=$_POST['c'];

$cumul=$somme*((1+($taux/100))**$duree);

echo "\n Le cumul est ";
print_r($cumul);
