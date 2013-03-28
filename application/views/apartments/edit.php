
<form class="form-actions" action="<?php echo URL::site('apartments/edit/' . $apartment->id) ?>" id="form_edit" enctype="multipart/form-data" method="POST">
    <fieldset class="places">
        <legend>Edit Apartment</legend>   
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label" for="title">Title:</label>
                    <div class="controls">
                        <input class="span12" type="text" id="title" placeholder="Amazing apartment" name="title" value="<?php echo $apartment->title ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="descr">Description:</label>
                    <div class="controls">
                        <textarea class="span12" type="text" id="descr" placeholder="Wonderful apartment near metro station and starbucks" name="descr"><?php echo $apartment->descr ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="cost">Cost:</label>
                    <div class="controls">
                        <input class="span12" type="text" id="cost" placeholder="100" name="cost" value="<?php echo $apartment->cost ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="cost">Type of apartment:</label>
                    <div class="btn-group" data-toggle="buttons-radio" id="type_switcher">
                        <?php foreach ($types as $type): ?>
                            <button type="button" class="btn  <?php echo $type->id == $apartment->type_id ? 'active' : '' ?>" data-id="<?php echo $type->id ?>"><?php echo $type->title ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="gmaps-input-address">Type address:</label>
                    <div class="controls">
                        <input id='gmaps-input-address' name="address" class="span12" placeholder='Start typing a place name...' type='text' name="" value="<?php echo $apartment->address ?>" />
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

                <input name="lat" id="lat" type="hidden" value="<?php echo $apartment->lat ?>">
                <input name="lng" id="lng" type="hidden" value="<?php echo $apartment->lng ?>">
                <input name="type_id" id="type" type="hidden" value="<?php echo $apartment->type_id ?>">
                <input name="status" id="status" type="hidden" value="<?php echo $apartment->status ?>">
            </div>
        </div>
    </fieldset>
    <input class="btn btn-large btn-primary pull-right" value="Save" type="submit">
    <legend>Gallery</legend>
    <span class="label label-important">Note: Remove button delete image without pressing "SAVE" button</span>
    <p></p>
<!--    <div class="uploaded_avatar">
        <div class="left">
            <div class="fileselector">
                <input id="fileupload" type="file" name="file" data-url="<?php // echo URL::site('uploader/temp'); ?>" enctype="multipart/form-data"/>
            </div>
        </div>
    </div>-->
    <div class="fileupload fileupload-new" data-provides="fileupload">
        <span class="btn btn-file">
            <span class="fileupload-new">Select file</span>
            <input id="fileupload" type="file" name="file" data-url="<?php echo URL::site('uploader/temp'); ?>" enctype="multipart/form-data"/>
        </span>
        <span class="fileupload-preview"></span>
    </div>
    <ul class="thumbnails">
        <?php foreach ($images as $image): ?>
            <li class="span3">
                <div class="thumbnail">
                    <a class="t-images" href="<?php echo Helper_Output::get_apartment($apartment, $image->name) ?>" rel="images"><img src="<?php echo Helper_Output::get_apartment($apartment, $image->name) ?>" alt="ALT NAME" style="height: 150px "></a>
                    <div class="caption">
                        <p align="center"><a onclick="javascript: create.remove_click_existed(this)" data-id="<?php echo $image->id ?>" class="btn btn-primary btn-block remove-th">Remove</a></p>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</form>

