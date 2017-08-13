<html>
	<head>
	</head>
	<body>
	here
	</body>
</html>

<?php
/*
	CoinPayments.net API Example
	Copyright 2016 CoinPayments.net. All rights reserved.	
	License: GPLv2 - http://www.gnu.org/licenses/gpl-2.0.txt
*/
/*
	require('./coinpayments.inc.php');
	$cps = new CoinPaymentsAPI();
	//$cps->Setup('Your_Private_Key', 'Your_Public_Key');
	$cps->Setup('328667D116017F2f33a00c9126a6121824e7B82948f4396A6163c70483f6112e', '4ecc73062d3a8218dc6e2d0dde7f5db140b495867083315172d5c8fcdaa0025e');

	$result = $cps->CreateTransactionSimple(10.00, 'USD', 'BTC', '', 'your_buyers_email@email.com');
	if ($result['error'] == 'ok') {
		$le = php_sapi_name() == 'cli' ? "\n" : '<br />';
		print 'Transaction created with ID: '.$result['result']['txn_id'].$le;
		print 'Buyer should send '.sprintf('%.08f', $result['result']['amount']).' BTC'.$le;
		print 'Status URL: '.$result['result']['status_url'].$le;
	} else {
		print 'Error: '.$result['error']."\n";
	}
*/

include('phpqrcode/qrlib.php'); 
 $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'phpqrcode'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    echo $PNG_TEMP_DIR;
//exit;
    //html PNG location prefix
    $PNG_WEB_DIR = 'phpqrcode/temp/';
 $matrixPointSize = 4;

   // include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';


     
    // outputs image directly into browser, as PNG stream 
    //QRcode::png('PHP QR Code :)');
 QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);        
echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  

$get = file_get_contents("https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=INR");
					print_r($get);
				exit;
    
?>

