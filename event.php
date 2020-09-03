<?php
include("operations.class.php");

$type = $_POST['type'];
$amount = (int)$_POST['amount'];

if(isset($_POST['destination'])){
	$destination = (string)$_POST['destination'];
}

if(isset($_POST['origin'])){
	$origin = (string)$_POST['origin'];	
}

$action = new operations();

switch($type){
	case 'deposit':
	if($action->checkAccountExist($destination)){	
	  $do_event = $action->deposit($destination, $amount);
	}
		break;
	case 'withdraw':
		if($action->checkAccountExist($origin)){
	  $do_event = $action->withdraw($origin, $amount);
		}
		break;
	case 'transfer':
		if(($action->checkAccountExist($origin))&&($action->checkAccountExist($destination))){
	  $do_event = $action->transfer($origin, $destination, $amount);
        }
		break;
	default:
		$do_event = 0;
		break;
}