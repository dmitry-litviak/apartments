<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
          <a class="brand" href="<?php echo URL::site() ?>">Apartments</a>
          
        <?php if (Auth::instance()->logged_in()): ?>
          <?php Helper_Mainmenu::setIsAdmin(Auth::instance()->get_user()->isAdmin()); ?>
            <div class="nav-collapse collapse">
            <ul class="nav">
                  <?php echo Helper_Mainmenu::render() ?>
            </ul>
        <?php endif; ?>
            
        <?php if (!Auth::instance()->logged_in()): ?>
          <form class="navbar-form pull-right" action="<?php echo URL::site('session/login') ?>" method="POST">
            <input class="span2" type="text" name="email" placeholder="Email">
            <input class="span2" type="password" name="password" placeholder="Password">
            <button type="submit" class="btn">Sign in</button>
          </form>
        <?php else: ?>
          <p class="navbar-text pull-right">
              Logged in as <a href="<?php echo URL::site('user/profile') ?>" class="navbar-link"><?php echo Auth::instance()->get_user()->user_profile->first_name?></a>
          </p>
        <?php endif; ?>
            
        </div> 
      </div>
    </div>
</div>