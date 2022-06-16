<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="https://wiesberg.net/assets/images/WiesbergBlack.png" alt="Wiesberg" height="64" width="auto" class="d-inline-block align-text-center">
        Wiesberg
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        include ('../../assets/components/fb37allowedids.php');
        if (in_array($steamprofile['steamid'], $allowed_steamids)) { ?>
        <li class="nav-item">
          <a class="nav-link" href="../../fachbereiche/37/dashboard.php">Dashboard</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="../../fachbereiche/37/bewerben.php">Bewerbungsportal</a>
        </li>
        <?php
        if (in_array($steamprofile['steamid'], $allowed_steamids)) { ?>
        <li class="nav-item">
          <a class="nav-link" href="../../fachbereiche/37/mitarbeiter.php">Mitarbeiterübersicht</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../fachbereiche/37/zeiten.php">Zeitübersicht</a>
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
            <img src="<?= $steamprofile['avatarmedium']?>" alt="Profilbild" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
            <li class="dropdown-item-text"><strong><?= $steamprofile['personaname'] ?></strong></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="?logout">Abmelden</a></li>
          </ul>
        </div>
    </div>
  </div>
</nav>