<div class="container-fluid">
    <form class="form-actions" action="<?php echo URL::site('session/register') ?>" method="POST">
        <fieldset class="places">
            <legend>Register</legend>
            <div class="row-fluid">
                <div class="span8">
                    <div class="control-group">
                        <label class="control-label" for="first_name">First Name:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="first_name" placeholder="John" name="first_name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="last_name">Last Name:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="last_name" placeholder="Smith" name="last_name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="gender">Gender: </label>
                        <div class="controls">
                            <select name="gender" id="gender" class="span10">
                                <option selected value="male" >Male</option>
                                <option value="female" >Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address">Address: </label>
                        <div class="controls">
                            <input class="span10" type="text" id="address" placeholder="Example: Great Britain , London, Baker Street 5" name="profile[address]" >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="last_name">Email:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="email" placeholder="Smith" name="last_name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="gender">Gender: </label>
                        <div class="controls">
                            <select name="gender" id="gender" class="span10">
                                <option selected value="male" >Male</option>
                                <option value="female" >Female</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <input class="btn btn-large btn-block btn-primary" value="Save" type="submit">
        <input class="btn btn-large btn-block" value="Cancel" type="reset">
    </form>
</div>