
<?php

$currentDate = date('Y-m-d', time());
$currentTime = date('h:i', time());

?>

<style>
    #formAddUser label{
        color: #3f3d56;
        letter-spacing:2px;
    }
    #formAddUser span{
        font-size:9.5px;
        color:#858796;
        letter-spacing:0px;
    }
    #formEditUser label,
    #formEditProfil label{
        color: #3f3d56;
        letter-spacing:2px;
    }
    #formEditUser span,
    #formEditProfil span{
        font-size:9.5px;
        color:#858796;
        letter-spacing:0px;
    }
</style>
<div class="modal fade userModal" id="addUser" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title"> <img src="./dashboard/imgs/whiteSalamateLogo.png" width="50" alt="">Add User</h3>
      </div>
      <form id="formAddUser" class="changeForm"  method="POST" action="" enctype="multipart/form-data">    
            <div class="modal-body">

                <div class="form-group">
                    <label for="username" class="col-form-label">Username  <br> <span> ! minimun length is 6 characteres </span> </label>
                    <input type="text" name="username" minlength="6" maxlength="15" title="! minimun length is 6 characteres" class="form-control" id="username" required>
                </div>   

                <div class="form-group">
                    <label for="fullName" class="col-form-label">FullName <br> <span >! space between first name and last name</span></label>
                    <input type="text" name="fullName" class="form-control" title="! space between first name and last name" id="fullName" required></input>
                </div> 

                <div class="form-group">
                <label for="nationality" class="col-form-label">Nationality </label>
                    <select class="form-control" name="nationality" id="nationality">
    
                    </select>
                </div> 

                <div class="form-group">
                    <label for="phoneNumber" class="col-form-label">Phone Number <br> <span >! type a valid phone number </span> </label>
                    <input type="tel" name="phoneNumber" minlength="10" 
                     title="! type a valid phone number + min length is 10 digits or more for foreign countries" class="form-control" id="phoneNumber" required></input>
                </div> 

                <div class="form-group">
                    <label for="birthday" class="col-form-label">Birthday </label>
                    <input type="date" name="birthday" class="form-control" id="birthday" max="<?php echo $currentDate; ?>" required>
                </div> 

                <div class="form-group">
                    <label for="gmail" class="col-form-label">Email <br> <span > ! Valid email ex : salamateUser@domainename.smthg</span> </label>
                    <input type="gmail" name="gmail" class="form-control" id="gmail" required>
                </div> 
                
                <div class="form-group">
                    <label for="profilPic" class="col-form-label">Photo de Profil  <br> <span > ! select a valid image format: png/PNG, jpeg/JPEG, jpg/JPG, gif/GIF </span> </label>
                    <input type="file" id="profilPic" name="profilPic" title="! select a valid image format: png/PNG, jpeg/JPEG, jpg/JPG, gif/GIF " 
                    accept="image/png,image/PNG, image/jpeg,imgae/JPEG, image/jpg,image/JPG, image/gif, image/GIF" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password" class="col-form-label">Password <br> <span >! Minimum 8  characters in length
                            Contains 3/4 of the following items:
                            - Uppercase Letters
                            - Lowercase Letters
                            - Numbers
                            - Symbols"  </span>  </label>
                    <input type="password" name="password" minlength="8" title="Minimum 8  characters in length
                            Contains 3/4 of the following items:
                            - Uppercase Letters
                            - Lowercase Letters
                            - Numbers
                            - Symbols" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="Cpassword" id="CpasswordLabel" class="col-form-label">Confirm Password</label>
                    <input type="password" name="Cpassword" minlength="8" class="form-control" id="Cpassword" required>
                </div>

                <div class="form-group">
                    <label for="role" id="roleLabel" class="col-form-label">Role <br> <span > 1 = admin , 0 = simple user </span> </label>
                    <select class="form-control" title="1 for the admin, 0 for the user" name="role" id="role" required>
                            <option>0</option>
                            <option>1</option>
                    </select>
                </div>


            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-salamate addUserBtn changeBtn" onclick="$('.userModal .changeForm').submit()" value="Save"></input>
                <button type="button" class="btn btn-dark-salamate" data-dismiss="modal">Cancel</button>
            </div>
    </form>
    </div>
  </div>
</div>