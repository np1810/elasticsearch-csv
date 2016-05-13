<?php
require_once("elasticClient.php");
$res["status"] = "fail";

if (isset($_GET["district"]) && isset($_GET["state"]) && !empty($_GET["district"]) && !empty($_GET["state"]))
{
	$district = htmlspecialchars($_GET["district"]);
	$state = htmlspecialchars($_GET["state"]);
	$client = $es->getClient();
	$json = '{"query":{"bool":{"must":[{"match":{"district":"'.$district.'"}},{"match":{"state":"'.$state.'"}}]}}}';
	$searchParams = ['index'=>'data','type'=>'pin','body'=>$json];
	if (is_null($client)) {
		$res["error"] = "Exception Occurred!";
	} else {
		$res = $client->search($searchParams);
		$res["status"] = "success";
	}
}

else if (isset($_GET["district"]) && !empty($_GET["district"]))
{
	$district = htmlspecialchars($_GET["district"]);
	$client = $es->getClient();
	$json = '{"query":{"bool":{"must":[{"match":{"district":"'.$district.'"}}]}}}';
	$searchParams = ['index'=>'data','type'=>'pin','body'=>$json];
	if (is_null($client)) {
		$res["error"] = "Exception Occurred!";
	} else {
		$res = $client->search($searchParams);
		$res["status"] = "success";
	}
}

else if (isset($_GET["q"]) && !empty($_GET["q"]))
{
	$q = htmlspecialchars($_GET["q"]);
	
	$searchParams = ['index'=>'data','type'=>'pin','q'=>$q];
	if (is_null($client)) {
		$res["error"] = "Exception Occurred!";
	} else {
		$res = $client->search($searchParams);
		$res["status"] = "success";
	}
}

else
{
	$res["status"] = "fail";
	$res["error"] = "Incorrect Parameters Specified!";
}

header('Content-type: text/javascript');
if (isset($_GET["pretty"]))
	echo json_encode($res, JSON_PRETTY_PRINT);
else
	echo json_encode($res);
?>
