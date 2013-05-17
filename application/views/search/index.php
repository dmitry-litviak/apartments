<style type="text/css">
    label.error {display:none !important;}
</style>
<form class="form-actions home_block center-children" action="<?php echo URL::site('search/map') ?>" method="GET" id="form-search">
    <h1 class="title-main">Canada's easiest rental search</h1>
    <fieldset class="places">
        <div class="row-fluid">
            <div class="span12">
                <br>
                <input type="text" class="span3 box-main" name='search' id="search" placeholder="Where do you want to live?">
                <input type="text" placeholder="Minimum Price" class="span2 box-main" name='from'>
                <span class="title-main">to</span>
                <input type="text" placeholder="Maximum Price" class="span2 box-main" name='to'>

                <div class="btn-group box-main" data-toggle="buttons-checkbox" id="type_switcher">
                    <?php foreach ($types as $type): ?>
                        <button type="button" class="btn" value="<?php echo $type->id ?>"><?php echo $type->title ?></button>
                    <?php endforeach; ?>
                </div>
                <input type="submit" class="btn btn-warning box-main" value="FIND APARTMENTS" />
                <div id='gmaps-error'></div>

                <input name="lat" id="lat" type="hidden" value="">
                <input name="lng" id="lng" type="hidden" value="">
            </div>
        </div>
    </fieldset>
</form>
