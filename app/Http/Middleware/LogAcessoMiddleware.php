<?php

namespace App\Http\Middleware;

use Closure;
use App\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $request - manipular
        //return $next($request);
        // $response - manipular
        //return Response('Chegamos no middleware, hello middleware.');        

        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();

        LogAcesso::create(array(
            'log' => "IP $ip acessou a rota $rota"
        ));

        $resposta = $next($request);

        $resposta->setStatusCode(201, 'Você conseguiu');
        
        return $resposta;
    }
}