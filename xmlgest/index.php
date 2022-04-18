<?php

/////////////////////////////////////////////////////////////////////
//
//     this is the index page of guestbook
//     it display records on page and format them with HTML tags
//     last modify was on 2020-12-27
//
/////////////////////////////////////////////////////////////////////


include('xml_class.php');
include('constant.php');

ini_set('display_errors', 0);

//creat a object of class xml_opration
$xml = new xml_opration;
$xml->xmlFormat();
$xml->page();

//display records for appointed count
$data = $xml->xmlPartFormat($page,$pagecount);

echo "<html>
         <head>
            <title>".PAGE_TITLE."</title>
			<link rel=\"stylesheet\" href=\"style.css?v=<?php echo time(); ?>\">
			<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
			<script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js'></script>		
			<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>		
			<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js'></script>
			<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>			
         </head>
        <body bgcolor='#FFFBDA'>
		<div class='row justify-content-center m-4'>
		<a href='../index.php' style='text-decoration:none; color:black;'><h2 style='font-family:Rockit;' class='pt-3 logo'> Auditar </h2></a>
		</div>";
echo "<table class='table1'>";
echo "<tr align=center class=title><td>".PAGE_TITLE."</td></tr>";
echo "</table><br>";
echo "<table class='table1' width='50%' border-collapse='collapse' align=center border=0 cellpadding=5 cellspacing=1>";


//////////////////////////////////////////////////
//  traversal the array $data                   //
//  and get attributes or values of every node  //
//  at last display these data and format them  //
//////////////////////////////////////////////////

$i = 1;
/* echo '<pre>' . var_export($data, true) . '</pre>'; */
foreach($data as $val){
    //print_r($val);
    if ($val['tag'] == 'root' && $val['type'] == 'open')
      continue;
    if ($val['tag'] == 'root' && $val['type'] == 'close')
      break;
    if ($val['tag'] == 'subject' && $val['type'] == 'open'){
           $id = $val['attributes']['id'];
           continue;
    }

    if ($val['tag'] == 'title'){
        $title = $val['value'];
        /* echo "<br>Title: ".$title; */
        continue;
    }
    if ($val['tag'] == 'author'){
        $author = $val['value'];
        /* echo "<br>Author: ".$author; */
        continue;
    }
    if ($val['tag'] == 'content'){
        $content = $val['value'];
        /* echo "<br>Content: ".$content; */
        continue;
    }
    if ($val['tag'] == 'time'){
        $time = $val['value'];
        /* echo "<br>Time: ".$time; */
        continue;
    }
    if ($val['tag'] == 'picture'){
        $picture = $val['value'];
        /* echo "<br>Picture: ".$picture; */
        continue;
    }

    if ($i == 1 && $page == 1)
        echo "<tr class='text'><td><a href='rss.xml' target='_BLANK'>xml</a></td><td align='right'><a href='creatnew.php?id=$id'>".NEW_LEAVE_WORD."</a></td></tr>";
    elseif ($i == 1 && $page != 1)
        echo "<tr class='text'><td><a href='rss.xml' target='_BLANK'>xml</a></td><td align='right'>".WANT_CEART_WORD."</td></tr>";
    //format data with HTML tags
    echo "
         <tr class='text' bgcolor='#D3D3D3'> 
             <td style='white-space: nowrap; border-radius:10px width: 1px;' rowspan='2'><img src='images/person/".$picture.".gif'</td>
             <th style='font-size:15px; '>".$author."</th>
			 
			 
			 
         </tr></td></tr>
         
		 <tr bgcolor='#D3D3D3' class='text'>
             
			 <td >".$time."</td>
             
		 </tr>
		 
		 <tr bgcolor='#D3D3D3'>
			<td> </td>
			<th style='padding-top:20px'>".$title."</th>
		 </tr>
		 
		 
		 
		 <tr bgcolor='#D3D3D3'>
			<td> </td>
            <td colspan='1' rowspan='2'>".$content."</td>
         </tr>
		 <tr>
		 </tr>
         <tr align='right' class='text'>
             <td colspan='2'>
			 <a href='modify.php?id=$id'><i class='material-icons' style='font-size:28px;'>edit </i></a>&nbsp;&nbsp;
			 <a href='delete.php?id=$id'> <i class='material-icons' style='font-size:28px;'>delete </i> </a>
			 </td>
         </tr>";
    $i++;
    if ($val['tag'] == 'subject' && $val['type'] == 'close')
      continue;
}

//Here is the pagenite system in depth of page

//echo "<tr class=text><td>".TOTAL_RECORD_FRONT.$pagecount.PAGE.$total.TOTAL_RECORD_BACK."</td>";
echo "<td colspan='2' align=right>".$pagestring."&nbsp;";
$select="<select onchange=\"location='?page='+this.options[this.selectedIndex].value\">";
    for ($i=1;$i<=$pagecount;$i++){
    $select.="<option value='$i'".(($i==$page)?' selected':'').">".$i."</option>";
    }
$select.="</select></td></tr>";
echo $select;

echo "</table>";
echo "<table width='70%' align='center' cellpadding='5' cellspacing='1'>";
echo "</table><br>";
echo "</body>";
echo "</html>";


?>