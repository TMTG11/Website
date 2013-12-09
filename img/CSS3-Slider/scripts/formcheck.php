<?php 

function checkmail($email,$check){
	require_once("/connection.php");
	$array["alert"]="function werkt".$email.$check;
	if(($email == "")||(empty($email))){
		$array["alert"] = "Voer een E-mail adres in <br/>";
		$array["maginserten"] = "false";
		$array["class"] = "negatief";
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$array["alert"] = $array["alert"]." Foutief e-mail adres ingevoerd<br/>";
		$array["maginserten"] = "false";
		$array["class"] = "negatief";
	}
	if($check == "check"){
		$gebruikercheck = mysql_query("SELECT * FROM gebruiker WHERE Email='$email'");
		$checkemail = mysql_fetch_array($gebruikercheck);
		if(count($checkemail) > 1){
			$array["alert"] = $array["alert"]." Gebruiker bestaat al<br/>";
			$array["maginserten"] = "false";
			$array["class"] = "negatief";
		}
	}
	if(isset($array)){
		return($array);
	}else{
		return(true);
	}
}


?>