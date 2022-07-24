<div class="container sticky-top" style="background-color: #fff;">
  <nav class="navbar navbar-expand-lg" style="background-color: #fff;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="https://strassenmeisterei-neuberg.de/assets/images/tcMPe2F2.png" alt="Wiesberg" height="64" width="auto" class="d-inline-block align-text-center"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php
          // Mindestens benötigte Berechtigung: Ausbilder
          if ($uPermLevel >= $perm_level_user) { ?>
            <li class="nav-item">
              <a class="nav-link" href="https://strassenmeisterei-neuberg.de/index.php">Dashboard</a>
            </li>
          <?php }
          // Wenn die Berechtigung NICHT Ausbilder ist ...
          if ($userPermlevel != $perm_level_user or $userPermlevel != $perm_level_instructor) { ?>
            <li class="nav-item">
              <a class="nav-link" href="https://strassenmeisterei-neuberg.de/bewerben.php">Bewerbungsportal</a>
            </li>
          <?php
          }
          // Mindestens benötigte Berechtigung: Ausbilder
          if ($uPermLevel >= $perm_level_instructor) { ?>
            <li class="nav-item">
              <a class="nav-link" href="https://strassenmeisterei-neuberg.de/mitarbeiter.php">Mitarbeiterübersicht</a>
            </li>
          <?php }
          // Mindestens benötigte Berechtigung: Personaler
          if ($uPermLevel >= $perm_level_hr) { ?>
            <li class="nav-item">
              <a class="nav-link" href="https://strassenmeisterei-neuberg.de/zeiten.php">Zeitübersicht <span class="badge text-bg-dark">BETA</span></a>
            </li>
          <?php }
          // Mindestens benötigte Berechtigung: Admin
          if ($uPermLevel >= $perm_level_admin) { ?>
            <li class="nav-item">
              <a class="nav-link" href="https://strassenmeisterei-neuberg.de/admin/user-management.php">Panel Benutzer</a>
            </li>
          <?php } ?>
          <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
          <!-- <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li> -->
        </ul>
        <div class="dropdown dropstart text-end pe-5">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= $steamprofile['avatarmedium'] ?>" alt="Profilbild" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li class="dropdown-item-text"><strong><?= $regusernameres['rpname'] ?></strong><br /><?= $urnkBadge ?></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="?logout">Abmelden</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</div>