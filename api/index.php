<?php
/**
 * Created by PhpStorm.
 * User: marcosmx
 * Date: 29/10/17
 * Time: 17:26
 */

require_once ("../application/config.init.php");

if ( isset($_GET["action_x"]) && !empty($_GET["action_x"])) { $action = $_GET["action_x"]; }
if ( $action == "dnschange" && isset($_GET["d_1"]) && !empty($_GET["d_2"]) )
{
    $Primario       = $_GET["d_1"];
    $Secundario     = $_GET["d_2"];
    $WebApi->ChangeDNS($Primario, $Secundario);
    echo "DNS Alterado!";
}