<?php
	
	$valid=false;
	function users($user, $pass, $valid) {
		if($valid=false){
			echo "Unsuccessful login. Try again.\n";
		} else {
			$valid=true;
			echo "Successful login.\n";
		}
	}
		$user1=users("john1", "John1234", true);
		$user2=users("sally", "Sally001", true);
		$user3=users("joe123", "Joe12345", true);
		$user4=users("jackson", "Jackson1", true);
		$user5=users("lizzy", "Lizzy321", true);

		$database=array($user1, $user2, $user3, $user4, $user5);
	
		//login tries counter
		$tries=0;
		$login=false;
	
		$user6=users("john1", "John4321", false);
		//$user6=$user1
		while($tries < 4){
			if(in_array($user6, $database)){
				echo "Login successful.\n";
				exit();
			} else {
				$tries++;
				$left=3-$tries;
				echo "$left tries left.\n";
			}
		}
		if($tries == 3){
			echo "Too many failed login attempts. Please try agian later.\n";
			exit();
		}	
	
//	users("john1", "John4321");
?>
