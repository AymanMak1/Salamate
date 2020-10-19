
<div class="modal fade diseaseModal" id="addDisease" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title"> <img src="./dashboard/imgs/whiteSalamateLogo.png" width="50" alt="">Add Disease</h3>
      </div>
      <form id="formAddDisease" class="changeForm" name="formAddDisease" method="POST" action="">    
            <div class="modal-body">

                <div class="form-group">
                    <label for="diseaseName" class="col-form-label">Disease Name </label>
                    <input type="text" name="diseaseName"  class="form-control" id="diseaseName" required>
                </div>   



                <div class="form-group">
                <label for="country" class="col-form-label"> Country </label>
                    <select class="form-control" name="country" id="country">
    
                    </select>
                </div> 


            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-salamate addDiseaseBtn changeBtn" value="Save"></input>
                <button type="button" class="btn btn-dark-salamate" data-dismiss="modal">Cancel</button>
            </div>
    </form>
    </div>
  </div>
</div>