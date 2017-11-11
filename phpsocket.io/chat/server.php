<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Workerman\Worker;
use PHPSocketIO\SocketIO;

// 创建socket.io服务端，监听2021端口
$io = new SocketIO(3120);
// 当有客户端连接时打印一行文字
$io->on('connection', function($socket)use($io){
    echo "new connection coming\n";
//    $socket->on('chat message', function($msg)use($io,$socket){
//        // 触发所有客户端定义的chat message from server事件
//        echo $msg;
////        $msg = "hahah";
////        $connection->join('group name');
//        $socket->emit('chat message from server', $msg);
////        $socket->emit('authenticated',"true");
//        $io->emit('test_server', $msg);
//        $socket->broadcast->emit('test_broadcast', "wwertewrtewrtewrt");
//    });

    $socket->on('authentication', function ($data) use ($io,$socket){
        $group = null;
        $username = $data['username'];
        $password = $data['password'];
//        $io->emit('chat message from server', "true");
        if ($password=="secret") {
            echo "login success";
            $socket->emit('authenticated',true);
            $socket->on('change name',function ($name)use(&$username){
                $username = $name;
                var_dump($username);
            });

            $socket->on('select group',function ($group2) use (&$group,$io,$socket){
                $group = $group2;
                var_dump("join success".$group);
                $socket->join($group2);
            });

            $socket->on('chat message', function($msg)use(&$group,$io,$socket,&$username){
                // 触发所有客户端定义的chat message from server事件
                $msg = $username.":".$msg;
                var_dump($msg);
                if ($group==null){
                    $io->emit('test_server', $msg);
                }else {
                    var_dump("gggg");
                    $io->to($group)->emit('test_server', $msg);
                }

            });

        }else {
            $socket->emit('authenticated',false);
            $socket->disconnect();
        }
    });
});

Worker::runAll();