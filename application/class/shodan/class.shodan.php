<?php

//==================================================================
// Shodan Class
//==================================================================
class Shodan
{
    private $Querys;
    private $ch;

    private function GetStr($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }


    function __construct()
    {
        $this->Querys               = array();
        @unlink("cookie.txt");
    }

    public function AddNewQuery($Dork)
    {
        $this->Querys[] = $Dork;
    }

    public function Login($Username,$Password)
    {
        echo "Logando \r\n";
        $this->ch	= curl_init();
        curl_setopt($this->ch, CURLOPT_URL, "https://account.shodan.io/login");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookie.txt");
        $headers = array();
        $headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:44.0) Gecko/20100101 Firefox/44.0";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $headers[] = "Accept-Language: en-US,en;q=0.5";
        $headers[] = "Referer: https://www.shodan.io/";
        $headers[] = "Connection: keep-alive";
        $headers[] = "Cache-Control: max-age=0";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($this->ch);//echo $result;
        curl_setopt($this->ch, CURLOPT_URL, "https://account.shodan.io/login");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, "username={$Username}&password={$Password}&grant_type=password&continue=https%3A%2F%2Fwww.shodan.io%2F&login_submit=Log+in");
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookie.txt");
        $headers = array();
        $headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:44.0) Gecko/20100101 Firefox/44.0";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $headers[] = "Accept-Language: en-US,en;q=0.5";
        $headers[] = "Referer: https://account.shodan.io/login";
        $headers[] = "Connection: keep-alive";
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_exec($this->ch);
        echo "[ + ] Connected \r\n";
    }

    private function GetsIpsByQuery($Query,$Page)
    {
        echo "Waiting \r\n";
        $NewArray           = array();
        @flush();
        curl_setopt($this->ch, CURLOPT_URL, "https://www.shodan.io/search?query=".urlencode($Query)."&page={$Page}");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookie.txt");
		curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,15);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 15);
        $headers = array();
        $headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:44.0) Gecko/20100101 Firefox/44.0";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $headers[] = "Accept-Language: en-US,en;q=0.5";
        $headers[] = "Referer: https://www.shodan.io/";
        $headers[] = "Connection: keep-alive";
        $headers[] = "Cache-Control: max-age=0";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($this->ch);//echo $result;
        $Data	= explode("\n",$result);
        @flush();
        @flush();
        if ( strpos($result,'Result limit reached.') == false) {
            foreach ($Data as $line) {
                if (strpos($line, '<div class="ip">') !== false) {
                    $Ips = $this->GetStr($line, '<a href="http://', '"');
                    if (strpos($Ips, ':') !== false) {
                        $NewArray[] = $Ips;
                    }
                }
            }
            return $NewArray;
        } else { return false; }

    }

    public function ParseResult()
    {
        $Ranges     = array();
        $ParsedData = array();
        $Count = 0;
        foreach ($this->Querys as $Query) {
            for ($Page = 0; $Page <= 1600; $Page++) {
                echo "[ + ] Dumping Page [ {$Query} ] [{$Page}] \r\n";
                $TargetList = $this->GetsIpsByQuery($Query, $Page);
                if ($TargetList !== false) {
                    foreach ($TargetList as $CurrentTarget) {
                        $Count++;
						@flush();
						@ob_flush();
						echo $CurrentTarget;
						usleep(32900);
						//popen( 'start C:/xampp/php/php.exe C:/xampp/htdocs/newera/scanner/api.php '.$CurrentTarget.' /c', 'r' );
						system("php api.php {$CurrentTarget} > /dev/null &");
                        //$Data = explode(".",$CurrentTarget);
                        //$Ranges[]   =   $Data[0].".".$Data[1];
                    }
                } else {
                    break;
                }
                echo implode("\n", $Ranges) . "\r\n";
            }
            sleep(1);
        }
    }


}
?>