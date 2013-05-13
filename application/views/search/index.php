<h1 class="title-main center">Canada's easiest rental search</h1>
<form class="form-actions center home_block" action="<?php echo URL::site('search/map') ?>" method="GET" id="form-search">
    <fieldset class="places">
        <div class="row-fluid">
            <div class="span12">
                <div class="control-group">
                    <h2 class="control-label title-main" for="search">Where do you want to live?</h2>
                    <div class="controls">
                            <input type="text" class="span5 box-main" name='search' id="search">
                            <div id='gmaps-error'></div>
                    </div>
                </div>
                <div class="control-group">
                        <h2 class="control-label title-main" for="from">What's your monthly budget?</h2>
                        <div class="controls">
                            <input type="text" placeholder="minimum" class="span2 box-main" name='from'>
                            <span class="lead title-main">to</span>
                            <input type="text" placeholder="maximum" class="span2 box-main" name='to'>
                        </div>
                </div>
                <div class="control-group ">
                        <h2 class="control-label title-main">How many bedrooms?</h2>
                        <div class="btn-group box-main" data-toggle="buttons-checkbox" id="type_switcher">
                         <?php foreach ($types as $type): ?>
                            <button type="button" class="btn" value="<?php echo $type->id ?>"><?php echo $type->title ?></button>
                         <?php endforeach; ?>
                        </div>
                </div>
                <br>
                <div class="control-group center">
                    <div class="controls">
                      <input type="submit" class="btn btn-warning btn-large box-main" value="FIND APARTMENTS" />
                    </div>
                </div>
                <input name="lat" id="lat" type="hidden" value="">
                <input name="lng" id="lng" type="hidden" value="">
                <!--<input name="type_id" id="type" type="hidden" value="1">-->
            </div>
        </div>
    </fieldset>
</form>
