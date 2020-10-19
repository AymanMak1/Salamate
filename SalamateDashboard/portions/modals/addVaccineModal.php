
<style>
    #formEditVaccine span,
    #formAddVaccine span{
        font-size:9.5px;
        color:#858796;
        font-weight:700;
        letter-spacing:0px;
    }
</style>
<div class="modal fade vaccineModal" id="addVaccine" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title"> <img src="./dashboard/imgs/whiteSalamateLogo.png" width="50" alt=""></h3>
      </div>
      <form id="formAddVaccine" class="changeForm" method="POST" action="">    
            <div class="modal-body">

                <div class="form-group">
                    <label for="vaccineName" class="col-form-label">Vaccine Name </label>
                    <input type="text" name="vaccineName"  class="form-control" id="vaccineName" required>
                </div>   

                <div class="form-group">
                <label for="vaccineDisease" class="col-form-label"> Disease Name </label>
                    <select class="form-control" name="vaccineDisease" id="vaccineDisease">
    
                    </select>
                </div> 

                  <div class="form-group">
                    <label for="vaccineInfos">Vaccine Infos</label>
                    <textarea class="form-control" name="vaccineInfos" id="vaccineInfos" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="nbrDoses" class="col-form-label">Nbr Doses</label>
                    <input type="number" min="1" name="nbrDoses"  class="form-control" id="nbrDoses" required>
                </div>   
              
                <div class="form-group">
                    <label for="daysBetween" class="col-form-label">Days between Doses </label> <br>   <span>if nbrDoses = 1 -> daysBetween = 0</span>
                    <input type="number" min="0" name="daysBetween"  class="form-control" id="daysBetween" required>
                </div>   

            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-salamate addVaccineBtn changeBtn" value="Save"></input>
                <button type="button" class="btn btn-dark-salamate" data-dismiss="modal">Cancel</button>
            </div>
    </form>
    </div>
  </div>
</div>