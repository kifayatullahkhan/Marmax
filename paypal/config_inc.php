<?php

// Set sandbox (test mode) to true/false.
$sandbox = TRUE;

// Set PayPal API version and credentials.
$api_version = '85.0';
$api_endpoint = $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
$api_username = $sandbox ? 'kstore_1349034185_biz_api1.yahoo.com' : 'm.jawabri_api1.citynet.com.co';
$api_password = $sandbox ? '1349034238' : 'CWVD37AR6QNYQRKF';
$api_signature = $sandbox ? 'AG5OBQ4-3TfS8IZEUAtLO9J5YrYuA-DXuqjC2YFuA0pC516QN-oEOU3l' : 'AFcWxV21C7fd0v3bYYYRCpSSRl31Aq7cXQRO1cl2gi9al-c6sFyiyW-h';
 