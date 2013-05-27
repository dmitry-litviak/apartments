<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <script type="text/javascript">
            var SYS = {baseUrl: '<?php echo URL::base() ?>'}
        </script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo URL::site('libs/html5shiv.js') ?>"></script>
        <![endif]-->

        <?php echo Helper_Output::renderCss(); ?>

    </head>
    <body>
        <!--<div style="max-width: 100%">-->
        <div id="wrap">
            <?php echo View::factory('layouts/partials/header')->render(); ?>
            <?php Helper_Alert::get_flash() ?>
            <div class="container main">
                <?php echo $content; ?>
            </div>
            <div class="hero-unit my-hero-unit" style="display: none;">
                <span id="filter_label">Search filters:</span>
                -- <span class="badge badge-warning filter-btn">Change filter</span>
                <?php if (Auth::instance()->logged_in()): ?>
                    -- <span class="badge badge-info alert-btn"><i class="icon-time icon-white"></i> Get alerts for this search</span>
                <?php endif; ?>
            </div>
            <div class="row-fluid">
                <div class="span12">

                    <div id='gmaps-canvas' class="map_canvas" style="display: none"></div>
                </div>
                <div class="scrollable side-bar" style="overflow: auto;">
    
                </div>
            </div>
            <div id="push"></div>
        </div>

        <?php echo View::factory('layouts/partials/footer')->render(); ?>
        <!--</div>-->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
        <script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/cat_js/intl/en_us/mapfiles/api-3/12/11/%7Bcommon,map,util,marker%7D.js"></script>
        <?php echo Helper_Output::renderJs(); ?>
    </body>
</html>