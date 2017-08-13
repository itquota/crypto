<?php
$result = include_once("../config/config.php");
//var_dump($options);

$conn = mysqli_connect($options['Datasources']['default']['host'],$options['Datasources']['default']['username'],$options['Datasources']['default']['password'],$options['Datasources']['default']['database']);
//var_dump($conn);

$response = json_encode($_POST);
//print_r($response);
if(!empty($_POST)){
	mysqli_query($conn,"insert into payment_response(response) values('$response')");
}
?>