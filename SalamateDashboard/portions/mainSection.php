 <!--Main Section-->

 <section id="main">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a  type="button" class="list-group-item active main-color-bg mainSection">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                Dashboard
              </a>
              <a type="button" id="actualitesCrudAnchor" class="list-group-item crudAnchor">
                <span>
                <img src="./dashboard/imgs/news.png" aria-hidden="true" width="20" alt="" srcset="">
                </span>
    
                Travel Notices <span class="badge badgeCountActualites"></span>  
              </a>
              

              <a id="showCrudTable" class="list-group-item crudAnchor">
              <img src="./dashboard/imgs/user.png" aria-hidden="true"  width="20" alt="" srcset="">
                Users <span class="badge badgeCountUsers"></span></a>

              <a id="maladiesCrudAnchor" class="list-group-item crudAnchor">
              <img src="./dashboard/imgs/virus.png" aria-hidden="true" width="20" alt="" srcset="">
                Diseases <span class="badge badgeCountDiseases"></span></a>   
              <a id="vaccinsCrudAnchor" class="list-group-item crudAnchor">
            
              <img src="./dashboard/imgs/pinkSyringe.png" aria-hidden="true" width="20" alt="" srcset="">
                Vaccines <span class="badge badgeCountVaccines"></span></a>

            </div>

            <div class="well">
              <h4>Verified User Accounts</h4>
              <div class="progress">
                <div
                  id="progress-bar-verifiedUsers"
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="0"
                  aria-valuemin="0"
                  aria-valuemax="100"
                  style="width: 0%;"
                >
                </div>
              </div>
              <h4>Unverified User Accounts</h4>
              <div class="progress">
              <span id="unverifiedUser" style="display:none"></span>
                <div
                  id="progress-bar-unverifiedUsers"
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="0"
                  aria-valuemin="0"
                  aria-valuemax="100"
                  style="width: 0%;"
                >
                  0%
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default websiteOverview">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Website Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2>
                    <span>
                           <img src="./dashboard/imgs/user.png" aria-hidden="true" width="40" alt="" srcset="">
                      </span>
                      <span id="countUsers"> </span>
                    </h2>
                    <h4>Users</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2>  
                       <span style="color:#ff3b5f">
                           <img src="./dashboard/imgs/news.png" aria-hidden="true" width="40" alt="" srcset="">
                           <span id="countActualites"> </span>
                      </span>
               
                     
                    </h2>
                    <h4 style="color:#ff3b5f">Travels Notices</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2>
                    <span>
                           <img src="./dashboard/imgs/virus.png" style="color:white;" aria-hidden="true" width="40" alt="" srcset="">
                      </span>
                      <span id="countDiseases"> </span>
                    </h2>
                    <h4 style="">Diseases</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2>
                      <span style="color:#ff3b5f">
                           <img src="./dashboard/imgs/pinkSyringe.png" aria-hidden="true" width="40" alt="" srcset="">
                           <span id="countVaccines"> </span>
                      </span>
                    
                 
                    </h2>
                    <h4 style="color:#ff3b5f">Vaccines</h4>
                  </div>
                </div>
              </div>
            </div>

            <!-- Latest Users -->
            <div class="panel panel-default latestUsersTable">
              <div class="panel-heading">
                <h3 class="panel-title">Latest Users</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-hover" id="latestUsersTable">
                  <thead id="theadLatest">
                  <tr>
                    <th>Username</th>
                    <th>FullName</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Verified</th>
                    <th>Joined</th>
                  </tr>
                  </thead>
                  <tbody>
                        <tr style="display:none;">
                          <td  style="text-align:center;" id="NoUsers"></td>
                        </tr>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
 
    </section>