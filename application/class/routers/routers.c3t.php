<?php

class C3T
{
	private $ch;
	private $Host;
	private $User;
	private $Pass;
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
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
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
		$result = curl_exec($this->ch);
		//echo $result;
		$Status = (strpos($result,"HTTP/1.1 200") !== false) ? true : false;
		if ($Status)
		{
			$this->Host = $Host;
			$this->User = $User;
			$this->Pass = $Pass;
		}
		return $Status;
	}
	
	
	public function DoOthers($Host,$User,$Pass)
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
		curl_setopt($this->ch, CURLOPT_TIMEOUT, 400); //timeout in seconds
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/userRpm/LanDhcpServerRpm.htm";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		curl_exec($this->ch);
		//echo $result;
		return true;
	}
	
	public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
	{
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/userRpm/LanDhcpServerRpm.htm");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/userRpm/LanDhcpServerRpm.htm";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		//echo $result;
		$ArrayConfig = str_replace("\n","",$this->GetStr($result,'var DHCPPara = new Array(',');'));
		$Configs = explode(",",str_replace('"',"",$ArrayConfig));
		$Url = "http://{$Host}/userRpm/LanDhcpServerRpm.htm?dhcpserver=".$Configs[0]."&ip1=".$Configs[1]."&ip2=".$Configs[2]."&Lease=".$Configs[3]."&gateway=".$Configs[4]."&domain=&dnsserver={$DNS1}&dnsserver2={$DNS2}&Save=Salvar";
		curl_setopt($this->ch, CURLOPT_URL, "{$Url}");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/userRpm/LanDhcpServerRpm.htm";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		$Status = (strpos($result,'"'.$DNS1.'",') !== false) ? true : false;
		return $Status;
	}
	
}