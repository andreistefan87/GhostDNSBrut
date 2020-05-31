<?php
/**
 * Created by PhpStorm.
 * User: marcosmx
 * Date: 23/10/17
 * Time: 12:34
 */
require_once(str_replace('\\','/',realpath(dirname(__FILE__)))."/../application/config.init.php");
$Shodan         = new Shodan();
$RangeMOdels    = array();
while (1 == 1 ) 
{
	foreach ( $Routers as $Item )
	{
		if ( isset($Item["shodandork"]) && !empty($Item["shodandork"]) &&  isset($Item["exploit"]) ) 
		{
			$Shodan->AddNewQuery($Item["shodandork"]);
		}
	}
		
		



	$Shodan->Login("BielRox1337","Renato6612");
	$Shodan->ParseResult();
}
