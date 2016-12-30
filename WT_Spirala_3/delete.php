<?php

	session_start();
	
	function AvoidXSS($unos) 
		{
			$unos = htmlspecialchars($unos);
			return $unos;
		}

	if(isset($_SESSION['login']) && isset($_GET['msgNum']))
	{
		$number = AvoidXSS($_GET['msgNum']);
	
		$xmlDoc = new DOMDocument();
		$xmlDoc->preserveWhiteSpace = false;
		$xmlDoc->formatOutput = true;
		$xmlDoc->Load('poruke.xml');
	
		$root = $xmlDoc->getElementsByTagName('sve_poruke')->item(0);
	
		$poruka = $root->getElementsByTagName('poruka')->item($number);
		$root->removeChild($poruka);
		$xmlDoc->save('poruke.xml');
	
		header("Location: admin.php");
	}
	else
	{
		header("Location: index.php");
	}
	
	
?>