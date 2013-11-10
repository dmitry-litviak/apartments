<div class="center">
<a class="btn btn-large btn-primary btn-block" href="<?php echo URL::site('apartments/create') ?>">Create Apartment</a>
</div>
<?php if (!count($apartments)): ?>
    <h5>You don't have apartments. To create them click "Create" at the top<h5>
<?php else: ?>
    <?php foreach ($apartments as $apartment): ?>
        <div class="media bordered" id="<?php echo $apartment->id ?>">
            <a class="pull-left" href="#">
                <img class="media-object bordered-img" src="<?php echo Helper_Output::get_apartment_first_img($apartment) ?>">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $apartment->title ?></h4>
                <span>
                    <strong>Description:</strong>
                    <?php echo $apartment->descr ?>
                </span>
                <hr class="hr-thin">
                <span>
                    <strong>Type/Number of rooms:</strong>
                    <?php echo $apartment->type->title ?>
                </span>
                <hr class="hr-thin">
                <span>
                    <strong>Address:</strong>
                    <?php echo $apartment->address ?>
                </span>
                <hr class="hr-thin">
                <span>
                    <strong>Cost:</strong>
                    <span class="label label-success">$<?php echo $apartment->cost ?></span>
                </span>
                <hr class="hr-thin">
                <span>
                    <strong>Status:</strong>
                    <?php echo Helper_Output::get_status($apartment->status) ?>
                </span>
                <hr class="hr-thin">
                <div class="pull-right">
                    <a class="btn btn-danger delete" data-id="<?php echo $apartment->id ?>">Delete</a>
                    <a class="btn btn-primary" href="<?php echo URL::site('apartments/edit/' . $apartment->id ) ?>">Edit</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<br>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Delete Apartment</h3>
  </div>
  <div class="modal-body">
    <p>Do you really want to delete <strong id="title-modal"></strong>?</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-danger" id="final_delete" >Delete</button>
  </div>
</div>