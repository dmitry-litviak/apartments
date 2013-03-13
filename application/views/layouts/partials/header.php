
    <div class="masthead">
      <h3 class="muted">Apartments Site</h3>
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
            <ul class="nav">
                <?php echo Helper_Mainmenu::render() ?>
                <?php if (Auth::instance()->get_user()): ?>
                    <?php $role = Auth::instance()->get_user()->roles->order_by('role_id', 'desc')->find()->name ?>
                    <?php if ($role == 'owner' || $role == 'admin'): ?>
                        <li><a href="<?php echo URL::site('apartments') ?>">My Apartments</a></li>
                    <?php endif; ?>
                    <?php if ($role == 'admin'): ?>
                        <li><a href="<?php echo URL::site('admin/dashboard') ?>">Admin Panel</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo URL::site('session/logout') ?>">Logout</a></li>
                <?php endif; ?>
            </ul>
          </div>
        </div>
      </div><!-- /.navbar -->
    </div>