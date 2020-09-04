<?php
class operations {

	public $account_path = '/home/techionc/public_html/ebanx.rms.net.ng/account_data/';
	
	public function __contstruct($account_id=''){
		
	if($account_id != ''){
$file = $this->account_path.$account_id.'.txt';
	if(!file_exists($file)){
		$myfile = fopen($file, "w");
		fclose($myfile);
	}	
		}
	}
	
	
	public function getBalance(string $account_id){
        if($this->checkAccountExist($account_id)){
		$amount = $this->getAmount($account_id);
		} else {
		$amount = 0;	
		}
		return($amount);
	}
	
	public function checkAccountExist(string $account_id){
		
$file = $this->account_path.$account_id.'.txt';
		
		if(file_exists($file)){
			$check = true;
		} else {
			$check = false;
		}
		
		return $check;
	}
	
	public function deposit(string $destination, int $amount){
		$starting_amount = $this->getBalance($destination);
		$id = $destination;
		$balance = $starting_amount + $amount; //would typically be the sum addition of previous balace and deposit amount 
		$this->setAmount($destination, $balance);
		
		$result = array (
    "destination"  => array("id" => $id, "balance" => $balance)
		);
		
		
		return($result);
	}
	
	public function withdraw(string $origin, int $amount){
		$starting_amount = $this->getBalance($origin);
		$id = $origin;
		$balance = $starting_amount - $amount;//would typically be the difference addition of previous balace and withdrawal amount 
		$this->setAmount($origin, $balance);
		
		$result = array (
    "origin"  => array("id" => $id, "balance" => $balance)
		);
		
	return($result);
		
	}
	
	public function transfer(string $origin, string $destination, int $amount){
//retrieve starting balance of origin and subtract
	$starting_amount_origin = $this->getBalance($origin);	
	$balance_origin = $starting_amount_origin - $amount;
	$this->setAmount($origin, $balance_origin);	
//retrive starting amount of destination and add		
	$starting_amount_destination = $this->getBalance($destination);	
	$balance_destination = $starting_amount_destination + $amount;
	$this->setAmount($destination, $balance_destination);		
		
	$id_origin = $origin;
	$id_destination = $destination;	
		
		$result = array (
    "origin"  => array("id" => $id_origin, "balance" => $balance_origin),
	"destination" => array("id" => $id_destination, "balance" => $balance_destination)		
		);
		
	return($result);
		
	}
	
	public function getAmount(string $account_id){
$file = $this->account_path.$account_id.'.txt';		
$myfile = fopen($file, "r") or die("Unable to open file!");
$amount = fread($myfile,filesize($file));
fclose($myfile);
		
$amount = (int)$amount;
		
		return($amount);
	}
	
	public function setAmount(string $account_id, int $amount){
$file = $this->account_path.$account_id.'.txt';		
$myfile = fopen($file, "w") or die("Unable to open file!");
$txt = (string)$amount;
fwrite($myfile, $txt);
fclose($myfile);
	}
	
public function accountReset(){
	
	try{
	$files = glob($this->account_path.'*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
	return('OK');
	} catch (Exception $e){
		return($e);
	}
	
}	

}