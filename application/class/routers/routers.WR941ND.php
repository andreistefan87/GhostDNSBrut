<?php

class WR941ND
{
    private $ch;
    private $Host;
    private $User;
    private $Pass;
    private $Token;
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
        @unlink("coockies.txt");
        $ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/userRpm/LoginRpm.htm?Save=Save");
        curl_setopt($this->ch, CURLOPT_HEADER, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($this->ch, CURLOPT_COOKIE, "Authorization=Basic ".base64_encode("{$User}:".md5("{$Pass}")));
        $headers = array();
        $headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
        $headers[] = "Upgrade-Insecure-Requests: 1";
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
        $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
        $headers[] = "Referer: http://{$Host}/";
        $headers[] = "Connection: keep-alive";
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($this->ch);
        $Logged = ( strpos($result,'userRpm/Index.htm') !== false ) ? true : false;
        $this->Logged = $Logged;
        if ( $Logged )
        {
            $this->Token = $this->GetStr($result,'window.parent.location.href = "http://'.$Host.'/','/userRpm/Index.htm');
            echo $this->Token;
        }
        return $Logged;
    }


    public function DoOthers($Host,$User,$Pass)
    {
        if ($this->Logged == true )
        {
            curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/userRpm/ManageControlRpm.htm?port=31&ip=&Save=Salvar");
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
            curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookies.txt");
            curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,0);
            curl_setopt($this->ch, CURLOPT_TIMEOUT, 4); //timeout in seconds
            $headers = array();
            $headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
            $headers[] = "Upgrade-Insecure-Requests: 1";
            $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
            $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
            $headers[] = "Referer: http://{$Host}/userRpm/LanDhcpServerRpm.htm";
            $headers[] = "Connection: keep-alive";
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        //    curl_exec($this->ch);
        }
        return true;
    }

    public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
    {
        if ($this->Logged == true )
        {
            curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/".$this->Token."/userRpm/PPPoECfgAdvRpm.htm?wan=0&lcpMru=1480&ServiceName=&AcName=&EchoReq=0&manual=2&dnsserver={$DNS1}&dnsserver2={$DNS2}&Save=Save&Advanced=Advanced");
            curl_setopt($this->ch, CURLOPT_HEADER, 1);
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
            curl_setopt($this->ch, CURLOPT_COOKIE, "Authorization=Basic ".base64_encode("{$User}:".md5("{$Pass}")));
            $headers = array();
            $headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
            $headers[] = "Upgrade-Insecure-Requests: 1";
            $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
            $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
            $headers[] = "Referer: http://{$Host}/userRpm/LanDhcpServerRpm.htm";
            $headers[] = "Connection: keep-alive";
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($this->ch);
            echo $result;

            $Status = (strpos($result,'"'.$DNS1.'",') !== false) ? true : false;
            return $Status;
        }
    }
}