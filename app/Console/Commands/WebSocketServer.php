<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;
use App\Chat;


class WebSocketServer extends Command
{
    protected $signature = 'start:websocket-server';
    protected $description = 'Start the WebSocket server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('WebSocket server is starting...');


        $port = 8080;
        $address = '127.0.0.1';

        // WebSocket sunucusunu başlatın
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat() // WebSocket işlevselliğini sağlayan sınıf
                )
            ),
            $port,
            $address
        );

        $this->info("WebSocket server started on {$address}:{$port}");

        // WebSocket sunucusunu çalıştırın
        $server->run();
    }
}
