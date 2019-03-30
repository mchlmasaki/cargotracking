<?php

return [

    /*
     *
     */

    /*
     *
     * This is your mpesa consumer key
     *
    */

    'consumer_key' => 'm4rkhSyBYThL5ph6Zhqx4dsku3YhcOIJ',

    /*
     * This is your mpesa secret key
     */

    'consumer_secret' => '6An8Tese0jAhhV9F',

    /*
     * shortcode is your paybill number
     */

    'short_code' => '734328',

    'passkey' => '45ee6de27ab656a192fc297e5ed14e277080bb09d42a8c00261fb4f410fcaf4d',

    /*
     * stk callback url that will be called by safaricom
     */

    'callback_url' => 'https://rupamall.co.ke/api/callback/mpesa',

    /*
     * validation url this url will be used by safaricom to validate transaction
     */

    'validation_url' => 'https://rupamall.co.ke/api/v1/stk-response'


];