
 <?php                // Uppdaterad gästbok

$ip = $_SERVER['REMOTE_ADDR'];
$datum = date('Y-m-d H:i');
$tdatum = date('Y-m-d');
$fnamn = "data/gastbok.txt";        // Katalog/fil för gästboksinläggen.
$fel = "(2 siffror)";
if ($_POST['namnet']){
	if ($_POST['texten']){
		 
		//if ($tdatum <> $_POST['koll'] ) {
			//$fel = "Fel datum! <a href =\"javascript:history.go(-1);\"><b>&larr; Backa och ändra!</b></a>"; 
			//}
		if ($_POST['ort']) 
		{
			// where you save into file
			
			$wantedDate = $_POST["koll"];
			/*$texten = str_replace("<", "&lt;", $_POST['texten']);
			$texten = str_replace(">", "&gt;", $texten);
			$texten = str_replace("|", "", $texten);
			$texten = stripslashes($texten);
			$texten = str_replace("\n", "<br>", $texten);    // Radbryter text
			$texten = str_replace("\r", "", $texten);*/
			//$hsida = str_replace("http://", "", $_POST['hsida']);
			 
			$input = $datum."|".$_POST['ort']."|".$texten."|".$_POST['namnet']."|".$_POST['email']."|".$_POST["adress"]."|".$ip."|".$_POST['koll']."|".$_POST["telnr"]."|".$_POST["postnr"]."|".$_POST["friend1"]."|".$_POST["friend2"]."|\n";
				if (file_exists($fnamn))
				{
					$fil = file_get_contents($fnamn);    // Hämta gamla texten till $file.
				}
			$fp = fopen ($fnamn, "w");      // Öppna filen för överskrivning
			fwrite($fp, "$input");           // Skriv in den nya texten 
			fwrite($fp, "$fil");         // Lägg till den tidigare texten
			fclose ($fp);             // Stänger filen.
			header("Location:". $_SERVER['PHP_SELF']); exit;
		}
	}
}
	echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n";
	echo "<HTML><HEAD><TITLE>Gästbok</TITLE>\n";
	echo "<META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=iso-8859-1'>\n";
	echo "<link rel='stylesheet' href='style.css?v=<?php echo time(); ?>'>";
	
	echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>";
	echo "<script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js'></script>";		
	echo "<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>";		
	echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js'></script>";
		
	// *** Här ändras teckensnitt och storlek. Kan även kompletteras med egna classer. ***
	echo "<style type=\"text/css\">
	table {font-size:10pt; font-family:Arial}
	.text {font-size:12pt; font-family:\'Times New Roman\'}
	hr {color: blue}
	</style>";
	echo "</HEAD>";
	
	
	echo "<BODY BGCOLOR=\"#ccccff\">\n";
	echo "<div class='row justify-content-center m-4'>
		<a href='../index.php' style='text-decoration:none; color:black;'><h2 style='font-family:Rockit;' class='pt-3 logo'> Auditar </h2></a>
		</div>";
	echo "<table class='t2'align=center width=100% bgcolor=\"#ffffcc\"><tr><td>\n";
	echo "<form class='mx-4' method=\"post\" action=\"$PHP_SELF\">\n"; 
	echo "<fieldset>";
	
	echo "<legend> Personal Info </legend>";
	//echo "<center><b>Gästbok</b></center>\n";
	echo date('Y-m-d H:i')."<br>\n";
	echo "<br>";
	
	echo "<table>\n";
	
	//email input
	
	echo '<div class="form-group">';
    echo'<label for="exampleInputEmail1">Email address</label>';
    echo'<input type="email" name="email" class="form-control" >';
    echo'<small id="emailHelp" class="form-text text-muted">We"ll never share your email with anyone else.</small>';
	echo"</div>";
	
	//namn input
	echo '<div class="row">';
	echo '<div class="ml-3 form-group col-xs-4">';
    echo'<label for="exampleInputEmail1">First Name </label>';
    echo'<input type="text" name="namnet" class="form-control" >';
	echo"</div>";
	
	echo '<div class="form-group col-xs-8 ml-3">';
    echo'<label for="exampleInputEmail1">Last Name </label>';
    echo'<input type="text" name="" class="form-control" >';
	echo"</div>";
	echo"</div>";
	
	//phone number input
	
	echo '<div class="form-group">';
    echo'<label for="exampleInputEmail1">Phone Number</label>';
    echo'<input type="text" name="telnr" class="form-control"  >';
	
	echo"</div>";
	//adress input
	
	echo '<div class="form-group">';
    echo'<label for="exampleInputEmail1">Adress</label>';
    echo'<input type="text" name="adress" class="form-control"  >';
	
	echo"</div>";
	// postnr
	
	echo '<div class="row">';
	echo '<div class="ml-3 form-group col-xs-4">';
    echo'<label for="exampleInputEmail1">PostNr </label>';
    echo'<input type="text" name="postnr" class="form-control" >';
	echo"</div>";
	
	
	//ort
	echo '<div class="form-group col-xs-8 ml-3">';
    echo'<label for="exampleInputEmail1">Ort </label>';
    echo'<input type="text" name="ort" class="form-control" >';
	echo"</div>";
	echo"</div>";
	
	
	
	
	echo "<tr style=\" opacity: 0.0\"><td>Namn:</td><td>E-post: (frivilligt)</td><td>Adress</td></tr>\n";
	
	echo "<tr><td><input style=\" opacity: 0.0\" type=\"text\" ></td>\n";
	
	//echo "<td><input type=\"text\" name=\"email\"></td>\n";
	echo "<td>   </td>\n";
	echo "<td>   </td>\n";
	echo "<td>   </td>\n";
	//echo "<td><input type=\"text\" name=\"adress\"></td></tr>\n";
	
	//echo "<tr> <td> TelNr : </td> <td> PostNr : </td> </tr>\n";
	
	echo "</fieldset>";
	
	
	
	//echo "<td><input type=\"text\" name=\"telnr\"></td>\n";
	//echo "<td><input type=\"text\" name=\"postnr\"></td>\n";

	// koll = kortnummer
	//månad = friend1
	//år = friend2
	//cvc = texten
	echo"<br>";
	echo"<br>";
	echo"<br>";
	echo "<legend> Betala </legend>";
	echo"<br>";
	echo '<div class="form-group">';
    echo'<label>Kortnummer</label>';
    echo'<input type="text" name="koll" class="form-control">';
	echo"</div>";
	
	
	
	echo '<div class="row">';
	echo '<div class="ml-3 form-group col-xs-4">';
    echo'<label for="exampleInputEmail1">Månad </label>';
    echo'<input type="text" name="friend1" class="form-control" >';
	echo"</div>";
	
	echo '<div class="form-group col-xs-4 ml-3">';
    echo'<label for="exampleInputEmail1">År </label>';
    echo'<input type="text" name="friend2" class="form-control" >';
	echo"</div>";
	
	echo '<div class="form-group col-xs-4 ml-3">';
    echo'<label for="exampleInputEmail1">CVC2 </label>';
    echo'<input type="text" name="texten" class="form-control" >';
	echo"</div>";
	
	echo"</div>";
	
	
	//echo "<tr><td>Visiting Time<br><br><input type='date' name='koll'></td></tr>\n";
	
	echo "<td style=\" opacity: 0.0\" >Friend1<br><input style=\" opacity: 0.0\" type='text' ></td>\n";
	echo "<td style=\" opacity: 0.0\">Friend2<br><input type='text' style=\" opacity: 0.0\"></td></table>\n";
	
	
	
	echo"<br>";
	echo "<label> Comments or Special needs </label>";
	echo "<br>";
	//echo "<textarea name=\"texten\" rows=\"3\" Cols=\"80\" style=\"width:100%\"></textarea><br>\n";
	echo"<br>";
	
	//echo "<input type=\"text\" name=\"koll\" size=1 maxlength=3> $fel ";
	echo " <input type=\"submit\" name=\"Submit\" value=\"Skicka\">\n";
	echo "<input type=\"reset\" name=\"reset\" value=\"Radera\">\n";
	
	echo "</form>\n";


	
	echo "</td></tr></table>\n";
	//$_POST['texten'] = "";    // Raderar $texten, förhindrar dubbelpost.
	echo"<a class='link' href='index.php'> Return Home  </a>";
	echo "</BODY></HTML>\n";
?>


