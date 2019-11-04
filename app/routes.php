<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
require __DIR__ .'/../vendor/RedBean/rb.php';

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

/**
 * EXAMPLE FOR ORM PERSIST
 */
/*
    $app->get('/car', function(Request $request, Response $response){
        $s=$this->get('ORM-S');
        R::setup($s->getConection(), $s->getUsuario(), $s->getPassword());
        //R::setup('mysql:host=127.0.0.1;port=3308;dbname=WsTest', 'root', '');
        $w = R::dispense('car');
        $w->name = 'Lobo del aire';
        $w->marca= 'Helicoptero';
        $w->modelo = 'A4 color negro y blanco';
        $id = R::store($w);
     $response->getBody()->write('hola mundo id='.$id);

        return $response;
    });

*/
    $app->post('/RequestPersist', function (Request $request, Response $response){
       
        $s = $this->get('ORM-S');
        R::setup($s->C(),$s->U(), $s->P());
        $m = R::dispense('log');
        $m->ontentType=$request->getHeaderLine('Content-Type');
        $m->body=file_get_contents('php://input');
        $m->date=date('Y-m-d H:i:s');
        /*
        */
        $uri = $request->getUri();
        $m->scheme=$uri->getScheme();
        $m->authority=$uri->getAuthority();
        $m->userInfo=$uri->getUserInfo();
        $m->host=$uri->getHost();
        $m->port=$uri->getPort();
        $m->path=$uri->getPath();
        $m->query=$uri->getQuery();
        $m->fragment=$uri->getFragment();

        /**
         * 
         */

        $stringHeader='';
        $headers = $request->getHeaders();
        foreach ($headers as $name => $values) {
            $stringHeader.=$name . ": " . implode(", ", $values);
            }


        $response->getBody()->write($stringHeader);
        R::store($m);
       
        return $response;

    });

};
