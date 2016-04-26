<?php
// load ZabbixApi
require_once 'build/ZabbixApi.class.php';
use ZabbixApi\ZabbixApi;

try
{
    // connect to Zabbix API
    //$api = new ZabbixApi('http://zabbix.confirm.ch/api_jsonrpc.php', 'zabbix_user', 'zabbix_password');
    $api = new ZabbixApi('http://202.6.233.15/zabbix/api_jsonrpc.php', 'puji', 'pujicute2016');
	echo "PadiNET Zabbix sample<br />";
	
	 $graphs = $api->graphItemGet();

    // print all graph IDs
    foreach($graphs as $graph){
		foreach($graph as $key=>$val){
			echo $key . " and " . $val . "<br />";
		}
/*        echo "Graphids".$graph->graphids." => ";
        echo "Getitemids".$graph->getitemids."<br />";
        echo "ITEMIDS ".$graph->itemids."<br />";*/
	}
        
    /* ... do your stuff here ... */
}
catch(Exception $e)
{
    // Exception in ZabbixApi catched
    echo $e->getMessage();
}
?>
