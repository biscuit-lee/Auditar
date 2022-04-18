<?php

include ('constant.php');
$id = $_GET['id'];
echo "<html>
         <head>
            <title>php&xml guestbook</title>
            <link rel='stylesheet' href='style.css'>
			<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
			<script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js'></script>		
			<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>		
			<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js'></script>
			<link rel='stylesheet' href='style.css?v=<?php echo time(); ?>'>
         </head>
         <body bgcolor='#FFFBDA'>";
		echo "<div class='row justify-content-center m-4'>
			<a href='../index.php' style='text-decoration:none; color:black;'><h2 style='font-family:Rockit;' class='pt-3 logo'> Auditar </h2></a>
			</div>";
		echo "<div class='container-fluid center'>";
		echo "<form action='insert.php' method='post' name='form1' onsubmit='return check()'>";
		echo "<input type='hidden' class='form-control' name='id' value='$id'><br>";
		echo WORD_AUTHOR."<input type='text' class='form-control' name='author'><br>";
		echo WORD_TITLE."<input type='text' class='form-control' name='title'><br>";

		echo WORD_CONTENT."<textarea class='form-control' name='content' cols='40' rows='5'></textarea><br><br>";
		echo SELECT_HEAD_PIC."<br><br>
      <img src='images/person/1.gif'><input type='radio' name='picture' value='1' checked>&nbsp;&nbsp;&nbsp;
      <img src='images/person/2.gif'><input type='radio' name='picture' value='2'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/3.gif'><input type='radio' name='picture' value='3'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/4.gif'><input type='radio' name='picture' value='4'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/5.gif'><input type='radio' name='picture' value='5'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/6.gif'><input type='radio' name='picture' value='6'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/7.gif'><input type='radio' name='picture' value='7'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/8.gif'><input type='radio' name='picture' value='8'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/9.gif'><input type='radio' name='picture' value='9'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/10.gif'><input type='radio' name='picture' value='10'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/11.gif'><input type='radio' name='picture' value='11'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/12.gif'><input type='radio' name='picture' value='12'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/13.gif'><input type='radio' name='picture' value='13'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/14.gif'><input type='radio' name='picture' value='14'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/15.gif'><input type='radio' name='picture' value='15'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/16.gif'><input type='radio' name='picture' value='16'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/17.gif'><input type='radio' name='picture' value='17'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/18.gif'><input type='radio' name='picture' value='18'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/19.gif'><input type='radio' name='picture' value='19'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/20.gif'><input type='radio' name='picture' value='20'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/21.gif'><input type='radio' name='picture' value='21'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/22.gif'><input type='radio' name='picture' value='22'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/23.gif'><input type='radio' name='picture' value='23'>&nbsp;&nbsp;&nbsp;
      <img src='images/person/24.gif'><input type='radio' name='picture' value='24'><br><br>";
echo "<input type='submit' class=' btn btn-success' value='".SUBMIT_BUTTON."'>";
echo "</form>";
echo "</table></body>";
echo "</html>";

?>

<SCRIPT language=javascript>
function check()
{

        if (document.form1.title.value=="")
           {
                alert("please enter title");
                form1.title.focus();
                return false;
           }
        if (document.form1.author.value=="")
           {
                alert("please enter author");
                form1.author.focus();
                return false;
           }
        if (document.form1.content.value=="")
           {
                alert("please enter content");
                form1.content.focus();
                return false;
           }

}
</SCRIPT>