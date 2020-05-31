<?php

class LiveTimVMG
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
		@unlink("acookies.txt");
		@flush();
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/login/login.html");
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_POST, 0);
		curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, 'acookies.txt');
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
		$headers = array();
		$headers[] = "Origin: http://{$Host}}";
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
		$headers[] = "Cache-Control: max-age=0";
		$headers[] = "Referer: http://{$Host}/login/login.html";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);//echo $result;
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/login/login-page.cgi");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, "AuthName={$User}&AuthPassword={$Pass}&isTelecomSupport=0");
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, 'acookies.txt');
		$headers = array();
		$headers[] = "Origin: http://{$Host}";
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
		$headers[] = "Cache-Control: max-age=0";
		$headers[] = "Referer: http://{$Host}/login/login.html";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);//echo $result;
		$Status = (strpos($result,"top.location='/index.html';") !== false) ? true : false;
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
				$this->ch = curl_init();
				curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/resetrouter.html");
				curl_setopt($this->ch, CURLOPT_HEADER, 1);
				curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
				$headers = array();
				$headers[] = "Accept-Encoding: gzip, deflate";
				$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
				$headers[] = "Upgrade-Insecure-Requests: 1";
				$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
				$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
				$headers[] = "Referer: http://{$Host}/resetrouter.html";
				$headers[] = "Connection: keep-alive";
				curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
				$result = curl_exec($this->ch);
				$Key = $this->GetStr($result,"var sessionKey='","'");//echo $Key;
				curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/rebootinfo.cgi?sessionKey={$Key}");
				curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
				curl_setopt($this->ch, CURLOPT_COOKIEFILE,"acookie.txt"); 
				curl_setopt($this->ch, CURLOPT_TIMEOUT, 900);
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
			@flush();
			$this->ch = curl_init();
			curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/pages/network/homeNetworking/lanSetup.html");
			curl_setopt($this->ch, CURLOPT_HEADER, 1);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
			curl_setopt($this->ch, CURLOPT_COOKIEFILE,"acookie.txt");
			$headers = array();
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
			$headers[] = "Referer: http://{$Host}/main.html";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($this->ch);echo $result;
			$Key = $this->GetStr($result,"var glbSessionKey = '","'");
			$this->Key = $Key;
			curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/pages/tabFW/homeNetworking-lanSetup.cgi");
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, "sessionKey={$Key}&action=NONE&dhcpLeasedTime=86400&lanDnsPrimary=107.155.152.15&lanDnsSecondary=8.8.8.8&enblIgmpSnp=0&enblDhcpAutoReserve=0&enblIgmpMode=0&lanDnsType=Static&enblDhcp6s=1&enblDhcp6Relay=0&enblDhcp6sStateful=0&enblDns6Stateful=1&enblRadvd=1&enblRadvdDNS=1&enblSLAAC=1&statefulPrefix=N%2FA&enblMldSnp=1&enblMldMode=1&dnsQueryScenario=0&brName=Default&ethIpAddress=192.168.1.1&ethSubnetMask=255.255.255.0&enblDhcpSrv=1&dhcpEthStart=192.168.1.2&dhcpEthEnd=192.168.1.254&day=1&hour=0&minute=0&dhcpGwOpt=0&dhcpRelayServer=&dnsType=on&enblIpv6Lan=1&ip6PrefixType=1&ipv6PDWanIfSelect=Default&lanIntfPrefix6=&ipv6UlaAddress=&ipv6UlaPrefixLength=&ip6LanAddrAssign=0&ip6DNSAssign=2&ipv6IntfIDStart=0%3A0%3A0%3A0%3A0%3A0%3A0%3A2&ipv6IntfIDEnd=0%3A0%3A0%3A0%3A0%3A0%3A0%3Affff&ipv6DomainName=&sysLanFirDns6State=0&sysLanSecDns6State=0&sysLanThiDns6State=0&dnsServerAssign=0");
			curl_setopt($this->ch, CURLOPT_POST, 1);
			curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
			curl_setopt($this->ch, CURLOPT_COOKIEFILE,"acookie.txt");
			$headers = array();
			$headers[] = "Origin: http://{$Host}";
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36";
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
			$headers[] = "Cache-Control: max-age=0";
			$headers[] = "Referer: http://{$Host}/pages/tabFW/tabFW.html?tabJson=../network/homeNetworking/tab.json&&tabIndex=0";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($this->ch);echo $result;
			@unlink("cookies.txt");
		}	
		return true;
		//echo $result;
	}
	

	
}