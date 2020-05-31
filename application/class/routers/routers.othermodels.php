<?php

class OtherModels
{
	private $ch;
	private $Host;
	private $User;
	private $Pass;
	private $Logged;
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
		return true;
	}
	
	
	public function DoOthers($Host,$User,$Pass)
	{
		return true;
	}
	
	public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
	{
		$OtherModels 	= array();
		$OtherModels[]	= "";
	}
	
}