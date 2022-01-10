<?php

declare(strict_types=1);

namespace App\Http\Action;

use Nyxio\Contract\Http\Method;
use Nyxio\Http;
use Nyxio\Routing\Attribute\Route;
use Nyxio\Routing\Attribute\RouteGroup;
use Psr\Http\Message\ResponseInterface;

#[Route(
    method: Method::GET,
    uri: '/hello',
)]
#[RouteGroup(name: 'api')]
class Hello
{
    public function handle(Http\Request $request, Http\Response $response): ResponseInterface
    {
        return $response->json(
            [
                'my name' => 'nyxio 🚀',
                'your code' => 'amazing',
            ]
        );
    }
}
