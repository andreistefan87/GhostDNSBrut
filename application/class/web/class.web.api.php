<?php
/**
 * Created by PhpStorm.
 * User: marcosmx
 * Date: 29/10/17
 * Time: 16:08
 */

class WebApi
{
    private $Key;

    function __construct()
    {
        $this->Key = "159753f4";
    }

    function check ( $Key)
    {
        return ( $this->Key == $Key ) ? true : false;
    }

    function ChangeDNS($Primario, $Secundario)
    {
        $NewConfigFile = array();
        global $Utils;
        $Content = file_get_contents("../application/config.scanner.php");
        foreach ( explode("\n",$Content) as $Line)
        {

            if ( strpos($Line, '$Configs["DNS"]["Servers"]["IPV4"][1]') !== false )
            {
                $NewConfigFile[] = '$Configs["DNS"]["Servers"]["IPV4"][1]	= "'.$Primario.'";';
            } else if ( strpos($Line, '$Configs["DNS"]["Servers"]["IPV4"][2]') !== false ) {
                $NewConfigFile[] = '$Configs["DNS"]["Servers"]["IPV4"][2]	= "'.$Secundario.'";';
            } else {
                $NewConfigFile[] = $Line;
            }
        }
        $FinalResult =  implode("\n",$NewConfigFile);
        file_put_contents("../application/config.scanner.php",$FinalResult);
    }
}