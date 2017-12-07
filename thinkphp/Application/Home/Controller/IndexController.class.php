<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{

    private $server;
    private $swoole_server_bind;

    public function index()
    {
        echo "swoole server: " . SWOOLE_VERSION;
    }

    public function server()
    {
        $this->swoole_server_bind = C('SWOOLE_SERVER_BIND');
        $swoole_server_option = C('SWOOLE_SERVER_OPTION');

        $this->server = new \Swoole\Server($this->swoole_server_bind['ip'], $this->swoole_server_bind['port']);
        $this->server->set($swoole_server_option);

        $this->server->on('Start', array($this, 'onStart'));
        $this->server->on('Connect', array($this, 'onConnect'));
        $this->server->on('Receive', array($this, 'onReceive'));
        $this->server->on('Task', array($this, 'onTask'));
        $this->server->on('Finish', array($this, 'onFinish'));
        $this->server->on('Close', array($this, 'onClose'));

        $this->server->start();
    }

    public function onStart(\Swoole\Server $server)
    {
        $time = date('Y-m-d H:i:s');
        echo "[$time]Start Swoole Server " . SWOOLE_VERSION . "\n";
        echo "bind ip:{$this->swoole_server_bind['ip']}, {$this->swoole_server_bind['port']}";
    }

    public function onConnect(\Swoole\Server $server, $fd, $from_id)
    {
        echo "Connect From Client:$from_id\n";
    }

    public function onReceive(\Swoole\Server $server, $fd, $reactor_id, $data)
    {
        echo "Get Message From Client {$fd}:{$data}\n";
        $task_id = $server->task($data);
        $server->send($fd, "You job id:$task_id\n");
    }

    public function onTask(\Swoole\Server $server, $task_id, $from_id, $data)
    {
        try {
            $msg = "start task with data:$data";
            $this->invokeLog($msg, $task_id);
            $obj = json_decode($data);
            $_controller = $obj->controller;
            $method = $obj->method;
            if (!empty($_controller) && !empty($method)) {
                $_controller = 'Home\\Controller\\' . $_controller;
                $rc = new \ReflectionClass($_controller . 'Controller');
                $hasMethod = $rc->hasMethod($method);
                if ($hasMethod) {
                    $instance = $rc->newInstance();
                    $_method = $rc->getMethod($method);
                    $_invoke = $_method->invoke($instance, $data, $server);
                    if (!is_string($_invoke))
                        $_invoke = json_encode($_invoke);
                    $server->Finish($_invoke);
                } else {
                    $msg = "error task->not found method:$method";
                    $this->invokeLog($msg, $task_id);
                }

            } else {
                $msg = "error task-> not found Controller or Method";
                $this->invokeLog($msg, $task_id);
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage() . "\n";
            $this->invokeLog($ex->getMessage() . '<-->' . $ex->getTraceAsString(), $task_id);;
        }
    }

    public function onFinish(\Swoole\Server $server, $task_id, $data)
    {
        $msg = "task finished:$data";
        echo $msg . "\n";
        $this->invokeLog($msg, $task_id);
    }

    public function onClose(\Swoole\Server $server, $fd, $from_id)
    {
        echo "Client {$fd} close connection\n";
    }

    private function invokeLog($message, $task_id)
    {
        $api_log = 'Swl_Server_LOG_';
        $destination = C('LOG_PATH') . $api_log . date('y_m_d') . '.log';
        $now = date('Y-m-d H:i:s');
        error_log("[{$now}] task:[$task_id]:\r\n{$message}\r\n", 3, $destination);
        //Log::write('RETURN_DATA:'.$message,Log::INFO,'',$destination);
    }
}