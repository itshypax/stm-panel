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
require '../steamauth/steamauth.php';
include("fb37dbconnect.php");
include ('../steamauth/userInfo.php');
include("registerpaneluser.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);
$id=$_REQUEST['id'];
// Mindestens benötigte Berechtigung: Personaler
if ($uPermLevel >= 2) {
$result = mysqli_query($dbconnect,"UPDATE memberManagement SET deleted = 1 WHERE id='".$id."'") or die ( mysqli_error());
header("Location: ../../fachbereiche/37/mitarbeiter.php"); 
} else {
    header("Location: ../../fachbereiche/37/mitarbeiter.php"); 
}
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>