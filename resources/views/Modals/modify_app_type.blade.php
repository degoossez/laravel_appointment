<div class="modal" id="modifyAppTypeModal" tabindex="-1" role="dialog" aria-labelledby="modifyAppTypeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifyAppTypeModalLabel">New open times</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form> 
          <div class="form-group">
            <label for="modal-description" class="col-form-label">Description:</label>
            <input type="text" class="form-control" id="modal-description" name="modal-description">
          </div>
          <div class="form-group">
            <label for="modal-length" class="col-form-label">Duration in minutes:</label>
            <input type="number" name="modal-length" id="modal-length" value="1" min="1" class="form-control">
          </div>
          <div class="form-group">
            <label for="modal-capacity" class="col-form-label">Amount of people:</label>
            <input type="number" id="modal-capacity" name="modal-capacity" value="1" min="1" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>  