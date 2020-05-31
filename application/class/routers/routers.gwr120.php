<?php

class GWR120
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
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		//curl_setopt($this->ch, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookie.txt");
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT ,8);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 8);
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/";
		$headers[] = "Authorization:Basic ".base64_encode("{$User}:{$Pass}");
		curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		//echo $result;
		$Status =  (strpos($result,"<title>Wireless Router </title>") !== false) ? true : false;
		if ($Status) {
			$this->Host = "{$Host}";
			$this->User = "{$User}";
			$this->Pass = "{$Pass}";
		} 
		return $Status;
	}
	
	function ChangePass()
	{
		curl_setopt($this->ch, CURLOPT_URL, "http://".$this->Host."/boafrm/formPasswordSetup");
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, "username=admin&newpass=passthehash&confpass=passthehash&submit-url=%2Fstatus.htm&save=Aplicar+%2F+Salvar");
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
		$headers = array();
		$headers[] = "Origin: http://".$this->Host."";
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "Authorization:Basic ".base64_encode("".$this->User.":".$this->Pass."");
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.110 Safari/537.36";
		$headers[] = "Cache-Control: max-age=0";
		$headers[] = "Referer: http://".$this->Host."/password.htm";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($this->ch);
		echo $result;
		$Status =  (strpos($result,"302 Redirect") !== false) ? true : false;
		if ($Status) {
			$this->Host = $this->Host;
			$this->User = "passthehash1";
			$this->Pass = $this->Pass;
		} 
		return $Status;
	}
	
	function ChangeDNS($DNS1,$DNS2)
	{
		$ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://".$this->Host."/boafrm/formWanTcpipSetup");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($this->ch, CURLOPT_USERPWD, $this->User. ":" . $this->Pass);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookie.txt");
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, "ipMode=pptp&pptpDynamicWanIP=0&wanType=ppp&wan_ip=172.1.1.1&wan_mask=255.255.255.0&wan_gateway=172.1.1.254&fixedIpMtuSize=1500&hostName=GWR-120&dhcpMtuSize=1492&pppUserName=claudia&pppPassword=1010&pppServiceName=&pppConnectType=0&pppMtuSize=1452&wan_pptp_use_dynamic_carrier_radio=dynamicIP&pptpEnableGetServIpByDomainName=1&pptpServerAddrIsDomainName=0&pptpServerAddr=172.1.1.1&pptpUserName=&pptpPassword=&pptpConnectType=0&pptpMtuSize=1460&wan_l2tp_use_dynamic_carrier_radio=staticIP&l2tpIpAddr=172.1.1.2&l2tpSubnetMask=255.255.255.0&l2tpDefGw=0.0.0.0&l2tpEnableGetServIpByDomainName=1&l2tpServerAddrIsDomainName=0&l2tpServerAddr=172.1.1.1&l2tpUserName=&l2tpPassword=&l2tpConnectType=0&l2tpMtuSize=1460&USB3G_USER=&USB3G_PASS=&USB3G_PIN=&USB3G_APN=&USB3G_DIALNUM=&USB3GMtuSize=&dnsMode=dnsManual&dns1=107.155.152.15&dns2=8.8.8.8&dns3=8.8.8.4&wan_macAddr=000000000000&upnpEnabled=ON&pingWanAccess=ON&webWanAccess=ON&webWanPort=80&WANPassThru1=ON&WANPassThru2=ON&WANPassThru3=ON&ipv6_passthru_enabled=ON&submit-url=%2Ftcpipwan.htm&save=Aplicar+%2F+Salvar");
		$headers = array();
		$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "Authorization:Basic ".base64_encode($this->User.":">$this->Pass);
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$headers[] = "Referer: http://".$this->Host."/tcpipwan.htm";
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		//echo $result;
		return (strpos($result,"302 Redirect") !== false) ? true : false;
	}
	
}