
<div class="modal fade" id="editTripModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title"> <i class="fa fa-plane" style="margin-right:8px;"></i> Edit Trip </h3>
      </div>
      <form id="editTripForm" name="editTripForm" method="POST" action="" enctype="multipart/form-data">    
            <div class="modal-body">

                <div class="form-group">
                    <label for="editTripName" class="col-form-label">Trip Name </label>
                    <input type="text" name="editTripName" class="form-control" id="editTripName" required>
                </div>   

                <div class="form-group">
                <label for="editTripDeparture" class="col-form-label">Trip Departure </label>
                    <select class="form-control" name="editTripDeparture" id="editTripDeparture" disabled>

                    </select>
                </div> 
                
                <div class="form-group">
                <label for="editTripDestination" class="col-form-label">TripDestination </label>
                    <select class="form-control" name="editTripDestination" id="editTripDestination" disabled>
    
                    </select>
                </div> 

                
                <div class="form-group">
                    <label for="editTripDepartureDate" class="col-form-label">Trip Departure Date </label>
                    <input type="date" name="editTripStartDate" class="form-control" id="editTripStartDate" min="<?php echo $currentDate; ?>" required>
                </div> 

                <div class="form-group">
                    <label for="editTripDestinationDate" class="col-form-label">Trip Destination Date </label>
                    <input type="date" name="editTripEndDate" class="form-control" id="editTripEndDate" min="<?php echo $currentDate; ?>" required>
                </div> 

            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-salamate" id="editTrip" value="Sauvegarder"></input>
                <button type="button" class="btn btn-dark-salamate" data-dismiss="modal">Annuler</button>
            </div>
    </form>
    </div>
  </div>
</div>