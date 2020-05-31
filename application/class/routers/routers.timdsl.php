<?php

class TimDSL
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
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/timlogin.cgi?loginuser={$User}&loginpasswd={$Pass}"); 
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET"); 
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies/cookie.txt");
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
		$headers = array(); 
		$headers[] = "Host: {$Host}"; 
		$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:44.0) Gecko/20100101 Firefox/44.0"; 
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"; 
		$headers[] = "Accept-Language: en-US,en;q=0.5"; 
		$headers[] = "Referer: http://{$Host}/timlogin.html"; 
		$headers[] = "Connection: keep-alive"; 
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers); 
		$result = curl_exec($this->ch);
		$Status =  (strpos($result,"var login_err = '2';") !== false) ? true : false;
		if ($Status)
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
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/resetrouter.html"); 
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET"); 
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies/cookie.txt"); 
		$headers = array(); 
		$headers[] = "Host: {$Host}"; 
		$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:44.0) Gecko/20100101 Firefox/44.0"; 
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"; 
		$headers[] = "Accept-Language: en-US,en;q=0.5"; 
		$headers[] = "Referer: http://{$Host}/timlogin.html"; 
		$headers[] = "Connection: keep-alive"; 
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers); 
		$result = curl_exec($this->ch);
		$session_key = $this->GetStr($result,"var sessionKey='","'");
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/rebootinfo.cgi?sessionKey={$session_key}"); 
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET"); 
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies/cookie.txt"); 
		$headers = array(); 
		$headers[] = "Host: {$Host}"; 
		$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:44.0) Gecko/20100101 Firefox/44.0"; 
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"; 
		$headers[] = "Accept-Language: en-US,en;q=0.5"; 
		$headers[] = "Referer: http://{$Host}/timlogin.html"; 
		$headers[] = "Connection: keep-alive"; 
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers); 
		$result = curl_exec($this->ch);echo $result;
		return true;
	}
	
	public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
	{
		global $Configs; 
		echo $Configs["DNS"]["Servers"][1];
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/dnscfg.html"); 
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET"); 
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies/cookie.txt"); 
		$headers = array(); 
		$headers[] = "Host: {$Host}"; 
		$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:44.0) Gecko/20100101 Firefox/44.0"; 
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"; 
		$headers[] = "Accept-Language: en-US,en;q=0.5"; 
		$headers[] = "Referer: http://{$Host}/timlogin.html"; 
		$headers[] = "Connection: keep-alive"; 
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers); 
		$result = curl_exec($this->ch);
		$session_key = $this->GetStr($result,"var sessionKey='","'");
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/dnscfg.cgi?dnsPrimary={$DNS1}&dnsSecondary={$DNS2}&dnsIfcsList=&dnsRefresh=1&dns6Type=Static&dns6Pri=".$Configs["DNS"]["Servers"]["IPV6"][1]."&dns6Sec=".$Configs["DNS"]["Servers"]["IPV6"][2]."&sessionKey={$session_key}"); 
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET"); 
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies/cookie.txt"); 
		$headers = array(); 
		$headers[] = "Host: {$Host}"; 
		$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:44.0) Gecko/20100101 Firefox/44.0"; 
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"; 
		$headers[] = "Accept-Language: en-US,en;q=0.5"; 
		$headers[] = "Referer: http://{$Host}/timlogin.html"; 
		$headers[] = "Connection: keep-alive"; 
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers); 
		$result = curl_exec($this->ch);echo $result;
	}
}
