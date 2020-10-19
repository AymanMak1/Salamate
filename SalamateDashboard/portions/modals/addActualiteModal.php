<div
      class="modal fade actualiteModal"
      id="addActualite"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form id="formAddActualite" class="changeForm" name="formAddActualite" method="POST" action="">
            <div class="modal-header">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="modal-title" id="myModalLabel"> <img src="./dashboard/imgs/whiteSalamateLogo.png" width="50" alt=""> Add Travel Notice </h3>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Travel Notice Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="title"
                  required
                />
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea
                  name="description"
                  class="form-control"
                  id="description"  
                  required
                ></textarea>
              </div>
              <div class="checkbox">
                <label> <input type="checkbox" id="published" /> Published </label>
              </div>
              <div class="form-group">
                <label>Publication Date</label>
                <input
                  type="date"
                  class="form-control"
                  id="publicationDate"
                  max="<?php echo date('Y-m-d', time()); ?>" 
                  required
                />
              </div>

            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-salamate addActualiteBtn changeBtn" value="Save"></input>
                <button type="button" class="btn btn-dark-salamate" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>