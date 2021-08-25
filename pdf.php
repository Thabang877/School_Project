<?php

require_once 'PDFMaster\app\bootstrap.php';

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

$capture = new \PDFMaster\Codecourse\Capture\Capture;
$view = new \PDFMaster\Codecourse\Views\View;
//$capture->load('invoice.php', [], 'pdf');


$capture->load('report.php', ['' => ''] );
$capture->respond('gmsReport.pdf', 'pdf');
