<?php
require_once 'dbconfig.php';

if(isset($_GET['code'])){
$code=$_GET['code'];
//echo $code; 
$sql = sprintf("SELECT url FROM links WHERE code='".$code."' ");
if ($result=mysqli_query($conn,$sql))
  {
  while ($obj=mysqli_fetch_row($result))
    {
	header('Location:'.$obj[0].'');
	die();
	}
  }
header('Location: index.php');
}
?>