<?php

namespace src\Admin\Process;

use swoole_process;
use Group\Process;
use Group\Sync\Dao\Dao;
use Group\Sync\SyncApp;
use Group\Protocol\Protocol;
use Group\Protocol\Client;

class HeartbeatProcess extends Process
{
	public function register()
	{	
		$server = $this->server;
		$process = new swoole_process(function($process) use ($server) {
			$app = new SyncApp();
			$dao = new Dao();
		    //心跳检测
			$server->tick(5000, function() use ($dao) {
				$sql = "SELECT ip,port FROM `nodes` WHERE status = 'active'";
		        $res = $dao->querySql($sql, 'default')->fetchAll();

		        foreach ($res as $serv) {
		        	$client = new Client($serv['ip'], $serv['port']);
		        	$client = $client->getClient();
		        	$client->setTimeout(5);
		        	$client->setData(Protocol::pack('ping'));
					$client->call(function($response, $error, $calltime) use ($serv, $dao) {
						//服务挂了，或者异常了
					    if (!$response) {
					    	$ip = $serv['ip'];
					    	$port = $serv['port'];
					    	$sql = "UPDATE `nodes`  SET `status` = 'unactive' WHERE ip = '{$ip}' and port = '{$port}'";
					    	$dao->querySql($sql, 'default');
					    }
					});
		        }
		        
		    });
		});

		return $process;
	}
}