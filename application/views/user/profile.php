<div class="container-fluid">
    <form class="form-actions" action="<?php echo URL::site('user/save') ?>" enctype="multipart/form-data" method="POST">
        <fieldset class="places">
            <legend>Edit Profile</legend>   
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label" for="first_name">First Name:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="first_name" placeholder="As on Passport" name="first_name" value="<?php echo $logged_user->first_name ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="last_name">Last Name:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="last_name" placeholder="As on Passport" name="last_name" value="<?php echo $logged_user->last_name ?>">
                        </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="email">Email:</label>
                      <div class="controls">
                        <input class="span10" type="text" id="email" readonly placeholder="Example: jd@travel.com" name="email" value="<?php echo $logged_user->email ?>">
                      </div>
                    </div>
                </div>
                <div class="span6">
                        <label>Avatar:</label>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo Helper_Output::get_avatar($logged_user) ?>" /></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="avatar" /></span>
                              <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                </div>
                </div>
            </fieldset>
        <input class="btn btn-large" value="Cancel" type="reset">
        <input class="btn btn-large btn-primary" value="Save" type="submit">
    </form>
</div>
    
    


    

