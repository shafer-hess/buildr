<?php

	//mock username and password
	//$username="user101";
	$username="user";
	//$password="Pass1001";
	$password="pass";
	
	//check username length - required at least 5 chars
	if(strlen($username) < 5){
		echo "Invalid username length. Username must be at least 5 characters long.\n";
		//return false;
	} else { 
		echo "Valid username.\n";
		//return true; 
	}

	//check password length - required at least 8 chars
	if(strlen($password) < 8){
		echo "Invalid password. Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, and a number.\n";
	} else if(strlen($password) >= 8){
		//check if it contains a uppercase letter, lowercase letter, and number
		if(preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password)){
			echo "Valid password.\n";
			//return true;
		} else { 
			echo "Invalid password. Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, and a number.\n";
			//return false; 
		}
	}
	
