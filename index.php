<?php

// error_reporting(E_ALL ^ E_NOTICE);
define('INPUT_TYPE_INT', 'int');
define('INPUT_TYPE_STR', 'str');

$stdin = fopen('php://stdin', 'r');
$name = '';
$surname = '';
$email = '';
$phonenumber1 = '';
$phonenumber2 = '';
$comment = '';
$peopleList = array( array('John','Walker','john@mail.com', '8686864515', '77777777777', 'Test comment'), array('Jonas','Jonaitis','jonas@mail.lt', '112', '911', 'Naujas komentaras'));
$arrIndex = '';

function handleTrimedUserInput($inputType = INPUT_TYPE_STR) {
  
	if(INPUT_TYPE_INT === $inputType) {
		 return intval(trim(fgets(STDIN)));
	} else if ($inputType === INPUT_TYPE_STR) {
		return strval(trim(fgets(STDIN)));
	}
	
	return trim(fgets(STDIN));
}


function createPerson( $name, $surname, $email, $phonenumber1, $phonenumber2, $comment) {
		global $peopleList;
	
		echo 'Enter name: ';
		$name = handleTrimedUserInput();
		echo 'Enter surname: ';
		$surname = handleTrimedUserInput();
		echo 'Enter email: ';
		$email = handleTrimedUserInput();

		while(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo("\n'$email' is not a valid email address\n");
			echo 'Enter valid email: ';
			$email = handleTrimedUserInput();
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				break;
			}
		}

		echo 'Enter phone number1: ';
		$phonenumber1 = handleTrimedUserInput();
		echo 'Enter phone number2: ';
		$phonenumber2 = handleTrimedUserInput();
		echo 'Enter comment: ';
		$comment =  handleTrimedUserInput();
		$person = array( $name, $surname, $email, $phonenumber1, $phonenumber2, $comment);
		
		array_push($peopleList, $person);
	}

	function repeatArray($arrIndex) {
		global $peopleList;

		print_r(array_values($peopleList));
		echo 'Enter person index: ';
		$arrIndex = handleTrimedUserInput(INPUT_TYPE_INT);
		echo 'change name: ';
		$name = handleTrimedUserInput();
		echo 'change surname: ';
		$surname = handleTrimedUserInput();
		echo 'change email: ';
		$email = handleTrimedUserInput();
		echo 'change phonenumber1: ';
		$phonenumber1 = handleTrimedUserInput();
		echo 'change phonenumber2: ';
		$phonenumber2 = handleTrimedUserInput();
		echo 'change comment: ';
		$comment = handleTrimedUserInput();

		$peopleList[$arrIndex] = array( $name, $surname, $email, $phonenumber1, $phonenumber2, $comment);	
	}

	function unsetArray($arrIndex) {
		global $arrIndex;
		global $peopleList;
		global $person;

		print_r(array_values($peopleList));
		echo 'Enter person ID who you want to delete: ';
		$arrIndex = handleTrimedUserInput(INPUT_TYPE_INT);

		if ($arrIndex === 0){
			array_shift($peopleList);
		}else{
			unset($peopleList[$arrIndex]);
		}
	}

	while (true){
		echo ' Press 1: Create a new person; ';
		echo ' Press 2: Edit person; ';
		echo ' Press 3: Delete person; ';
		echo ' Press 4: Show person list; ';
		echo ' Press 5: Exit program; ';
		
		$input = handleTrimedUserInput(INPUT_TYPE_INT);

		if ($input === 1){
	 		createPerson( $name, $surname, $email, $phonenumber1, $phonenumber2, $comment);
		}
		else if ($input === 2){
			repeatArray( $arrIndex );
		}
		else if ($input === 3){
			unsetArray($arrIndex);
		}
		else if ($input === 4){
			print_r(array_values($peopleList));
		}
		else if ($input === 5){
			exit(" Good bye \n");
		}
		else {
			echo "WRONG NUMBER\n";	
		}
	}

?>