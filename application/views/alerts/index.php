<legend>Alerts list</legend>
<?php if (!count($alerts)): ?>
    <h5>You don't have alerts. To create them go to the map<h5>
        <?php else: ?>
            <?php foreach ($alerts as $alert): ?>
                <div class="hero-unit my-hero-unit" id="<?php echo $alert->id ?>" style="padding: 10px">
                    <div class="media-body">
                        <span>
                            <strong>Link:</strong>
                            <a href="<?php echo Helper_Output::get_alert($alert) ?>"><?php echo $alert->title ?></a>
                        </span>
                        <br>
                        <br>
                        <span>
                            <strong>Results:</strong>
                            <span class="badge badge-important"><?php echo $alert->count ?></span>
                        </span>
                        <div class="pull-right">
                            <a class="btn btn-danger delete" href="<?php echo URL::site('alerts/delete/' . $alert->id) ?>">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
