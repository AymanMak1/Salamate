
<?php

$currentDate = date('Y-m-d', time());
$currentTime = date('h:i', time());

?>
<div id="wrapper" class="addTripSection section">
     <div class="form-container">
           <span class="form-heading" style="font-family: 'Courgette', cursive;">Organize Trip</span>
           <form action="" id="addTripForm" method="POST">
             
              		<div class="input-group">
                      <i class="fas fa-suitcase"></i>
                      <input type="text" placeholder="Trip Name" name="tripName" id="tripName" required>
                      <span class="bar"></span>
                    </div>

                    <span class="label">Trip Departure</span>
                    <div class="input-group">
                      <i class="fas fa-plane-departure"></i>
                      <select name="tripDeparture" id="tripDeparture" required>
                           <option value="">Destination</option>
                      </select>
                      <span class="bar"></span>
                    </div>

                    <span class="label">Trip Destination</span>
                    <div class="input-group">
                      <i class="fas fa-plane-arrival"></i>
                      <select name="tripDestination" id="tripDestination" required>
                           <option value="">Destination</option>
                      </select>
                      <span class="bar"></span>
                    </div>

                    <span class="label">Trip Departure Date</span>
                    <div class="input-group">
                    <i class="fas fa-calendar-alt"></i>
                      <input type="date" min="<?php echo $currentDate; ?>" id="tripStartDate" name="tripStartDate" placeholder="Departure Date" required>
                      <span class="bar"></span>
                    </div>

                    <span class="label">Trip Arrival Date</span>
                    <div class="input-group">
                    <i class="fas fa-calendar-alt"></i>
                      <input type="date" min="<?php echo $currentDate; ?>" id="tripEndDate" name="tripEndDate" placeholder="Arrival Date" required>
                      <span class="bar"></span>
                    </div>


                    <div class="input-group">
                           <button id="addTripBtn" type="submit"><i class="fas fa-save"></i></button>
                           <!--input id="addTripBtn" type="submit"-->
                    </div>
                    <div class="allTripsLink">
                        <a type="button">list all your organised trips</a>
                    </div>
           
           </form>
     </div>
</div>