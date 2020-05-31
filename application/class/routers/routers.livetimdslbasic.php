<?php

class LiveTimDsl
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
		@unlink("cookie.txt");
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($this->ch, CURLOPT_COOKIEJAR,"cookie.txt");
		curl_setopt($this->ch, CURLOPT_USERPWD, $User . ":" . $Pass);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
		$headers = array();
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/timlogin.html";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);	//echo $result;
		$Status = (strpos($result,"wizardmain.html") !== false) ? true : false;
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
				curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/resetrouter.html");
				curl_setopt($this->ch, CURLOPT_HEADER, 1);
				curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
				curl_setopt($this->ch, CURLOPT_USERPWD, $User . ":" . $Pass);
								curl_setopt($this->ch, CURLOPT_COOKIEFILE,"cookie.txt"); 
				$headers = array();
				$headers[] = "Accept-Encoding: gzip, deflate";
				$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
				$headers[] = "Upgrade-Insecure-Requests: 1";
				$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
				$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
				$headers[] = "Referer: http://{$Host}/resetrouter.html";
				$headers[] = "Connection: keep-alive";
				curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
				$result = curl_exec($this->ch);//echo $result;
				$Key = $this->GetStr($result,"var sessionKey='","'");//echo $Key;
				curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/wancfg.cmd?action=reboot");
				curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
				curl_setopt($this->ch, CURLOPT_COOKIEFILE,"cookie.txt"); 
				curl_setopt($this->ch, CURLOPT_TIMEOUT, 900);
				curl_setopt($this->ch, CURLOPT_USERPWD, $User . ":" . $Pass);
				$headers = array();
				$headers[] = "Accept-Encoding: gzip, deflate";
				$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
				$headers[] = "Upgrade-Insecure-Requests: 1";
				$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
				$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
				$headers[] = "Referer: http://{$Host}/resetrouter.html";
				$headers[] = "Connection: keep-alive";
				curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
				curl_exec($this->ch);//echo $result;
				curl_close($this->ch);
				@unlink("cookies.txt");
			}	
			return true;
		}
	
	public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
	{
		if ($this->Auth) 
		{
			//$this->ch = curl_init();
			curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/dnscfg.html");
			curl_setopt($this->ch, CURLOPT_HEADER, 1);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
			curl_setopt($this->ch, CURLOPT_COOKIEFILE,"cookie.txt");
			curl_setopt($this->ch, CURLOPT_USERPWD, $User . ":" . $Pass);
			$headers = array();
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
			$headers[] = "Referer: http://{$Host}/main.html";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($this->ch);
			$Key = $this->GetStr($result,"var sessionKey='","'");
			$this->Key = $Key;
			curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/dnscfg.cgi?dnsPrimary={$DNS1}&dnsSecondary={$DNS2}&dnsIfcsList=&dnsRefresh=1&dns6Type=DHCP&dns6Ifc=ppp1.1&sessionKey={$Key}");
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
			curl_setopt($this->ch, CURLOPT_COOKIEFILE,"cookie.txt");
			curl_setopt($this->ch, CURLOPT_USERPWD, $User . ":" . $Pass);
			$headers = array();
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
			$headers[] = "Referer: http://{$Host}/dnscfg.html";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($this->ch);//echo $result;
		//	curl_close($this->ch);
		//	@unlink("cookies.txt");
		}	
		return true;
		//echo $result;
	}
	

	
}