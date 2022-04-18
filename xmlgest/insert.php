<?php

include('xml_class.php');
include('constant.php');

//creat a object og class xml_opration
$xml = new xml_opration;

$title = $xml->formatXmlString($_POST['title']);
$author = $xml->formatXmlString($_POST['author']);
$content = $xml->formatXmlString($_POST['content']);
$picture = $_POST['picture'];
$id = (int)$_POST['id'] + 1;
/* $idInt = 1;
$id = "$_POST['id']-$idInt"; */

$xml->insertXmlFile($id, $title, $author, $content, $picture);

$xml->writeXmlFile();

header("location:index.php");

?>