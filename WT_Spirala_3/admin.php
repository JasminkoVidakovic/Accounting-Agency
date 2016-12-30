<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact Us</title>
		<link rel="stylesheet" href="contact_form_style.css" type="text/css" />
		<script type="text/javascript" src="contact_form.js" charset="UTF-8"></script>
</head>
<?php
	
    if(!isset($_SESSION['login']))
	{ 	
        header("Location: index.php");
        exit();
    }
	else if(isset($_SESSION['login']))
	{
		echo "<p>Dobro došli na upravljačku ploču!</p><br><br>";
		echo "<script type='text/javascript' src='admin_sugg.js'></script>";
		echo "<a href='index.php'>Povratak na početni page</a><br><br>";
		echo "<a href='logout.php'>Logout</a><br><br><br><br><br>";
		echo "<a href='report.php?napravi=1'><b>Kreiraj izvještaj (CSV)</b></a><br><br>";
		echo "<a href='report.php?napravi=2'><b>Kreiraj izvještaj (PDF)</b></a><br><br><br><br>";
		echo "<p>Brza pretraga pošiljaoca (po emailu i imenu):&nbsp;&nbsp;<input type='text' name='pretraga' id='search' onkeyup='suggestMe(this)' method = 'get'></p>";		
		echo "<p id='rezultati'>Rezultati i prijedlozi:<br><br><span id='ovdje_se_prikazi'></span></p><br><br><br>";
		echo "<b>Poruke:</b><br><br>";
		echo "----------------------------------------------------------------------------------------------------<br><br><br>";
		
		if(file_exists('poruke.xml'))
		{
		$xmlDoc=new SimpleXMLElement('poruke.xml', 0, true);
		
		$i = 0;
	
		foreach($xmlDoc->poruka as $poruka) 
		{			
			echo "Ime i prezime:     ".$poruka->ime."<br><br>";
			echo "Broj telefona:     ".$poruka->telefon."<br><br>";
			echo "Email:     ".$poruka->email."<br><br>";
			echo "Ocjena:     ".$poruka->ocjena."<br><br>";
			echo "Tekst poruke:     ".$poruka->msg."<br><br><br><br>";
			echo "<a href='edit.php?broj=".$i."'>Napomena admina(klik za promjenu)</a>:  ".$poruka->napomena."<br><br><br><br>";
			echo "<a href='delete.php?msgNum=".$i."'><b>Obriši poruku</b></a><br><br>";
			echo "----------------------------------------------------------------------------------------------------<br><br><br>";
			$i = $i + 1;
		}
		}
		else
		{
				echo "Nema poruka.";
		}
	
	}

?>
	<body>
			
	
	</body>
</html>