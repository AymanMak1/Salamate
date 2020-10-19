
<div class="burger">
    <i class="fas fa-bars"></i>
</div>
<nav class="sidebar">
        <div class="logo nav-link" style="cursor:pointer">
            <img src="./imgs/whiteSalamateLogo.png" width="120" alt="">
        </div>
        <ul>
            <li style="cursor:pointer;">
    
                <a type="button" class="profil-btn">
                <img src="../pdp/<?php echo $_SESSION['profilPic'];?>" width="26" style=" display:inline-block; position:relative; top:12px;"id="porfilPic" alt="">
                    <span class="welcome"></span>
                    <i class="fas fa-caret-down first"></i>
                </a>
                <ul class="profil-dropdown">
                    <li><a type="button" onclick="$('#editProfilModal').modal('show');">Edit your profile</a></li>
                    <li><a type="button" id="logoutBtn">Logout</a></li>
                </ul>
            </li>
            <li style="cursor:pointer;">
      
                <a type="button" class="voyages-btn">
                <i class="fas fa-plane"  style="padding-right:8px;"></i>
                    Trips
                    <i class="fas fa-caret-down second"></i>
                </a>
                <ul class="voyages-dropdown">
                    <li><a type="button" class="nav-link addTripLink">Organize a trip</a></li>
                    <li><a type="button" class="nav-link">List your trips</a></li>
                </ul>
            </li>
            <li>
                <a type="button" class="vaccins-btn nav-link">
                    <img src="./imgs/syringe.png" width="30"  style="padding-right:8px;" alt="">
                    Vaccines
                    <!--i class="fas fa-caret-down third"></i-->
                </a>
                <!--ul class="vaccins-dropdown">
                    <li><a type="button" class="nav-link">Undone Vaccins</a></li>
                    <li><a type="button" class="nav-link">Done Vaccins</a></li>
                </ul-->
            </li>
            <li><a type="button" class="nav-link"> <i class="fas fa-exclamation-circle"  style="padding-right:8px;"></i>Travel Notices</a></li>
        </ul>
    </nav>