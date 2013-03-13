<legend>Favorites list</legend>
<?php if (!count($apartments)): ?>
    <h5>You don't have favorites. To create them go to the map<h5>
        <?php else: ?>
            <?php foreach ($apartments as $apartment): ?>
                <div class="media bordered" id="<?php echo $apartment->id ?>">
                    <a class="pull-left" href="#">
                        <img class="media-object bordered-img" src="<?php echo Helper_Output::get_apartment($apartment, "small_") ?>">
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
                        <div class="pull-right">
                            <a class="btn btn-danger delete" href="<?php echo URL::site('favorites/delete/' . $apartment->id) ?>">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
