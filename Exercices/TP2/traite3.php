<html>
<head>
    <title>Traitement3 du CSV</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<?php
  $file = file("borneswifi_EPSG4326_utf8.csv");
  $i = 0;
  echo "<p>Table de CSV</p>";
  echo '<table border="1">';
  foreach ($file as $line_num => $line) {
    echo "<tr><td>".$line."</td></tr>";
    $i++;
  }
  echo "</table>";
  echo "Nombre de point acces : ".$counter."<br />";
 ?>
</body>
</html>
