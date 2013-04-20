<fieldset>
    <legend class="center">Charge $4 dollars to get the full information</legend>
    <div class="row-fluid">
        <div class="span6 center" style="margin-left: 25%">
            <form class="form-actions" action="<?php echo URL::site('payment/pay') ?>" method="post">
                <input type="hidden" name="hash" value="<?php echo $hash ?>">
                <script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
                        data-key="<?php echo Kohana::$config->load('stripe')->get('test')['publishable_key']; ?>"
                        data-amount="400" data-description="Payment for full info">
                </script>
            </form>
        </div>
    </div>
</fieldset>
