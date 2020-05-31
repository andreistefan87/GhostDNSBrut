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
<a href="index.php" style="z-index:999999; position:fixed; " class="btn btn-info"> Voltar </a>
<div class="container">

    <h2></h2>
    <p></p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Ip Address</th>
            <th>Header</th>
            <th>Body</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($WebInterface->ContentByTitle($Titulo) as $Item )
        {
            $Content  = "<tr>";
            $Content .= "<td><a href='viewsingle.php?ip=".$Item["ip"]."'>".$Item["ip"]."</a></td>";
            $Content .= "<td> Header </td>";
            $Content .= "<td> Body </td>";
            $Content .= "</tr>";
            echo  $Content;
        }

        ?>

        </tbody>
    </table>
</div>

</body>
</html>
