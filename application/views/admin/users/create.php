<form class="form-actions" action="<?php echo URL::site('admin/users/create') ?>" method="POST">
  <legend>Create User</legend>
  <?php Helper_Alert::get_flash() ?>
  <fieldset>
    <div class="control-group">
      <label class="control-label" for="email">Email</label>
      <div class="controls">
        <input type="text" id="email" placeholder="Email" name="email">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="text" id="firstName" placeholder="Password" name="password">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="first_name">First Name</label>
      <div class="controls">
        <input type="text" id="first_name" placeholder="First Name" name="first_name">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="last_name">Last Name</label>
      <div class="controls">
        <input type="text" id="last_name" placeholder="Last Name" name="last_name">
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <input type="submit" class="btn btn-primary" value="Create" />
        <button class="btn" type="button">Cancel</button>
      </div>
    </div>
  </fieldset>
</form>
