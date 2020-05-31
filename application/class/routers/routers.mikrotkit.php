<?php



class Mikrotik
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

	}
	
	
	public function DoOthers($Host,$User,$Pass)
	{
		if ($this->Logged)
		{
			
		}
	}
	
	public function ChangeDNS($Host,$User,$Pass,$DNS1,$DNS2)
	{

	}
}
?>
