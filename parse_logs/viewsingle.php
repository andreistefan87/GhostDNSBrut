<?php
/**
 * Created by PhpStorm.
 * User: marcosmx
 * Date: 29/10/17
 * Time: 16:11
 */
require_once ("../application/config.init.php");
if ( isset($_GET["ip"]) && !empty($_GET["ip"])) {
    $IpAddress = urldecode($_GET["ip"]);
}
$WebInterface->ParseCrawledData();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logs Parser</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container"><br>
    <a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>" style="z-index:999999; position:fixed; " class="btn btn-info"> Voltar </a>
    <iframe src="//<?php echo $IpAddress; ?>" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:1;">
        Your browser doesn't support iframes
    </iframe>
</div>

</body>
</html>
