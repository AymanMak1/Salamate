  <!--Nav-->
  <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle collapsed" 
            data-toggle="collapse"
            data-target="#navbar"
            aria-expanded="false"
            aria-controls="navbar"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Salamat-e</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#" class="navlink">Dashboard</a></li>
            <li><a  type="button" class="navlink">Travel Notices</a></li>
            <li><a  type="button" class="navlink">Users</a></li>
            <li><a  type="button" class="navlink">Diseases</a></li>
            <li><a  type="button" class="navlink">Vaccines</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">

            <div class="btn-group">
                <button type="button" style="height:50px; border-radius:0;" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Welcome <span id="welcomeUsername"></span> <?php //echo $_SESSION['username']; ?>
             
                        <span id="profilPic" style="border-radius:50%; background-color:pink; height:50px;"><img src="" height="30" alt="profilPic" id="welcomeProfilPic"> </span>
            
                </button>
                <div class="dropdown-menu"  style="padding-left:20px; margin-top:12px;" >
                  <a style="text-decoration:none;   color: #858796; margin-bottom:8px" onclick="editProfil()" class="dropdown-item editProfil"  type="button">Edit your profile</a>
                  <div class="dropdown-divider"></div>
                  <a style="text-decoration:none; color: #858796;" class="dropdown-item" id="logoutBtn"  type="button">Log Out</a>
                </div>
            </div>
        
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>