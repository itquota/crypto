<?php
/*
	CoinPayments.net API Example
	Copyright 2016 CoinPayments.net. All rights reserved.	
	License: GPLv2 - http://www.gnu.org/licenses/gpl-2.0.txt
*/

$result = include_once("../config/config.php");
if(!empty($_POST)){
	$amount = $_POST['qty'];
	$currency = $_POST['currency'];
	//	$amount = $_POST['amount'];
	function is_connected()
	{
		$connected = @fsockopen("www.example.com", 80); 
											//website, port  (try 80 or 443)
		if ($connected){
			$is_conn = true; //action when connected
			fclose($connected);
		}else{
			$is_conn = false; //action in connection failure
		}
		return $is_conn;
	}
	
	$connected = is_connected();
	if($connected){			
		require('./coinpayments.inc.php');
		$cps = new CoinPaymentsAPI();
		//$cps->Setup('Your_Private_Key', 'Your_Public_Key');
		$cps->Setup('328667D116017F2f33a00c9126a6121824e7B82948f4396A6163c70483f6112e', '4ecc73062d3a8218dc6e2d0dde7f5db140b495867083315172d5c8fcdaa0025e');

	//	$result = $cps->CreateTransactionSimple($amount, $currency, $currency, '', 'it.developer.quota@gmail.com');
	
		$req = array(
			'amount' => $amount,
			'currency1' => $currency,
			'currency2' => $currency,
			'address' => '', // send to address in the Coin Acceptance Settings page
			'item_name' => 'Test Item/Order Description',
			'ipn_url' => 'ipn_handler.php',
		);
		// See https://www.coinpayments.net/apidoc-create-transaction for all of the available fields

		$result = $cps->CreateTransaction($req);

	//	print_r($result);
		if ($result['error'] == 'ok') {
			$le = php_sapi_name() == 'cli' ? "\n" : '<br />';
			$txid = $result['result']['txn_id'];
		//	print 'Transaction created with ID: '.$result['result']['txn_id'].$le;
		//	print 'Buyer should send '.sprintf('%.08f', $result['result']['amount']).' BTC'.$le;
		//	print 'Status URL: '.$result['result']['status_url'].$le;
			$address = $result['result']['address'];
			$status_url = $result['result']['status_url'];
			$qrcode_url = $result['result']['qrcode_url'];
		} else {
			print 'Error: '.$result['error']."\n";
		}

		$conn = mysqli_connect($options['Datasources']['default']['host'],$options['Datasources']['default']['username'],$options['Datasources']['default']['password'],$options['Datasources']['default']['database']);
		//var_dump($conn);

		$response = json_encode($result);
		//print_r($response);

		mysqli_query($conn,"insert into payment_requests(amount,txid,address,status_url,qrcode_url) values('$amount', '$txid', '$address', '$status_url', '$qrcode_url')");
		
		include('phpqrcode/qrlib.php'); 
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'phpqrcode'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
	//	echo $PNG_TEMP_DIR;
		//exit;
		
		echo '<span style ="display:inline-block; width:350px;">Please send '.$amount.' '.$currency.' to address '.$address.'</span>';
		
		//html PNG location prefix
		$PNG_WEB_DIR = 'phpqrcode/temp/';
		$matrixPointSize = 4;

		// include "qrlib.php";    

		//ofcourse we need rights to create temp dir
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);


		$filename = $PNG_TEMP_DIR.'qrcode'.$txid.'.png';

	//	$qrcodeData = 'PHP QR Code :)';
		$qrcodeData = 'bitcoin:'.$address.'?amount='.$amount;
		
		// outputs image directly into browser, as PNG stream 
		//QRcode::png('PHP QR Code :)');
		//$filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
		QRcode::png($qrcodeData, $filename, $errorCorrectionLevel, $matrixPointSize, 2);        
		echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>'; 
		echo '<input type = "hidden" name = "address" value  = "'.$address.'">';
		echo '<input type = "hidden" name = "txid" value  = "'.$txid.'">';
	}else{
		echo "No internet connection, Please try again later";		
	}
}
?>

