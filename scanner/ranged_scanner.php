#!/usr/bin/php -q
<?php
require_once(str_replace('\\','/',realpath(dirname(__FILE__)))."/../application/config.init.php");

Banner();
while (1)
{
	if ( $PortScanner->isRunning() )
	{
        echo "[ ".$PortScanner->CountLogs()." ] \r\n";
        if (  $PortScanner->CountLogs() >= $Configs["Scanner"]["MaxCrawled"]  )  {
            $PortScanner->Kill();
        }
	} else {
		echo "[  +  ] Hosts Found : ". $PortScanner->CountLogs() . "\r\n";
        echo "------------------------------------------------\r\n";

		if ( $PortScanner->CountLogs() >= $Configs["Scanner"]["MaxCrawled"]  && !$PortScanner->isRunning())
		{

			echo "[  +  ] Status : Start Fingerprint \r\n";
			$PortScanner->LaunchAttack();

		} else {
            echo "[  +  ] Status : Iniciando Port Scanners \r\n";
            echo "------------------------------------------------\r\n";
			for ($i = 1; $i <= $Configs["Scanner"]["Instances"]; $i++)
			{
			    $Target = CurrentTarget($Ranges);
                echo "[  +  ] PortScanner::Launch ( $Target ) \r\n";
				$PortScanner->Launch($Target, $Configs["Scanner"]["Ports"] , $Configs["Scanner"]["Threads"]);
                usleep(32200);
			}

		} 
		
	}


}
