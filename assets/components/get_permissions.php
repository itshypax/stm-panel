<?php

include('../../assets/components/fb37dbconnect.php');

$permsconnect=mysqli_connect($hostname,$username,$password,$dbname);

$steaid=$steamprofile['steamid'];
$getperms = mysqli_query($permsconnect, "SELECT * FROM panelUsers WHERE steamid='".$steaid."'") or die (mysqli_error($permsconnect));
$permission = mysqli_fetch_assoc($getperms);

$perm_admin = $permission['admin'];
$perm_ma = $permission['manageApplications'];
$perm_mm = $permission['manageMembers'];
$perm_mmn = $permission['manageMemberNotes'];
$perm_vt = $permission['viewTime'];
$perm_vdb = $permission['viewDashboard'];

$u_rank = $permission['displayRank'];

if ($u_rank == "Admin") {
    $u_rank_cl = "badge text-bg-danger";
} elseif ($u_rank == "Verwaltung") {
    $u_rank_cl = "badge text-bg-warning";
} elseif ($u_rank == "Personaler") {
    $u_rank_cl = "badge text-bg-success";
} elseif ($u_rank == "Ausbilder") {
    $u_rank_cl = "badge text-bg-info";
} else {
    $u_rank_cl = "badge text-bg-secondary";
}

?>