
<div id='gmaps-error'></div>
<input type="hidden" id="lng" value="<?php echo $lng ?>">
<input type="hidden" id="lat" value="<?php echo $lat ?>">
<input type="hidden" id="type_id" name="type_id" value='<?php echo!empty($type_id) ? $type_id : "" ?>'>
<input type="hidden" id="from" value="<?php echo $from ?>">
<input type="hidden" id="to" value="<?php echo $to ?>">

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
    </div>
    <form class="form-actions center" action="<?php echo URL::site('search/map') ?>" method="POST" id="form-search">
        <fieldset class="places">
            <div class="row-fluid">
                <div class="span12">
                    <div class="control-group">
                        <label class="control-label lead" for="search">Where do you want to live?</label>
                        <div class="controls">
                            <input type="text" class="span5" name='search' id="search">
                            <div id='gmaps-error'></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label lead" for="from">What's your monthly budget?</label>
                        <div class="controls">
                            <input type="text" placeholder="Any Price" class="span2" name='from'>
                            <span class="lead">to</span>
                            <input type="text" placeholder="Any Price" class="span2" name='to'>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label lead">How many bedrooms?</label>
                        <div class="btn-group" data-toggle="buttons-checkbox" id="type_switcher">
                            <?php foreach ($types as $type): ?>
                                <button type="button" class="btn" value="<?php echo $type->id ?>"><?php echo $type->title ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br>
                    <input name="lat" id="lat" type="hidden" value="">
                    <input name="lng" id="lng" type="hidden" value="">
                    <!--<input name="type_id" id="type" type="hidden" value="1">-->
                </div>
            </div>
        </fieldset>
    </form>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-warning" id="fin-search" >Search</button>
    </div>
</div>

<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js" ></script>