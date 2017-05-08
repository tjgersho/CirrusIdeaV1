<?php

class User{
	
		
	public function __construct() {
        $this->username = 'tjgersho';
	$this->name = 'Travis';
	$this->ID = 1;
	}

	
	private function get($type, $token){
	
		if($type == 'token'){
		return 1;
		
		}
	} 	
	
	public function loggedin(){
	
		if(isset($_SESSION['username'])){
		
		return 1;
		}else{
		return 0;
		}
		
	}
	
}

?>