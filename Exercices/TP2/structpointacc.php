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
$prefix="\"label\": ";
$suffix=", \"score\"";
$adress=array();
$lon=array();
$lat=array();
$a=array("id","point d accès","lon","lat");
foreach($lines as $target){
	$e=str_getcsv($target,$delimiter=",");
	$q=array("lon"=>$e[2],"lat"=>$e[3]);
	$d=distance($p,$q);
	$coupl=array("nom"=>$e[0],"distance"=>$d);
	$url="https://api-adresse.data.gouv.fr/reverse/?lon=".$e[2]."&lat=".$e[3]."&type=street";
	$string=smartcurl($url,0);
	$index=strpos($string,$prefix);
	$adr=substr($string, $index,strpos($string,$suffix)-strpos($string,$prefix));
	$z=array_combine($a,$e);
	$tab[$i]=$z;
	$i=$i+1;
	array_push($dist,$d);
	array_push($noms,$e[0]);
	array_push($adress,$adr);
	array_push($lon,$e[2]);
	array_push($lat,$e[3]);
	if($coupl["distance"]<200){
		array_push($minusd,$coupl);
	}

}
array_multisort($dist,$noms,$adress,$lon,$lat);
$n=5;
if($argc>=2){
	$n=$argv[1];
}
for($j=0;$j<$n;$j++){
	var_dump($dist[$j],$noms[$j],$adress[$j],$lon[$j],$lat[$j]);
}
