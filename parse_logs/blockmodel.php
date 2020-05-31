<?php
/**
 * Created by PhpStorm.
 * User: marcosmx
 * Date: 29/10/17
 * Time: 16:11
 */
require_once ("../application/config.init.php");
if ( isset($_GET["titulo"]) && !empty($_GET["titulo"])) {
    $Titulo = urldecode($_GET["titulo"]);
}
$WebInterface->BlockTitle($Titulo);

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
    <meta http-equiv="refresh" content="1;URL='index.php'" />
</head>
<body>


<div class="container"><br>
    <div class="alert alert-success">
        <strong>Status : </strong>  Bloqueado com Sucesso

    </div>
</div>

</body>
</html>
