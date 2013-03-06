<legend>Apartments list</legend>
<?php if (!count($apartments)): ?>
    <h5>You don't have apartments. To create them click "Create" at the bottom<h5>
<?php else: ?>
    <?php foreach ($apartments as $apartment): ?>
        <div class="media bordered">
            <a class="pull-left" href="#">
                <img class="media-object" src="<?php echo Helper_Output::get_apartment($apartment, "small_") ?>">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $apartment->title ?></h4>
                <h5>Description:</h5>
                <p><?php echo $apartment->descr ?></p>
                <h5>Type/Number of rooms:</h5><?php echo $apartment->type->title ?>
                <h5>Address:</h5><?php echo $apartment->address ?>
                <h5>Cost:</h5><span class="label label-success">$<?php echo $apartment->cost ?></span>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<br>
<a class="btn btn-large btn-primary" href="<?php echo URL::site('apartments/create') ?>">Create Apartment</a>
