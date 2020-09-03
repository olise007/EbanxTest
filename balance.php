<?php
include("operations.class.php");
$account_id = $_GET['account_id'];
$request = new operations();

if($request->checkAccountExist($account_id)){
  $retrieval = $request->getBalance($account_id);
} else {
  $retrieval = 0;	
}
echo ($retrieval);
