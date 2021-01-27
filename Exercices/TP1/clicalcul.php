<?php
require_once("libcalcul.php");
echo "\n Le cumul est ";
print_r($argv[1]*((1+($argv[2]/100))**$argv[3]));
