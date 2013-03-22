
<div class="masthead">
    <h3 class="muted zero-margin"><a class="head" href="<?php echo URL::base() ?>">Apartments Site</a></h3>
    <h5 class="muted zero-margin"><a class="head" href="<?php echo URL::base() ?>">Tag Line</a></h5>
    <hr class="hr-thin">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <?php echo Helper_Mainmenu::render() ?>
                    <?php if (Auth::instance()->get_user()): ?>
                        <?php $role = Auth::instance()->get_user()->roles->order_by('role_id', 'desc')->find()->name ?>
                        <?php if ($role == 'admin'): ?>
                            <li><a href="<?php echo URL::site('admin/dashboard') ?>">Admin Panel</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div><!-- /.navbar -->
</div>