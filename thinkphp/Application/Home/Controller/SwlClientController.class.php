<?php

namespace Home\Controller;

use Think\Controller;

class SwlClientController extends Controller
{
    private $client;
    private $swoole_server_bind;

    public function index()
    {
    }

    public function run()
    {
        $this->initSwlClient();
        $this->scan();
    }

    private function scan()
    {
        $this->client->send(json_encode(array('userid' => 1, 'controller' => 'Scan', 'method' => 'index')) . "\n");
        while (1) {
            $message = $this->client->recv();
            if ($message) {
                echo "Get Message From Server:{$message}\n";
                break;
            }
        }
    }

    private function initSwlClient()
    {
        $this->swoole_server_bind = C('SWOOLE_SERVER_BIND');
        $this->client = new \Swoole\Client(SWOOLE_SOCK_TCP);
        $this->client->connect($this->swoole_server_bind['ip'], $this->swoole_server_bind['port'], 0.5);
    }
}
