<?php
function get_domain($url)
{
  $pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $regs['domain'];
  }
  return false;
}

require_once 'dbconfig.php';
//$conn=mysqli_connect("localhost","root","","grassroots",'3307') or die(mysqli_connect_error());

if(isset($_GET['longUrl']) && isset($_GET['shortName'])){
$longUrl= $_GET['longUrl'];
$shortName= $_GET['shortName'];
$newurl= "domain_name/shorturl/".$shortName;  // "abc.xy/shorturl/".$shortName; { enter domain name }
if (filter_var($longUrl, FILTER_VALIDATE_URL)) {
    //echo("url is a valid URL");
	$fsql= sprintf("SELECT id FROM links WHERE url='".$longUrl."' OR code='".$shortName."'");
	$fres=mysqli_query($conn,$fsql);
	$fcount =mysqli_num_rows($fres);
	if($fcount==0)  //no copy of code or url exist
	{
	$sql = sprintf("SELECT id FROM links WHERE url='".$longUrl."' AND code='".$shortName."'");
	$res=mysqli_query($conn,$sql);
	$count =mysqli_num_rows($res);
	if($count>=1){
		$arr=array("result"=>"failure",
		"message"=>"similar url exist"
		);
		$arr = json_encode($arr,JSON_UNESCAPED_SLASHES);
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		echo $arr;
	}else{
		$sql1 = sprintf("INSERT INTO `links`(`url`, `newurl`,`code`) VALUES ('".$longUrl."','".$newurl."','".$shortName."')");
		$res=mysqli_query($conn,$sql1);
		$arr=array("result"=>"success",
		"longUrl"=>"$longUrl",
		"shorturl"=>"$newurl"
		);
		$arr = json_encode($arr,JSON_UNESCAPED_SLASHES);
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		echo $arr;
	}
}
else{
	$arr=array("result"=>"failure",
		"message"=>"similar url or code exist in db"
		);
		$arr = json_encode($arr,JSON_UNESCAPED_SLASHES);
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		echo $arr;
}

} else {
    $arr=array("result"=>"failure",
	"message"=>"Url is not a valid"
	);
	$arr = json_encode($arr,JSON_UNESCAPED_SLASHES);
	header('Cache-Control: no-cache, must-revalidate');
	header('Content-type: application/json');
	echo $arr;
}

}
?>