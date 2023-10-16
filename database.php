<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "coviddb";
    $con=mysqli_connect($servername, $username, $password, $database);
    if(!$con){
        die('Could not Connect My Sql:' .mysql_error());
    }
?>