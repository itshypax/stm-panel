<nav class="top_navbar">
  <div class="container">
    <div class="row clearfix">
      <div class="col-12">
        <div class="navbar-logo">
          <a href="javascript:void(0);" class="bars"></a>
          <a class="navbar-brand" href="https://polizei-nordholm.de/dashboard"><img src="https://wiesberg.net/assets/images/WiesbergWhite.png" width="30" alt="TEst"><span class="ml-10">STRASSENMEISTEREI NEUBERG</span></a>
        </div>
        <ul class="nav navbar-nav">
                <li class="dropdown profile">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <img class="rounded-circle" src="<?= $steamprofile['avatarfull']?>" alt="User">
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="user-info">
                                                                    <h6 class="user-name m-b-0">James Law</h6>
                                								<p class="user-position"><a href="<?= $steamprofile['profileurl'] ?>"><?= $steamprofile['steamid'] ?></a></p>
                                <hr>
                            </div>
                        </li>
                        <li><a href="#" id="openSettings"><i class="icon-settings m-r-10"></i> <span>Einstellungen</span></a></li>
                        <li><a href="https://polizei-nordholm.de/?logout"><i class="icon-power m-r-10"></i><span>Ausloggen</span></a></li>
                    </ul>
                </li>
            </ul>
      </div>
    </div>
  </div>
</nav>