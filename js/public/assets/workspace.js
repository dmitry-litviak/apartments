(function(){
window.JST = window.JST || {};

window.JST['apartment'] = _.template('<!--    <div class="media">\n        <a class="pull-left" href="#">\n            <img class="media-object bordered-img" src="<%= item.ap.img %>" height="128" width="128">\n        </a>\n        <div class="span5">\n            <h4><%= item.ap.title %></h4>\n            <div>\n                <strong>Description:</strong>\n                <%= item.ap.descr %>\n            </div>\n            <div>\n                <strong>Address:</strong>\n                <%= item.ap.address %>\n            </div>\n            <div>\n                <strong>Rooms:</strong>\n                <%= item.ap.type_id %>\n            </div>\n            <div>\n                <strong>Cost:</strong>\n                <span class="label label-success">$<%= item.ap.cost %></span>\n            </div>\n            <div class="pull-right">\n                <% if (item.fav.user_id != 0) { %>\n                    <button class="btn btn-primary <%= item.fav.status ? \'disabled\' : \'\' %>" id="favorite" onclick="javascript: map.add_to_favorite(<%= item.ap.id %>, this, <%= item.fav.user_id %>)" ><%= item.fav.status ? \'In Favorites\' : \'Add to Favorites\'%></button>\n                <% } else {%>\n                    <button class="btn btn-danger disabled" id="favorite" >You should sign in as a shopper to use favorites feature</button>\n                <% } %>\n            </div>\n        </div>\n    </div>-->\n<div class="tabbable tabs-left">\n    <ul class="nav nav-tabs">\n        <li class=""><a href="#lA" data-toggle="tab">Photos</a></li>\n        <li class="active"><a href="#lB" data-toggle="tab">Details</a></li>\n        <li><a href="#lC" data-toggle="tab">Contact</a></li>\n    </ul>\n    <div class="tab-content">\n        <div class="tab-pane" id="lA">\n            <img class="bordered-img" src="<%= item.ap.img %>" height="128" width="128">\n        </div>\n        <div class="tab-pane active" id="lB">\n            <h4><%= item.ap.title %></h4>\n            <div>\n                <strong>Description:</strong>\n                <%= item.ap.descr %>\n            </div>\n            <div>\n                <strong>Address:</strong>\n                <%= item.ap.address %>\n            </div>\n            <div>\n                <strong>Rooms:</strong>\n                <%= item.ap.type_id %>\n            </div>\n            <div>\n                <strong>Cost:</strong>\n                <span class="label label-success">$<%= item.ap.cost %></span>\n            </div>\n        </div>\n        <div class="tab-pane" id="lC">\n            <p><strong>Email</strong>:  </p>\n        </div>\n    </div>\n</div>\n\n<div class="">\n    <% if (item.fav.user_id != 0) { %>\n    <button class="btn btn-primary <%= item.fav.status ? \'disabled\' : \'\' %>" id="favorite" onclick="javascript: map.add_to_favorite( < %= item.ap.id % > , this, < %= item.fav.user_id % > )" ><%= item.fav.status ? \'In Favorites\' : \'Add to Favorites\'%></button>\n    <% } else {%>\n    <button class="btn btn-danger disabled" id="favorite" >You should sign in as a shopper to use favorites feature</button>\n    <% } %>\n</div>');
})();