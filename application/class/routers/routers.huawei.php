<?php

class Huawei
{
	private $ch;
	private $Host;
	private $User;
	private $Pass;
	function __construct()
	{
		$this->ch = curl_init();
	}
	public function Login($Host,$User,$Pass)
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "https://{$Host}:80/asp/GetRandCount.asp");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
		$headers[] = "Origin: https://{$Host}:80";
		$headers[] = "Accept-Encoding: gzip, deflate, br";
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36";
		$headers[] = "Accept: */*";
		$headers[] = "Referer: https://{$Host}:80/";
		$headers[] = "X-Requested-With: XMLHttpRequest";
		$headers[] = "Connection: keep-alive";
		$headers[] = "Content-Length: 0";
		$result = curl_exec($this->ch);
		echo $result;
		$Status = (strpos($result,"home.asp") !== false) ? true : false;
		return $Status;
	}
	
		public function DoOthers($Host,$User,$Pass)
		{

			return true;
		}
	
	public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
	{
			$this->ch = curl_init();
			curl_setopt($this->ch, CURLOPT_URL, "https://{$Host}:80/tcpipwan.asp");
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
			$headers[] = "Referer: https://{$Host}:80/tcpipwan.asp";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($this->ch);
			echo $result;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://{$Host}:80/goform/formWanTcpipSetup");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "dnsMode=dnsManual&dns1={$DNS1}&dns2={$DNS2}&dns3=107.155.152.15&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&submit-url=%2Ftcpipwan.asp&save=Aplicar+Altera%E7%F5es");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
			curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");

			$headers = array();
			$headers[] = "Origin: https://{$Host}:80";
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "Authorization: Basic ".base64_encode("{$User}:{$Pass}");
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.110 Safari/537.36";
			$headers[] = "Cache-Control: max-age=0";
			$headers[] = "Referer: https://{$Host}:80/tcpipwan.asp";
			$headers[] = "Connection: keep-alive";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			curl_setopt($ch, CURLOPT_URL, "https://{$Host}:80/goform/formTools");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "reboot=Sim%2C+reinicie+o+AP%21&submit-url=%2Ftools.asp");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
			curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
			$headers = array();
			$headers[] =  "Origin: https://{$Host}:80";
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "Authorization: Basic ".base64_encode("{$User}:{$Pass}");
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.110 Safari/537.36";
			$headers[] = "Cache-Control: max-age=0";
			$headers[] = "Referer: https://{$Host}:80/tools.asp";
			$headers[] = "Connection: keep-alive";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			curl_close($ch);
			curl_close($this->ch);
		}
	

	
}