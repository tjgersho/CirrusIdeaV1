<?php

class Auth{
	
	private $apiKey;
	
	
	public function __construct() {

	$this->apiKey = '123';
	}
	
	private function verifyKey($apiKey, $origin){
	
	return 1;
	
	}
	
	public function printkey(){
	echo $this->apiKey;
	}

}

?>