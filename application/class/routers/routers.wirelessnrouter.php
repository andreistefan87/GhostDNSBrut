<?php
/**
 * Created by PhpStorm.
 * User: Paulo
 * Date: 21/11/2017
 * Time: 21:13
 */


class WirelessNRouter
{
    private $ch;
    private $Host;
    private $User;
    private $Pass;
    private $Logged;
    function __construct()
    {
        $this->ch = curl_init();
    }
    private function GetStr($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    public function Login($Host,$User,$Pass)
    {
        $ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/");
        curl_setopt($this->ch, CURLOPT_HEADER, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
        $headers = array();
        $headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
        $headers[] = "Upgrade-Insecure-Requests: 1";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
        $headers[] = "Referer: http://{$Host}/";
        //$headers[] = "Cookie: "."Authorization=Basic ".base64_encode("{$User}:".md5("{$Pass}"));
        $headers[] = "Connection: keep-alive";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($this->ch);//echo $result;

            $Status = (strpos($result,"main.asp") !== false) ? true : false;
            $Status2 = (strpos($result,"main.html") !== false) ? true : false;
            if ($Status ||  $Status2 == true )
            {
                $this->Host = $Host;
                $this->User = $User;
                $this->Pass = $Pass;
                $this->Logged = $Status;
            }
            return $Status;
    }


    public function DoOthers($Host,$User,$Pass)
    {
        if ($this->Logged == true )
        {
            curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/goform/SysToolReboot");
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
            curl_setopt($this->ch, CURLOPT_COOKIEFILE,"cookie.txt");
            $headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0";
            $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
            $headers[] = "Accept-Language: en-US,en;q=0.5";
            $headers[] = "If-Modified-Since: 0";
            $headers[] = "Referer: http://{$Host}/system_reboot.asp";
            $headers[] = "Cookie: language=pt; admin:language=pt";
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
        return true;
    }

    public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
    {
        if ($this->Logged == true )
        {
            curl_setopt($this->ch,CURLOPT_URL, "http://{$Host}/goform/AdvSetDns");
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch,	CURLOPT_POSTFIELDS, "GO=wan_dns.asp&rebootTag=&DSEN=1&DNSEN=on&DS1={$DNS1}&DS2={$DNS2}");
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
            echo $result;
        }
    }

}