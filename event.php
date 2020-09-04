<?php
include("operations.class.php");
$data = json_decode(file_get_contents('php://input'), true);

$type = $data['type'];

$amount = (int)$data['amount'];

if(isset($data['destination'])){
	$destination = (string)$data['destination'];
}

if(isset($data['origin'])){
	$origin = (string)$data['origin'];	
}

http_response_code(201);
	
switch($type){
	case 'deposit':
	  $action = new operations($destination);	
	  $do_event = $action->deposit($destination, $amount);
		break;
	case 'withdraw':
		$action = new operations();
		if($action->checkAccountExist($origin)){
	  $do_event = $action->withdraw($origin, $amount);		
		}
		break;
	case 'transfer':
		$action = new operations();
		if($action->checkAccountExist($origin)){
	  $do_event = $action->transfer($origin, $destination, $amount);
        }
		break;
	default:
		http_response_code(404);
		$do_event = 0;
		break;
}

if(($do_event != '')&&($do_event != 0)){
	$do_event = json_encode($do_event);
} else {
http_response_code(404);
$do_event = 0;	
}


echo ($do_event);