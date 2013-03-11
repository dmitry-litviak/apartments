<div id='gmaps-canvas' class="map_canvas"></div>
<div id='gmaps-error'></div>
<input type="hidden" id="lng" value="<?php echo $lng ?>">
<input type="hidden" id="lat" value="<?php echo $lat ?>">
<input type="hidden" id="type_id" name="type_id" value="<?php echo !empty($type_id) ? $type_id : "" ?>">
<input type="hidden" id="from" value="<?php echo $from ?>">
<input type="hidden" id="to" value="<?php echo $to ?>">

<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js" ></script>