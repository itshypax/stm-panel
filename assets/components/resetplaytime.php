<?php

include("fb37dbconnect.php");

$dbconnect = mysqli_connect($hostname, $username, $password, $dbname);

if ($dbconnect->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $dbconnect->connect_error);
}

mysqli_query($dbconnect, "TRUNCATE table OldPlaytimes") or die(mysqli_error($dbconnect));

sleep(10);

mysqli_query($dbconnect, "INSERT INTO OldPlaytimes (name, playtime) SELECT name, playtime FROM UserPlaytimes") or die(mysqli_error($dbconnect));

sleep(30);

mysqli_query($dbconnect, "UPDATE UserPlaytimes SET playtime='0'") or die(mysqli_error($dbconnect));
