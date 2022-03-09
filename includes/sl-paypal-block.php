<?php

class SL_PayPalBlock {
    public static function generate($attributes) {

        $desc = self::getValue('desc', $attributes);
        $buttonID = self::getValue('buttonid', $attributes);

        if($desc == NULL || $buttonID == NULL) {
            return '<p>Usage: [paypal-block desc="text description" buttonID="123"]</p>';
        }
        else {
            return <<<BODY
    <div class="item-group col-xs-12">
    <div class="col-xs-12 col-sm-8 ">$desc</div>
    <div class="col-xs-12 col-sm-4">
        <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="$buttonID">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
    </div>
    </div>
BODY;
        }
    }

    public static function getValue($key, $attributes) {
        if(array_key_exists($key, $attributes)) {
            return $attributes[$key];
        }
        else
            return NULL;
    }
}
