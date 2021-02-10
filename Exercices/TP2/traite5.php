<?php
    include("tp2-helpers.php");
    $row = 0;
    $res = array();
    if(($handle = fopen("borneswifi_EPSG4326_utf8.csv", "r")) !== FALSE){
        while(($data = fgetcsv($handle, $length = 100, $delimiter=",", $eclos
         = "\n")) !== FALSE){
            $temp = initAccesspoint($data);
            $res[$row] = $temp;
            $row++;
        }

    }

    $Grenette = geopoint(5.72752, 45.19102);
    $i = 0;
    $min_dis = 1000;
    $min = array();
    while($i < count($res)){
        $line = $res[$i];
        $coor = geopoint($line['lon'], $line['lat']);
        $dis = distance($coor, $Grenette);
        if($dis < 200){
            print_r($line);
            echo "distance:". $dis ."\n"; 
            if($dis<$min_dis){
                $min_dis = $dis;
                $min = $line;
            }
        }
        $i++;
    }
    echo "Le point plus proche est : \n";
    print_r($min);
    echo "distance:". $min_dis ."\n"; 
    fclose($handle);
?>