
<!--admin-->

<?php                  // Uppdaterad 26 juli 2018


$fnamn = "data/gastbok.txt";        // Filen som skall ändras (med sökväg).
if (file_exists($fnamn)) {
	if (isset ($_REQUEST["spara"])) {    // Spara ändringar:
		$r = $_POST['r']; $nr = $_POST['nr'];     // r=radnr. nr=del på raden.
		$fil = file($fnamn);
		$raden = explode('|', $fil[$r]);
		for($i = 0; $i<$nr+1; $i++) {
			$raden[$i] = $_POST['c'.$i];         // Hämtar från formulär till raden.
		}
		$raden[2] = stripslashes($raden[2]);
		$raden[2] = str_replace("\r\n", "<br>", $raden[2]);    // Lägger till <br>
		$raden = implode('|', $raden);        // Packar ihop raden.
		$raden = $raden ."\r\n";        // Lägger tillbaka radbrytningen.
		$fil[$r] = $raden;
		$fp = fopen($fnamn, 'w');
		fwrite($fp, implode('', $fil));        // Packar ihop raderna och sparar.
		fclose($fp);

		header("Location:". $_SERVER['PHP_SELF']);    // Till fil efer redigering.
	}
	 
	if (isset ($_REQUEST["radera"])) {            // Raderar rad:
		$innehåll = file($fnamn);
		array_splice ($innehåll, $_REQUEST["radera"], 1);
		$fil = fopen ($fnamn,"w");
		if ($fil)
		{
		
		foreach ($innehåll as $radera) { fputs ($fil, $radera); }
		flock ($fil, 3); fclose ($fil);
		}

		header("Location:". $_SERVER['PHP_SELF']);    // Till fil, som visas efter radering.
	}
	 
	echo "<html><head>
	<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">
	<META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">
	<meta name=\"robots\" content=\"noindex, nofollow\">
	<link rel=\"stylesheet\" href=\"style.css?v=<?php echo time(); ?>\">
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
	<script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js'></script>		
	<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>		
	<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js'></script>
	<title>Redigera gästbok</title></head><body BGCOLOR=\"#99FFFF\">\n";
	
	
	echo "Senast ändrad: ".date("Y-m-d H:i", filemtime($fnamn)).".<br>\n";
	 
	if (isset ($_REQUEST["rad"]))
	{
	 
		echo "<form name=\"edit\" method=\"post\" action=\"$PHP_SELF\">\n";
		echo "<b>Ändra denna post:</b><br>\n";
		$data = file($fnamn);
		$ed = explode('|', $data[$_GET['rad']]);    // Raden som skall ändras.
		foreach($ed as $nr=>$del)
		{
			$rad = $_GET['rad'];                
		}
		$Timenow = date('Y-m-d H:i');
		$ed[2] = str_replace("<br>", "\n", $ed[2]);    // Tar bort <br>.
		echo "<center><table class='t2 center'><tr>\n";
		echo "<td>Date<br><input type=\"text\" size=30 name=\"c0\" value=\"$Timenow\"></td>\n";
		echo "<td>Ort<br><input type=\"text\" size=30 name=\"c1\" value=\"$ed[1]\"></td>\n";
		echo "<td>IP-nummer<br><input type=\"text\" size=30 name=\"c6\" value=\"$ed[6]\"></td></tr><tr>\n";
		echo "<td colspan=3>Text<br><textarea name=\"c2\" rows=10 cols=80 style=\"width:100%\">$ed[2]</textarea></td></tr><tr>\n";
		echo "<td>Namn<br><input type=\"text\" size=30 name=\"c3\" value=\"$ed[3]\"></td>\n";
		echo "<td>E-post<br><input type=\"text\" size=30 name=\"c4\" value=\"$ed[4]\"></td>\n";
		echo "<td>Adress<br><input type=\"text\" size=30 name=\"c5\" value=\"$ed[5]\"></td></tr><tr>\n";
		echo "<td>Date<br><input type=\"text\" size=30 name=\"c7\" value=\"$ed[7]\"></td>";
		echo "<td>TelNr<br><input type=\"text\" size=30 name=\"c8\" value=\"$ed[8]\"></td>";
		echo "<td>PostNr<br><input type=\"text\" size=30 name=\"c9\" value=\"$ed[9]\"></td><tr></tr>";
		echo "<td>Friend 1<br><input type=\"text\" size=30 name=\"c10\" value=\"$ed[10]\"></td>\n";
		echo "<td>Friend 2<br><input type=\"text\" size=30 name=\"c11\" value=\"$ed[11]\"></td></tr><tr>\n";
		
		echo "<input type=\"hidden\" name=\"nr\" value=\"$nr\">\n";
		echo "<input type=\"hidden\" name=\"r\" value=\"$rad\">\n";
		echo "<td colspan=4><input type=\"submit\" name=\"spara\" value=\"Spara\">\n";
		echo "<input type=\"reset\" value=\"Ångra\"></form></td></tr>\n";
		
		echo "</table>\n";
		
	}
	// this is where the table of data get from
	else {
		$data = file($fnamn)Or Die("Filen, $fnamn är tom!<br>\n");
		echo"<h1 class='jumbotron center'> Guest List </h1>";
		asort($data);    // Om raderna skall sorteras.
		echo "<table class='table table-hover center' cellspacing=1>\n";                // Radlista.
		echo "<tr><th></th><th>Edited Last</th><th>Ort</th><th>Namn</th><th>IP-nr</th><th>E-post</th><th>Adress</th><th>Date</th><th>TelNr</th><th>PostNr</th><th>Friend 1</th><th>Friend 2</th></tr>\n";
		echo "<tbody>";
		foreach($data as $index=>$rad)
		{
			$fält = explode("|",$rad);
			echo "<tr valign=top bgcolor=white>\n";
			echo "<td><a class='andralink'href=\"?rad=$index\">Ändra</a> <a class='raderaLink'href=\"?radera=$index\">Radera</a></td>\n";
			echo "<td>$fält[0]</td><td>$fält[1]</td><td>$fält[3]</td><td>$fält[6]</td><td>$fält[4]</td><td>$fält[5]</td></td><td>$fält[7]</td><td>$fält[8]</td><td>$fält[9]</td><td>$fält[10]</td><td>$fält[11]</td>\n";
			echo "</tr>\n";
		}
		echo "</tbody>";
		echo "</table>\n";
	}
	} 
	else {
		echo "Filen:<b> $fnamn </b>finns inte!";
		}
	
	echo"<a class='link' href='index.php'> Return Home  </a>";
	
echo "</body></html>";
?>
