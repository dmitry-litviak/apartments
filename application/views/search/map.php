
<div id='gmaps-error'></div>


<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="center" action="<?php echo URL::site('search/map') ?>" method="GET" id="form-search" style="margin: 0">
        <div class="modal-body">
            <fieldset class="places">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="control-group">
                            <label class="control-label lead" for="search">Where do you want to live?</label>
                            <div class="controls">
                                <input type="text" class="span12" name='search' id="search">
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
                        <input type="hidden" name="sel_types" id="sel_types" value="<?php echo $sel_types ?>">
                        <input type="hidden" id="search_input" value="<?php echo $search ?>">
                        <input type="hidden" name="lng" id="lng" value="<?php echo $lng ?>">
                        <input type="hidden" name="lat" id="lat" value="<?php echo $lat ?>">
                        <input type="hidden" id="type_id" name="type_id" value='<?php echo!empty($type_id) ? $type_id : "" ?>'>
                        <input type="hidden" id="from" value="<?php echo $from ?>">
                        <input type="hidden" id="to" value="<?php echo $to ?>">
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-warning" id="fin-search" >Search</button>
        </div>
    </form>
</div>

<div id="alertModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <fieldset class="places">
            <div class="row-fluid">
                <div class="span12">
                    <legend class="lead">Get alerts for this search</legend>
                    <div class="control-group">
                        <label class="control-label" for="title-alert">Name your search:</label>
                        <div class="controls">
                            <input type="text" class="span12" name='title' id="title-alert">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-warning" id="fin-alert" >Save</button>
    </div>
</div>

<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js" ></script>