    <table class="table table-striped">
        <thead>
                <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Actions</th>
                </tr>
        </thead>
</table>
<div class="buttons">
     <a href="<?php echo URL::site('admin/apartments/create') ?>" class="btn btn-primary" type="button">Create New Apartment</a>
</div>
<hr>
<span class="label label-important">Note: click on status label to change the status of apartment</span>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Delete Apartment</h3>
  </div>
  <div class="modal-body">
    <p>Do you really want to delete this apartment?</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-danger" id="final_delete" >Delete</button>
  </div>
</div>