<?php

namespace common\modules\chat\controllers;

use common\modules\chat\components\Chat;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;

/**
 * Default controller for the `chat` module
 */
class DaemonController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8082
        );

        echo 'Start' . PHP_EOL;
        //$server->loop->addPeriodicTimer(2, function () {
        //    echo date('H:i:s') . PHP_EOL;
        //});

        $server->run();

        //$server = IoServer::factory(
        //    new Chat(),
        //    8082
        //);
        //
        //$server->run();
    }
}
