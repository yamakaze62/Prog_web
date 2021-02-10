<?php
include("tp2-helpers.php");
$lines=file('borneswifi_EPSG4326.csv');
echo count($lines)-1;
$i=0;
$p=array("lon"=>5.72752,"lat"=>45.19102);
$tab=array();
$minusd=array();
$dist=array();
$noms=array();
$a=array("id","point d accès","lon","lat");
foreach($lines as $target){
	$e=str_getcsv($target,$delimiter=",");
	$q=array("lon"=>$e[2],"lat"=>$e[3]);
	$d=distance($p,$q);
	$coupl=array("nom"=>$e[0],"distance"=>$d);
	$z=array_combine($a,$e);
	$tab[$i]=$z;
	$i=$i+1;
	array_push($dist,$d);
	array_push($noms,$e[0]);
	if($coupl["distance"]<200){
		array_push($minusd,$coupl);
	}

}
array_multisort($dist,$noms);
$n=5;
if($argc>=2){
	$n=$argv[1];
}
for($j=0;$j<$n;$j++){
	var_dump($dist[$j],$noms[$j],$p);
}
