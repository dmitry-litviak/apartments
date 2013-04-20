<div class="container-fluid">
    <form class="form-actions" action="<?php echo URL::site('user/save_aplication') ?>"  method="POST">
        <fieldset class="places">
            <legend>Edit Application From</legend>   
            <div class="row-fluid">
                <div class="span6">
                    <legend>Personal Info:</legend>
                    <div class="control-group">
                        <label class="control-label" for="name">Name:</label>
                        <div class="controls">
                            <input class="span10" readonly type="text" id="name" placeholder="Name" name="name" value="<?php echo $application->name ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="phone">Phone:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="phone" placeholder="Phone" name="phone" value="<?php echo $application->phone ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">Email:</label>
                        <div class="controls">
                            <input class="span10" readonly type="text" id="email" placeholder="Email" name="email" value="<?php echo $application->email ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="sin">SIN:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="sin" placeholder="Sin" name="sin" value="<?php echo $application->sin ?>">
                        </div>
                    </div>
                    <legend>References:</legend>
                    <div class="control-group">
                        <label class="control-label" for="ref_name_1">Name:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_name_1" placeholder="Name" name="ref_name_1" value="<?php echo $application->ref_name_1 ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ref_rel_1">Relationship:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_rel_1" placeholder="Relationship" name="ref_rel_1" value="<?php echo $application->ref_rel_1 ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ref_phone_1">Phone:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_phone_1" placeholder="Phone" name="ref_phone_1" value="<?php echo $application->ref_phone_1 ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ref_email_1">Email:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_email_1" placeholder="Email" name="ref_email_1" value="<?php echo $application->ref_email_1 ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="control-group">
                        <label class="control-label" for="ref_name_2">Name:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_name_2" placeholder="Name" name="ref_name_2" value="<?php echo $application->ref_name_2 ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ref_rel_2">Relationship:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_rel_2" placeholder="Relationship" name="ref_rel_2" value="<?php echo $application->ref_rel_2 ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ref_phone_2">Phone:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_phone_2" placeholder="Phone" name="ref_phone_2" value="<?php echo $application->ref_phone_2 ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ref_email_2">Email:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_email_2" placeholder="Email" name="ref_email_2" value="<?php echo $application->ref_email_2 ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="control-group">
                        <label class="control-label" for="ref_name_3">Name:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_name_3" placeholder="Name" name="ref_name_3" value="<?php echo $application->ref_name_3 ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ref_rel_3">Relationship:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_rel_3" placeholder="Relationship" name="ref_rel_3" value="<?php echo $application->ref_rel_3 ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ref_phone_3">Phone:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_phone_3" placeholder="Phone" name="ref_phone_3" value="<?php echo $application->ref_phone_3 ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ref_email_3">Email:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="ref_email_3" placeholder="Email" name="ref_email_3" value="<?php echo $application->ref_email_3 ?>">
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <legend>Current Address:</legend>
                    <div class="control-group">
                        <label class="control-label" for="cur_addr">Address:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="cur_addr" placeholder="Address" name="cur_addr" value="<?php echo $application->cur_addr ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="cur_city_prov">City and Province:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="cur_city_prov" placeholder="City and Province" name="cur_city_prov" value="<?php echo $application->cur_city_prov ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="cur_post">Postal Code:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="cur_post" placeholder="Postal Code" name="cur_post" value="<?php echo $application->cur_post ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="cur_time">Time at Address:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="cur_time" placeholder="Time at Address" name="cur_time" value="<?php echo $application->cur_time ?>">
                        </div>
                    </div>
                    <legend>Previous Address:</legend>
                    <div class="control-group">
                        <label class="control-label" for="prev_addr">Address:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="prev_addr" placeholder="Address" name="prev_addr" value="<?php echo $application->prev_addr ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="prev_city_prov">City and Province:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="prev_city_prov" placeholder="City and Province" name="prev_city_prov" value="<?php echo $application->prev_city_prov ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="prev_post">Postal Code:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="prev_post" placeholder="Postal Code" name="prev_post" value="<?php echo $application->prev_post ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="prev_time">Time at Address:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="prev_time" placeholder="Time at Address" name="prev_time" value="<?php echo $application->prev_time ?>">
                        </div>
                    </div>
                    <legend>Additional Info</legend>
                    <div class="control-group">
                        <label class="control-label" for="pets">Pets:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="pets" placeholder="Pets" name="pets" value="<?php echo $application->pets ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="parking">Parking Required:</label>
                        <div class="controls">
                            <select name="parking">
                                <option <?php $application->parking == "yes" ? "selected" : "" ?> value="yes">yes</option>
                                <option <?php $application->parking == "no" ? "selected" : "" ?>  value="no">no</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="co_app">Co-Applicants:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="co_app" placeholder="applicant #" name="co_app" value="<?php echo $application->co_app ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="add_app">Additional Occupants:</label>
                        <div class="controls">
                            <input class="span10" type="text" id="add_app" placeholder="Additional Occupants" name="add_app" value="<?php echo $application->add_app ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="source">Income Source:</label>
                        <div class="controls">
                            <textarea class="span10" id="source" placeholder="Please Explain" name="source" value=""><?php echo $application->source ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="missed">Anything we missed?</label>
                        <div class="controls">
                            <textarea class="span10" id="missed" placeholder="Anything we missed?" name="missed" value=""><?php echo $application->missed ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <hr>
        <div class="pull-right">
            <input class="btn btn-large" value="Cancel" type="reset">
            <input class="btn btn-large btn-primary" value="Save" type="submit">
        </div>
    </form>
</div>






