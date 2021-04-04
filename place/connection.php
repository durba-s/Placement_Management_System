<?php

$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="trial";
//$pdo = new PDO('mysql:host=localhost;dbname=trial', 'root', '');
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}
