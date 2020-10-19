 <!--Header -->
 <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1>
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              Dashboard <small>Manage Salamate Site</small>
            </h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button
                class="btn btn-default dropdown-toggle"
                type="button"
                id="dropdownMenu1"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="true"
              >
              Create Contents
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li>
                  <a type="button"
                  onclick="javascript:
                    $('.changeForm .changeBtn').removeClass('editActualiteBtn editUserBtn addUserBtn editVaccineBtn addVaccineBtn editDiseaseBtn addDiseaseBtn').addClass('addActualiteBtn');
                    $('.changeForm').attr('id', 'formAddActualite');
                    $('.actualiteModal').attr('id', 'addActualite');
                    $('#addActualite .modal-title').text('Add Travel Notices');
                    $('#addActualite .changeForm').trigger('reset');" 
                    data-toggle="modal" data-target="#addActualite">Add Travel Notices</a
                  >
                </li>
                <!---->
                <li><a type="button"
                onclick="javascript:
                    $('#role').css('display', 'block');
                    $('#roleLabel').css('display', 'block');
                    $('#roleLabel span ').css('display', 'block');
                    $('#Cpassword').css('display', 'block');
                    $('#CpasswordLabel').css('display', 'block');
                    $('.changeForm .changeBtn').removeClass('editUserBtn editActualiteBtn addActualiteBtn editVaccineBtn addVaccineBtn').addClass('addUserBtn');
                    $('.changeForm').attr('id', 'formAddUser');
                    $('.userModal').attr('id', 'addUser');
                    $('.userModal .modal-title').text('Add User');
                    $('#addUser .changeForm').trigger('reset');" 
                    data-toggle="modal" data-target="#addUser"
                    class="addUserdropdown"> Add User</a></li>

                <li><a type="button" 
                onclick="javascript:
                    $('.changeForm .changeBtn').removeClass('editDiseaseBtn editActualiteBtn addActualiteBtn editVaccineBtn addVaccineBtn editUserBtn addUserBtn').addClass('addUserBtn');
                    $('.changeForm').attr('id', 'formAddDisease');
                    $('.diseaseModal').attr('id', 'addDisease');
                    $('.diseaseModal .modal-title').text('Add Disease');
                    $('#addDisease .changeForm').trigger('reset');" 
                data-toggle="modal" data-target="#addDisease"> Add Disease</a></li>

               <li>
                    <a type="button" id="addVaccineLink"
                    onclick="javascript:
                    $('.changeForm .changeBtn').removeClass('editVaccineBtn editUserBtn addUserBtn editActualiteBtn addActualiteBtn editDiseaseBtn addDiseaseBtn').addClass('addVaccineBtn');
                    $('.changeForm').attr('id', 'formAddVaccine');
                    $('.vaccineModal').attr('id', 'addVaccine');
                    $('#addVaccine .modal-title').text('Add Vaccine');
                    $('#addVaccine .changeForm').trigger('reset');"
                     data-toggle="modal" data-target="#addVaccine">Add Vaccine</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>