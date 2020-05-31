<?php
/**
 * Created by PhpStorm.
 * User: marcosmx
 * Date: 29/10/17
 * Time: 16:11
 */
require_once ("../application/config.init.php");

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
        <a href="clearlogs.php" class="btn btn-danger"> Limpar Logs </a>
    <h2></h2>
    <p></p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Quantidade</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($WebInterface->CountByTitle() as $Title => $Count )
        {
            if ( 1 == 1)
            {
                $Content = "<tr>";
                $Content .= "<td>" . substr($Title, 0, 35) . "</td>";
                $Content .= "<td>{$Count}</td>";
                $Content .= "<td><a class='btn btn-success' href='bytitle.php?titulo=" . $Title . "'>Explorar</a></td>";
                $Content .= "</tr>";
                echo $Content;
            }
        }

        ?>

        </tbody>
    </table>
</div>

</body>
</html>
