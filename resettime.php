<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>

<?php
require '/assets/steamauth/steamauth.php';
include("/assets/components/fb37dbconnect.php");
include ('/assets/steamauth/userInfo.php');
include("/assets/components/registerpaneluser.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);
// Mindestens benötigte Berechtigung: Admin
if ($uPermLevel >= 4) {
$result = mysqli_query($dbconnect,"UPDATE UserPlaytimes SET online = '0', server = NULL") or die ( mysqli_error());
header("Location: https://wiesberg.net/fachbereiche/37/zeiten.php"); 
} else {
    header("Location: https://wiesberg.net/fachbereiche/37/index.php"); 
}
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>