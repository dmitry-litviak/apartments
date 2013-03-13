<form class="form-actions" action="<?php echo URL::site('session/create') ?>" method="POST">
    <fieldset class="places">
        <legend>Create Account</legend>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label" for="first_name">First Name:</label>
                    <div class="controls">
                        <input class="span12" type="text" id="first_name" placeholder="John" name="first_name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="last_name">Last Name:</label>
                    <div class="controls">
                        <input class="span12" type="text" id="last_name" placeholder="Smith" name="last_name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email:</label>
                    <div class="controls">
                        <input class="span12" type="text" id="email" placeholder="john@mail.com" name="email">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">Password:</label>
                    <div class="controls">
                        <input class="span12" type="password" id="password" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="cost">Type of account:</label>
                    <div class="btn-group" data-toggle="buttons-radio" id="type_switcher">
                        <button type="button" class="btn active" data-id="1">Shopper</button>
                        <button type="button" class="btn" data-id="2">Owner</button>
                    </div>
                </div>
                <input name="type_id" id="type" type="hidden" value="1">
                <div class="control-group pull-right">
                    <input class="btn btn-large" value="Cancel" type="reset">
                    <input class="btn btn-large btn-primary" value="Save" type="submit">
                </div>
            </div>
            <div class="span6">
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
            </div>
        </div>
    </fieldset>
</form>