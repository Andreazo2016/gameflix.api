<?php
namespace Api\Middleware;

class Auth{

    public function __invoke($app)
    {
        return function () use ( $app ) {


            $app->redirect('/api.sippa/api/erro');

        };
    }
}