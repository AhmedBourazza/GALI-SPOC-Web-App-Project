<?php
$serverName="localHost";
$dbUserName="root";
$dbPassword="root";
$dbName="galispoc";
$conn=mysqli_connect($serverName,$dbUserName,$dbPassword,$dbName);
if(!$conn)
{
    die("Connection failed: ". mysqli_connect_error());

}
