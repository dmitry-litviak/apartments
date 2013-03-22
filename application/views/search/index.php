<form class="form-actions center" action="<?php echo URL::site('search/map') ?>" method="POST" id="form-search">
    <fieldset class="places">
        <legend>Search Apartments</legend>
        <div class="row-fluid">
            <div class="span12">
                <div class="control-group">
                    <label class="control-label" for="search">Where do you want to live?</label>
                    <div class="controls">
                            <input type="text" class="span5" name='search' id="search">
                            <div id='gmaps-error'></div>
                    </div>
                </div>
                <div class="control-group">
                        <label class="control-label" for="from">What's your monthly budget?</label>
                        <div class="controls">
                            <input type="text" placeholder="Any Price" class="span2" name='from'>
                            <span>to</span>
                            <input type="text" placeholder="Any Price" class="span2" name='to'>
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
            </div>
        </div>
    </fieldset>
</form>
