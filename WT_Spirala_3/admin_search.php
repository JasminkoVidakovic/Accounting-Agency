<?php

	session_start();
	
	function AvoidXSS($unos) 
		{
			$unos = htmlspecialchars($unos);
			return $unos;
		}
	
	if(!isset($_SESSION['login']))
	{ 	
        header("Location: index.php");
        exit();
    }
	else if(isset($_SESSION['login']) && isset($_REQUEST["upit"]) && file_exists('poruke.xml'))
	{
		
		$imena_mailovi = array("");
				
		$xmlDoc=new SimpleXMLElement('poruke.xml', 0, true);
	
		foreach($xmlDoc->poruka as $poruka) 
		{			
			$ime=$poruka->ime;
			$email=$poruka->email;
			
			array_push($imena_mailovi, $ime, $email);

		}
		
		$query_sign = AvoidXSS($_REQUEST["upit"]);

		$hint = "";

		if ($query_sign !== "") 
		{
			$query_sign = strtolower($query_sign);
			$duzina=strlen($query_sign);
			
			foreach($imena_mailovi as $name) 
			{
				if (stristr($query_sign, substr($name, 0, $duzina))) 
				{
					if ($hint === "") 
					{
						$hint = $name;
						
					} 
					else 
					{
						$hint .= "<br><br> $name";
					}
        }
    }
}
		
		if($hint== "")
		{
			echo "Nema rezultata";
		}
		else
		{
			echo $hint;
		}
		
	}




?>