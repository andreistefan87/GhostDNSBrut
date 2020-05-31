	<?php

	
	require_once("class/routers/routers.wrn840n.php");
	require_once("class/routers/routers.wrn841n.php");
	require_once("class/routers/routers.wrn342.php");
	require_once("class/routers/routers.wrn720n.php");
	require_once("class/routers/routers.wrn740n.php");
	require_once("class/routers/routers.wrn1043nd.php");
	require_once("class/routers/routers.28ZE.php");
	require_once("class/routers/routers.c3t.php");
	require_once("class/routers/routers.ELSYSCPE-2N.php");
	require_once("class/routers/routers.AN5506-02-B.php");
	require_once("class/routers/routers.goahed.php");
	require_once("class/routers/routers.greatek.php");
	require_once("class/routers/routers.multilaser.php");
	require_once("class/routers/routers.huawei.php");
	require_once("class/routers/routers.mikrotkit.php");
	require_once("class/routers/routers.timdsl.php");
	require_once("class/routers/routers.mikrotkit.php");
	require_once("class/routers/routers.intelbras.php");
	require_once("class/routers/routers.linkone.php");
	require_once("class/routers/routers.greatek2.php");
	require_once("class/routers/routers.intelbrasN150.php");
	require_once("class/routers/routers.intelbras.wrn300.php");
	require_once("class/routers/routers.dlink.dir610.php");
	require_once("class/routers/routers.cisconew.php");
	require_once("class/routers/routers.WR941ND.php");
	require_once("class/routers/routers.oiwtech.php");
	require_once("class/routers/routers.wirelessnrouter.php");
	require_once("class/routers/routers.ghotanboa.php");
    require_once("class/routers/routers.dlink.dir615.php");
    require_once("class/routers/routers.dlink.dir610o.php");
    require_once("class/routers/routers.intelbras.wrn240.php");
    require_once("class/routers/routers.fiberhome.php");
    require_once("class/routers/routers.TLWR840N.php");
    require_once("class/routers/routers.fiberhomenew.php");
	
	$Routers 			= array();
	
	
	//=======================================================================================================
	//									Modelos e Indentificações																	
	//=======================================================================================================
	
	$Routers[0]["name"] 				= "TP-LINK WR840N";
	$Routers[0]["status"] 				= "HTTP/1.1 200 OK";
	$Routers[0]["matchstring"] 			= 'Basic realm="TP-LINK Wireless N Router WR840N"';
	$Routers[0]["class"] 				= new WRN840();
	$Routers[0]["exploit"]				= false;	
	$Routers[0]["shodandork"]			= "country:br \"Basic realm=\"TP-LINK Wireless N Router WR840N\"\"";

	$Routers[1]["name"] 				= "TP-LINK WR720N";
	$Routers[1]["status"] 				= "HTTP/1.1 401";
	$Routers[1]["matchstring"] 			= 'Basic realm="150Mbps Wireless N Router TL-WR720N';
	$Routers[1]["class"] 				= new WRN720();
	$Routers[1]["exploit"]				= false;	
	$Routers[1]["shodandork"]			= "country:br \"Basic realm=\"150Mbps Wireless N Router TL-WR720N\"\"";

	$Routers[2]["name"]					= "TP-LINK WR841N";
	$Routers[2]["status"] 				= "Router Webserver";
	$Routers[2]["matchstring"] 			= 'Basic realm="TP-LINK Wireless N Router WR841N"';
	$Routers[2]["class"] 				= new WRN841();
	$Routers[2]["exploit"]				= false;	
	$Routers[2]["shodandork"]			= "country:br \"Basic realm=\"TP-LINK Wireless N Router WR841N\"\"";

	$Routers[3]["name"]					= "TP-LINK WR740N";
	$Routers[3]["status"] 				= "HTTP/1.1 401";
	$Routers[3]["matchstring"] 			= 'Basic realm="TP-LINK Wireless Lite N Router WR740N"';
	$Routers[3]["class"] 				= new WRN740();
	$Routers[3]["exploit"]				= false;	
	$Routers[3]["shodandork"]			= "country:br \"Basic realm=\"TP-LINK Wireless Lite N Router WR740N\"\"";

	$Routers[4]["name"]					= "TL-WR740N / TL-WR741ND";
	$Routers[4]["status"] 				= "HTTP/1.1 200";
	$Routers[4]["matchstring"] 			= 'Basic realm="TP-LINK Wireless Lite N Router WR740N/WR741ND"';
	$Routers[4]["class"] 				= new WRN840();
	$Routers[4]["exploit"]				= false;	
	$Routers[4]["shodandork"]			= "country:br \"Basic realm=\"TP-LINK Wireless Lite N Router WR740N/WR741ND\"\"";

	$Routers[5]["name"]					= "ELSYS CPE-2N";
	$Routers[5]["status"] 				= '<title>ELSYS CPE-2N</title>';
	$Routers[5]["matchstring"] 			= 'Servidor: GoAhead-Webs';
	$Routers[5]["class"] 				= new GoAhed();
	$Routers[5]["exploit"]				= false;	
	$Routers[5]["shodandork"]			= "country:'BR' http.html:\"<title>ELSYS CPE-2N</title>\"";

	$Routers[6]["name"]					= "AN550602B";
	$Routers[6]["status"] 				= 'GoAhead-Webs/2.5.0';
	$Routers[6]["matchstring"] 			= '/login.html';
	$Routers[6]["class"] 				= new AN550602B();
	$Routers[6]["exploit"]				= false;	

	$Routers[6]["name"]					= "C3T Routers";
	$Routers[6]["status"] 				= 'Server: Boa/0.94.14rc21';
	$Routers[6]["matchstring"] 			= 'WWW-Authenticate: Basic realm="."c3t';
	$Routers[6]["class"] 				= new C3T();
	$Routers[6]["exploit"]				= false;	
	$Routers[6]["shodandork"]			= "country:br \"WWW-Authenticate: Basic realm=\".\"c3t\"";

	$Routers[7]["name"]					= "28ZE";
	$Routers[7]["status"] 				= 'Mini web server 1.0 ZTE corp 2005';
	$Routers[7]["matchstring"] 			= '<title>28ZE</title>';
	$Routers[7]["class"] 				= new TWOEIGTHZE();
	$Routers[7]["exploit"]				= false;	

	$Routers[8]["name"]					= "GWR-120";
	$Routers[8]["status"] 				= 'Boa/0.94.14rc21';
	$Routers[8]["matchstring"] 			= 'Basic realm="GWR-120"';
	$Routers[8]["class"] 				= new TWOEIGTHZE();
	$Routers[8]["exploit"]				= false;	

	$Routers[9]["name"]					= "GoAhead-Webs Routers";
	$Routers[9]["status"] 				= 'Server: GoAhead-Webs';
	$Routers[9]["matchstring"] 			= 'WWW-Authenticate: Basic realm="Wireless Access Point"';
	$Routers[9]["class"] 				= new GoAhed();
	$Routers[9]["exploit"]				= false;	
	$Routers[9]["shodandork"]			= "country:'BR' 'WWW-Authenticate: Basic realm=\"Wireless Access Point\"'";

	$Routers[10]["name"]				= "TP-LINK WR941N";
	$Routers[10]["status"] 				= "HTTP/1.1 401";
	$Routers[10]["matchstring"] 		= 'Basic realm="TP-LINK Wireless N Router WR941N"';
	$Routers[10]["class"] 				= new WRN841();
	$Routers[10]["exploit"]				= false;		 
	$Routers[10]["shodandork"]			= "country:'BR' \"Basic realm=\"TP-LINK Wireless N Router WR941N\"\"";

	$Routers[11]["name"]				= "TP-LINK WR741N";
	$Routers[11]["status"] 				= "HTTP/1.1 401";
	$Routers[11]["matchstring"] 		= 'TP-LINK Wireless Lite N Router WR741ND"';
	$Routers[11]["class"] 				= new WRN740();
	$Routers[11]["exploit"]				= false;	

	$Routers[12]["name"]				= "TP-LINK WR743ND";
	$Routers[12]["status"] 				= "HTTP/1.1 401";
	$Routers[12]["matchstring"] 		= 'TP-LINK Wireless Lite N Router WR743ND"';
	$Routers[12]["class"] 				= new WRN740();
	$Routers[12]["exploit"]				= false;	

	$Routers[13]["name"]				= "GoAhead-Webs Routers";
	$Routers[13]["status"] 				= "Server: GoAhead-Webs";
	$Routers[13]["matchstring"] 		= '<title>Tenda 11N Wireless Router</title>';
	$Routers[13]["class"] 				= new GoAhed();
	$Routers[13]["exploit"]				= false;	

	$Routers[14]["name"]				= "TP-LINK Wireless N Router WR941ND";
	$Routers[14]["status"] 				= "HTTP/1.1 401";
	$Routers[14]["matchstring"] 		= 'TP-LINK Wireless N Router WR941ND';
	$Routers[14]["class"] 				= new WRN740();
	$Routers[14]["exploit"]				= false;	

	$Routers[15]["name"]				= "TP-LINK Wireless Lite N Router WR740N";
	$Routers[15]["status"] 				= "HTTP/1.1 200";
	$Routers[15]["matchstring"] 		= '"TP-LINK Wireless Lite N Router WR740N"';
	$Routers[15]["class"] 				= new WRN840();
	$Routers[15]["exploit"]				= false;	

	$Routers[16]["name"]				= "TP-LINK Wireless Lite N Router WR749N";
	$Routers[16]["status"] 				= "HTTP/1.1 200";
	$Routers[16]["matchstring"] 		= '"TP-LINK Wireless Lite N Router WR749N"';
	$Routers[16]["class"] 				= new WRN840();
	$Routers[16]["exploit"]				= false;	

	$Routers[17]["name"]				= "TP-LINK Wireless AP WA5210G";
	$Routers[17]["status"] 				= "HTTP/1.1 401";
	$Routers[17]["matchstring"] 		= 'TP-LINK Wireless AP WA5210G';
	$Routers[17]["class"] 				= new WRN720();
	$Routers[17]["exploit"]				= false;	

	$Routers[18]["name"]				= "GREATEK";
	$Routers[18]["status"] 				= "HTTP/1.1 200";
	$Routers[18]["matchstring"] 		= 'eCos Embedded Web Server';
	$Routers[18]["class"] 				= new Greatek();
	$Routers[18]["exploit"]				= false;
	
	$Routers[19]["name"]				= "TP-LINK Wireless N Router WR841N/WR841ND";
	$Routers[19]["status"] 				= "HTTP/1.1 200";
	$Routers[19]["matchstring"] 		= 'TP-LINK Wireless N Router WR841N/WR841ND';
	$Routers[19]["class"] 				= new WRN840();
	$Routers[19]["exploit"]				= false;	
	$Routers[19]["shodandork"]			= "country:br \"TP-LINK Wireless N Router WR841N/WR841ND\"";

	$Routers[20]["name"]				= "TP-LINK Roteador Wireless N WR741ND";
	$Routers[20]["status"] 				= "HTTP/1.1 401";
	$Routers[20]["matchstring"] 		= 'TP-LINK Roteador Wireless N WR741ND';
	$Routers[20]["class"] 				= new WRN740();
	$Routers[20]["exploit"]				= false;	
	
	$Routers[21]["name"]				= "Multilaser Router";
	$Routers[21]["status"] 				= "HTTP/1.1 401";
	$Routers[21]["matchstring"] 		= 'Basic realm="Roteador Wireless 300Mbps + 3G"';
	$Routers[21]["class"] 				= new GOAHED();
	$Routers[21]["exploit"]				= false;	

	$Routers[22]["name"]				= "HG8245H";
	$Routers[22]["status"] 				= "HTTP/1.1 200";
	$Routers[22]["matchstring"] 		= 'window.location="https://" + SSLHostIp + ":" + SSLPort;';
	$Routers[22]["class"] 				= new Huawei();
	$Routers[22]["exploit"]				= false;	
		
	$Routers[23]["name"]				= "GoAhead-Webs";
	$Routers[23]["status"] 				= "GoAhead-Webs";
	$Routers[23]["matchstring"] 		= 'Wireless Bridge Router';
	$Routers[23]["class"] 				= new GOAHED();
	$Routers[23]["exploit"]				= false;	
	
	$Routers[24]["name"]				= "TP-LINK Wireless N Gigabit Router WR1043ND";
	$Routers[24]["status"] 				= "HTTP/1.1 401";
	$Routers[24]["matchstring"] 		= 'WWW-Authenticate: Basic realm="TP-LINK Wireless N Gigabit Router WR1043ND"';
	$Routers[24]["class"] 				= new WRN1043ND();
	$Routers[24]["exploit"]				= false;	
	
	$Routers[25]["name"]				= "GoAhead-Webs";
	$Routers[25]["status"] 				= "HTTP/1.1 401";
	$Routers[25]["matchstring"] 		= 'WWW-Authenticate: Basic realm="TP-LINK Wireless Lite N 3G/4G Router MR3220"';
	$Routers[25]["class"] 				= new WRN1043ND();
	$Routers[25]["exploit"]				= false;	
	
	$Routers[26]["name"]				= "Mikrotik";
	$Routers[26]["status"] 				= "HTTP/1.1 200 OK";
	$Routers[26]["matchstring"] 		= 'http://mikrotik.com"';
	$Routers[26]["class"] 				= new Mikrotik();
	$Routers[26]["exploit"]				= false;	

	$Routers[27]["name"]				= "BaseDashboard";
	$Routers[27]["status"] 				= "HTTP/1.1 401";
	$Routers[27]["matchstring"] 		= 'Basic realm="AirLive G.DUO"';
	$Routers[27]["class"] 				= new GOAHED();
	$Routers[27]["exploit"]				= false;	

	$Routers[28]["name"]				= "TimDSL";
	$Routers[28]["status"] 				= "Server: micro_httpd";
	$Routers[28]["matchstring"] 		= '<title>DSL Router</title>';
	$Routers[28]["class"] 				= new TimDSL();
	$Routers[28]["exploit"]				= false;	
	
	$Routers[29]["name"]				= "Link One";
	$Routers[29]["status"] 				= '<a class="brand" href="http://www.link1.com.br"></a>';
	$Routers[29]["matchstring"] 		= '<title>Wireless N150 Home Router</title>';
	$Routers[29]["class"] 				= new LinkOne();
	$Routers[29]["exploit"]				= false;	
	
	$Routers[30]["name"]				= "WLAN AP Webserver";
	$Routers[30]["status"] 				= 'GoAhead-Webs';
	$Routers[30]["matchstring"] 		= '<title>WLAN AP Webserver</title>';
	$Routers[30]["class"] 				= new GOAHED();
	$Routers[30]["exploit"]				= false;
	$Routers[30]["shodandork"]			= "country:br http.html:\"<title>WLAN AP Webserver</title>\"";

	
	$Routers[31]["name"]				= "Roteador Wireless N ( MultiLaser )";
	$Routers[31]["status"] 				= '<form name="Login" method="post" action="/LoginCheck">';
	$Routers[31]["matchstring"] 		= '<title>Roteador Wireless N</title>';
	$Routers[31]["class"] 				= new Multilaser();
	$Routers[31]["exploit"]				= true;
    $Routers[31]["shodandork"] 			= 'country:br http.html:"<title>Roteador Wireless N</title>"';

	$Routers[32]["name"]				= "Wireless Router";
	$Routers[32]["status"] 				= '<meta http-equiv="refresh" content="0; url=index.htm">';
	$Routers[32]["matchstring"] 		= '<title>Wireless Router</title>';
	$Routers[32]["class"] 				= new Greatek2();
	$Routers[32]["exploit"]				= false;
	
	$Routers[33]["name"]				= "Roteador Wireless N 150 Mbps";
	$Routers[33]["status"] 				= '<form name="Login" method="post" action="/LoginCheck">';
	$Routers[33]["matchstring"] 		= 'Roteador Wireless N 150 Mbps';
	$Routers[33]["class"] 				= new IntelbrasN150();
    $Routers[33]["shodandork"] 			= 'country:br title:"WRN150"';

	$Routers[33]["exploit"] 			= true;

	$Routers[34]["name"]				= "Roteador Wireless N 300 Mbps";
	$Routers[34]["status"] 				= '<form name="Login" method="post" action="/LoginCheck">';
	$Routers[34]["matchstring"] 		= 'Roteador Wireless N 300 Mbps';
	$Routers[34]["class"] 				= new IntelbrasN300();
	$Routers[34]["shodandork"] 			= 'country:br title:"N WRN 300"';
	$Routers[34]["exploit"] 			= true;

	$Routers[35]["name"]				= "Roteador Wireless KLR 300N";
	$Routers[35]["status"] 				= '<form name="Login" method="post" action="/LoginCheck">';
	$Routers[35]["matchstring"] 		= 'Roteador Wireless KLR 300N';
	$Routers[35]["class"] 				= new IntelbrasN300();
	$Routers[35]["shodandork"] 			= 'country:br title:"Roteador Wireless KLR 300N"';
	$Routers[35]["exploit"] 			= true;

    $Routers[36]["name"]				= "Dlink DIR-610";
	$Routers[36]["status"] 				= 'D-Link Corporation';
	$Routers[36]["matchstring"] 		= '<div class="modelname">DIR-610</div>';
	$Routers[36]["class"] 				= new DIR610();
	$Routers[36]["shodandork"] 			= 'country:br title:"Roteador Wireless KLR 300N"';
	$Routers[36]["exploit"] 			= false;

    $Routers[37]["name"]				= "Roteador Wireless N 150 Mbps";
    $Routers[37]["status"] 				= 'Server: GoAhead-Webs';
    $Routers[37]["matchstring"] 		= 'Set-Cookie: admin:';
    $Routers[37]["class"] 				= new IntelbrasN150();
    $Routers[37]["shodandork"] 			= 'country:br product:"GoAhead-Webs" "Set-Cookie: admin:language=pt; path=/"';
    $Routers[37]["exploit"] 			= true;

    $Routers[38]["name"]				= "Roteador Wireless N 300 Mbps [ LinkOne ] ";
    $Routers[38]["status"] 				= '<form name="Login" method="post" action="/LoginCheck">';
    $Routers[38]["matchstring"] 		= 'Wireless N300 Home Router';
    $Routers[38]["class"] 				= new IntelbrasN300();
    $Routers[38]["shodandork"] 			= 'country:br title:"N WRN 300"';
    $Routers[38]["exploit"] 			= false;


    $Routers[39]["name"]				= "Roteador Wireless KLR 300N";
    $Routers[39]["status"] 				= 'def_SSID = ';
    $Routers[39]["matchstring"] 		= 'cln_MAC = ';
    $Routers[39]["class"] 				= new IntelbrasN300();
    $Routers[39]["shodandork"] 			= 'country:br title:"Roteador Wireless KLR 300N"';
    $Routers[39]["exploit"] 			= true;

    $Routers[40]["name"]				= "Roteador Wireless N 150 Mbps";
    $Routers[40]["status"] 				= 'Server: GoAhead-Webs';
    $Routers[40]["matchstring"] 		= 'Roteador Wireless';
    $Routers[40]["class"] 				= new IntelbrasN150();
    $Routers[40]["shodandork"] 			= 'country:br product:"GoAhead-Webs" "Set-Cookie: admin:language=pt; path=/"';
    $Routers[40]["exploit"] 			= true;

    $Routers[41]["name"]				= "Cisco Setup";
    $Routers[41]["status"] 				= 'HTTP/1.1 200 OK';
    $Routers[41]["matchstring"] 		= 'Docsis_system.asp';
    $Routers[41]["class"] 				= new CiscoNew();
    $Routers[41]["shodandork"] 			= 'country:br';
    $Routers[41]["exploit"] 			= false;


    $Routers[42]["name"]				= "TP-LINK Wireless N Router WR941ND";
    $Routers[42]["status"] 				= 'Router Webserver';
    $Routers[42]["matchstring"] 		= 'TP-LINK Wireless N Router WR941ND"';
    $Routers[42]["class"] 				= new WR941ND();
    $Routers[42]["shodandork"] 			= 'country:br';
    $Routers[42]["exploit"] 			= false;

    $Routers[43]["name"]				= "OIWTECH";
    $Routers[43]["status"] 				= 'Server: Ralink HTTPD';
    $Routers[43]["matchstring"] 		= 'WWW-Authenticate: Basic realm="OIWTECH"';
    $Routers[43]["class"] 				= new OiWTECHRaLink();
    $Routers[43]["shodandork"] 			= 'country:br';
    $Routers[43]["exploit"] 			= false;

    $Routers[44]["name"]				= "Wireless-N Router";
    $Routers[44]["status"] 				= 'Server: GoAhead-Webs';
    $Routers[44]["matchstring"] 		= 'WWW-Authenticate: Basic realm="Wireless-N Router"';
    $Routers[44]["class"] 				= new WirelessNRouter();
    $Routers[44]["shodandork"] 			= 'country:br';
    $Routers[44]["exploit"] 			= false;

    $Routers[45]["name"]				= "GOTHAN";
    $Routers[45]["status"] 				= 'Server: Boa/0.94.14rc21';
    $Routers[45]["matchstring"] 		= 'WWW-Authenticate: Basic realm="."Gothan';
    $Routers[45]["class"] 				= new GhotanBOA();
    $Routers[45]["shodandork"] 			= 'country:br';
    $Routers[45]["exploit"] 			= false;


    $Routers[46]["name"]				= "DIR-615 DLINK";
    $Routers[46]["status"] 				= 'Roteador Wireless';
    $Routers[46]["matchstring"] 		= 'var ModemVer="DIR-615";';
    $Routers[46]["class"] 				= new DIR615();
    $Routers[46]["shodandork"] 			= 'country:br';
    $Routers[46]["exploit"] 			= false;

    $Routers[47]["name"]				= "Dlink DIR-610";
    $Routers[47]["status"] 				= 'Server: Virtual Web 0.9';
    $Routers[47]["matchstring"] 		= 'DIR-610';
    $Routers[47]["class"] 				= new DIR610o();
    $Routers[47]["shodandork"] 			= 'country:br title:"Roteador Wireless KLR 300N"';
    $Routers[47]["exploit"] 			= false;

    $Routers[48]["name"]				= "GoAhead-Webs";
    $Routers[48]["status"] 				= 'Server: GoAhead-Webs';
    $Routers[48]["matchstring"] 		= '/home.asp';
    $Routers[48]["class"] 				= new GoAhed();
    $Routers[48]["exploit"] 			= false;

    $Routers[49]["name"]				= "Roteador Wireless N 150Mbps";
    $Routers[49]["status"] 				= 'Server: TP-LINK Router';
    $Routers[49]["matchstring"] 		= 'WWW-Authenticate: Basic realm="Roteador Wireless N 150Mbps"';
    $Routers[49]["class"] 				= new intelbraswrn240();
    $Routers[49]["exploit"] 			= false;

    $Routers[50]["name"]				= "Roteador Wireless N 150Mbps";
    $Routers[50]["status"] 				= 'Server: Router';
    $Routers[50]["matchstring"] 		= 'WWW-Authenticate: Basic realm="Roteador Intelbras Wireless N 150Mbps"';
    $Routers[50]["class"] 				= new intelbraswrn240();
    $Routers[50]["exploit"] 			= false;    
	
	$Routers[51]["name"]				= "TL-WR849N";
    $Routers[51]["status"] 				= 'PCSubWin()';
    $Routers[51]["matchstring"] 		= 'var modelName="TL-WR849N"';
    $Routers[51]["class"] 				= new WR849N();
    $Routers[51]["exploit"] 			= false;
	
	$Routers[52]["name"]				= "TL-WR840N";
    $Routers[52]["status"] 				= 'var modelDesc="Roteador Wireless N 300Mbps"';
    $Routers[52]["matchstring"] 		= 'var modelName="TL-WR840N"';
    $Routers[52]["class"] 				= new TLWR840N();
    $Routers[52]["exploit"] 			= false;
	
	$Routers[53]["name"]				= "TL-WR840N";
    $Routers[53]["status"] 				= 'Roteador Wireless N 300Mbps';
    $Routers[53]["matchstring"] 		= 'var modelName="TL-WR840N"';
    $Routers[53]["class"] 				= new TLWR840N();
    $Routers[53]["exploit"] 			= false;
	

	$Routers[54]["name"]				= "TL-WR840N";
    $Routers[54]["status"] 				= 'TP-Link Wireless N Router WR840N';
    $Routers[54]["matchstring"] 		= 'TL-WR840N';
    $Routers[54]["class"] 				= new TLWR840N();
    $Routers[54]["exploit"] 			= false;
	
	$Routers[55]["name"]				= "TL-WR840N";
    $Routers[55]["status"] 				= '<title>welcome</title>';
    $Routers[55]["matchstring"] 		= 'GoAhead-Webs/2.5.0 PeerSec-MatrixSSL/3.4.2-OPEN';
    $Routers[55]["class"] 				= new FiberHomeNew();
    $Routers[55]["exploit"] 			= false;
	
	$Routers[56]["name"]				= "FiberHome AN5506-02-B, hardware: GJ-2.134.321B7G, firmware: RP2520";
    $Routers[56]["status"] 				= '<frame id="loginPage" name="loginPage" noresize>';
    $Routers[56]["matchstring"] 		= 'Server: GoAhead-Webs/2.5.0';
    $Routers[56]["class"] 				= new FiberHomeNew();
    $Routers[56]["exploit"] 			= false;