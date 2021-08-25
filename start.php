<?php

require 'vendor/autoload.php';

define('SITE_URL', 'http://localhost/GMS/payment.php');

$paypal = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
    'AYiHw_PlSPKPvSrqt2Csh-XgXmdkreDW7VAla4eZJ7PcQP4V0vlbOr9Luu4Y4wUmRN7XkvumJc7nCa6i',
    'ENpzrp0cuKwr9TzPGbMq06ORYbOkwrZjZRBKV5LO_dSrNEXH1aG2_Ji43opijDcxp6FZAJBKCCmjM36E'
    )
  );


 ?>
