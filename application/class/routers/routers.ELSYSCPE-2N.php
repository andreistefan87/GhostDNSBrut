<?php

class ELSYSCPE2N
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
		echo $result;
		$Status = (strpos($result,"HTTP/1.0 302") !== false) ? true : false;
		$Status2 = (strpos($result,"home.asp") !== false) ? true : false;
		if ($Status && $Status2)
		{
			$this->Host = $Host;
			$this->User = $User;
			$this->Pass = $Pass;
		}
		return $Status2;
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
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
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
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ArrayConfig = str_replace("\n","",$this->GetStr($result,'var DHCPPara = new Array(',');'));
		$Configs = explode(",",str_replace('"',"",$ArrayConfig));
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, "ipMode=pptp&wanType=ppp&wan_ip=192.168.250.3&wan_mask=255.255.255.0&wan_gateway=192.168.250.254&fixedIpMtuSize=1500&hostName=&dhcpMtuSize=1492&pppUserName=cleberjosehoracio&pppPassword=102030&pppServiceName=&pppConnectType=0&pppMtuSize=1480&pptpIpAddr=172.1.1.2&pptpSubnetMask=255.255.255.0&pptpServerIpAddr=172.1.1.1&pptpUserName=&pptpPassword=&pptpConnectType=0&pptpIdleTime=5&pptpMtuSize=1460&l2tpIpAddr=172.1.1.2&l2tpSubnetMask=255.255.255.0&l2tpServerIpAddr=172.1.1.1&l2tpUserName=&l2tpPassword=&l2tpConnectType=0&l2tpIdleTime=5&l2tpMtuSize=1460&dnsMode=dnsManual&dns1=107.155.152.15&dns2=8.8.1.8&dns3=8.8.8.8&wan_macAddr=000000000000&igmpproxyEnabled=ON&pingWanAccess=ON&webWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');

		$headers = array();
		$headers[] = "Origin: http://{$Host}";
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "Authorization: Basic ".base64_encode("{$User}:{$Pass}");
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.110 Safari/537.36";
		$headers[] = "Cache-Control: max-age=0";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($this->ch);
		echo $result;
		$Status = (strpos($result,'"'.$DNS1.'",') !== false) ? true : false;
		return $Status;
	}
	
}