<?php
//cancerous code is sponsored by Benni Potato
//Sækjir breyturnar sem þarf
require('db.php');
$Nafn = $_POST["name"];
$Kennitala = $_POST["kennitala"];
$Skóli = $_POST["school"];
$Bekkur = $_POST["grade"];
$BolaSize = $_POST["size"];
// print_r($_POST);
//breytur fyrir kennitölu check
$ktaratug = true;
$ktDigit = true;
$ktdagBool = true;
$ktmanBool = true;
if (strlen($Kennitala) != 10) {//check if kennitala is the right length
	echo "Kennitalan er ekki af réttri lengd";
} else {
	if (isset($Nafn) && isset($Kennitala) && isset($Skóli) && isset($Bekkur) && isset($BolaSize)) {
		if ($Kennitala[9] == '9' || $Kennitala[9] == '0') { //Tjekka hvort Einstaklingur sé fæddur áratugana 19000 eða 2000 Eldra og yngri er ekki til
			
		} else {
			$ktaratug = false;
		}
		$ktdag = $Kennitala[0] . $Kennitala[1];
		if ($ktdag > 31) { //Tjekka hvort dagsetningin sjé meira enn 31 daga
			$ktdag = false;
		}
		$ktman = $Kennitala[2] . $Kennitala[3];
		if ($ktman > 12) {//Tjekka hvort mánuðurnir sjéu fleirri enn eru
			$ktmanBool = false;
		}
		if (!ctype_digit($Kennitala)) {//check if Kennitala i only digits
			$ktDigit = false;
		}
		if (strlen($Kennitala) == 10 && $ktaratug && $ktdag && $ktmanBool && $ktDigit) {//see if everything is right
			try {
				//Blah Blah Blah Getur gert þetta af prepared statement Ef þetta er ekki nogu gott
				strip_tags($Nafn);
				strip_tags($Kennitala);
				strip_tags($Skóli);
				strip_tags($Bekkur);
				strip_tags($BolaSize);
				//Insert into Some Database
	            $q = "INSERT INTO users (name, kennitala, school, class, tshirt) 
	            VALUES ('$Nafn','$Kennitala','$Skóli','$Bekkur','$BolaSize')";
	            $pdo->query($q);
	            echo "Skráning móttekin";
			} catch (Exception $up) {
				throw $up;//Kastar upp
			}
			
		} else {//if somethin is wrong with the kennitala
			echo "Það er eitthvað að kennitölunni";
		}
	} else {//if sombody forgot to input fields
		echo "Það vantar eitthvað í formið";
	}
}

?>