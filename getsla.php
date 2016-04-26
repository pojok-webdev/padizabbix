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
	
	 $graphs = $api->serviceGetsla(array("serviceids"=>array("1","2"),"intervals"=>array(
						"from"=>1152452201,
						"to"=>1461645184004 
					)));

    // print all graph IDs
    foreach($graphs as $graph){
		foreach($graph as $key=>$val){
			echo "<br />FIRST LEVEL DATA ".$key . "<- and -></->" . $val . "<br />";
			if($key==="problems"){
				echo "has problem ".count($val)." <br />";
				foreach($val as $k=>$v){
					echo $k." =>".$v."<br />";
				}
			}
			if($key==="sla"){
				$slacount = count($val);
				for($i=0;$i<$slacount;$i++){
					echo "from ".$val[$i]->from . ", " ;
					echo "to ". $val[$i]->to . ", " ;
					echo "sla ". $val[$i]->sla . ", " ;
					echo "okTime ". $val[$i]->okTime . ", " ;
					echo "problemTime ". $val[$i]->problemTime . ", " ;
					echo "downtime ". $val[$i]->downtimeTime . "<br />";
				}
			}
		}
	}
        
    /* ... do your stuff here ... */
}
catch(Exception $e)
{
    // Exception in ZabbixApi catched
    echo $e->getMessage();
}
?>
