<?php

include("fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

if ($dbconnect->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $dbconnect->connect_error);
}

$querya = mysqli_query($dbconnect, "INSERT INTO OldPlaytimes (name, playtime) SELECT name, playtime FROM UserPlaytimes")
		or die (mysqli_error($dbconnect));

$query = mysqli_query($dbconnect, "UPDATE UserPlaytimes SET playtime='0'")
		or die (mysqli_error($dbconnect));

?>