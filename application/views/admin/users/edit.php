<form class="form-actions" action="<?php echo URL::site('admin/users/edit') ?>" method="POST">
  <legend>Create User</legend>
  <?php Helper_Alert::get_flash() ?>
  <fieldset>
      <input type="hidden" name="id" value="<?php echo $user->id ?>">  
    <div class="control-group">
      <label class="control-label" for="email">Email</label>
      <div class="controls">
          <input type="text" id="email" placeholder="Email"  name="email" value="<?php echo $user->email ?>">
      </div>
    </div>
      
    <div class="control-group">
      <label class="control-label" for="first_name">First Name</label>
      <div class="controls">
        <input type="text" id="first_name" placeholder="First Name" name="first_name" value="<?php echo $user->user_profile->first_name ?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="last_name">Last Name</label>
      <div class="controls">
        <input type="text" id="last_name" placeholder="Last Name" name="last_name" value="<?php echo $user->user_profile->last_name ?>">
      </div>
    </div>
     
    <div class="control-group">
      <label class="control-label" for="last_name">Role</label>  
      <div class="controls">
          <select name="role_id">
              <?php foreach (ORM::factory('Role')->find_all() as $role): ?>
              <option value="<?php echo $role->id ?>" <?php echo $role->id == $user->getRole()->id ? "selected": "" ?> ><?php echo $role->name ?></option>
              <?php endforeach; ?>
          </select>
      </div>
    </div>
      
    <div class="control-group">
      <div class="controls">
        <input type="submit" class="btn btn-primary" value="Update" />
        <button class="btn" type="button">Cancel</button>
      </div>
    </div>
  </fieldset>
</form>
