<?php
set_time_limit(0);
require_once( "class/utils/class.webrequest.php" );
require_once( "class/utils/class.colors.php" );
require_once( "class/utils/class.utils.php" );
require_once( "class/scanner/class.scanner.utils.php" );
require_once( "class/shodan/class.shodan.php");
require_once( "class/web/class.web.api.php");
require_once( "class/web/class.web.interface.php");
require_once( "config.routers.php" );
require_once( "config.bruteforce.php" );
require_once( "config.scanner.php" );
require_once( "config.rangelist.php" );
require_once( "config.layout.php" );

$WebRequest 			    = new CWebRequest();
$Utils					    = new Utils();
$Colors					    = new Colors();
$PortScanner			    = new RangedPortScanner ();
$Shodan                     = new Shodan();
$WebInterface               = new WebInterface();
$WebApi                     = new WebApi();