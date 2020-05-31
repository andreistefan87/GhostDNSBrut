<?php

class GhotanBOA
{
    private $ch;
    private $Host;
    private $User;
    private $Pass;
    private $Auth;
    private $Key;
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
        $this->ch = curl_init();
    }
    public function Login($Host,$User,$Pass)
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/timlogin.cgi?loginuser={$User}&loginpasswd={$Pass}");
        curl_setopt($this->ch, CURLOPT_HEADER, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($this->ch, CURLOPT_COOKIEJAR,"cookie.txt");
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($this->ch, CURLOPT_USERPWD, $User . ":" . $Pass);
        $headers = array();
        $headers[] = "Accept-Encoding: gzip, deflate";
        $headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
        $headers[] = "Upgrade-Insecure-Requests: 1";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
        $headers[] = "Referer: http://{$Host}/timlogin.html";
        $headers[] = "Connection: keep-alive";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($this->ch);echo $result;
        $Status = (strpos($result,"HTTP/1.0 302 Redirect") !== false) ? true : false;
        if ($Status)
        {
            $this->Host = $Host;
            $this->User = $User;
            $this->Pass = $Pass;
            $this->Auth = $Status;
        }
        return $Status;
    }

    public function DoOthers($Host,$User,$Pass)
    {
        if ($this->Auth)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://{$Host}//boafrm/formRebootCheck");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.htm");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,8);
            curl_setopt($ch, CURLOPT_TIMEOUT, 8);
            curl_setopt($ch, CURLOPT_USERPWD, $User . ":" . $Pass);
            $headers = array();
            $headers[] = "Origin: http://{$Host}";
            $headers[] = "Accept-Encoding: gzip, deflate, br";
            $headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
            $headers[] = "Upgrade-Insecure-Requests: 1";
            $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
            $headers[] = "Content-Type: application/x-www-form-urlencoded";
            $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
            $headers[] = "Cache-Control: max-age=0";
            $headers[] = "Referer: http://{$Host}/boafrm/formWanTcpipSetup";
            $headers[] = "Connection: keep-alive";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            @unlink("cookies.txt");
        }
        return true;
    }

    public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
    {
        if ($this->Auth)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://{$Host}/boafrm/formWanTcpipSetup");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=8.8.4.4&wan_macAddr=000000000000&upnpEnabled=ON&igmpproxyEnabled=ON&pingWanAccess=ON&webWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.htm&save=Aplicar+Altera%C3%A7%C3%B5es");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,8);
            curl_setopt($ch, CURLOPT_TIMEOUT, 8);
            curl_setopt($ch, CURLOPT_USERPWD, $User . ":" . $Pass);
            $headers = array();
            $headers[] = "Origin: http://{$Host}";
            $headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
            $headers[] = "Upgrade-Insecure-Requests: 1";
            $headers[] = "Content-Type: application/x-www-form-urlencoded";
            $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
            $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
            $headers[] = "Cache-Control: max-age=0";
            $headers[] = "Referer: http://{$Host}/tcpipwan.htm";
            $headers[] = "Connection: keep-alive";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            echo $result;
            //	@unlink("cookies.txt");
        }
        return true;
        //echo $result;
    }



}