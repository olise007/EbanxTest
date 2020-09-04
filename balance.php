<?php
include("operations.class.php");
$account_id = $_GET['account_id'];
$request = new operations();

if($request->checkAccountExist($account_id)){
  $retrieval = $request->getBalance($account_id);
} else {
  http_response_code(404);
  $retrieval = 0;	
}
echo ($retrieval);
