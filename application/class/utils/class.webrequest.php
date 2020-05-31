<?php

class CWebRequest
{
	private $ch;
	public function Get($Url , $BasicAuth = false)
	{
		global $Utils;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://{$Url}/");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		$headers = array();
		$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:54.0) Gecko/20100101 Firefox/54.0";
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
		$headers[] = "Accept-Language: en-US,en;q=0.5";
		$headers[] = "Cookie: language=en";
		
		$headers[] = "Connection: keep-alive";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($BasicAuth != false ) {
			$Data = explode(":",$BasicAuth);
			$username = $Data[0];
			$password = $Data[1];
			curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
		}
		$result = curl_exec($ch);
		if ( strpos($result,"location.href = '") !== false )
		{
			echo "PUTAP";
			$NewUrl = $Utils->GetStr($result,"location.href = '/","';");
			$NewUrl = "http://{$Url}/".$NewUrl;
			echo $NewUrl;
			curl_setopt($ch, CURLOPT_URL, $NewUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
			$headers = array();
			$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:54.0) Gecko/20100101 Firefox/54.0";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
			$headers[] = "Accept-Language: en-US,en;q=0.5";
			$headers[] = "Cookie: language=en";
			$headers[] = "Connection: keep-alive";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			if ($BasicAuth != false ) {
				$Data = explode(":",$BasicAuth);
				$username = $Data[0];
				$password = $Data[1];
				curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
				$headers[] = "Content-Type: application/x-www-form-urlencoded";
			}
			$Data = curl_exec($ch);
			$result .= $Data;
			
			}
		if ( strpos($result,'This document has moved to a new <a href="') !== false )
		{
		
			$NewUrl = $Utils->GetStr($result,'This document has moved to a new <a href="','"');
			curl_setopt($ch, CURLOPT_URL, $NewUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
			$headers = array();
			$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:54.0) Gecko/20100101 Firefox/54.0";
			$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
			$headers[] = "Accept-Language: en-US,en;q=0.5";
			$headers[] = "Cookie: language=en";
			$headers[] = "Connection: keep-alive";
			$headers[] = "Upgrade-Insecure-Requests: 1";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			if ($BasicAuth != false ) {
				$Data = explode(":",$BasicAuth);
				$username = $Data[0];
				$password = $Data[1];
				curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
				$headers[] = "Content-Type: application/x-www-form-urlencoded";
			}
			$Data = curl_exec($ch);
			$result .= $Data;
			
		}
        if ( strpos($result,'parent.location="') !== false )
        {

            $NewUrl = $Utils->GetStr($result,'parent.location="/','"</script></head><body></body></html>');
            $NewUrl = "http://{$Url}/".$NewUrl;
            curl_setopt($ch, CURLOPT_URL, $NewUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $headers = array();
            $headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:54.0) Gecko/20100101 Firefox/54.0";
            $headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
            $headers[] = "Accept-Language: en-US,en;q=0.5";
            $headers[] = "Cookie: language=en";
            $headers[] = "Connection: keep-alive";
            $headers[] = "Upgrade-Insecure-Requests: 1";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            if ($BasicAuth != false ) {
                $Data = explode(":",$BasicAuth);
                $username = $Data[0];
                $password = $Data[1];
                curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
                $headers[] = "Content-Type: application/x-www-form-urlencoded";
            }
            $Data = curl_exec($ch);
            $result .= $Data;

        }
			if ( strpos($result,'302 Redirect') !== false )
			{
				$NewUrl = $Utils->GetStr($result,'Location: ',"\r\n");
				curl_setopt($ch, CURLOPT_URL, $NewUrl);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 1);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
				$headers = array();
				$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:54.0) Gecko/20100101 Firefox/54.0";
				$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
				$headers[] = "Accept-Language: en-US,en;q=0.5";
				$headers[] = "Cookie: language=en";
				$headers[] = "Connection: keep-alive";
				$headers[] = "Upgrade-Insecure-Requests: 1";
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				if ($BasicAuth != false ) {
					$Data = explode(":",$BasicAuth);
					$username = $Data[0];
					$password = $Data[1];
					curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
					$headers[] = "Content-Type: application/x-www-form-urlencoded";
				}
				$Data = curl_exec($ch);
				$result .= $Data;
			
			}

		$this->ch = $ch;
		return $result;
	}
	
	public function Parse($Response)
	{
		
		global $Utils;
		$result 		=  str_replace("<TITLE>","<title>",$Response);
		$result 		=  str_replace("</TITLE>","</title>",$result);
		$Title 			=  $Utils->GetStr($result,'<title>','</title>');
		$isBasicAuth 		=  ( strpos($result,"401 Unauthorized") !== false ) ? "Sim" : "Nao";
		$header_size 		=  curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
		$header 		=  substr($result, 0, $header_size);
		$body 			=  substr($result, $header_size);
		return str_replace("\r\n","","|".$Title."|".base64_encode($header)."|".base64_encode($body)."|");
	}	

}
