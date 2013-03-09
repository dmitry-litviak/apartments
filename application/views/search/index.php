<form class="form-actions" action="<?php echo URL::site('search') ?>" method="POST">
    <fieldset class="places">
        <legend>Search Apartments</legend>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label" for="search">Where do you want to live?</label>
                    <div class="controls">
                            <input type="text" class="span12" name='search'>
                    </div>
                </div>
                <div class="control-group">
                    <div class="span6">
                        <label class="control-label">How many bedrooms?</label>
                        <div class="btn-group" data-toggle="buttons-radio" id="type_switcher">
                         <?php foreach ($types as $type): ?>
                            <button type="button" class="btn  <?php echo $type->id == 1 ? 'active' : '' ?>" data-id="<?php echo $type->id ?>"><?php echo $type->title ?></button>
                         <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="span6">
                        <label class="control-label" for="cost">What's your monthly budget?</label>
                        <div class="controls">
                            <input type="text" class="span5" name='from'>
                            to
                            <input type="text" class="span5" name='to'>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                      <input type="submit" class="btn btn-warning btn-large btn-block" value="FIND APARTMENTS" />
                    </div>
                </div>
            </div>
            <div class="span6 justified">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>
    </fieldset>
</form>
