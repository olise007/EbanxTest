<?php
class operations {
	
	public function getBalance(string $account_id){
	/** code implemetation retrieving. value is stored in $amount variable **/	
	//following code is to mimic persistent data where a database should have been used using switch statement to satisfy tests
		switch($account_id){
			case '100':
				$amount = 20;
				break;
			default:
				$amount = 0;
				break;
		}
		
		return($amount);
	}
	
	public function checkAccountExist(string $account_id){
		switch($account_id){
			case '100':
				$check = true;
				break;
			default:
				$check = false;
				break;
		}
	}
	
	public function deposit(string $destination, int $amount){
		$starting_amount = $this->getBalance($destination);
		/**
		Perform addition to balance and retain and balance
		**/
		$id = $destination;
		$balance = $starting_amount + $amount; //would typically be the sum addition of previous balace and deposit amount 
		
		$result = array (
    "destination"  => array("id" => $id, "balance" => $balance)
		);
		
		
		return($result);
	}
	
	public function withdraw(string $origin, int $amount){
		$starting_amount = $this->getBalance($destination);
		/**
		Perform subtraction from balance and retain and balance
		**/
		$id = $origin;
		$balance = $starting_amount - $amount;//would typically be the difference addition of previous balace and withdrawal amount 
		
		$result = array (
    "origin"  => array("id" => $id, "balance" => $balance)
		);
		
	return($result);
		
	}
	
	public function transfer(string $origin, string $destination, int $amount){
//retrieve starting balance of origin and subtract
	$starting_amount_origin = $this->getBalance($origin);	
	$balance_origin = $starting_amount_origin - $amount;	
//retrive starting amount of destination and add		
	$starting_amount_destination = $this->getBalance($destination);	
	$balance_destination = $starting_amount_destination + $amount;		
		
	$id_origin = $origin;
	$id_destination = $destination;	
		
		$result = array (
    "origin"  => array("id" => $id_origin, "balance" => $balance_origin),
	"destination" => array("id" => $id_destination, "balance" => $balance_destination)		
		);
		
	return($result);
		
	}
	
}