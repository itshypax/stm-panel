<?php

include("../../assets/components/fb37dbconnect.php");

$reguserdb=mysqli_connect($hostname,$username,$password,$dbname);

if ($reguserdb->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $reguserdb->connect_error);
}


$currentUserSteamID = $steamprofile['steamid'];
$reguserquery1 = mysqli_query($reguserdb,"SELECT * FROM panelUsers WHERE `steamid` = '".$currentUserSteamID."'");
$regusernum = mysqli_num_rows($reguserquery1);
$regusernameres = mysqli_fetch_array($reguserquery1);

if(isset($_POST['new']) && $_POST['new']==1){
    $uid=$_REQUEST['id'];
    $urpname =$_REQUEST['rpname'];
    mysqli_query($reguserdb,"UPDATE panelUsers SET rpname='".$urpname."' WHERE id='".$uid."'")
    or die(mysql_error());
    header("Refresh:0");
    header("Refresh:0");
}

if ($regusernum != 1) {
        $reguserdatetime = date("Y-m-d H:i:s");
        mysqli_query($reguserdb,"INSERT INTO panelUsers (`steamid`, `regAt` , `displayRank`, `admin`) VALUES ('".$currentUserSteamID."', '".$reguserdatetime."', 'Gast', 0)");
        header("Refresh:0");
    } else {
        if($regusernameres['rpname'] == NULL) { 
            ?>
            <!-- Modal -->
            <div class="modal fade show" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" style="display: block; background-color: rgb(0 0 0 / .35);" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLiveLabel">RP Namen festlegen</h5>
                        </div>
                        <div class="modal-body">
                            <form name="form" method="post" action="">
                                <input type="hidden" name="new" value="1" />
                                <input name="id" type="hidden" value="<?php echo $regusernameres['id'];?>" />
                                <div class="form-floating mb-3">
                                    <input id="floatingInput" class="form-control rounded-3" type="text" name="rpname" placeholder="TheLegend27" required>
                                    <label for="floatingInput">Vor- und Zuname</label>
                                </div>
                                <p><input class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Speichern" /></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }

        $uPermission = $regusernameres['displayRank'];
        $uPermAdmin = $regusernameres['admin'];
        if ($uPermission == "Admin") {
            $uPermLevel = 4;
        }
        elseif ($uPermission == "Verwaltung") {
            $uPermLevel = 3;
        }
        elseif ($uPermission == "Personaler") {
            $uPermLevel = 2;
        }
        elseif ($uPermission == "Ausbilder") {
            $uPermLevel = 1;
        }
        else {
            $uPermLevel = 0;
        }
        
        if ($regusernameres['displayRank'] == "Admin") {
            $urnkBadge = "<span class='badge text-bg-danger'>Admin</span>";
        } elseif ($regusernameres['displayRank'] == "Verwaltung") {
            $urnkBadge = "<span class='badge text-bg-warning'>Verwaltung</span>";
        } elseif ($regusernameres['displayRank'] == "Personaler") {
            $urnkBadge = "<span class='badge text-bg-info'>Personaler</span>";
        } elseif ($regusernameres['displayRank'] == "Ausbilder") {
            $urnkBadge = "<span class='badge text-bg-success'>Ausbilder</span>";
        } else {
            $urnkBadge = "<span class='badge text-bg-secondary'>Gast</span>";
        }
    }

?>