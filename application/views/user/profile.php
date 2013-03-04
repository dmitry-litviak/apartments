<div class="container-fluid">
    <form class="form-actions" action="<?php echo URL::site('user/save') ?>" method="POST">
        <fieldset class="places">
            <legend>Edit Profile</legend>   
            <div class="row-fluid">
                <div class="span5">
                    <div class="control-group">
                        <label class="control-label" for="first_name">First Name</label>
                        <div class="controls">
                            <input class="span10" type="text" id="first_name" placeholder="As on Passport" name="profile[first_name]" value="<?php echo $logged_user->user_profile->first_name ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="last_name">Last Name</label>
                        <div class="controls">
                            <input class="span10" type="text" id="last_name" placeholder="As on Passport" name="profile[last_name]" value="<?php echo $logged_user->user_profile->last_name ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="gender">Gender: </label>
                        <div class="controls">
                          <select name="profile[gender]" class="span10">
                            <option <?php echo $logged_user->user_profile->gender == 'male' ? 'selected' : '' ?> value="male" >Male</option>
                            <option <?php echo $logged_user->user_profile->gender == 'female' ? 'selected' : '' ?> value="female" >Female</option>
                          </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address">Address: </label>
                        <div class="controls">
                            <input class="span10" type="text" id="address" placeholder="Example: Great Britain , London, Baker Street 5" name="profile[address]" value="<?php echo $logged_user->user_profile->address ?>">
                        </div>
                    </div>
                    </div>
                    <div class="span5">
                        <div class="control-group">
                          <label class="control-label" for="email">Email</label>
                          <div class="controls">
                            <input class="span10" type="text" id="email" readonly placeholder="Example: jd@travel.com" name="email" value="<?php echo $logged_user->email ?>">
                          </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputDates">Avatar: </label>

                            <img id="avatar-img" src="<?php echo Helper_Output::getAvatar($logged_user) ?>" style="width: 100px; height: 100px">
                            <span class="upload-progress" ></span>
                            <input id="avatar" name="profile[avatar]" type="hidden" value="<?php echo Helper_Output::getClearPathToAvatar($logged_user) ?>">
                            <div class="controls">
                                <input class="span10" type="file" name="file" >
                            </div>
                          </div>
                    </div>
                </div>
            </fieldset>
        <input class="btn btn-large btn-primary" value="Save" type="submit">
        <input class="btn btn-large" value="Cancel" type="reset">
    </form>
</div>
    
    


    

