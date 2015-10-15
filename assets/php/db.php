<?php
try {
	$Server = "localhost";
	$Username = "root";
	$Password = "";
	$pdo = new PDO("mysql:dbname=fkg;host=$Server", "$Username", "$Password" );
	$pdo->exec("set names utf8");
}
catch(PDOException $e)
{
	echo '<script> alert("Could not connect") </script>';
	throw $e;
}
?>