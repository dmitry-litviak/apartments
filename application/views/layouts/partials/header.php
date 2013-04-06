<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="span2" style="margin-top: 2px">
                <a class="brand my-brand" href="<?php echo URL::base() ?>">Apartments Site</a><br>
                <label class="tag-line">Tag Line</label>
            </div>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php echo Helper_Mainmenu::render() ?>
                    <?php if (Auth::instance()->get_user()): ?>
                        <?php $role = Auth::instance()->get_user()->roles->order_by('role_id', 'desc')->find()->name ?>
                        <?php if ($role == 'admin'): ?>
                            <li><a href="<?php echo URL::site('admin/dashboard') ?>">Admin Panel</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>