<?php
/**
 * Created by PhpStorm.
 * User: luisfernando
 * Date: 16/04/2017
 * Time: 18:58
 */

namespace Api;
use \Slim\Slim as Slim;

Class RouteDumper extends \Slim\Router {
    public static function getAllRoutes() {
        $app_routes = Slim::getInstance();
        $routes_array = [];
        $routes = $app_routes->router->routes;
        foreach ($routes as $key => $route){
           $routes_array[] = $route->getPattern();
        }

       return['total' => count($routes_array), 'rotas' => $routes_array];
    }
}