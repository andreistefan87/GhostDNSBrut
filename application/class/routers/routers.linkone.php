<?php

class LinkOne
{
	private $ch;
    public $Host;
    public $User;
    public $Pass;
    public $Auth;
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
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/LoginCheck");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, "Username={$User}&checkEn=0&Password={$Pass}");
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($this->ch, CURLOPT_COOKIEJAR,"cookie.txt");
		curl_setopt($this->ch, CURLOPT_USERPWD, $User . ":" . $Pass);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 3);
		$headers = array();
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
		$headers[] = "Accept-Language: en-US,en;q=0.5";
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Referer: http://{$Host}/login.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);//	echo $result;
		$Status = (strpos($result,"index.asp") !== false) ? true : false;
		if ($Status)
		{
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
			//$this->ch = curl_init();
			curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/wan_dns.asp");
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
			echo $result;
		}	
		return true;
		//echo $result;
	}
	
	public function DoOthers($Host,$User,$Pass)
		{
			if ($this->Auth) 
			{
				
				
			}	
			@unlink("cookies.txt");
			return true;
		}
	
	

	
}
