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
        <div style="max-width: 100%">
            <div class="container">
                <?php echo View::factory('layouts/partials/header')->render(); ?>
                <?php Helper_Alert::get_flash() ?>
                <?php echo $content; ?>
            </div>
            <div id='gmaps-canvas' class="map_canvas" style="display: none"></div>
            <div class="container">
                <hr style="margin: 10px 0px">
                <?php echo View::factory('layouts/partials/footer')->render(); ?>
            </div>
        </div>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
        <?php echo Helper_Output::renderJs(); ?>
    </body>
</html>