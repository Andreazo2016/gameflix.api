<?php

use Illuminate\Container\Container as Container;
use Illuminate\Database\Connectors\ConnectionFactory as ConnectionFactory;
use Illuminate\Database\ConnectionResolver as ConnectionResolver;
use Illuminate\Database\Eloquent\Model as Model;


    $settings = array(
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'phpteste',
        'username' => 'root',
        'password' => 'solonopole',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    );

    $container = new Container();
    $connFactory = new ConnectionFactory($container);
    $conn = $connFactory->make($settings);
    $resolver = new ConnectionResolver();
    $resolver->addConnection('default', $conn);
    $resolver->setDefaultConnection('default');
    Model::setConnectionResolver($resolver);

