<form class="form-actions" action="<?php echo URL::site('search/map') ?>" method="POST" id="form-search">
    <fieldset class="places">
        <legend>Search Apartments</legend>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label" for="search">Where do you want to live?</label>
                    <div class="controls">
                            <input type="text" class="span12" name='search' id="search">
                    </div>
                </div>
                <div class="control-group">
                        <label class="control-label" for="from">What's your minimum monthly budget?</label>
                        <div class="controls">
                            <input type="text" class="span5" name='from'>
                        </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="to">What's your maximum monthly budget?</label>
                    <div class="controls">
                        <input type="text" class="span5" name='to'>
                    </div>
                </div>
                <div class="control-group">
                        <label class="control-label">How many bedrooms?</label>
                        <div class="btn-group" data-toggle="buttons-checkbox" id="type_switcher">
                         <?php foreach ($types as $type): ?>
                            <button type="button" class="btn" value="<?php echo $type->id ?>"><?php echo $type->title ?></button>
                         <?php endforeach; ?>
                        </div>
                </div>
                <div class="control-group center">
                    <div class="controls">
                      <input type="submit" class="btn btn-warning btn-large" value="FIND APARTMENTS" />
                    </div>
                </div>
                <input name="lat" id="lat" type="hidden" value="">
                <input name="lng" id="lng" type="hidden" value="">
                <!--<input name="type_id" id="type" type="hidden" value="1">-->
                <div id='gmaps-error'></div>
            </div>
            <div class="span6 justified">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>
    </fieldset>
</form>
