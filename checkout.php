<?php

require 'start.php';

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;




if(!isset($_POST['price'], $_POST['product'])){
die();
}

$product = $_POST['product'] ;
$price = $_POST['price'];
$shipping = 0.50;

$total = $price + $shipping;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item -> setName($product)
  ->setCurrency('GBP')
  ->setQuantity(1)
  ->setPrice($price);

  $itemList = new ItemList();
  $itemList -> setItems([$item]);

  $details = new Details();
  $details->setShipping($shipping)
  ->setSubtotal($price);

  $amount = new Amount();
  $amount->setCurrency('GBP')
  ->setTotal($total)
  ->setDetails($details);

  $transaction = new Transaction();
  $transaction->setAmount($amount)
  ->setItemList($itemList)
  ->setDescription('PayForPackage')
  ->setInvoiceNumber(uniqid());

  $redirectUrls = new RedirectUrls();
  $redirectUrls->setReturnUrl(SITE_URL . '?success=true')
  ->setCancelUrl(SITE_URL . '?success=false');

  $payment = new Payment();
  $payment->setintent('sale')
  ->setPayer($payer)
  ->setRedirectUrls($redirectUrls)
  ->setTransactions([$transaction]);

try{

  $payment->create($paypal);


}catch(Exception $e){
  die($e);
}

//echo $approvalUrl = $payment->getApprovalLink();
$approvalUrl = $payment->getApprovalLink();

header("Location: {$approvalUrl}");
 ?>
