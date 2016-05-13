<?php
require 'vendor/autoload.php';
class elastic {
	function getClient()
	{
		$configParams = [
			'hosts' => ['localhost:9200'],
			'retries' => 3
		];
		try {
			return (Elasticsearch\ClientBuilder::fromConfig($configParams));
		} catch (Exception $e) {
			return null;
		}
	}
}
$es=new elastic();
?>
