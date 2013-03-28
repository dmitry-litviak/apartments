<form class="form-actions" action="<?php echo URL::site('apartments/create') ?>" enctype="multipart/form-data" method="POST" id="form_create">
    <fieldset class="places">
        <legend>Create Apartment</legend>   
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <input class="span12" type="text" id="title" placeholder="Amazing apartment" name="title">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="descr">Description:</label>
                    <div class="controls">
                        <textarea class="span12" type="text" id="descr" placeholder="Wonderful apartment near metro station and starbucks" name="descr"></textarea>
                    </div>
                </div>
                <!--                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <label class="control-label" for="descr">Main Image:</label>
                                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo URL::site('img/icon-no-image-512.png') ?>" /></div>
                                    <div>
                                        <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="image" /></span>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>-->
                <div class="control-group">
                    <label class="control-label" for="cost">Cost:</label>
                    <div class="controls">
                        <input class="span12" type="text" id="cost" placeholder="100" name="cost">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="cost">Type of apartment:</label>
                    <div class="btn-group" data-toggle="buttons-radio" id="type_switcher">
                        <?php foreach ($types as $type): ?>
                            <button type="button" class="btn  <?php echo $type->id == 1 ? 'active' : '' ?>" data-id="<?php echo $type->id ?>"><?php echo $type->title ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="gmaps-input-address">Type address:</label>
                    <div class="controls">
                        <input id='gmaps-input-address' name="address" class="span12" placeholder='Start typing a place name...' type='text' name="" />
                        <div id='gmaps-error'></div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">Map:</label>
                    <div class="controls">
                        <div id='gmaps-canvas' class="map_canvas"></div>
                    </div>
                </div>

                <input name="lat" id="lat" type="hidden" value="">
                <input name="lng" id="lng" type="hidden" value="">
                <input name="type_id" id="type" type="hidden" value="1">
            </div>
        </div>
    </fieldset>
    <input class="btn btn-large btn-primary pull-right" value="Create" type="submit">

    <legend>Gallery</legend>
    <div class="fileupload fileupload-new" data-provides="fileupload">
        <span class="btn btn-file">
            <span class="fileupload-new">Select file</span>
            <input id="fileupload" type="file" name="file" data-url="<?php echo URL::site('uploader/temp'); ?>" enctype="multipart/form-data"/>
        </span>
        <span class="fileupload-preview"></span>
    </div>
    <ul class="thumbnails"></ul>
</form>
